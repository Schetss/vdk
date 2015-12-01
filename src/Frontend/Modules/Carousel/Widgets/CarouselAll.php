<?php

namespace Frontend\Modules\Carousel\Widgets;

/*
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Carousel\Engine\Model as FrontendCarouselModel;

/**
 * This is a widget for the carousel
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class CarouselAll extends FrontendBaseWidget
{
    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();
        $this->loadTemplate();
        $this->parse();
    }

    /**
     * Parse
     */

    private function parse()
    {
        $CarouselAll = FrontendCarouselModel::getAllCarousel();
        $this->tpl->assign('widgetCarousel', $CarouselAll);
    }
}
