<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(HttpClientInterface $client): Response
    {
        // /!\ quand y'as pas de constructeurs
        $response = $client->request(
            'GET',
            'https://freefakeapi.io/api/posts'
        );

        $content = $response->toArray();
        // dd($content);
        return $this->render('post/index.html.twig', [
            'posts' => $content,
        ]);
    }
    #[Route('/post_with_token', name: 'app_post_token')]
    public function indexWithToken(HttpClientInterface $client): Response
    {
        $response = $client->request('POST', 'https://freefakeapi.io/authapi/login', [

            'headers' => [
                'Content-Type' => 'application.json',
            ],
            'json' => [
                'username' => 'MikePayne',
                'password' => 'myBeaut1fu11P@ssW0rd!'
            ],
        
            // ...
        ]);
        $content = $response->toArray();

        $token = $content['token'];
        $response2 = $client->request('GET', 'https://freefakeapi.io/authapi/posts', [
            'auth_bearer' => $token,
        ]);

        $content2 = $response2->toArray();
        // dd($content['token']);
        return $this->render('post/index.html.twig', [
            'posts' => $content2,
        ]);
    }
}
