<?php namespace Core;

class Request
{
    public function json(bool $asArray = false)
    {
        $content = file_get_contents('php://input');
        $content_array = json_decode($content, $asArray);
        return $content_array;
    }
}