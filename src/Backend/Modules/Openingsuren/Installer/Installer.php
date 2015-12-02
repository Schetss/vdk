<?php

namespace Backend\Modules\Openingsuren\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Openingsuren module
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
        $this->addModule('Openingsuren');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Openingsuren');

        $this->setActionRights(1, 'Openingsuren', 'Index');
        $this->setActionRights(1, 'Openingsuren', 'Add');
        $this->setActionRights(1, 'Openingsuren', 'Edit');
        $this->setActionRights(1, 'Openingsuren', 'Delete');
        $this->setActionRights(1, 'openingsuren', 'Sequence');
        $this->setActionRights(1, 'Openingsuren', 'Categories');
        $this->setActionRights(1, 'Openingsuren', 'AddCategory');
        $this->setActionRights(1, 'Openingsuren', 'EditCategory');
        $this->setActionRights(1, 'Openingsuren', 'DeleteCategory');
        $this->setActionRights(1, 'Openingsuren', 'SequenceCategories');

        $this->insertExtra('Openingsuren', 'block', 'OpeningsurenCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Openingsuren', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('Openingsuren', 'block', 'Openingsuren');
        $this->insertExtra('Openingsuren', 'block', 'OpeningsurenDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationOpeningsurenId = $this->setNavigation($navigationModulesId, 'Openingsuren');
        $this->setNavigation(
            $navigationOpeningsurenId,
            'Openingsuren',
            'openingsuren/index',
            array('openingsuren/add', 'openingsuren/edit')
        );
        $this->setNavigation(
            $navigationOpeningsurenId,
            'Categories',
            'openingsuren/categories',
            array('openingsuren/add_category', 'openingsuren/edit_category')
        );

    }
}
