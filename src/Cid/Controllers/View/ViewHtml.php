<?php

namespace Cid\Controllers\View;

use Psr\Http\Message\ResponseInterface;
use Smarty;

class ViewHtml implements IView
{
	/**
	* @var Smarty
	*/
	private $generator;

	/**
	* @var ResponseInterface
	*/
	private $response;


	function __construct()
	{
		$viewFolder = ROOT . DS . APP_DIR . '/Views';

		$this->generator = new Smarty();
		$this->generator->setTemplateDir($viewFolder);
		$this->generator->setCompileDir("{$viewFolder}/templates_c");
        $this->generator->setCacheDir("{$viewFolder}/cache");
        $this->generator->setConfigDir("{$viewFolder}/configs");
	}

	public function setResponse(ResponseInterface $response)
	{
		$this->response = $response;
	}

	public function render($name_view)
	{
		$name_view = $name_view . '.tpl';

		//$this->response->setStatusCode(Response::HTTP_OK);
		//$this->response->headers->set('Content-Type', 'text/html');

		$content = $this->generator->fetch($name_view);
		$this->response->getBody()->write($content);

		return $this->response->withStatus(200);
	}

	public function set($name, $value)
	{
		$this->generator->assign($name, $value);
	}

	public function isInCache($name_view)
	{
		return false;
	}
}