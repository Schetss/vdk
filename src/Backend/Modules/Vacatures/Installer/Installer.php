<?php

namespace Backend\Modules\Vacatures\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Vacatures module
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
        $this->addModule('Vacatures');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Vacatures');

        $this->setActionRights(1, 'Vacatures', 'Index');
        $this->setActionRights(1, 'Vacatures', 'Add');
        $this->setActionRights(1, 'Vacatures', 'Edit');
        $this->setActionRights(1, 'Vacatures', 'Delete');
        $this->setActionRights(1, 'vacatures', 'Sequence');
        $this->setActionRights(1, 'Vacatures', 'Categories');
        $this->setActionRights(1, 'Vacatures', 'AddCategory');
        $this->setActionRights(1, 'Vacatures', 'EditCategory');
        $this->setActionRights(1, 'Vacatures', 'DeleteCategory');
        $this->setActionRights(1, 'Vacatures', 'SequenceCategories');

        $this->insertExtra('Vacatures', 'block', 'VacaturesCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Vacatures', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // add extra's
        $subnameID = $this->insertExtra('Vacatures', 'block', 'Vacatures');
        $this->insertExtra('Vacatures', 'block', 'VacaturesDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationVacaturesId = $this->setNavigation($navigationModulesId, 'Vacatures');
        $this->setNavigation(
            $navigationVacaturesId,
            'Vacatures',
            'vacatures/index',
            array('vacatures/add', 'vacatures/edit')
        );
        $this->setNavigation(
            $navigationVacaturesId,
            'Categories',
            'vacatures/categories',
            array('vacatures/add_category', 'vacatures/edit_category')
        );

    }
}
