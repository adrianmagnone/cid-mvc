# Cid Framework
Is a simple PHP micro MVC framework for purpose of study.
Use in production is not recommended.

## Install instructions

It's recommended that you use [Composer](https://getcomposer.org/) to install

    ```bash
    $ composer require adrianmagnone/cid
    ```

## Usage instructions

Create an index.php file in your public folder and put the following contents:

    ```php
    <?php

    require_once '../vendor/Cid/src/Cid.php';

    Cid::init(dirname(__FILE__));

    $get_routes = [
        [ 'dir' => '/',     'action' => "IndexController::index" ],
        [ 'dir' => '/home', 'action' => "HomeController::index" ],
    ];

    $post_routes = [];

    Cid::initRoutes($get_routes, $post_routes);

    ```
Create .env file in root folder, copy the values from .env.example and change it.

Create a View folder, with subfolders cache, configs, templates_c.

## Testing instructions
## Contributing instructions
## Support resources
## Author credits
## Software license
