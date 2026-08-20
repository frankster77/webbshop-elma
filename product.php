<?php
ob_start();
session_start();
include_once 'Models/Products.php';
include_once 'Components/ProductComponent.php';
include_once 'Components/HeaderComponent.php';
$header = new HeaderComponent();
include_once 'Models/Database.php';
$db = new Database();
$laptop = $db->getLaptopById($_GET['id'] ?? 1);
include_once 'Components/FooterComponent.php';
$footer = new FooterComponent();
if (isset($_SESSION['cartId'])) {
    $cartCount = $db->getCartCount($_SESSION['cartId']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title> - Laptopshop</title>
</head>

<body>
    <nav
        class="bg-violet-400 fixed w-full top-4 left-1/2 -translate-x-1/2 max-w-5xl rounded-full border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-8 py-4">
            <ul
                class="flex flex-col p-4 md:p-0 mt-3 font-medium border border-default rounded-base md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="index.php"
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
                    <a href="accountLogin.php"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-1 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Logga
                        in</a>
                </li>
                <li>
                    <a href="accountRegister.php"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Skapa
                        konto</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['email'])): ?>
                <div class="flex items-center gap-2 text-white text-base ml-8">
                    <span class="opacity-90">
                        <?= htmlspecialchars($_SESSION['email']) ?>
                    </span>

                    <a href="logout.php" class="text-white/80 hover:text-white underline underline-offset-2">
                        Logga ut
                    </a>
                </div>
            <?php endif; ?>

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
            <a href="cart.php" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>

                <!-- Cart Count -->
                <span id="cart-count"
                    class="absolute -top-2 -right-3 text-xs font-medium text-black bg-white rounded-full px-1.5 py-0.5">
                    <?= $cartCount ?>
                </span>
            </a>
        </div>
    </nav>

    <!-- Product Details Section -->
    <div class="max-w-5xl mx-auto mt-32 px-2">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 flex flex-col md:flex-row gap-10 min-h-[700px]">
            <div class="flex-1 flex items-center justify-center">
                <img src="<?php echo $laptop->imgUrl; ?>" alt="<?php echo $laptop->name; ?>"
                    class="w-90 object-cover rounded-lg shadow-md" />
            </div>
            <div class="flex-1 flex flex-col justify-center">

                <h1 class="text-3xl font-bold mb-6"><?php echo $laptop->name; ?></h1>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed"><?php echo $laptop->description; ?></p>
                <p class="text-2xl font-bold text-violet-500 mb-4"><?php echo $laptop->price; ?> kr</p>

                <form action="addToCart.php" method="POST">

                    <input type="hidden" name="productId" value="<?php echo $laptop->id; ?>">

                    <button type="submit"
                        class="bg-violet-400 text-white px-6 py-2 rounded-full font-medium hover:bg-violet-500 transition">
                        Lägg i varukorg
                    </button>

                </form>

            </div>

        </div>
    </div>
    <?php $footer->render(); ?>

</body>

</html>