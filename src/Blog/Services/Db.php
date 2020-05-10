<?php

/* Класс для базы данных */

namespace Blog\Services;

class Db
{
    /** @var \PDO */
    private $pdo;

    public function __construct() # коннект к бд с помощью PDO
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
            );
        $this->pdo->exec('SET NAME UTF8');
    }

    public function query(string $sql, array $params=[], string $className): ?array # функция запроса к бд
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result)
        {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}