<?php
require_once __DIR__ . "/../app/core/Router.php";

$url = isset($_GET['url']) ? $_GET['url'] : 'inicio';

$router = new Router();
$router->add("inicio", "InicioController", "index");
$router->add("libros", "LibroController", "index");
$router->add("autores", "AutorController", "index");  // ✅ Se agrega ruta a autores

$router->add("api/libros", "LibroController", "store", "POST");
$router->add("api/libros/delete/([0-9]+)", "LibroController", "delete", "DELETE");

$router->add("api/autores", "AutorController", "store", "POST");
$router->add("api/autores/delete/([0-9]+)", "AutorController", "delete", "DELETE");

$router->dispatch($url);
?>
