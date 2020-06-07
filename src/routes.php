<?php

/* Навигация в url строке */

return [
    '~^articles/(\d+)$~' => [\Blog\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\Blog\Controllers\ArticlesController::class, 'edit'],
    '~^$~' => [\Blog\Controllers\MainController::class, 'main'],
    '~^articles/add$~' => [\Blog\Controllers\ArticlesController::class, 'add'],
    ];