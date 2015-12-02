<?php

namespace Frontend\Modules\Location\Widgets;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Modules\Location\Engine\Model as FrontendLocationModel;

/**
 * This is the location-widget: 1 specific address
 *
 * @author Matthias Mullie <forkcms@mullie.eu>
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 * @author Tijs Verkoyen <tijs@sumocoders.be>
 */

class ContactForm extends FrontendBaseWidget
{
    
    public function execute()
    {
       
        parent::execute();

        $this->loadTemplate();
        $this->parse();
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        $contact = FrontendLocationModel::getContactForm();
        $this->tpl->assign('widgetContactForm', $contact);
    }
}
