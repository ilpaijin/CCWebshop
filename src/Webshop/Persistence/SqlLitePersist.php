<?php

namespace Webshop\Persistence;

/**
* SqlLitePersist class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class SqlLitePersist 
{
    protected $db;

    public function __construct()
    {
        $this->db = new \PDO('sqlite::memory:');
        $this->setTable();
    }

    public function setTable()
    {
        $this->db->exec('
            CREATE TABLE Cart (Id TEXT, Product TEXT, Qty INT, Price REAL, ListPrice REAL, Type TEXT, Exp TEXT)
        ');
    }

    public function save( array $data)
    {
        $insert = ('
            INSERT INTO Cart (Id, Product, Qty, Price, ListPrice, Type, Exp) 
            VALUES (:id, :product, :qty, :price, :listPrice, :type, :exp)
            ');

        $stmt = $this->db->prepare($insert);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product', $product);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':listPrice', $listPrice);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':exp', $expiration);

        foreach($data as $d)
        {
            $id = $d->getId();
            $product = $d->getName();
            $qty = $d->getQty();
            $price = $d->getPrice();
            $listPrice = $d->getListPrice();
            $type = $d->getType();
            $expiration = $d->getExpiration() ? $d->getExpiration()->format('Y-m-d H:i:s') :$d->getExpiration();
            
            $stmt->execute();
        }
    }

    public function getContents()
    {
        $res = $this->db->query("SELECT * FROM Cart");

        foreach($res as $row) {
            echo "<br />**********<br />";
            echo "Id: " . $row['Id'] . "<br />";
            echo "Product: " . $row['Product'] . "<br />";
            echo "Qty: " . $row['Qty'] . "<br />";
            echo "Sell Price: " . $row['Price'] . "<br />";
            echo "List Price: <del>" . $row['ListPrice'] . "</del><br />";
            echo "Type: " . $row['Type'] . "<br />";
            echo "Exp: " . $row['Exp'] . "<br />";
            echo "Partial: " . $row['Qty'] * $row['Price'] . "<br />";
            echo "**********<br />";
        }
    }
}
