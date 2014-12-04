#Laravel Custom Responses

[Описание на русском](https://github.com/vanchelo/Laravel-Custom-Responses/blob/master/README.ru.md)

##Install

Require this package with composer:
```
composer require "vanchelo/laravel-custom-responses dev-master"
```

After updating composer, add the ServiceProvider to the providers array in `app/config/app.php`
```
'Vanchelo\CustomResponses\ResponsesServiceProvider'
```

Create `responses` folder in `app/views` and three blade templates:
`defult.blade.php`, `403.blade.php`, `404.blade.php`

##How to use

In controller:
```php
class PageController extends Controller
{
    public function index($id)
    {
        if ( ! $page = Page::find($id)) App::abort(404);
        // or
        if ( ! $page = Page::find($id)) return App::make(404);
        
        return View::make('page', compact('page'));
    }
}
```

##Create you own custom response

For example we will create custom response for 401 (Unauthorized) status code.

1. Create class and put it on your app folder
```php
<?php namespace Acme\Responses;

// app/Acme/Responses/Unauthorized.php

class Unauthorized extends Response
{
    protected $view = 'responses.401';
    protected $defaultCode = 401;
}
```

2. Create blade template `401.blade.php` and put it on `app/views/responses`

3. Put this code in `app/start/gobal.php`:
```php
App::bind('401', 'Acme\Responses\Unauthorized'); 
```
4. That's all
