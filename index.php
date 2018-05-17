<?php

include "vendor/autoload.php";

$loader = new Twig_Loader_Filesystem('./components');
$loader->addPath('./pages', 'page');

$twig = new Twig_Environment($loader, array(
    'cache' => './storage/cache/twig',
    'auto_reload' => true,
));

$uri = '/'.ltrim($_SERVER['REQUEST_URI'], '/');

try {
    $patterns = [
        '@page'.$uri.'/index.twig',
        '@page'.$uri.'.twig',
    ];
    foreach ($patterns as $uri) {
        if ($loader->exists($uri)) {
            echo $twig->render($uri, []);
            break;
        }
    }
}
catch (Exception $e) {
    echo $e->getMessage();
}