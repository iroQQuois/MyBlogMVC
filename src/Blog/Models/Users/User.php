<?php

/* класс пользователя */

namespace Blog\Models\Users;

use Blog\Models\ActiveRecordEntity;
use InvalidArgumentException;

class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    public static function signUp(array $userData)
    {
        // Проверки
        if (empty($userData['nickname']))
        {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname']))
        {
            throw new InvalidArgumentException('Никнейм может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($userData['email']))
        {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidArgumentException('Мыло может состоять только из символов латинского алфавита и цифр');
        }

        if (mb_strlen($userData['password']) < 8)
        {
            throw new InvalidArgumentException('Пароль должен состоять из не менее 8 символов');
        }

        if (static::findOneByColumn('nickname', $userData['nickname']) !== null)
        {
            throw new InvalidArgumentException('Пользователь с таким ником уже зарегистрирован');
        }

        if (static::findOneByColumn('email', $userData['email']) !== null)
        {
            throw new InvalidArgumentException('Пользователь с таким мылом уже зарегистрирован');
        }


        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        // таким способом мы не передаём пароль ни в куки, ни в кеш, а юзаем токен
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;

    }

    public function getEmail(): string
    {
        return $this->email;
    }
}