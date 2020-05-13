<?php

/* Контроллер для статей */

namespace Blog\Controllers;

use Blog\Models\Articles\Article;
use Blog\View\View;

class ArticlesController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();
        var_dump($properties);
        return;

        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }
}
