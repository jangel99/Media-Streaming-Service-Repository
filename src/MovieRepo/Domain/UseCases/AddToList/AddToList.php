<?php

namespace App\MovieRepo\Domain\UseCases\AddToList;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\MovieListRepository;

class AddToList extends \App\MovieRepo\Domain\UseCases\UseCase
{

    private MovieListRepository $movieListRepository;

    public function __construct(MovieListRepository $movieListRepository) {
        $this->movieListRepository = $movieListRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $this->movieListRepository->addMovieToList($useCaseRequest->getMovieId(), $useCaseRequest->getUserId());
    }
}