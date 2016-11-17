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
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        $defaultCommands = parent::getDefaultCommands();
 
		$defaultCommands []= new Commands\InfoCommand();
		$defaultCommands []= new Commands\InstallPackagesCommand;
		$defaultCommands []= new Commands\SeedBuildCommand;
		$defaultCommands []= new Commands\SeedResetCommand;
		$defaultCommands []= new Commands\InstallCommand;
		$defaultCommands []= new \Propel\Generator\Command\ConfigConvertCommand();
		$defaultCommands []= new \Propel\Generator\Command\MigrationMigrateCommand();		

        return $defaultCommands;
    }
}