<?php

namespace AppBundle\Model;


use Doctrine\DBAL\Connection;

/**
 * Class Product
 * @package AppBundle\Model
 */
class Product
{
    /** @var Connection */
    private $conn;

    /**
     * Product constructor.
     *
     * @param Connection $conn
     */
    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $product
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function create($product)
    {
        $stmt = $this->conn->prepare('INSERT INTO ean (`name`, `ean`, `material`, `price`, `vat`)
                                VALUES (:name, :ean, :material, :price, :vat)');

        foreach ($product as $field => $value) {
            $stmt->bindValue(':' . $field, $value, \PDO::PARAM_STR);
        }

        $stmt->execute();
    }


}