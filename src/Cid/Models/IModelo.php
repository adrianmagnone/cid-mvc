<?php
namespace Cid\Models;

interface IModelo
{
	function addParam($name, $value, $type);

	function execute();

	function executeAndFechOne();

	function executeAndFechAll();
}
