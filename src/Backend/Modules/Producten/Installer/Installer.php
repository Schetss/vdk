<?php

namespace Backend\Modules\Producten\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Producten module
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
        $this->addModule('Producten');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Producten');

        $this->setActionRights(1, 'Producten', 'Index');
        $this->setActionRights(1, 'Producten', 'Add');
        $this->setActionRights(1, 'Producten', 'Edit');
        $this->setActionRights(1, 'Producten', 'Delete');
        $this->setActionRights(1, 'producten', 'Sequence');
        $this->setActionRights(1, 'Producten', 'Categories');
        $this->setActionRights(1, 'Producten', 'AddCategory');
        $this->setActionRights(1, 'Producten', 'EditCategory');
        $this->setActionRights(1, 'Producten', 'DeleteCategory');
        $this->setActionRights(1, 'Producten', 'SequenceCategories');

        $this->insertExtra('Producten', 'block', 'ProductenCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Producten', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('Producten', 'block', 'Producten');
        $this->insertExtra('Producten', 'block', 'ProductenDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationProductenId = $this->setNavigation($navigationModulesId, 'Producten');
        $this->setNavigation(
            $navigationProductenId,
            'Producten',
            'producten/index',
            array('producten/add', 'producten/edit')
        );
        $this->setNavigation(
            $navigationProductenId,
            'Categories',
            'producten/categories',
            array('producten/add_category', 'producten/edit_category')
        );

    }
}
