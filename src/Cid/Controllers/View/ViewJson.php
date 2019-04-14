<?php

namespace Cid\Controllers\View;

use Psr\Http\Message\ResponseInterface;

class ViewJson implements IView
{
	private $value;

	/**
	* @var ResponseInterface
	*/
	private $response;

	public function render($name_view = '')
	{
		$content = json_encode($this->value);

		$this->response->getBody()->write($content);
		return $this->response->withStatus(200);
	}

	public function setResponse(ResponseInterface $response)
	{
		$this->response = $response;
	}

	public function set($name, $value)
	{
		$this->value = $value;
	}

	public function isInCache($name_view)
	{
		return false;
	}
}