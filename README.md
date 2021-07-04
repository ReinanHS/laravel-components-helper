[![Total Downloads](https://img.shields.io/packagist/dt/reinanhs/laravel-components-helper.svg?style=flat)](https://packagist.org/packages/reinanhs/laravel-components-helper)
[![Latest Stable Version](https://img.shields.io/packagist/v/reinanhs/laravel-components-helper.svg?style=flat)](https://packagist.org/packages/reinanhs/laravel-components-helper)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)

## Laravel Components  Helper

Ready-to-use and customizable components.

## Installation

### Using Composer

```sh
composer require reinanhs/laravel-components-helper
```

Or manually by modifying `composer.json` file:

``` json
{
    "require": {
        "reinanhs/laravel-components-helper": "dev-master"
    }
}
```

And run `composer install`

Then add Service provider to `config/app.php`

``` php
    'providers' => [
        // ...
        \Reinanhs\LaravelComponentsHelper\ComponentHelperServiceProvider::class,
    ]
```

## Quick start

This is a quick and simple example for you to create a table automatically based on a **model**. First create a class to represent your table.

```php
<?php

namespace App\Helpers;

use App\Models\Project;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\EloquentTable;

class ProjectTable extends EloquentTable
{
    protected $model = Project::class;
}
```

you will need to instance the table in your controller

```php
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(5);
        
        $array = $projects->getCollection()->toArray();
        $table = new ProjectTable($array);

        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('table', $table);
    }
}    
```

Now just render your table in the view

```blade
{!! $table->render() !!}
```

##  Configuration Files

Bootstrap 5 classes are used by default for styling the tables. That can be modified by changing the configuration.

First, publish the package assets/configuration.

`php artisan vendor:publish --provider="Reinanhs\LaravelComponentsHelper\ComponentHelperServiceProvider" --tag="config"`

This will create config file config/components-helper.php.

```php
/**
 * Components Helper Configuration File.
 */
return [

    /**
     * Attributes of table 
     * 
     * @return array
     */
    'default_table_attributes' => [
        'class' => 'table table-striped',
    ],
];

```

## Eloquent Table

You can change the rendering of an attribute

```php
class ProjectTable extends EloquentTable
{
    protected $model = Project::class;

    public function getCostAttribute(int $cost)
    {
        return "<button>{$cost}</button>";
    }
}
```
