<?php
function productComponent($laptop)
{
    ?>
    <div
        class="flex flex-col h-full items-center justify-center border border-gray-300 rounded-lg p-3 m-3 hover:shadow-lg transition">

        <a href="product.php?id=<?php echo $laptop->id; ?>" class="block">

            <section>
                <img src="<?php echo $laptop->imgUrl; ?>" alt="<?php echo $laptop->name; ?>"
                    class="h-48 w-96 object-contain rounded-lg mb-2" />
            </section>

            <h2 class="text-lg text-center font-semibold p-2">
                <?php echo $laptop->name; ?>
            </h2>

            <p class="text-gray-600 p-1 text-center">
                <?php echo $laptop->price; ?>:-
            </p>

            <p class="text-gray-600 p-1 text-center">
                <?php echo $laptop->description; ?>
            </p>

        </a>
        <form action="addToCart.php" method="POST">

            <input type="hidden" name="productId" value="<?php echo $laptop->id; ?>">

            <button type="submit"
                class="bg-violet-400 text-white px-6 py-2 rounded-full font-medium hover:bg-violet-500 transition">
                Köp
            </button>

        </form>

    </div>
    </a>
    <?php
}

?>