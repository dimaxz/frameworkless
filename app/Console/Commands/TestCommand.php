<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Command;

use Symfony\Component\Console\Helper\DescriptorHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;

/**
 * ListCommand displays the list of all available commands for the application.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TestCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('test')
            ->setDefinition($this->createDefinition())
            ->setDescription('Test commands')
            ->setHelp(<<<'EOF'
This is test commands
EOF
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getNativeDefinition()
    {
        return $this->createDefinition();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = new DescriptorHelper();
        $helper->describe($output, $this->getApplication(), array(
            'valuename' => $input->getOption('valuename'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    private function createDefinition()
    {
        return new InputDefinition(array(
            new InputArgument('valuename', InputArgument::OPTIONAL, 'The value name'),
//            new InputOption('raw', null, InputOption::VALUE_NONE, 'To output raw command list'),
//            new InputOption('format', null, InputOption::VALUE_REQUIRED, 'The output format (txt, xml, json, or md)', 'txt'),
        ));
    }
}
