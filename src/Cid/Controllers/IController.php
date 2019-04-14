<?php
namespace Cid\Controllers;

use Cid\Factory\IFactory;

interface IController
{
	function before($request, $response, $vars);
	function set($name, $value);
	function render($view);
	function setContentToHtml();
	function setContentToJson();
	function setContentToXml();
	function setContentToPlainText();
	function getUrlBase();
	function setFactoryModels(IFactory $factory);
	function model($name);
	function setFactoryViews(IFactory $factory);
	function view($name);
	function getParam($name);
}