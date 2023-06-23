<?php

namespace App\Controller;

use App\MovieRepo\Domain\UseCases\GenerateServicesPage\GenerateServicesPage;
use App\MovieRepo\Domain\UseCases\GenerateServicesPage\GenerateServicesRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('home/services/{location}', name: 'app_services')]
    public function index($location, GenerateServicesPage $generateServicesPage): Response
    {
        $generateServicesPageRequest = new GenerateServicesRequest($location);
        $generateServicesPageResponse = $generateServicesPage->execute($generateServicesPageRequest);

        return $this->render('services/index.html.twig', [
            'location' => $location,
            'username' => $this->getUser()->getUserIdentifier(),
            'movieList' => $generateServicesPageResponse
        ]);
    }
}
