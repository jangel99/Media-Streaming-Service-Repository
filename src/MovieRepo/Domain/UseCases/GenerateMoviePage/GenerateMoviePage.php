<?php

namespace App\MovieRepo\Domain\UseCases\GenerateMoviePage;

use App\DTO\GenerateMoviePageResponse\GenerateMoviePageResponse;
use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\ComentsRepository;
use App\Repository\MovieListRepository;
use App\Repository\MovieRepository;
use phpDocumentor\Reflection\Types\True_;

class GenerateMoviePage extends \App\MovieRepo\Domain\UseCases\UseCase
{

    private MovieRepository $movieRepository;
    private ComentsRepository $comentsRepository;
    private MovieListRepository $movieListRepository;

    public function __construct(MovieRepository $movieRepository, ComentsRepository $comentsRepository, MovieListRepository $movieListRepository) {
        $this->movieRepository = $movieRepository;
        $this->comentsRepository = $comentsRepository;
        $this->movieListRepository = $movieListRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $movie = $this->movieRepository->getMovieByCountryAndId($useCaseRequest->getCountry(),$useCaseRequest->getMovieID());
        $comments = $this->comentsRepository->getComments($useCaseRequest->getMovieID());
        $generateMoviePageResponse = new GenerateMoviePageResponse();
        $generateMoviePageResponse->setTitle($movie[0]['name']);
        $generateMoviePageResponse->setDescription($movie[0]['description']);
        $generateMoviePageResponse->setDuration($movie[0]['duration']);
        $generateMoviePageResponse->setYear($movie[0]['year']);
        $generateMoviePageResponse->setRating($movie[0]['rating']);
        $generateMoviePageResponse->setLocation($movie[0]['location']);
        $generateMoviePageResponse->setImg($movie[0]['img']);
        $generateMoviePageResponse->setComments($comments);
        $generateMoviePageResponse->setGenre($movie[0]['genre']);
        $generateMoviePageResponse->setDirector($movie[0]['director']);
        $generateMoviePageResponse->setAcotrs($movie[0]['actors']);

        if($this->movieListRepository->hasList($useCaseRequest->getMovieID(), $useCaseRequest->getUserId())) {
            $generateMoviePageResponse->setIsInList(1);
        } else {
            $generateMoviePageResponse->setIsInList(0);
        }

        return $generateMoviePageResponse;
    }
}