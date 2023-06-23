<?php

namespace App\MovieRepo\Domain\UseCases\GenerateServicesPage;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\MovieRepository;

class GenerateServicesPage extends \App\MovieRepo\Domain\UseCases\UseCase
{

    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        return $this->movieRepository->getMovieByLocation($useCaseRequest->getLocation());
    }
}