<?php
include_once 'Models/UserDatabase.php';
include_once 'Models/Products.php';
include_once 'Models/Category.php';
include_once 'vendor/autoload.php';

class Database
{
    public $pdo;
    private $usersDatabase;


    function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['DATABASE_HOST'];
        $db = $_ENV['DATABASE_DB'];
        $username = $_ENV['DATABASE_USERNAME'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $port = $_ENV['DATABASE_PORT'];

        $dsn = "mysql:host=$host;port=$port;dbname=$db";
        $this->pdo = new PDO($dsn, $username, $password);

        $this->usersDatabase = new UserDatabase($this->pdo);
        $this->usersDatabase->setupUsers();
        $this->usersDatabase->seedUsers();

    }
    function getPopularLaptops()
    {
        $query = $this->pdo->query("SELECT * FROM Laptops ORDER BY popularityFactor DESC LIMIT 0, 10");
        $Laptops = $query->fetchAll(PDO::FETCH_CLASS, "Laptop");
        return $Laptops;
    }

    function getAllLaptops()
    {
        $query = $this->pdo->query("SELECT * FROM Laptops");
        $Laptops = $query->fetchAll(PDO::FETCH_CLASS, "Laptop");
        return $Laptops;
    }

    function getAllCategories()
    {
        $query = $this->pdo->query("SELECT * FROM Categories");
        return $query->fetchAll(PDO::FETCH_CLASS, "Category");
    }

    function searchLaptops($searchWord)
    {
        $query = $this->pdo->prepare("SELECT * FROM Laptops WHERE name like :searchWord");
        $searchWordWithProcent = '%' . $searchWord . '%';
        $query->execute(['searchWord' => $searchWordWithProcent]);

        $query->execute(['searchWord' => '%' . $searchWord . '%']);
        $Laptops = $query->fetchAll(PDO::FETCH_CLASS, "Laptop");
        return $Laptops;
    }

    function getLaptopById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Laptops WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetchObject("Laptop");
    }

    function getLaptopsInCategory($categoryId, $sort, $order)
    {
        if (!in_array($sort, ['name', 'price'])) {
            $sort = 'name';
        }
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }
        $query = $this->pdo->prepare("SELECT * FROM Laptops WHERE categoryId = :categoryId ORDER BY $sort $order");
        $query->execute(['categoryId' => $categoryId]);
        return $query->fetchAll(PDO::FETCH_CLASS, "Laptop");
    }

    function getCategoryById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Categories WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetchObject("Category");
    }

    function createCart($userId)
    {
        $query = $this->pdo->prepare("INSERT INTO Cart (userId) VALUES (:userId)");
        $query->execute(['userId' => $userId]);
        return $this->pdo->lastInsertId();
    }

    function addToCart($cartId, $productId)
    {

        $query = $this->pdo->prepare("INSERT INTO CartItem (cartId, productId, quantity) VALUES (:cartId, :productId, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $query->execute([
            'cartId' => $cartId,
            'productId' => $productId
        ]);
    }

    function getCartItems($cartId)
    {
        $query = $this->pdo->prepare("SELECT CartItem.productId,CartItem.quantity,Laptops.name,Laptops.price,Laptops.imgUrl FROM CartItem JOIN Laptops ON CartItem.productId = Laptops.id WHERE CartItem.cartId = :cartId");
        $query->execute([
            'cartId' => $cartId
        ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCartTotal($cartId)
    {
        $query = $this->pdo->prepare("SELECT SUM(Laptops.price * CartItem.quantity) AS total FROM CartItem JOIN Laptops ON CartItem.productId = Laptops.id WHERE CartItem.cartId = :cartId");
        $query->execute(['cartId' => $cartId]);

        return $query->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
    public function deleteCartItem($cartId, $productId)
    {
        $delete = $this->pdo->prepare("DELETE FROM CartItem WHERE cartId = :cartId AND productId = :productId");

        $delete->execute([
            'cartId' => $cartId,
            'productId' => $productId
        ]);
    }

    function getCartCount($cartId)
    {
        $query = $this->pdo->prepare("
        SELECT SUM(quantity) AS total
        FROM CartItem
        WHERE cartId = :cartId
    ");

        $query->execute([
            'cartId' => $cartId
        ]);

        return $query->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    function updateQuantity($cartId, $productId, $quantity)
    {
        $query = $this->pdo->prepare("UPDATE CartItem SET quantity = :quantity WHERE cartId = :cartId AND productId = :productId");
        $query->execute([
            'quantity' => $quantity,
            'cartId' => $cartId,
            'productId' => $productId
        ]);
    }
    function getUsersDatabase()
    {
        return $this->usersDatabase;
    }

    function clearCart($cartId)
    {
        $query = $this->pdo->prepare("DELETE FROM CartItem WHERE cartId = :cartId");
        $query->execute(['cartId' => $cartId]);
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

    function updateFreightRule($zoneCode, $zoneName, $baseFee, $weightMultiplier, $freeShippingThreshold)
    {
        $query = $this->pdo->prepare("INSERT INTO freight_rules (zone_code, zone_name, base_fee, weight_modifier, free_shipping_threshold) VALUES (:zone_code, :zone_name, :base_fee, :weight_multiplier, :free_shipping_threshold) ON DUPLICATE KEY UPDATE zone_name = :zone_name, base_fee = :base_fee, weight_modifier = :weight_multiplier, free_shipping_threshold = :free_shipping_threshold");
        $query->execute([
            'zone_code' => $zoneCode,
            'zone_name' => $zoneName,
            'base_fee' => $baseFee,
            'weight_multiplier' => $weightMultiplier,
            'free_shipping_threshold' => $freeShippingThreshold
        ]);
    }

    function getShippingOptions()
    {
        $query = $this->pdo->prepare("SELECT * FROM freight_rules");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getShippingOption($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM freight_rules WHERE id = :id");
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getTotalWeight($cartId)
    {
        $query = $this->pdo->prepare("SELECT SUM(Laptops.weight * CartItem.quantity) AS total_weight FROM CartItem JOIN Laptops ON CartItem.productId = Laptops.id WHERE CartItem.cartId = :cartId");
        $query->execute(['cartId' => $cartId]);

        return $query->fetch(PDO::FETCH_ASSOC)['total_weight'] ?? 0;
    }



}
