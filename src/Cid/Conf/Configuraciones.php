<?php
namespace Cid\Conf;

class Configuraciones
{
	private static $datos;

	public static function duracionCacheView()
	{
		return self::get('smarty.duracion.cache');
	}

	public static function dnsBaseDatos()
	{
		return self::get('db.dsn');
	}

	public static function usuarioBaseDatos()
	{
		return self::get('db.username');
	}

	public static function passBaseDatos()
	{
		return self::get('db.passwd');
	}

	public static function get($key)
	{
		if (is_null(self::$datos))
		{
			self::getDatosConfiguraciones();
		}

		if (! array_key_exists($key, self::$datos))
		{
			return false;
		}

		return self::$datos[$key];
	}

    private static function getDatosConfiguraciones()
    {
    	$str_datos = file_get_contents(ROOT . DS . APP_DIR .'/baseconf.ini');
        self::$datos = json_decode($str_datos,true);
    }
}
?>