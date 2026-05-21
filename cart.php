<?php
ob_start();
session_start();
include_once 'Models/Database.php';
$db = new Database();
$cartItems = [];
if (isset($_SESSION['cartId'])) {
    $cartItems = $db->getCartItems($_SESSION['cartId']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Varukorg</title>
</head>

<body>
    <div class="min-h-screen flex justify-center items-center bg-gray-100">
        <section class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <a href="/" class="text-sm text-gray-600 hover:text-gray-800 mb-3 inline-block">
                ← Back to Main Store
            </a>
            <div class="cart flex flex-col gap-4">

                <?php foreach ($cartItems as $item): ?>

                    <div class="item flex items-center justify-between border rounded-lg p-4 shadow-sm">
                        <div class="flex items-center gap-4">
                            <img src="<?= $item['imgUrl'] ?>" alt="<?= $item['name'] ?>"
                                class="w-38 h-28 object-cover rounded-md">
                            <div>
                                <h3 class="text-lg font-semibold">
                                    <?= $item['name'] ?>
                                </h3>

                                <p class="text-gray-700 font-medium">
                                    <?= $item['price'] ?> kr
                                </p>

                                <!-- Antal för minus-->
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="border-2 border-gray-400 p-1.5 rounded">



                                        <!-- Minus -->
                                        <a href="updateQuantity.php?action=minus&productId=<?= $item['productId'] ?>"
                                            class=" hover:bg-violet-100 px-3 py-1 rounded-l-xl">
                                            -
                                        </a>

                                        <!-- Antal för plus-->
                                        <span class="text-sm font-medium px-2 py-1">
                                            <?= $item['quantity'] ?>
                                        </span>

                                        <!-- Plus -->
                                        <a href="updateQuantity.php?action=plus&productId=<?= $item['productId'] ?>"
                                            class="hover:bg-violet-100 px-3 py-1 rounded-r-xl">
                                            +
                                        </a>
                                    </div>

                                    <!-- Soptunna -->
                                    <a href="removeFromCart.php?productId=<?= $item['productId'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="28" viewBox="0 0 24 24"
                                            fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>


                        </div>

                    </div>


                <?php endforeach; ?>

            </div>

            <?php if (isset($_SESSION['cartId'])): ?>
                <div class="cart-total text-xl font-bold p-3">
                    <h2>
                        Totalt: <?= $db->getCartTotal($_SESSION['cartId']) ?> kr
                    </h2>
                </div>
            <?php endif; ?>
            <div class="flex justify-center">
            <section
                class="bg-violet-400 text-white px-3 py-4 rounded-full w-50 text-center font-medium hover:bg-violet-500">
                Fortsätt till betalning -> Ej tillgänglig
            </section>

            </div>
    </div>
</body>

</html>