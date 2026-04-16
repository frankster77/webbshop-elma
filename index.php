<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <nav
        class="bg-violet-400 fixed w-full top-4 left-1/2 -translate-x-1/2 w-full max-w-5xl rounded-full border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-8 py-4">
            <ul
                class="flex flex-col p-4 md:p-0 mt-3 font-medium border border-default rounded-base md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white bg-brand rounded-sm md:bg-transparent md:hover:text-white/75 md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Products</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Login</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-black/50 md:p-0 md:dark:hover:bg-transparent">Create
                        account</a>
                </li>
            </ul>
            <form class="max-w-md ml-auto mr-8">
                <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="search"
                        class="block w-full p-3 ps-10 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                        placeholder="Search" required />
                    <button type="button"
                        class="absolute end-1.5 bottom-1.5 text-white bg-violet-400 hover:bg-violet-500 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
                </div>
            </form>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
           class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
           <circle cx="8" cy="21" r="1" />
           <circle cx="19" cy="21" r="1" />
           <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
       </svg>
       <span id="cart-count" class="absolute top-0 right-0 mt-4 mr-4 text-xs font-medium text-black bg-white rounded-full px-1.5 py-0.5">0</span>
   </div>
</body>

</html>