<?php

namespace App\Controller;

use App\MovieRepo\Domain\UseCases\AddToList\AddToList;
use App\MovieRepo\Domain\UseCases\AddToList\AddToListRequest;
use App\MovieRepo\Domain\UseCases\DeleteComment\DeleteComment;
use App\MovieRepo\Domain\UseCases\DeleteComment\DeleteCommentRequest;
use App\MovieRepo\Domain\UseCases\GenerateMoviePage\GenerateMoviePage;
use App\MovieRepo\Domain\UseCases\GenerateMoviePage\GenerateMoviePageRequest;
use App\MovieRepo\Domain\UseCases\insertComment\InsertComment;
use App\MovieRepo\Domain\UseCases\insertComment\InsertCommentRequest;
use App\MovieRepo\Domain\UseCases\RemoveFromList\RemoveFromList;
use App\MovieRepo\Domain\UseCases\RemoveFromList\RemoveFromListRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('home/{country}/movie/{movieID}', name: 'app_movie')]
    public function index($country, $movieID, GenerateMoviePage $generateMoviePage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $generateMoviePageResponse = $generateMoviePage->execute(new GenerateMoviePageRequest(
            $country,
            $movieID,
            $this->getUser()->getId()
        ));


        return $this->render('movie/index.html.twig', [
            'title' => $generateMoviePageResponse->getTitle(),
            'description' => $generateMoviePageResponse->getDescription(),
            'year' => $generateMoviePageResponse->getYear(),
            'img' => $generateMoviePageResponse->getImg(),
            'location' => $generateMoviePageResponse->getLocation(),
            'duration' => $generateMoviePageResponse->getDuration(),
            'rating' => $generateMoviePageResponse->getRating(),
            'id' => $movieID,
            'country' => $country,
            'comments' => $generateMoviePageResponse->getComments(),
            'username' => $this->getUser()->getUserIdentifier(),
            'userid' => $this->getUser()->getId(),
            'isInList' => $generateMoviePageResponse->getIsInList(),
            'genre' => $generateMoviePageResponse->getGenre(),
            'director' => $generateMoviePageResponse->getDirector(),
            'actors' => $generateMoviePageResponse->getAcotrs()
        ]);
    }

    #[Route('home/comment', name: 'comment')]
    public function addComment(InsertComment $insertComment) {
        $user = $this->getUser();

        $insertComment->execute(new InsertCommentRequest(
            $user->getId(),
            $_POST['id'],
            $_POST['comment'],
            $user->getUserIdentifier()
        ));

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->redirect('/MoviesRepository/public/home/'. $_POST['country'].'/movie/'. $_POST['id']);
    }

    #[Route('home/uncomment', name: 'uncomment')]
    public function unComment(DeleteComment $deleteComment) {

        $deleteComment->execute(new DeleteCommentRequest(
            $_POST['commentId']
        ));
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->redirect('/MoviesRepository/public/home/'. $_POST['country'].'/movie/'. $_POST['id']);
    }

    #[Route('home/addToList', name: 'addToList')]
    public function addToList(AddToList $addToList) {

        $addToList->execute(
            new AddToListRequest(
                $_POST['id'],
                $this->getUser()->getId()
            )
        );

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->redirect('/MoviesRepository/public/home/'. $_POST['country'].'/movie/'. $_POST['id']);
    }

    #[Route('home/removeFromList', name: 'removeFromList')]
    public function removeFromList(RemoveFromList $removeFromList) {

        $removeFromList->execute(
            new RemoveFromListRequest(
                $_POST['id'],
                $this->getUser()->getId()
            )
        );

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->redirect('/MoviesRepository/public/home/'. $_POST['country'].'/movie/'. $_POST['id']);
    }
}
