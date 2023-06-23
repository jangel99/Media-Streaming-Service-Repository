<?php

namespace App\MovieRepo\Domain\UseCases\RequestAPI;

use App\DTO\RequestAPIResponse\RequestApiListDTO;
use App\DTO\RequestAPIResponse\RequestApiResponse;
use App\Entity\Movie;
use App\MovieRepo\Domain\ApiConfigs\configApiOMDB;
use App\MovieRepo\Domain\ApiConfigs\configApiUtelly;
use App\MovieRepo\Domain\Model\Movie\MovieRepository;
use App\MovieRepo\Domain\UseCases\UseCase;
use App\MovieRepo\Domain\UseCases\UseCaseRequest;
use Doctrine\Persistence\ManagerRegistry;

class RequestApi extends UseCase
{
    private $curlOptions;
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository) {
        $this->movieRepository = $movieRepository;
        $configApitUtelli = new configApiUtelly();
        $configApiOMDB = new configApiOMDB();
        $this->curlOptions = $configApitUtelli->getOptions();
    }

    public function execute(UseCaseRequest $useCaseRequest)
    {
        $movieCached = $this->movieRepository->getMovieByName($useCaseRequest->getSearchValue());
        $requestApiListDTO = new RequestApiListDTO();
        if($movieCached) {

            $requestApiListDTO->setCached(TRUE);
            $requestApiListDTO->setProject($movieCached[0]["project"]);
            $requestApiListDTO->setId($movieCached[0]["id"]);

        } else {
            $this->generateUrl($useCaseRequest->getSearchValue(), $useCaseRequest->getCountry());
            $response = $this->getApiResponse();
            if(is_array($response->results)){
                $requestApiListDTO->setStatus(TRUE);
                foreach ($response->results as $movieResponse) {

                    $imdbID = $movieResponse->external_ids->imdb->id;
                    $this->generateUrlOMDB($imdbID);
                    $responseOMDB = $this->getApiResponse();

                    if($this->movieRepository->getMovieByImdbId($imdbID) == null){
                        $this->persistMovie($movieResponse, $responseOMDB, $imdbID, $useCaseRequest->getCountry());
                    }

                    $movieRequest = [
                        "title" => $responseOMDB->Title,
                        "rating" => $responseOMDB->imdbRating,
                        "project" => $useCaseRequest->getCountry(),
                        "duration" => $responseOMDB->Runtime,
                        "description" => $responseOMDB->Plot,
                        "img" => $responseOMDB->Poster,
                        "locations" => $this->getLocation($movieResponse->locations),
                        "year" => $responseOMDB->Year,
                        "genre" => $responseOMDB->Genre,
                        "director" => $responseOMDB->Director,
                        "actors" => $responseOMDB->Actors,
                    ];

                    $requestApiListDTO->addMovieToList($movieRequest);

                }

            } else {
                $requestApiListDTO->setStatus(FALSE);
            }
        }
        return $requestApiListDTO;
    }

    private function getLocation($locations) {
        $services = "";
        foreach ($locations as $location) {
            $services = $services . ", " . $location->display_name;
        }
        return $services;
    }

    private function generateUrl($searchValue, $country) {
        $baseUrl = "https://utelly-tv-shows-and-movies-availability-v1.p.rapidapi.com/lookup?term=". rawurlencode($searchValue)."&country=" . $country;
        $this->curlOptions[CURLOPT_URL] = $baseUrl;
    }

    private function generateUrlOMDB($imdbID) {
        $baseUrl = "http://www.omdbapi.com/?apikey=f6a738e9&i=" . $imdbID;
        $this->curlOptions[CURLOPT_URL] = $baseUrl;
    }

    private function getApiResponse() {
        $curl = curl_init();

        curl_setopt_array($curl, $this->curlOptions);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return json_decode($response);
        }
    }

    private function persistMovie($response, $responseOMDB, $imdbID, $country) {
        $locations = $this->getLocation($response->locations);
        $title = $responseOMDB->Title;
        $description = $responseOMDB->Plot;
        $project = $country;
        $duration = $responseOMDB->Runtime;
        $year = $responseOMDB->Year;
        $rating = $responseOMDB->imdbRating;
        $img = $responseOMDB->Poster;
        $genre = $responseOMDB->Genre;
        $director = $responseOMDB->Director;
        $actors = $responseOMDB->Actors;
        $this->movieRepository->persistMovie($locations, $title, $description, $project, $duration, $year, $rating, $imdbID, $country, $img, $genre, $director, $actors);
    }

}