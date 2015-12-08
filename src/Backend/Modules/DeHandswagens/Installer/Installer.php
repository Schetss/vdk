<?php

namespace Backend\Modules\DeHandswagens\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the de handswagens module
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
        $this->addModule('DeHandswagens');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'DeHandswagens');

        $this->setActionRights(1, 'DeHandswagens', 'Index');
        $this->setActionRights(1, 'DeHandswagens', 'Add');
        $this->setActionRights(1, 'DeHandswagens', 'Edit');
        $this->setActionRights(1, 'DeHandswagens', 'Delete');
        $this->setActionRights(1, 'de_handswagens', 'Sequence');

        // add extra's
        $subnameID = $this->insertExtra('DeHandswagens', 'block', 'DeHandswagens');
        $this->insertExtra('DeHandswagens', 'block', 'DeHandswagensDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationclassnameId = $this->setNavigation(
            $navigationModulesId,
            'DeHandswagens',
            'de_handswagens/index',
            array('de_handswagens/add','de_handswagens/edit')
        );

    }
}
