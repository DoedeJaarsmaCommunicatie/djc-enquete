<?php
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get('/encrypt/{string}', 'Crypto\\EncryptStringController');

$router->get('/user/{id}', 'User\\GetUserController');
$router->post('/user/{id}', 'User\\PatchUserController');

$router->get('/questions/', 'Question\\FetchQuestionsController');
$router->get('/questions/{id}', 'Question\\FetchQuestionController');

$router->get('/answer/{user}/{question}', 'Answer\\FetchAnswerController');
$router->post('/answer/{user}/{question}', 'Answer\\PutAnswerController');

$router->post('/finished/{id}', 'FinishedQuestionsController');
