<?php namespace Core;

class Response
{
    public function setJson()
    {
        header('Content-Type: application/json');
        return $this;
    }

    public function setCode(int $code)
    {
        http_response_code($code);
        return $this;
    }

    public function redirect(string $url, int $statusCode)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}