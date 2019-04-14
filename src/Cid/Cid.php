<?php
date_default_timezone_set('America/Argentina/Cordoba');

use Cid\Strategy\MiRoute;
use Cid\Config;

class Cid
{
	public static function init($path)
	{
		/**
 		* Usamos DS como separador de directorios.
 		*/
		if (!defined('DS')) {
			define('DS', DIRECTORY_SEPARATOR);
		}

		/**
 		*
 		*/
		if (!defined('ROOT')) {
			define('ROOT', dirname(dirname($path)));
		}

		/**
  		*
 		*/
		if (!defined('APP_DIR')) {
			define('APP_DIR', basename(dirname($path)));
		}

		/**
 		*
 		*/
		if (!defined('PUBLIC_DIR')) {
			define('PUBLIC_DIR', basename($path));
		}
		if (!defined('WWW_PUBLIC')) {
			define('WWW_PUBLIC', $path . DS);
		}

		require_once ROOT . '/vendor/autoload.php';

		self::initConfig();
		//self::cleanUri();
	}

	public static function initRoutes($get_routes, $post_routes)
	{
		MiRoute::run($get_routes, $post_routes);
	}

	public static function initConfig()
	{
		Config::init();
	}

	/*
		Se quita del REQUEST_URI el nombre de la carpeta que contiene el sitio
		para evitar errores con el sistema de ruteo.
	*/
	public static function cleanUri()
	{
		$uri = getenv('REMOVE_FROM_REQUEST_URI');
		$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));
	}
}