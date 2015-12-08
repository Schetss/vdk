<?php

namespace Backend\Modules\Service\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Service module
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
        $this->addModule('Service');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Service');

        $this->setActionRights(1, 'Service', 'Index');
        $this->setActionRights(1, 'Service', 'Add');
        $this->setActionRights(1, 'Service', 'Edit');
        $this->setActionRights(1, 'Service', 'Delete');
        $this->setActionRights(1, 'service', 'Sequence');
        $this->setActionRights(1, 'Service', 'Categories');
        $this->setActionRights(1, 'Service', 'AddCategory');
        $this->setActionRights(1, 'Service', 'EditCategory');
        $this->setActionRights(1, 'Service', 'DeleteCategory');
        $this->setActionRights(1, 'Service', 'SequenceCategories');

        $this->insertExtra('Service', 'block', 'ServiceCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Service', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('Service', 'block', 'Service');
        $this->insertExtra('Service', 'block', 'ServiceDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationServiceId = $this->setNavigation($navigationModulesId, 'Service');
        $this->setNavigation(
            $navigationServiceId,
            'Service',
            'service/index',
            array('service/add', 'service/edit')
        );
        $this->setNavigation(
            $navigationServiceId,
            'Categories',
            'service/categories',
            array('service/add_category', 'service/edit_category')
        );

    }
}
