<?php
include_once 'Models/Database.php';
$db = new Database();
$allproducts = $db->getAllLaptops();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laptopshop</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <section class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
        <a href="/" class="text-sm text-gray-600 hover:text-gray-800 mb-3 inline-block">
            ← Back to Main Store
        </a>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">💻 All Laptops</h2>
            <a href="add.php" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md text-sm">
                Add New +
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b text-gray-600 text-sm">
                        <th class="p-2">Name</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    <?php foreach ($allproducts as $product): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2"><?php echo $product->name; ?></td>
                            <td class="p-2"><?php echo $product->categoryId; ?></td>
                            <td class="p-2"><?php echo $product->price; ?> kr</td>

                            <td class="p-2">
                                <a href="edit.php?id=<?php echo $product->id; ?>"
                                    class="bg-violet-400 hover:bg-violet-500 text-white px-3 py-1 rounded-lg text-sm transition">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </section>

</body>

</html>