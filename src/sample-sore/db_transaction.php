<?php

// https://www.digitalocean.com/community/tutorials/how-to-use-the-pdo-php-extension-to-perform-mysql-transactions-in-php-on-ubuntu-18-04

// running on nginx
// http://introphp/sample-sore/orders.php

class DBTransaction
{
    protected $pdo;
    public $last_insert_id;

    public function __construct()
    {
        // Defining some constants at runtime
        define('DB_NAME', 'sample_store');
        define('DB_USER', 'sample_user');
        define('DB_PASSWORD', 'PASSWORD');
        define('DB_HOST', 'localhost');

        $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . 
            ";dbname=" . DB_NAME, 
            DB_USER, DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function startTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function insertQuery($sql, $data)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $this->last_insert_id = $this->pdo->lastInsertId();
    }

    public function submit()
    {
        try {
            $this->pdo->commit();
        } catch(PDOException $e) {
            echo 'Oh shit!: ' . $e;
            $this->pdo->rollBack();
            return false;
        }

          return true;
    }
}

