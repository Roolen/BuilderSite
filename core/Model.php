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
        $statement = $this->builder->getStatementSelect();
        $statement["table"] = $this->table;

        $statStr = join(' ', $statement);

        $result = $connect->query($statStr);
        unset($connect);
        return $result->fetchAll();
    }

    public function where(array $where)
    {
        $this->builder->where($where);

        return $this;
    }

    public function orderBy(string $orderBy, bool $isDesc = false)
    {
        $this->builder->orderBy($orderBy, $isDesc);

        return $this;
    }

    public function insert(array $object)
    {
        if (empty($object)) return false;

        $connect = $this->connect();
        $statement = 'INSERT INTO ' . $this->table . ' SET ';

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

    public function update(int $id = null, array $update)
    {
        if (empty($update)) return false;

        $connect = $this->connect();
        $statement = 'UPDATE ' . $this->table . ' SET ';

        $isFirst = true;
        foreach ($update as $key=>$val)
        {
            if (!$isFirst) $statement .= ', ';
            $statement .= $key . ' = "' .$val . '"';
            $isFirst = false;
        }

        if (!is_null($id))
            $this->builder->where(["id" => $id]);

        $statement .= ' ' . $this->builder->where;

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

    public function delete(array $where)
    {
        $connect = $this->connect();
        $statement = 'DELETE FROM ' . $this->table . ' ';

        if (!empty($where))
            $this->where($where);

        $statement .= $this->builder->where;

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