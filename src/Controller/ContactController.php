<?php

namespace App\Controller;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $mail = new PHPMailer(true); {
            try {

                // $mail ->SMTPDebug = SMTP::DEBUG_SERVER;

                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ing.topaz@gmail.com';
                $mail->Password   = 'kztkaawsrdtveuyb';
                //SMTP username
                //Enable SMTP authentication
                // $from = $request->request->get('from');

                $mail->setFrom("no-reply@site.fr");
                // dd($from);



                $to = 'ing.topaz@gmail.com';
                $mail->addAddress($to);

                $subject = $request->request->get('subject');
                $body = $request->request->get('body');


                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->isHTML();

                $attachment = $request->files->get('attachment');
                if ($attachment instanceof UploadedFile) {
                    $mail->addAttachment($attachment->getPathname(), $attachment->getClientOriginalName());
                }

                $mail->send();


                echo 'message has been sent';
                // dd($from);

            } catch (Exception $e) {
                $message = [
                    'text' => 'An error occurred while sending the email: ' . $mail->ErrorInfo,
                    'type' => 'danger',
                ];
            }
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
