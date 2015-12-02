{*
    variables that are available:
    - {$widgetCallToActionFooterWidget}:
*}

{option:widgetCallToActionFooterWidget}
<div>
    <section class="section-alt section-inset">
        <div class="wrapper">
            <div class="wrapper-inner">
                <div class="grid">
                    <div class="grid-items group">
                       {iteration:widgetCallToActionFooterWidget} <div class="grid-m-1of3 grid-s-1of1 grid-xs-1of1"><div class="grid-item"><div class="entry entry-box group"><h3><a id="maincontent_0_Teasers_teasersgrid_0_teasersleft_0_HypTeaserTitle" href="{$widgetCallToActionFooterWidget.link}">{$widgetCallToActionFooterWidget.title}</a></h3><a href="{$widgetCallToActionFooterWidget.link}"><img src="{$SITE_URL}/src/Frontend/Files/CallToAction/afbeelding/400x300/{$widgetCallToActionFooterWidget.img}" alt="{$widgetCallToActionFooterWidget.title}"></a>{$widgetCallToActionFooterWidget.content}<a href="{$widgetCallToActionFooterWidget.link}" target="" title="" class="button button-att" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetCallToActionFooterWidget.linktext}</a></div></div></div>{/iteration:widgetCallToActionFooterWidget}
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>
   
{/option:widgetCallToActionFooterWidget}


