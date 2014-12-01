<?php namespace Vanchelo\CustomResponses\Responses;

class Forbidden extends Response
{
    protected $view = 'responses.403';
    protected $defaultCode = 403;
}
