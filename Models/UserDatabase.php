<?php
include_once 'vendor/autoload.php';


class UserDatabase
{
    private $pdo;
    private $auth;

    function getAuth()
    {
        return $this->auth;
    }
    function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->auth = new \Delight\Auth\Auth($pdo);
    }

    function setupUsers()
    {
    }



    function seedUsers()
    {
        if ($this->pdo->query("select * from users where email='elma.hejsan@system.se'")->rowCount() == 0) {
            $userId = $this->auth->admin()->createUser("elma.hejsan@system.se", "Hejsan123#", "elma.hejsan@system.se");
        }
    }

    function addUserDetails($id, $streetaddress, $name, $postalCode, $city)
    {
        $query = $this->pdo->prepare("INSERT INTO UserDetails (id, streetaddress, name, postalCode, city) VALUES (:id, :streetaddress, :name, :postalCode, :city)");
        $query->execute([
            "id" => $id,
            "streetaddress" => $streetaddress,
            "name" => $name,
            "postalCode" => $postalCode,
            "city" => $city
        ]);
    }


}

?>