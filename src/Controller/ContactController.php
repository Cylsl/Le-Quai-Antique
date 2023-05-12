<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Classe\Mail_contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/nous-contacter', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('notice', 'Merci de nous avoir contacté. Notre équipe va vous répondre dans les meilleurs délais.');

            $contactFormData = $form->getData();
            $content = $contactFormData['nom'] . '&nbsp;' . $contactFormData['prenom'] . '&nbsp;' . $contactFormData['email'] . '&#160; vous a envoyé le message suivant:<br><br> ' .  $contactFormData['content'];


            $mail = new Mail_contact;
            $mail->send('quaiantiquerestaurant@gmail.com', 'Le Quai Antique', 'Vous avez reçu une nouvelle demande de contact', $content);
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
