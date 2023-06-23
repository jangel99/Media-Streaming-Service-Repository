<?php

namespace App\Controller;

use App\MovieRepo\Domain\UseCases\RequestAPI\RequestApi;
use App\MovieRepo\Domain\UseCases\RequestAPI\RequestApiRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/home/{country}/search/{searchValue}', name: 'search')]
    public function search($country, $searchValue, RequestApi $requestApi): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $requestMovieApiRequest = new RequestApiRequest();
        $requestMovieApiRequest->setSearchValue($searchValue);
        $requestMovieApiRequest->setCountry($country);
        $requestApiResponse = $requestApi->execute($requestMovieApiRequest);
        if($requestApiResponse->getStatus()) {
            $movieList = $requestApiResponse->getMovieList();
        } else {
            $movieList = null;
        }
        if($requestApiResponse->getCached()) {
            return $this->redirect("/MoviesRepository/public/home/".$country."/movie/".$requestApiResponse->getId());
        } else {
            return $this->render('search/search.html.twig', [
                'search' => $searchValue,
                'country' => $requestApiResponse->getProject(),
                'movieList' => $movieList,
                'status' => $requestApiResponse->getStatus(),
                'username' => $this->getUser()->getUserIdentifier()
            ]);
        }
    }
}
