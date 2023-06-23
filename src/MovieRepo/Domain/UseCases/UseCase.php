<?php

namespace App\MovieRepo\Domain\UseCases;

abstract class UseCase
{
abstract public function execute(UseCaseRequest $useCaseRequest);
}