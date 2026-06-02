<?php

class HeaderComponent
{
    public function render()
    {
        echo '
       <section class="bg-gradient-to-r from-purple-300 to-white text-black pt-40 pb-50">
            <div class="max-w-5xl mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    LaptopStore
                </h1>
                <p class="text-lg md:text-l mb-8 text-black/80">
                    I vår laptopbutik möts nyfikenhet och trygghet under samma tak. 
                    För dig som är ung och brinner för webbutveckling erbjuder vi kraftfulla datorer som klarar allt från kodning och design till tunga utvecklingsmiljöer. 
                    Här hittar du laptops med snabb prestanda, högupplösta skärmar och flexibilitet som gör det enkelt att arbeta var du vill – oavsett om du bygger din första hemsida eller jobbar med avancerade projekt.
                    Samtidigt är vi en butik där alla ska känna sig välkomna, även du som kanske tycker att datorer känns krångliga. 
                    Vi tar oss tid att lyssna, förklara och guida dig till rätt val i lugn och ro. 
                    Behöver du hjälp att komma igång? Vi finns här för att visa hur allt fungerar – från att starta datorn till att använda internet, e-post och videosamtal.
                    Hos oss handlar det inte bara om teknik, utan om människor. 
                    Vi tror på att göra det digitala livet enklare, roligare och mer tillgängligt för alla – oavsett erfarenhet.
                </p>
            </div>
            <div class="flex justify-center p-10">
                <!-- Robot -->
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                     stroke="#060505" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-bot-icon lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/>
                    <path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
    </div>
</div>

  </section>
        ';
    }
}

?>