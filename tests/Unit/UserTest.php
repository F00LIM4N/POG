<?php

namespace App\Tests\Unit;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    public function getEntity() : User
    {
        return (new User())
            ->setEmail('test@email.com')
            ->setRoles([0])
            ->setPassword('Abcd@123')
            ->setLastname('Nom')
            ->setFirstname('Prénom')
            ->setPseudo('Pseudo')
            ->setDateBirth(new DateTime())
            ->setDescription('Description de test')
            ->setIsMailValid(true)
            ->setPhone('0102030405');
    }

    public function assertHasErrors (User $user, int $number = 0) 
    {
            self::bootKernel();
            $container = static::getContainer();
            $errors = $container->get('validator')->validate($user);

            //Récupérer les messages d'erreur
            $messages = [];

            /** @var ConstraintViolation $error */
            foreach($errors as $error) {
                $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
            }

            $this->assertCount($number, $errors, implode(' | ', $messages));
    }

    public function testInvalidBlank() {
        
        $this->assertHasErrors($this->getEntity()->setEmail(''), 1);
        $this->assertHasErrors($this->getEntity()->setPassword(''), 1);
        $this->assertHasErrors($this->getEntity()->setLastname(''), 1);
        $this->assertHasErrors($this->getEntity()->setFirstname(''), 1);
        $this->assertHasErrors($this->getEntity()->setPseudo(''), 1);
        $this->assertHasErrors($this->getEntity()->setPhone(''), 1);

    }
}
