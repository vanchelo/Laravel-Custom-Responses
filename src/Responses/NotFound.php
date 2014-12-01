<?php namespace Vanchelo\CustomResponses\Responses;

class NotFound extends Response
{
    protected $view = 'responses.404';
    protected $defaultCode = 404;
}
