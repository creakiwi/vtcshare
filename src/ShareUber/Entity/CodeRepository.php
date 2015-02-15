<?php

namespace ShareUber\Entity;

class CodeRepository
{
    private $dbh = null;

    public function __construct($dsn, $user, $passwd)
    {
        try {
            $this->dbh = new \PDO($dsn, $user, $passwd);
        } catch (\PDOException $e) {
        }
    }

    public function connectionEstablished()
    {
        return $this->dbh !== null;
    }

    public function findRandomCode($type)
    {
        $query = $this->dbh->query(sprintf('SELECT code FROM code WHERE type=\'%s\' ORDER BY weight * RAND() DESC LIMIT 0, 1', $type));
        $code = $query->fetchColumn();

        $stmt = $this->dbh->prepare('UPDATE code SET display=display+1 WHERE type=:type and code=:code');
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        return $code;
    }

    public function insertCode($type, $code)
    {
        $stmt = $this->dbh->prepare('INSERT INTO code(type, code) VALUES (:type, :code)');
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
    }

    public function fuckedUp($type, $code)
    {
        $stmt = $this->dbh->prepare('UPDATE code SET fuckedup=fuckedup+1 WHERE type=:type AND code=:code');
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
    }
}
