<?php
namespace Cid\Controllers\View;

use Psr\Http\Message\ResponseInterface;

interface IView
{
	function setResponse(ResponseInterface $response);
	function set($name, $value);
	function render($name_view);
	function isInCache($name_view);
}