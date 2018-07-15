<?php

namespace WordCup\Commands;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WordCup\Requests\MatchsRequest;

class MatchsCommands extends Command
{
    protected function configure()
    {
        $this->setName('cup:matchs');
        $this->setDescription('Show The World Cup Teams');
        $this->addArgument('team', null, 'Team Matchs');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $matchsRequest = new MatchsRequest(new Client());

        foreach ($matchsRequest->getMatchs($input->getArgument('team')) as $match) {
            $output->writeln($match->home_team->country . ' ' . $match->home_team->goals . ' x ' . $match->away_team->country . ' ' . $match->away_team->goals);
        }
    }
}
