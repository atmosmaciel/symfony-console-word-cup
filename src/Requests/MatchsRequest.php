<?php

namespace WordCup\Requests;

use GuzzleHttp\Client;

class MatchsRequest
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getMatchs($team = null)
    {
        $response = $this->client->request('GET', API_URL . '/matches/');
        $matchs = json_decode($response->getBody());

        if ($team) {
            $filterTeams = array_filter($matchs, function ($t) use ($team) {
                return $t->home_team->country == $team || $t->away_team->country == $team;
            });

            return $filterTeams;
        }

        return $matchs;
    }
}
