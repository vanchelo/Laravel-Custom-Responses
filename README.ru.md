#Laravel Custom Responses

##Установка

Подключаем пакет через composer:
```
composer require "vanchelo/laravel-custom-responses dev-master"
```

После завершения обновления composer, добавить в массив `providers` конфига `app/config/app.php`
```
'Vanchelo\CustomResponses\ResponsesServiceProvider'
```

Создать папку `responses` в `app/views` и три Blade шаблона:
`defult.blade.php`, `403.blade.php`, `404.blade.php`

##Как использовать

В контроллере:
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

В результате будет сгенерирован наш подготовленный ответ, если запрос пришел с AJAX, сервер вернет ответ в JSON представлении, в противном случае наш подготовленный шаблон, т.е. ответ в HTML представлении.

##Создаем собственные подготовленные ответы (responses)

Для примера создадим ответ на 401 (Unauthorized) статусный код.

1. Создаем класс **Unauthorized** и помещаем в любую удобную папку доступную автозагрузчику, в примере это папка `app/Acme/Responses/`:
```php
<?php namespace Acme\Responses;

// app/Acme/Responses/Unauthorized.php

class Unauthorized extends Response
{
    protected $view = 'responses.401';
    protected $defaultCode = 401;
}
```
где - **$view** - это адрес нашего Blade шаблона, **$defaultCode** - код ответа, можно не устанавливать, тогда будет взят код из исключения 

- Создаем Blade шаблон `401.blade.php` в папке `app/views/responses`

- И добавляем код представленный ниже в `app/start/global.php` или куда вам удобнее:
```php
App::bind('401', 'Acme\Responses\Unauthorized'); 
```
P.S. Я выношу подобный код в сервис провайдеры

- Всё. Можно пользоваться
