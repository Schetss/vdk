<?php

namespace Frontend\Modules\Producten\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Producten\Engine\Model as FrontendProductenModel;

/**
 * This is a widget with the Producten-categories
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Category2 extends Widget
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
        $categories = FrontendProductenModel::getAllCategory2();

        // any categories?
        // if (!empty($categories)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('Producten', 'category');

        //     // loop and reset url
        //     foreach ($categories as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetProductenCategory2', $categories);
    }
}
