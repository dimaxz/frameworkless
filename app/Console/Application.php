<?php

namespace Frameworkless\Console;

use Symfony\Component\Console\Application as CoreApp;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;

class Application extends CoreApp
{
    /**
     * Gets the name of the command based on input.
     *
     * @param InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        // This should return the name of your command.
        return 'help';
    }
//	
//	protected function my_command(){
//		exit('f');
//	}

	/**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new \Symfony\Component\Console\Command\HelpCommand();


        return $defaultCommands;
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
	
	
	
	
	
	
	function __o(){
				$this->register('packages:install')
			->setDescription('Say hello to someone on the command line.')
			->setDefinition(array(
				new InputArgument('name', InputArgument::OPTIONAL, 'The name of the person to say hello to.', 'Stranger'),
			))
			->setCode(function (InputInterface $input, OutputInterface $output) {

				$finder = \Symfony\Component\Finder\Finder::create();

				$root_path = __DIR__ . "../..";

				$iterator = $finder
						->files()
						->in($root_path . "/vendor/*/*/db");

				foreach ($iterator as $file) {
					//print $file->getRealpath() . PHP_EOL;

					// Dump the relative path to the file, omitting the filename
					//var_dump($file->getRelativePath());

					// Dump the relative path to the file
					//var_dump($file->getRelativePathname());

					if (!copy($file->getRealpath(), $root_path . '/db/' . $file->getRelativePathname())) {
					   echo sprintf("error copy migration %s..." . PHP_EOL, $file->getRelativePathname());
					}
					else{
						echo sprintf("copy migration %s" . PHP_EOL, $file->getRelativePathname());
					}
				}

				echo "completed!" . PHP_EOL;				
				
				
			});		
	}
}