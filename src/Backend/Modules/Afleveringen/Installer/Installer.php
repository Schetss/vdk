<?php

namespace Backend\Modules\Afleveringen\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Afleveringen module
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
        $this->addModule('Afleveringen');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Afleveringen');

        $this->setActionRights(1, 'Afleveringen', 'Index');
        $this->setActionRights(1, 'Afleveringen', 'Add');
        $this->setActionRights(1, 'Afleveringen', 'Edit');
        $this->setActionRights(1, 'Afleveringen', 'Delete');
        $this->setActionRights(1, 'afleveringen', 'Sequence');
        $this->setActionRights(1, 'Afleveringen', 'Categories');
        $this->setActionRights(1, 'Afleveringen', 'AddCategory');
        $this->setActionRights(1, 'Afleveringen', 'EditCategory');
        $this->setActionRights(1, 'Afleveringen', 'DeleteCategory');
        $this->setActionRights(1, 'Afleveringen', 'SequenceCategories');

        $this->insertExtra('Afleveringen', 'block', 'AfleveringenCategory', 'Category', null, 'N', 1002);
        $this->insertExtra('Afleveringen', 'widget', 'Categories', 'Categories', null, 'N', 1003);


        // copy the qqFileUploader needed for multiple fileupload
        if (!\SpoonFile::exists(PATH_LIBRARY . '/external/qqFileUploader.php')) {
            copy(dirname(__FILE__) . '/data/qqFileUploader.php', PATH_LIBRARY . '/external/qqFileUploader.php');
        }


        // add extra's
        $subnameID = $this->insertExtra('Afleveringen', 'block', 'Afleveringen');
        $this->insertExtra('Afleveringen', 'block', 'AfleveringenDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationAfleveringenId = $this->setNavigation($navigationModulesId, 'Afleveringen');
        $this->setNavigation(
            $navigationAfleveringenId,
            'Afleveringen',
            'afleveringen/index',
            array('afleveringen/add', 'afleveringen/edit')
        );
        $this->setNavigation(
            $navigationAfleveringenId,
            'Categories',
            'afleveringen/categories',
            array('afleveringen/add_category', 'afleveringen/edit_category')
        );

    }
}
