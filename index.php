<?php 

    require_once __DIR__ . "/vendor/autoload.php";

    use CoffeeCode\Router\Router;

    $router = new Router(PATH_OF_YOUR_APP);

    // namespace from controller
    $router->namespace("Source\App\Renderers");

    // prefix in url 
    $router->group(null);


    /* ----- TODAS AS ROTAS DO SISTEMA ESTARÃO LISTADAS ABAIXO ----- */

    $router->get("/", "HomeController:render");


    // namespace from controllers
    $router->namespace("Source\App\Api");

    // prefix in url 
    $router->group('api');

    $router->get('/get/{id}', 'ApiController:get');
    $router->post('/addProduct', 'ApiController:addProduct');
    $router->post('/updateProduct', 'ApiController:updateProduct');
    $router->delete('/removeProduct/{id}', 'ApiController:removeProduct');
    $router->post('/like', 'ApiController:like');
    
    $router->dispatch();