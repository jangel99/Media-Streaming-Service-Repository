<?php

namespace App\MovieRepo\Domain\ApiConfigs;

class configApiUtelly
{
    private $options = [
	CURLOPT_URL => "",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "gzip,deflate",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: utelly-tv-shows-and-movies-availability-v1.p.rapidapi.com",
		"X-RapidAPI-Key: 651810c0cfmshe21ef4b10c7781fp1647d9jsnb97a9d45a403"
	    ],
    ];

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }


}