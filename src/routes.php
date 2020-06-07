<?php

/* Навигация в url строке */

return [
    '~^articles/(\d+)$~' => [\Blog\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\Blog\Controllers\ArticlesController::class, 'edit'],
    '~^$~' => [\Blog\Controllers\MainController::class, 'main'],
    '~^users/register$~' => [\Blog\Controllers\UsersController::class, 'signUp'],
    '~^articles/add$~' => [\Blog\Controllers\ArticlesController::class, 'add'],
    ];