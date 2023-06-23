<?php

namespace App\Controller;

use App\MovieRepo\Domain\UseCases\GenerateHomePage\GenerateHomePage;
use App\MovieRepo\Domain\UseCases\GenerateHomePage\GenerateHomePageRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(GenerateHomePage $generateHomePage): Response
    {
        $generateHomePageResponse = $generateHomePage->execute($generateHomePageRequest = new GenerateHomePageRequest());
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'top' => $generateHomePageResponse,
            'username' => $this->getUser()->getUserIdentifier()
        ]);
    }
}
