<?php

namespace Frontend\Modules\Openingsuren\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Openingsuren\Engine\Model as FrontendOpeningsurenModel;

/**
 * This is a widget with the Openingsuren-open
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Openingsuren extends Widget
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
        // get open
        $open = FrontendOpeningsurenModel::getAllOpeningsuren();

        // // any open?
        // if (!empty($open)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('Openingsuren', 'category');

        //     // loop and reset url
        //     foreach ($open as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetOpeningsuren', $open);
    }
}
