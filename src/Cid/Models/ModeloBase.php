<?php
namespace Cid\Models;

use Cid\Models\IModelo;
use Cid\Models\MyPdo;
use \PDO;
use \PDOException;

abstract class ModeloBase implements IModelo
{
    protected $pdo;
    protected $sql;
    protected $params = array();

    public function addParam($name, $value, $type)
    {
        $this->params[] = array($name, $value, $type);
    }

    public function execute()
    {
        try
        {
            $this->conectar();
            $stmt = $this->pdo->prepare($this->sql);

            if ($this->params)
            {
                foreach ($this->params as $bind)
                {
                    $stmt->bindValue($bind[0], $bind[1], $bind[2]);
                }
            }
            $stmt->execute();
            $this->params = array();
            return $stmt;
        }
        catch (PDOException $e)
        {
            return false;
        }
        catch (Exception $e1)
        {
            return false;
        }
    }

    public function executeAndFechOne()
    {
        $stmt = $this->execute();
        if (! $stmt)
        {
            return false;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function executeAndFechAll()
    {
        $stmt = $this->execute();
        if (! $stmt)
        {
            return false;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function conectar()
    {
        if (is_null($this->pdo))
        {
            $this->pdo = MyPdo::create();
        }
    }
}