<?php
/**
 * Uskur
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Uskur (http://uskur.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Uskur/ConfigurationManager',
    ['path' => '/configuration-manager'],
    function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Configurations', 'action' => 'index']);
        $routes->fallbacks(DashedRoute::class);
    }
);
