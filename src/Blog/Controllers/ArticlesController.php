<?php

/* Контроллер для статей */

namespace Blog\Controllers;

use Blog\Exceptions\NotFoundException;
use Blog\Models\Articles\Article;
use Blog\Models\Users\User;
use Blog\View\View;

class ArticlesController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
           throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function add(): void
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();

        var_dump($article);
    }
}
