Laravel 5 log viewer
======================

TL;DR
-----
The best (IMO) Log Viewer for Laravel 5 (compatible with 4.2 too). **Install with composer, create a route to `LogViewerController`**. No public assets, no vendor routes, works with and/or without log rotate. Inspired by Micheal Mand's [Laravel 4 log viewer](https://github.com/mikemand/logviewer) (works only with laravel 4.1)

What ?
------
Small log viewer for laravel. Looks like this:

![capture d ecran 2014-12-01 a 10 37 18](https://cloud.githubusercontent.com/assets/1575946/5243642/8a00b83a-7946-11e4-8bad-5c705f328bcc.png)

Install
-------
Install via composer
```
composer require guarinog/laravel-log-viewer
```

Add Service Provider to `config/app.php` in `providers` section
```php
'Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider',
```

Add a route in `app/Http/routes.php` (or choose another route): 
```php 
Route::get('logviewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::controller('logviewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController', [
    'getData' => 'logviewer.data'
]);
``` 

Go to `http://myapp/logs` or some other route
