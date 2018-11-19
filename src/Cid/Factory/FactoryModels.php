<?php
namespace Cid\Factory;

use Cid\Factory\IFactory;

class FactoryModels implements IFactory
{
	public function create($name)
	{
		try
		{
			$modelname = $name;
			$model = new $modelname();
			return $model;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}