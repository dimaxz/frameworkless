<?php

namespace Frameworkless\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Description of HelloWorldCommand
 *
 * @author Dmitriy
 */
class SeedCommand extends Command
{

	protected function configure()
	{
		$this->setName('seed:build')
				->setDescription('Create seeds data')
				->setDefinition(
						new InputDefinition(array(
					new InputOption('class', 'c', InputOption::VALUE_REQUIRED),
					new InputOption('amount', 'a', InputOption::VALUE_OPTIONAL)
						))
		);
		$this->setName('seed:reset')
				->setDescription('Reset seeds data')
				->setDefinition(
						new InputDefinition(array(
					new InputOption('class', 'c', InputOption::VALUE_REQUIRED)
						))
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
	
		if (!$class = $input->getOption('class')) {
			$output->writeln("Model not set");
			return;
		}

		if ($input->getArgument('command') == "seed:reset" && $class::reset()) {
			$output->writeln(sprintf("Seed %s reset success!", $class));
		} else {
			$number = $input->getOption('amount');
			$class::build($number > 1 ? $number : 1);
			$output->writeln(sprintf("Seed %s amount %s create success!", $class, $number));
		}
	}
}
