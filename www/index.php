<?php
function myAutoLoader(string $className)
{
require_once __DIR__ . '/../src/' . $className . '.php';
}

spl_autoload_register('myAutoLoader');

$author = new \Blog\Models\Users\User('Иван');
$article = new \Blog\Models\Articles\Article('Заголовок', 'Текст', $author);


$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/../src/routes.php';

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction)
{
    preg_match($pattern, $route, $matches);
    if (!empty($matches))
    {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound)
{
    echo 'Страница не найдена';
    return;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);
?>