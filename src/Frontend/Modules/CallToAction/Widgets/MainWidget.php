<?php

namespace Frontend\Modules\CallToAction\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\CallToAction\Engine\Model as FrontendCallToActionModel;

/**
 * This is a widget with the Call To Action-calltoactions
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class MainWidget extends Widget
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
        // get calltoactions
        $calltoactions = FrontendCallToActionModel::getAllMainWidgets();

        // // any calltoactions?
        // if (!empty($calltoactions)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('CallToAction', 'category');

        //     // loop and reset url
        //     foreach ($calltoactions as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetCallToActionMainWidget', $calltoactions);
    }
}
