<?php
include_once 'vendor/autoload.php';
include_once 'Models/Database.php';
$db = new Database();
$db->clearCart($_SESSION['cartId']);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orderbekräftelse</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="max-w-5xl mx-auto mt-32 px-2">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center text-lg">
            <h1 class="font-bold text-2xl">Tack för din beställning!</h1>
            <section class="flex justify-center my-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-badge-check-icon lucide-badge-check">
                    <path
                        d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
            </section>
            <p>Din beställning har genomförts och kommer att behandlas inom kort.</p>
            <a href="/" class="text-sm text-blue-500 hover:text-blue-800 mb-3 inline-block">
                ← Back to Main Store
            </a>
        </div>
    </div>
</body>

</html>