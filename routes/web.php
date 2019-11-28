<?php
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get('/encrypt/{string}', 'Crypto\\EncryptStringController');

$router->get('/user/{id}', 'User\\GetUserController');
