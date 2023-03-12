<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/profile')]
class ProfileController extends AbstractController
{

    #[Route('/', name: 'app_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        $user = $this->getUser();
        $address = $user->getAddress();
        $city = $address->getCity();
        $country = $city->getCountry();
        return $this->render('profile/show.html.twig', [
            'user' => $user,
            'address' => $address,
            'city' => $city,
            'country' => $country,
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
             /** @var UploadedFile $picture */
             $picture = $form->get('picture')->getData();

             // this condition is needed because the 'picture' field is not required
             // so the PDF file must be processed only when a file is uploaded
             if ($picture) {
                 $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                 // this is needed to safely include the file name as part of the URL
                 $safeFilename = $slugger->slug($originalFilename);
                 $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();
 
                 // Move the file to the directory where brochures are stored
                 try {
                     $picture->move(
                         $this->getParameter('pictures_directory'),
                         $newFilename
                     );
                 } catch (FileException $e) {
                     // ... handle exception if something happens during file upload
                 }
 
                 // updates the 'picturename' property to store the PDF file name
                 // instead of its contents
                 $user->setPicture($newFilename);
             }
            
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profile_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
