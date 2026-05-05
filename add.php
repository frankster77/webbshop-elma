<?php
include_once 'Models/Database.php';
$db = new Database();
$laptop = new Laptop();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $categoryId = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $query = $db->pdo->prepare("INSERT INTO Laptops (name, categoryId, price, description) VALUES (:name, :categoryId, :price, :description)");
    $query->execute([
        'name' => $name,
        'categoryId' => $categoryId,
        'price' => $price,
        'description' => $description
    ]);

    header("Location: admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Laptop</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <section class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <a href="admin.php" class="text-sm text-gray-600 hover:text-gray-800 mb-3 inline-block">
            ← Back to laptops
        </a>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Laptop</h2>

        <form method="post" class="space-y-4">

            <div>
                <label for="name" class="block text-sm text-gray-600 mb-1">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $laptop->name; ?>"
                    class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required>
            </div>

            <div>
                <label for="category" class="block text-sm text-gray-600 mb-1">Category</label>
                <input type="text" id="category" name="category" value="<?php echo $laptop->categoryId; ?>"
                    class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required>
            </div>

            <div>
                <label for="price" class="block text-sm text-gray-600 mb-1">Price</label>
                <input type="number" id="price" name="price" value="<?php echo $laptop->price; ?>"
                    class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required>
            </div>

            <div>
                <label for="description" class="block text-sm text-gray-600 mb-1">Description</label>
                <textarea id="description" name="description"
                    class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400"
                    rows="4" required><?php echo $laptop->description; ?></textarea>
            </div>

            <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white py-2 rounded-md text-sm">
                Update
            </button>

        </form>

    </section>

</body>

</html>