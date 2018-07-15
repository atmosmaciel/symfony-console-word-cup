<?php

namespace WordCup\Commands;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WordCup\Requests\TeamsRequest;

class TeamsCommands extends Command
{
    protected function configure()
    {
        $this->setName('cup:teams');
        $this->setDescription('Show The World Cup Teams');
        $this->addArgument('group_letter', null, 'teste descritpion');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $teamsRequest = new TeamsRequest(new Client());

        foreach ($teamsRequest->getTeams($input->getArgument('group_letter')) as $team) {
            $output->writeln($team->country .  ' - GRUPO: ' . $team->group_letter);
        }
    }
}
