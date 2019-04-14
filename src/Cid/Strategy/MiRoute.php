<?php

namespace Cid\Strategy;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Container\Container;
use League\Route\RouteCollection;
use League\Route\Http\Exception as HttpException;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;

use Cid\Strategy\BaseStrategy;

class MiRoute
{
	public static function run($get_routes, $post_routes)
	{
		try
		{
			$container = new Container;

			$container->share('response', Response::class);
			$container->share('request', function () {
			    return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
			});

			$container->share('emitter', SapiEmitter::class);

			$route = new RouteCollection($container);
			$route->setStrategy(new BaseStrategy);

			foreach ($get_routes as $infoRuta)
			{
				$route->get($infoRuta['dir'], $infoRuta['action']);
			}

			foreach ($post_routes as $infoRuta)
			{
				$route->post($infoRuta['dir'], $infoRuta['action']);
			}

			//var_dump($container->get('request'));

			$response = $route->dispatch($container->get('request'), $container->get('response'));


		}
		catch (HttpException $e)
		{
			$response = new Response('php://memory', (int)$e->getStatusCode(), $e->getHeaders());
		}

		$container->get('emitter')->emit($response);
	}
}