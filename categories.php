<?php
include_once 'Components/ProductComponent.php';
include_once 'Components/HeaderComponent.php';
$header = new HeaderComponent();
include_once 'Models/Database.php';
$db = new Database();
$sort = $_GET['sort'] ?? 'name';
$order = $_GET['order'] ?? 'asc';
$laptops = $db->getLaptopsInCategory($_GET['id'] ?? '', $sort, $order);
$selectedOption = $sort . '-' . $order;
$laptop = $db->searchLaptops($_GET['search'] ?? '');

include_once 'Components/FooterComponent.php';
$footer = new FooterComponent();

$category = $db->getCategoryById($_GET['id'] ?? '');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laptopshop</title>
</head>

<body>
    <nav
        class="bg-violet-400 fixed w-full top-4 left-1/2 -translate-x-1/2 max-w-5xl rounded-full border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-8 py-4">
            <ul
                class="flex flex-col p-4 md:p-0 mt-3 font-medium border border-default rounded-base md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white bg-brand rounded-sm md:bg-transparent md:hover:text-white/75 md:p-0"
                        aria-current="page">Hem</a>
                </li>
                <li class="relative group">
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0">
                        Produkter
                    </a>

                    <!-- Dropdown -->
                    <ul class="absolute left-0 top-full hidden group-hover:block bg-white shadow-lg rounded w-40">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 font-bold">Alla produkter</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Datorer</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-1 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Logga
                        in</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Skapa
                        konto</a>
                </li>
            </ul>
            <!-- Search Form -->
            <form method="get" action="search.php" class="max-w-md ml-auto mr-8">
                <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Sök</label>
                <!-- Search Icon -->
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <!-- Search Input -->
                    <input type="search" name="search" id="search"
                        class="block w-full p-3 ps-10 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                        placeholder="Sök" required />
                    <button type="submit"
                        class="absolute end-1.5 bottom-1.5 text-white bg-violet-400 hover:bg-violet-500 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Sök</button>
                </div>
            </form>

            <!-- Shopping Cart Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                <circle cx="8" cy="21" r="1" />
                <circle cx="19" cy="21" r="1" />
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg>
            <span id="cart-count"
                class="absolute top-0 right-0 mt-4 mr-5 text-xs font-medium text-black bg-white rounded-full px-1.5 py-0.5">0</span>
        </div>
    </nav>

    <?php $header->render(); ?>

    <!-- Popular Products Section -->
    <h1 class="text-center text-2xl font-bold font-mono mb-4 p-10"><?php echo $category->category; ?></h1>
    <select id="sortSelect" class="mb-4 border border-gray-400 p-2">
        <option value="default">Sortera efter:</option>
        <option value="name_asc" <?php echo $selectedOption === 'name-asc' ? 'selected' : ''; ?>>Namn A-Ö</option>
        <option value="name_desc" <?php echo $selectedOption === 'name-desc' ? 'selected' : ''; ?>>Namn Ö-A</option>
        <option value="price_asc" <?php echo $selectedOption === 'price-asc' ? 'selected' : ''; ?>>Lägsta pris</option>
        <option value="price_desc" <?php echo $selectedOption === 'price-desc' ? 'selected' : ''; ?>>Högsta pris</option>
    </select>
    <div class="grid grid-cols-3 gap-3">
        <?php foreach ($laptops as $laptop):
            productComponent($laptop);
        endforeach; ?>
    </div>
    <?php $footer->render(); ?>
    <script src="Js/scripts.js"></script>
</body>

</html>