<?php

namespace Frontend\Modules\Contact\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Contact\Engine\Model as FrontendContactModel;

/**
 * This is a widget with the Contact-werknemers
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Verkoop extends Widget
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
        // get werknemers
        $werknemers = FrontendContactModel::getAllVerkoop();

        // // any werknemers?
        // if (!empty($werknemers)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('Contact', 'category');

        //     // loop and reset url
        //     foreach ($werknemers as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetContactVerkoop', $werknemers);
    }
}
