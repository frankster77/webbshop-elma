<?php
class FooterComponent {
    public function render() {
        echo '
       <footer class="bg-violet-500 text-white py-10 pt-12 mt-10">
           <div class="container mx-auto text-center">
               <p>&copy; ' . date("Y") . ' Laptopshop. All rights reserved.</p>
           </div>
       </footer>';
    }
}
?>