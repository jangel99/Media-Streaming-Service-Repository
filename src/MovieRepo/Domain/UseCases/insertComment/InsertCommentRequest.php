<?php

namespace App\MovieRepo\Domain\UseCases\insertComment;

class InsertCommentRequest extends \App\MovieRepo\Domain\UseCases\UseCaseRequest
{
    private $comment;
    private $movieID;
    private $userID;
    private $userName;

    public function __construct($userID, $movieID, $comment, $userName) {
        $this->userID = $userID;
        $this->movieID = $movieID;
        $this->comment = $comment;
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getMovieID()
    {
        return $this->movieID;
    }

    /**
     * @param mixed $movieID
     */
    public function setMovieID($movieID): void
    {
        $this->movieID = $movieID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }
}