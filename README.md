#Laravel Custom Responses

##Install
Via composer

Create `responses` folder in app/views and 3 blade templates:
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
