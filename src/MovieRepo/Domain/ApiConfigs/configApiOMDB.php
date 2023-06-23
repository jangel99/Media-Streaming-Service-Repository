<?php

namespace App\MovieRepo\Domain\ApiConfigs;

class configApiOMDB
{

    private string $OMDBkey;

    /**
     * @return string
     */
    public function getOMDBkey(): string
    {
        return $this->OMDBkey;
    }

    /**
     * @param string $OMDBkey
     */
    public function setOMDBkey(string $OMDBkey): void
    {
        $this->OMDBkey = $OMDBkey;
    }

}