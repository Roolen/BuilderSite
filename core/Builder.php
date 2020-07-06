<?php namespace Core;

class Builder
{
    public string $where = '';
    public string $fields = '';

    public function getStatement()
    {
        $statement = [
            "op"     => 'SELECT',
            "fields" => $this->fields,
            "from"   => 'FROM',
            "table"  => '',
            "where"  => $this->where,
        ];

        if (empty($statement["fields"]))
        {
            $statement["fields"] = '*';
        }

        return $statement;
    }
}