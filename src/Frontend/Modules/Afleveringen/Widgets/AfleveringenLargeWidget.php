<?php

namespace Frontend\Modules\Afleveringen\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Afleveringen\Engine\Model as FrontendAfleveringenModel;

/**
 * This is a widget with the Afleveringen-afleveringen
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class AfleveringenLargeWidget extends Widget
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
        // get afleveringen
        $afleveringen = FrontendAfleveringenModel::getAllAfleveringLarge();

        // any afleveringen?
        // if (!empty($afleveringen)) {
        //     // build link
        //     $link = Navigation::getURLForBlock('Afleveringen', 'category');

        //     // loop and reset url
        //     foreach ($afleveringen as &$row) {
        //         $row['url'] = $link . '/' . $row['url'];
        //     }
        // }

        // assign comments
        $this->tpl->assign('widgetAfleveringLarge', $afleveringen);
    }
}
