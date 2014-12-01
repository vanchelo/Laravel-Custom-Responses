#Laravel Custom Responses

##Install
Require this package with composer:
```
composer require vanchelo/laravel-custom-responses
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
