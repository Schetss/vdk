<?php

namespace Frontend\Modules\Vacatures\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Vacatures\Engine\Model as FrontendVacaturesModel;

/**
 * This is a widget with the Vacatures-categories
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Categories extends Widget
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
        $categories = FrontendVacaturesModel::getAllCategories();

        // any categories?
        if (!empty($categories)) {
            // build link
            $link = Navigation::getURLForBlock('Vacatures', 'category');

            // loop and reset url
            foreach ($categories as &$row) {
                $row['url'] = $link . '/' . $row['url'];
            }
        }

        // assign comments
        $this->tpl->assign('widgetVacaturesCategories', $categories);
    }
}
