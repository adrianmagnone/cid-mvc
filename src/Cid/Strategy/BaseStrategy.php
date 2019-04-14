<?php

namespace Cid\Strategy;

use \Exception;
//use League\Route\Strategy\StrategyInterface;
use League\Route\Strategy\ApplicationStrategy;
//use League\Route\Strategy\AbstractStrategy;
//use League\Route\Http\Exception as HttpException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Route;
use RuntimeException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Cid\Factory\FactoryModels;
use Cid\Controllers\ErrorController;
use Cid\Factory\FactoryView;

class BaseStrategy extends ApplicationStrategy
{
    /**
     * {@inheritdoc}
     */
    public function getCallable(Route $route, array $vars)
    {
        return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($route, $vars) {
            $controller = $route->getCallable();

            $instance = new $controller[0]();
            $function = $controller[1];

            $instance->before($request, $response, $vars);
            $instance->setFactoryModels(new FactoryModels);
            $instance->setFactoryViews(new FactoryView);

            $response = $instance->$function();

            return $next($request, $response);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function getNotFoundDecorator(NotFoundException $exception)
    {
        return $this->showErrorPage('notFound');
    }

    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception)
    {
        return $this->showErrorPage('notAllowed');
    }

    private function showErrorPage($function)
    {
        return function (ServerRequestInterface $request, ResponseInterface $response, callable $next) use ($function) {
            $instance = new ErrorController();
            $instance->setFactoryViews(new FactoryView);

            $instance->before($request, $response, null);
            $response = $instance->$function();

            return $next($request, $response);
        };
    }

}



