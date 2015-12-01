<?php

namespace Backend\Modules\Carousel\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Carousel module
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
        $this->addModule('Carousel');

        // install the locale, this is set here beceause we need the module for this
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setModuleRights(1, 'Carousel');

        $this->setActionRights(1, 'Carousel', 'Index');
        $this->setActionRights(1, 'Carousel', 'Add');
        $this->setActionRights(1, 'Carousel', 'Edit');
        $this->setActionRights(1, 'Carousel', 'Delete');
        $this->setActionRights(1, 'carousel', 'Sequence');

        // add extra's
        $subnameID = $this->insertExtra('Carousel', 'block', 'Carousel');
        $this->insertExtra('Carousel', 'block', 'CarouselDetail', 'Detail');

        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationclassnameId = $this->setNavigation(
            $navigationModulesId,
            'Carousel',
            'carousel/index',
            array('carousel/add','carousel/edit')
        );

    }
}
