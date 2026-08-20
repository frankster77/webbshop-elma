<?php
ob_start();
session_start();
include_once 'Models/Database.php';
$db = new Database();
$cartItems = [];
if (isset($_SESSION['cartId'])) {
    $cartId = $_SESSION['cartId'];
    $cartItems = $db->getCartItems($cartId);
    $freightId = $_GET['freightId'] ?? null;
    $freightCost = 0;

    $totalWeight = $db->getTotalWeight($cartId);
    $cartTotal = $db->getCartTotal($cartId);

    if ($freightId) {
        $freightRule = $db->getShippingOption($freightId);
        if (
            $freightRule->free_shipping_threshold > 0 &&
            $cartTotal >= $freightRule->free_shipping_threshold
        ) {
            $freightCost = 0;
        } else {
            $freightCost = $freightRule->base_fee +
                ($freightRule->weight_modifier * $totalWeight);
        }

    } else {
        $freightRule = null;
    }

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
                                        <a onclick="updateQuantity(<?= $item['productId'] ?>, 'minus')"
                                            class=" hover:bg-violet-100 px-3 py-1 rounded-l-xl">
                                            -
                                        </a>

                                        <!-- Antal för plus-->
                                        <span class="text-sm font-medium px-2 py-1">
                                            <?= $item['quantity'] ?>
                                        </span>

                                        <!-- Plus -->
                                        <a onclick="updateQuantity(<?= $item['productId'] ?>, 'plus')"
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
            <p>
                Vikt: <?= $db->getTotalWeight($_SESSION['cartId']) ?> kg
            </p>
            <select class="w-full border border-gray-300 rounded-lg p-3 mt-6">
                <option value="">Välj fraktalternativ</option>
                <?php
                $freightRules = $db->getShippingOptions();
                foreach ($freightRules as $rule) {
                    $isSelected = ($rule->id == $freightId) ? "selected" : "";
                    echo "<option $isSelected value='$rule->id'>$rule->zone_name - $rule->base_fee kr + $rule->weight_modifier kr/kg</option>";
                }
                ?>
            </select>

            <div class="mt-6 border-t pt-6">

                <h2 class="font-light text-lg mb-2">Totalpris</h2>
                <div class="flex items-center gap-7 mb-4">

                    <p id="conversion-result" class="text-xl font-bold">
                        <?= number_format($db->getCartTotal($_SESSION['cartId']) + $freightCost, 2) ?> SEK
                    </p>

                    <select id="currency" class="border border-gray-300 rounded-lg p-2">
                        <option value="SEK">SEK</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <form action="checkout.php" method="POST">
                    <button
                        class="bg-violet-400 text-white px-3 py-4 rounded-full w-50 text-center font-medium hover:bg-violet-500">
                        Fortsätt till betalning
                    </button>
                </form>

            </div>

    </div>
    </div>
    <script>
        document.querySelector("select").addEventListener("change", async function () {
            updateQuantity(null, "freightChange");

            // här ska du uppdatera totalsumman i UI
        });
        function updateQuantity(productId, action) {
            // Logik för att hantera klick på produkt
            if (action === "plus") {
                window.location.href = "updateQuantity.php?action=plus&productId=" + productId + "&freightId=" +
                    document.querySelector("select").value;
            } else if (action === "minus") {
                window.location.href = "updateQuantity.php?action=minus&productId=" + productId + "&freightId=" +
                    document.querySelector("select").value;
            } else if (action === "freightChange") {
                window.location.href = "cart.php?freightId=" + document.querySelector("select").value;
            }
        }
    </script>
    <script>
        const amount = <?= $db->getCartTotal($_SESSION['cartId']) + $freightCost ?>;
        const currency = document.getElementById("currency");
        const result = document.getElementById("conversion-result");

        const APP_ID = "2a6ed835dc0d45b4a340b58ab81f91b5";

        async function convertCurrency() {
            const selectedCurrency = currency.value;

            if (selectedCurrency === "SEK") {
                result.textContent = amount.toFixed(2) + " SEK";
                return;
            }

            try {
                const response = await fetch(
                    `https://openexchangerates.org/api/latest.json?app_id=${APP_ID}`
                );

                const data = await response.json();

                const converted =
                    amount * (data.rates[selectedCurrency] / data.rates.SEK);

                result.textContent =
                    converted.toFixed(2) + " " + selectedCurrency;

            } catch (error) {
                console.error(error);
                result.textContent = "Kunde inte konvertera valutan.";
            }
        }

        currency.addEventListener("change", convertCurrency);

        convertCurrency();
    </script>
</body>
</body>

</html>