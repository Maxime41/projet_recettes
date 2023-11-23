<?php

namespace App\Service;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendMailService
{
    public function __construct(private MailerInterface $mailer)
    {

    }
    public function send(
        string $from,
        string $to,
        string $subject,
        string $template,
        array $context
    ): void
    {

        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("emails/$template.html.twig")
            ->context($context);
            
        // On envoie le mail
        $this->mailer->send($email);
    }
    //Dire bonjour à tous
    public function dire_bonjour_a_tous($utilisateurs){
        foreach ($utilisateurs as $utilisateur) {
            $email_tous = (new TemplatedEmail())
            ->from("admin@a.com")
            ->to($utilisateur->getEmail())
            ->subject("Coucou")
            ->htmlTemplate("emails/test.html.twig")
            ->context(['prenom' => $utilisateur->getNom(),'nom' => $utilisateur->getPrenom()]);
            
            // On envoie le mail à tout le monde avec le foreach
            $this->mailer->send($email_tous);
        }
    }  
    public function dire_bonjour($utilisateur){
        // $vrai_utilisateur =  $repository->find_utilisateur($utilisateur);
        // Methode d'envoie de mail à la connexion (quand ca passe dans AppAuthentificator.php)
        $email_bonjour = (new TemplatedEmail())
            ->from("no-reply@monsite.net")
            ->to($utilisateur->getEmail())
            ->subject("Bonjour")
            ->htmlTemplate("emails/connexion.html.twig")
            ->context(['prenom' => $utilisateur->getNom(),'nom' => $utilisateur->getPrenom(), 'adresse' => $utilisateur->getEmail()]);
            
            // On envoie le mail à la personne qui se connecte
            $this->mailer->send($email_bonjour);
        
    }
}