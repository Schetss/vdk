<?php

namespace Backend\Modules\Contact\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Contact module
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
        $this->addModule('Contact');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Contact');

        $this->setActionRights(1, 'Contact', 'Index');
        $this->setActionRights(1, 'Contact', 'Add');
        $this->setActionRights(1, 'Contact', 'Edit');
        $this->setActionRights(1, 'Contact', 'Delete');
        $this->setActionRights(1, 'contact', 'Sequence');
        $this->setActionRights(1, 'Contact', 'Categories');
        $this->setActionRights(1, 'Contact', 'AddCategory');
        $this->setActionRights(1, 'Contact', 'EditCategory');
        $this->setActionRights(1, 'Contact', 'DeleteCategory');
        $this->setActionRights(1, 'Contact', 'SequenceCategories');

        $this->insertExtra('Contact', 'block', 'ContactCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Contact', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('Contact', 'block', 'Contact');
        $this->insertExtra('Contact', 'block', 'ContactDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationContactId = $this->setNavigation($navigationModulesId, 'Contact');
        $this->setNavigation(
            $navigationContactId,
            'Contact',
            'contact/index',
            array('contact/add', 'contact/edit')
        );
        $this->setNavigation(
            $navigationContactId,
            'Categories',
            'contact/categories',
            array('contact/add_category', 'contact/edit_category')
        );

    }
}
