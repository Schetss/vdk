<?php

namespace Backend\Modules\CallToAction\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Call To Action module
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Installer extends ModuleInstaller
{
    public function install()
    {
        // import the sql
        $this->importSQL(dirname(__FILE__) . '/Data/install.sql');

        // install the module in the database
        $this->addModule('CallToAction');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'CallToAction');

        $this->setActionRights(1, 'CallToAction', 'Index');
        $this->setActionRights(1, 'CallToAction', 'Add');
        $this->setActionRights(1, 'CallToAction', 'Edit');
        $this->setActionRights(1, 'CallToAction', 'Delete');
        $this->setActionRights(1, 'call_to_action', 'Sequence');
        $this->setActionRights(1, 'CallToAction', 'Categories');
        $this->setActionRights(1, 'CallToAction', 'AddCategory');
        $this->setActionRights(1, 'CallToAction', 'EditCategory');
        $this->setActionRights(1, 'CallToAction', 'DeleteCategory');
        $this->setActionRights(1, 'CallToAction', 'SequenceCategories');

        $this->insertExtra('CallToAction', 'block', 'CallToActionCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('CallToAction', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('CallToAction', 'block', 'CallToAction');
        $this->insertExtra('CallToAction', 'block', 'CallToActionDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationCallToActionId = $this->setNavigation($navigationModulesId, 'CallToAction');
        $this->setNavigation(
            $navigationCallToActionId,
            'CallToAction',
            'call_to_action/index',
            array('call_to_action/add', 'call_to_action/edit')
        );
        $this->setNavigation(
            $navigationCallToActionId,
            'Categories',
            'call_to_action/categories',
            array('call_to_action/add_category', 'call_to_action/edit_category')
        );

    }
}
