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
class InstallPackagesCommand extends Command{

    protected function configure(){
	$this->setName('packages:install')
		->setDescription('Install packages migration and assets');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
	$finder = \Symfony\Component\Finder\Finder::create();

	$root_path = __DIR__ . "../../../..";

	$iterator = $finder
		->files()
		->in($root_path . "/vendor/*/*/db");

	foreach($iterator as $file){

	    if(!copy($file->getRealpath(), $root_path . '/db/' . $file->getRelativePathname())){
		$output->writeln(sprintf("error copy migration %s...", $file->getRelativePathname()));
	    } else{
		$output->writeln(sprintf("copy migration %s", $file->getRelativePathname()));
	    }
	}

	$output->writeln("completed!");
    }
}
