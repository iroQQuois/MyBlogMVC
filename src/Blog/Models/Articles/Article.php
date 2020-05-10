<?php
namespace Blog\Models\Articles;

use Blog\Models\ActiveRecordEntity;
use Blog\Models\Users\User;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected string $name;

    /** @var string */
    protected string $text;

    /** @var string */
    protected string $authorId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }
}