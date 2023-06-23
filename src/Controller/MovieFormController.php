<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieFormController extends AbstractController
{
    #[Route('/movieForm', name: 'app_movie_form')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $movie = new Movie();

        $form = $this->createFormBuilder($movie)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('project', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Submit Movie'])
            ->getForm();

        return $this->render('movie_form/index.html.twig', [
        ]);
    }
}
