<?php

namespace App\MovieRepo\Domain\UseCases\insertComment;

use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use App\Repository\ComentsRepository;

class InsertComment extends \App\MovieRepo\Domain\UseCases\UseCase
{
    private ComentsRepository $comentsRepository;

    public function __construct(ComentsRepository $comentsRepository) {
        $this->comentsRepository = $comentsRepository;
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $this->comentsRepository->insertComment(
            $useCaseRequest->getComment(),
            $useCaseRequest->getMovieID(),
            $useCaseRequest->getUserID(),
            $useCaseRequest->getUserName()
        );
    }
}