<?php
namespace Cid\Models;

//use Cid\Conf\Configuraciones;
use \PDO;

class MyPdo extends PDO
{
	static $instance;

    public function __construct()
    {
        $dsn      = getenv('DB_DSN');      //Configuraciones::dnsBaseDatos();
        $username = getenv('DB_USERNAME'); //Configuraciones::usuarioBaseDatos();
        $passwd   = getenv('DB_PASSWORD'); //Configuraciones::passBaseDatos();

        parent::__construct($dsn, $username, $passwd);
    }

    public static function create()
    {
    	if (self::$instance == null)
        {
    		self::$instance = new MyPdo();
    		self::$instance->query("SET NAMES 'utf8'");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}

    	return self::$instance;
    }
}