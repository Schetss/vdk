<?php

namespace Backend\Modules\Openingsuren\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\Openingsuren\Engine\Model as BackendOpeningsurenModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;

/**
 * This is the add-action, it will display a form to create a new item
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Add extends ActionAdd
{
    /**
     * Execute the actions
     */
    public function execute()
    {
        parent::execute();

        $this->loadForm();
        $this->validateForm();

        $this->parse();
        $this->display();
    }

    /**
     * Load the form
     */
    protected function loadForm()
    {
        $this->frm = new Form('add');

        $this->frm->addText('naam', null, null, 'inputText title', 'inputTextError title');
        $this->frm->addText('maandagvoormiddag_open');
        $this->frm->addText('maandagvoormiddag_sluit');
        $this->frm->addText('maandagnamiddag_open');
        $this->frm->addText('maandagnamiddag_sluit');
        $this->frm->addText('dinsdagvoormiddag_open');
        $this->frm->addText('dinsdagvoormiddag_sluit');
        $this->frm->addText('dinsdagnamiddag_open');
        $this->frm->addText('dinsdagnamiddag_sluit');
        $this->frm->addText('woensdagvoormiddag_open');
        $this->frm->addText('woensdagvoormiddag_sluit');
        $this->frm->addText('woensdagnamiddag_open');
        $this->frm->addText('woensdagnamiddag_sluit');
        $this->frm->addText('donderdagvoormiddag_open');
        $this->frm->addText('donderdagvoormiddag_sluit');
        $this->frm->addText('donderdagnamiddag_open');
        $this->frm->addText('donderdagnamiddag_sluit');
        $this->frm->addText('vrijdagvoormiddag_open');
        $this->frm->addText('vrijdagvoormiddag_sluit');
        $this->frm->addText('vrijdagnamiddag_open');
        $this->frm->addText('vrijdagnamiddag_sluit');
        $this->frm->addText('zaterdagvoormiddag_open');
        $this->frm->addText('zaterdagvoormiddag_sluit');
        $this->frm->addText('zaterdagnamiddag_open');
        $this->frm->addText('zaterdagnamiddag_sluit');
        $this->frm->addText('zondagvoormiddag_open');
        $this->frm->addText('zondagvoormiddag_sluit');
        $this->frm->addText('zondagnamiddag_open');
        $this->frm->addText('zondagnamiddag_sluit');
        $this->frm->addCheckbox('wij_zijn_op_vakantie');
        $this->frm->addCheckbox('maandag_open');
        $this->frm->addCheckbox('dinsdag_open');
        $this->frm->addCheckbox('woensdag_open');
        $this->frm->addCheckbox('vrijdag_open');
        $this->frm->addCheckbox('zondag_open');
        $this->frm->addCheckbox('zaterdag_open');
        $this->frm->addCheckbox('donderdag_open');
        $this->frm->addText('sluitingsdagen');

        // get categories
        $categories = BackendOpeningsurenModel::getCategories();
        $this->frm->addDropdown('category_id', $categories);

        // meta
        $this->meta = new Meta($this->frm, null, 'naam', true);

    }

    /**
     * Parse the page
     */
    protected function parse()
    {
        parent::parse();

        // get url
        $url = Model::getURLForBlock($this->URL->getModule(), 'Detail');
        $url404 = Model::getURL(404);

        // parse additional variables
        if ($url404 != $url) {
            $this->tpl->assign('detailURL', SITE_URL . $url);
        }
        $this->record['url'] = $this->meta->getURL();

    }

    /**
     * Validate the form
     */
    protected function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            $this->frm->cleanupFields();

            // validation
            $fields = $this->frm->getFields();

            $fields['naam']->isFilled(Language::err('FieldIsRequired'));
            $fields['category_id']->isFilled(Language::err('FieldIsRequired'));

            // validate meta
            $this->meta->validate();

            if ($this->frm->isCorrect()) {
                // build the item
                $item = array();
                $item['language'] = Language::getWorkingLanguage();
                $item['naam'] = $fields['naam']->getValue();
                $item['maandagvoormiddag_open'] = $fields['maandagvoormiddag_open']->getValue();
                $item['maandagvoormiddag_sluit'] = $fields['maandagvoormiddag_sluit']->getValue();
                $item['maandagnamiddag_open'] = $fields['maandagnamiddag_open']->getValue();
                $item['maandagnamiddag_sluit'] = $fields['maandagnamiddag_sluit']->getValue();
                $item['dinsdagvoormiddag_open'] = $fields['dinsdagvoormiddag_open']->getValue();
                $item['dinsdagvoormiddag_sluit'] = $fields['dinsdagvoormiddag_sluit']->getValue();
                $item['dinsdagnamiddag_open'] = $fields['dinsdagnamiddag_open']->getValue();
                $item['dinsdagnamiddag_sluit'] = $fields['dinsdagnamiddag_sluit']->getValue();
                $item['woensdagvoormiddag_open'] = $fields['woensdagvoormiddag_open']->getValue();
                $item['woensdagvoormiddag_sluit'] = $fields['woensdagvoormiddag_sluit']->getValue();
                $item['woensdagnamiddag_open'] = $fields['woensdagnamiddag_open']->getValue();
                $item['woensdagnamiddag_sluit'] = $fields['woensdagnamiddag_sluit']->getValue();
                $item['donderdagvoormiddag_open'] = $fields['donderdagvoormiddag_open']->getValue();
                $item['donderdagvoormiddag_sluit'] = $fields['donderdagvoormiddag_sluit']->getValue();
                $item['donderdagnamiddag_open'] = $fields['donderdagnamiddag_open']->getValue();
                $item['donderdagnamiddag_sluit'] = $fields['donderdagnamiddag_sluit']->getValue();
                $item['vrijdagvoormiddag_open'] = $fields['vrijdagvoormiddag_open']->getValue();
                $item['vrijdagvoormiddag_sluit'] = $fields['vrijdagvoormiddag_sluit']->getValue();
                $item['vrijdagnamiddag_open'] = $fields['vrijdagnamiddag_open']->getValue();
                $item['vrijdagnamiddag_sluit'] = $fields['vrijdagnamiddag_sluit']->getValue();
                $item['zaterdagvoormiddag_open'] = $fields['zaterdagvoormiddag_open']->getValue();
                $item['zaterdagvoormiddag_sluit'] = $fields['zaterdagvoormiddag_sluit']->getValue();
                $item['zaterdagnamiddag_open'] = $fields['zaterdagnamiddag_open']->getValue();
                $item['zaterdagnamiddag_sluit'] = $fields['zaterdagnamiddag_sluit']->getValue();
                $item['zondagvoormiddag_open'] = $fields['zondagvoormiddag_open']->getValue();
                $item['zondagvoormiddag_sluit'] = $fields['zondagvoormiddag_sluit']->getValue();
                $item['zondagnamiddag_open'] = $fields['zondagnamiddag_open']->getValue();
                $item['zondagnamiddag_sluit'] = $fields['zondagnamiddag_sluit']->getValue();
                $item['wij_zijn_op_vakantie'] = $fields['wij_zijn_op_vakantie']->getChecked() ? 'Y' : 'N';
                $item['maandag_open'] = $fields['maandag_open']->getChecked() ? 'Y' : 'N';
                $item['dinsdag_open'] = $fields['dinsdag_open']->getChecked() ? 'Y' : 'N';
                $item['woensdag_open'] = $fields['woensdag_open']->getChecked() ? 'Y' : 'N';
                $item['vrijdag_open'] = $fields['vrijdag_open']->getChecked() ? 'Y' : 'N';
                $item['zondag_open'] = $fields['zondag_open']->getChecked() ? 'Y' : 'N';
                $item['zaterdag_open'] = $fields['zaterdag_open']->getChecked() ? 'Y' : 'N';
                $item['donderdag_open'] = $fields['donderdag_open']->getChecked() ? 'Y' : 'N';
                $item['sluitingsdagen'] = $fields['sluitingsdagen']->getValue();
                $item['sequence'] = BackendOpeningsurenModel::getMaximumSequence() + 1;
                $item['category_id'] = $this->frm->getField('category_id')->getValue();

                $item['meta_id'] = $this->meta->save();

                // insert it
                $item['id'] = BackendOpeningsurenModel::insert($item);

                $this->redirect(
                    Model::createURLForAction('Index') . '&report=added&highlight=row-' . $item['id']
                );
            }
        }
    }
}
