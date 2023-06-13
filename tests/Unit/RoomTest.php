<?php

namespace App\Tests\Unit;

use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class RoomTest extends KernelTestCase
{
    //Récupérer l'entité, évite la redondance
    public function getEntity() : Room
    {
        return (new Room())
            ->setTitleRoom('Room #1')
            ->setDateRoom(new \DateTimeImmutable())
            ->setContentRoom('Content #1');
    }

    public function assertHasErrors(Room $room, int $number = 0) {

        self::bootKernel();
        $container = static::getContainer();
        $errors = $container->get('validator')->validate($room);

        //Récupérer les messages d'erreur
        $messages = [];

        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        //Combien d'erreurs sont attendues
        $this->assertCount($number, $errors, implode(', ', $messages));

    }


    public function testEntityIsValid(): void
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidBlankTitleRoom() {

        $this->assertHasErrors($this->getEntity()->setTitleRoom(''), 1);
    }

    public function testInvalidBlankContentRoom() {
        
        $this->assertHasErrors($this->getEntity()->setContentRoom(''), 1);
    }
}
