<?php
try
{


    function myAutoLoader(string $className)
    {
    require_once __DIR__ . '/../src/' . $className . '.php';
    }

    spl_autoload_register('myAutoLoader'); # автозагрузка неймспейсов

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
        throw new \Blog\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\Blog\Exceptions\DbException $e){
    $view = new \Blog\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\Blog\Exceptions\NotFoundException $e){
    $view = new \Blog\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage(), 404]);
}

?>