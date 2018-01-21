<?php
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
$console = new Application('My Silex Application', 'Silex Sample');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);
$console
    ->register('keygen')
    ->setDefinition(array(
          new InputArgument('user', InputArgument::REQUIRED, 'Logged user.')
        , new InputArgument('key', InputArgument::REQUIRED, 'API Key')
    ))
    ->setDescription('Gerador de key')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
	$key = $app['auth.new.token']($input->getArgument('user'), $input->getArgument('key'));
	$output->writeln([
		'Generated key for "'.$input->getArgument('user').'" and "'.$input->getArgument('key').'"'
		, '=============='
		, $key
	]);
    })
;
return $console;
