<?php
function productComponent($laptop) {
?>    
<div class="flex flex-col items-center justify-center border border-gray-300 rounded-lg p-3 m-3">
                <section>
                    <img src="<?php echo $laptop->imgUrl; ?>" alt="<?php echo $laptop->name; ?>"
                        class="h-48 w-96 object-contain rounded-lg mb-2" />
                </section>
                <h2 class="text-lg font-semibold p-2"><?php echo $laptop->name; ?></h2>
                <p class="text-gray-600 p-1"><?php echo $laptop->price; ?>:-</p>
                <p class="text-gray-600 p-1 text-center"><?php echo $laptop->description; ?></p>
                <a href="#"
                    class="bg-violet-400 text-white px-6 py-3 p-1 rounded-full font-medium hover:bg-violet-500 transition">
                    Köp
                </a>
            </div>
            <?php
}

?>
