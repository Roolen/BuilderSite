<?php namespace Core;

use Exception;
use PDO;

class Model
{
    protected string $table;

    protected \Core\Builder $builder;

    public function query()
    {
        $this->builder = new \Core\Builder();

        return $this;
    }
    
    public function all()
    {
        $connect = $this->connect();
        $statement = $this->builder->getstatement();
        $statement["table"] = $this->table;

        $statStr = join(' ', $statement);

        $result = $connect->query($statStr);
        unset($connect);
        return $result->fetchAll();
    }

    public function where(array $where)
    {
        $str = '';
        $count = 0;
        if (empty($this->builder->where))
        {
            $str = 'WHERE';
        }
        else
        {
            $count = 1;
        }

        foreach ($where as $key=>$val)
        {
            if ($count > 0) $str .= 'or ';

            $str .= ' ' . $key . '=' . $val . ' ';
                
            $count++;
        }

        $this->builder->where = $str;

        return $this;
    }

    public function insert(array $object)
    {
        if (empty($object)) return false;

        $connect = $this->connect();
        $statement = 'insert into ' . $this->table . ' set ';

        $isFirst = true;
        foreach ($object as $key=>$val)
        {
            if (!$isFirst) $statement .= ', ';
            $statement .= $key . ' = "' . $val . '"';
            $isFirst = false;
        }

        try 
        {
            $connect->beginTransaction();
            $response = $connect->exec($statement);
    
            $connect->commit();
        }
        catch (Exception $e)
        {
            $connect->rollBack();
            echo $e->getMessage();
        }
        
        unset($connect);
        return $response;
    }

    private function connect()
    {
        $appConfig = new \Config\App();
        $dbConfig = new \Config\Database();
        $default = $dbConfig->default;

        extract($default);
        $dsn = "{$driver}:host={$hostname};dbname={$database};port={$port};".
                "charset={$charset};";

        $options = [];
        if ($appConfig->Environment === \Config\ENV_DEVELOP)
        {
            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        }

        return new PDO($dsn, $username, $password, $options);
    }
}