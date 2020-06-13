<?php

/* Навигация в url строке */

return [
    '~^articles/(\d+)$~' => [\Blog\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\Blog\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\Blog\Controllers\ArticlesController::class, 'add'],
    '~^users/register$~' => [\Blog\Controllers\UsersController::class, 'signUp'],
    '~^$~' => [\Blog\Controllers\MainController::class, 'main'],
];