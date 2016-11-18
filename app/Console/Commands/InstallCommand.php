<?php
namespace Frameworkless\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Description of HelloWorldCommand
 *
 * @author Dmitriy
 */
class InstallCommand extends Command{

    protected function configure(){
	$this->setName('install')
		->setDescription('Install project, up migration and seeds');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

	$command	 = $this->getApplication()->find('config:convert');
	$returnCode	 = $command->run(new ArrayInput([
	    'command' => 'config:convert'
		]), $output);

	$command	 = $this->getApplication()->find('packages:install');
	$returnCode	 = $command->run(new ArrayInput([
	    'command' => 'packages:install'
		]), $output);

	$command	 = $this->getApplication()->find('migration:migrate');
	$returnCode	 = $command->run(new ArrayInput([
	    'command' => 'migration:migrate'
		]), $output);

	$output->writeln("install completed!");
    }
}
