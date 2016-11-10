<?php
use League\Container\Container;
use League\Container\ReflectionContainer;
use Symfony\Component\HttpFoundation\Request;
/**
 * Container setup
 */
$container = new Container();
$container->delegate(
    new ReflectionContainer() // Auto-wiring
);

/**
 * set Request
 */
$container->add(Request::class,Request::createFromGlobals());

/**
 * set Twig
 */
$container->add(Twig_Environment::class)
    ->withArgument(new Twig_Loader_Filesystem(__DIR__ . '/../app/views/'));

/**
 * set Monolog
 */
$container->share(Monolog\Logger::class)
		->withArgument('myLogger')
		;

/**
 * set Propel2 Logger
 */
Propel\Runtime\Propel::getServiceContainer()->setLogger('defaultLogger', (new Monolog\Logger('defaultLogger'))
		->pushHandler(new Monolog\Handler\StreamHandler('php://stderr')));

/**
 * set Debug bar
 */
$container->add(DebugBar\StandardDebugBar::class)
		->withMethodCall("addCollector",[
			new DebugBar\Bridge\Twig\TwigCollector(
					new DebugBar\Bridge\Twig\TraceableTwigEnvironment($container->get(Twig_Environment::class))
					)
		])
		->withMethodCall("addCollector",[
			new DebugBar\Bridge\Propel2Collector(Propel\Runtime\Propel::getConnection())
		])
		->withMethodCall("addCollector",[
			new \DebugBar\Bridge\MonologCollector($container->get(Monolog\Logger::class))
		])
;


/**
 * inflector interfaces
 */

$container->inflector(Psr\Log\LoggerAwareInterface::class)
          ->invokeMethod('setLogger', [$container->get(Monolog\Logger::class)]);

$container->inflector(Frameworkless\Controllers\PageInterface::class)
          ->invokeMethod('setTwig', [$container->get(Twig_Environment::class)])
		  ->invokeMethod('setDebugbar', [$container->get(DebugBar\StandardDebugBar::class)])
		;
