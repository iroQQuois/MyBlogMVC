<?php
namespace Blog\Controllers;

use Blog\Models\Users\User;
use Blog\Models\Users\UserActivationService;
use Blog\Services\EmailSender;
use Blog\View\View;
use InvalidArgumentException;


class  UsersController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);

            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User)
            {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');
    }
}