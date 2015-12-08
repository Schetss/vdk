<?php

namespace Frontend\Modules\Service\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Service\Engine\Model as FrontendServiceModel;

/**
 * This is a widget with the Service-categories
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Category1 extends Widget
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
        // get categories
        $categories = FrontendServiceModel::getAllCategory1();

        // any categories?
        // if (!empty($categories)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('Service', 'category');

        //     // loop and reset url
        //     foreach ($categories as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetServiceCategory1', $categories);
    }
}
