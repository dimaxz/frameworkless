<?php

namespace Frameworkless\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Description of HelloWorldCommand
 *
 * @author Dmitriy
 */
class SeedResetCommand extends Command
{

	protected function configure()
	{
		$this->setName('seed:reset')
				->setDescription('Reset all seeds data')
				->setDefinition(
						new InputDefinition(array(
					new InputOption('class', 'c', InputOption::VALUE_REQUIRED)
						))
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
	
		if (!$class = $input->getOption('class')) {
			$output->writeln("Class Model not set");
			return;
		}

		if($class::reset()){
			$output->writeln(sprintf("Seed %s reset success!", $class));
		}
		else
			$output->writeln("Command seed:reset fail to execute!");
	}
}
