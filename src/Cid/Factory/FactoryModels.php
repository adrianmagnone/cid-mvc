<?php
namespace Cid\Factory;

use Cid\Factory\IFactory;
use Cid\Config;

class FactoryModels implements IFactory
{
	public function create($name)
	{
		try
		{
			$namespace = Config::get('MODEL_NAMESPACE');
			$modelname = "{$namespace}$name";

			if (class_exists($modelname))
			{
				$model = new $modelname();
				return $model;
			}
			return false;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}