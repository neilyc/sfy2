<?php

namespace Test\HelloworldBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('test:hello')
            ->setDescription('Hello World example command')
            ->addArgument('who', InputArgument::OPTIONAL, 'Who to greet.', 'World');
            //php app/console  test:hello troger => hello troger
            //php app/console  test:hello  => hello world
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Hello <comment>%s</comment>!', $input->getArgument('who')));
    }
}
