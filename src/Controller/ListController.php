<?php

namespace App\Controller;

use App\MovieRepo\Domain\UseCases\GenerateListPage\GenerateListPage;
use App\MovieRepo\Domain\UseCases\GenerateListPage\GenerateListPageRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('home/list', name: 'app_list')]
    public function index(GenerateListPage $generateListPage): Response
    {
        $movieList = $generateListPage->execute(new GenerateListPageRequest($this->getUser()->getId()));
        return $this->render('list/index.html.twig', [
            'username' => $this->getUser()->getUserIdentifier(),
            'movieList' => $movieList
        ]);
    }
}
