<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SendMailService;
use App\Controller\IngredientController;
use App\Repository\UserRepository;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends AbstractController
{
   // private SendMailService $mailer3;

    public function __construct(private SendMailService $mailer)
    {
      //  $this->mailer3 = $mailer2;
    }
    
    #[Route('/email', name: 'app_email')]
    public function index(): Response //SendMailService $mailer
    {
        $prenom = 'benjamin';
        $nom = 'Sebert';
        $this->mailer->send(
            'no-reply@monsite.net',
            'destinataire@monsite.net',
            'Titre de mon message',
            'test',
            ['prenom' => $prenom, 'nom' => $nom]
        );
        return $this->render('emails/test.html.twig', [
            'prenom' => $prenom,
            'nom' => $nom,
        ]);
    }
    #[Route('/email_tous', name: 'app_email.tous')]
    public function index_tous(UserRepository $repository): Response 
    {
        $utilisateurs = $repository->findAll();
        $this->mailer->dire_bonjour_a_tous($utilisateurs);
        return $this->redirectToRoute('app_ingredient');
    }
    #[Route('/contact', name: 'app_email.contact')]
    public function contact(UserRepository $repository, Request $request): Response 
    {
        $form_contact = $this->createForm(ContactType::class, [ 'submit label' => 'Contacter l\'administrateur']);

        $form_contact->handleRequest($request);

        if($form_contact->isSubmitted() && $form_contact->isValid()) {
            $data = $form_contact->getData();
            // dd($data);
            $adresse = $data["Adresse"];
            $this->mailer->send(
                $adresse,
                'admin@a.com',
                'Demande de contact',
                'contact_context',
                ['Nom' => $data["Nom"], 'nature' => $data["Nature_contact"]]
            );

            $this->addFlash('success', 'L\'administrateur du site a bel et bien été contacté');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('emails/contact.html.twig', [
            'form_contact' => $form_contact->createView(),
        ]);
    }
}
