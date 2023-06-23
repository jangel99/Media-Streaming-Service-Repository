<?php

namespace App\MovieRepo\Domain\UseCases\GenerateHomePage;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\MovieRepository;

class GenerateHomePage extends \App\MovieRepo\Domain\UseCases\UseCase
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        return $this->movieRepository->getMostRatedMovies();
    }
}