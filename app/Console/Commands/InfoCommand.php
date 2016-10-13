<?php

namespace Frameworkless\Console\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * Description of HelloWorldCommand
 *
 * @author Dmitriy
 */
class InfoCommand extends Command
{
    protected function configure()
    {
        $this->setName('info')
            ->setDescription('Outputs \'Info about command\'');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('This is frameworkless console');
    }
}
