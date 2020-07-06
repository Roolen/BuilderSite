<?php namespace Core;

class Builder
{
    public string $where = '';
    public string $fields = '';
    public string $orderBy = '';

    public function getStatementSelect()
    {
        $statement = [
            "op"     => 'SELECT',
            "fields" => $this->fields,
            "from"   => 'FROM',
            "table"  => '',
            "where"  => $this->where,
            "orderby"=> $this->orderBy,
        ];

        if (empty($statement["fields"]))
        {
            $statement["fields"] = '*';
        }

        return $statement;
    }

    public function where(array $where)
    {
        $str = '';
        $count = 0;
        if (empty($this->where))
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

            if (is_int($val))
                $str .= ' ' . $key . '=' . $val . ' ';
            else if (is_string($val))
                $str .= ' ' . $key . ' = "' . $val . '" ';
                
            $count++;
        }

        $this->where = $str;
    }

    public function orderBy(string $orderBy, bool $isDesc = false)
    {
        $str = '';
        $count = 0;
        if (empty($this->orderBy))
        {
            $str = 'ORDER BY ';
        }
        else
        {
            $count = 1;
        }

        if ($count > 0)
            $str .= ', ';
        
        $str .= $orderBy;
        
        if ($isDesc)
            $str .= ' DESC';

        $this->orderBy .= $str;
    }
}