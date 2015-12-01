{*
    variables that are available:
    - {$widgetCarousel}:
*}

{option:widgetCarousel}
   
	
 <div class="carousel-header" data-behaviour="daf.ui.Carousel" data-carousel-index="daf.ui.CarouselHeaderIndex" data-options='{"speed":500,"auto":5000,"continuous":true}'>
    <div>
        <ul class="reset-list carousel-items">{iteration:widgetCarousel}<li data-index-title="{$widgetCarousel.title}" data-index-subtitle="{$widgetCarousel.subtitle}"><figure class="top-left"><a href="{$widgetCarousel.link}"><img src="{$SITE_URL}/src/Frontend/Files/Carousel/afbeelding/940x400/{$widgetCarousel.img}" alt="" /><figcaption class="carousel-item-description"><span class="title">{$widgetCarousel.title}</span><span class="subtitle">{$widgetCarousel.subtitle}</span></figcaption></a></figure></li>{/iteration:widgetCarousel}
        </ul>
    </div>
</div>


{/option:widgetCarousel} 

