<?php

namespace Backend\Modules\Openingsuren\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\Openingsuren\Engine\Model as BackendOpeningsurenModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;

/**
 * This is the edit-action, it will display a form with the item data to edit
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Edit extends ActionEdit
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->loadData();
        $this->loadForm();
        $this->validateForm();

        $this->parse();
        $this->display();
    }

    /**
     * Load the item data
     */
    protected function loadData()
    {
        $this->id = $this->getParameter('id', 'int', null);
        if ($this->id == null || !BackendOpeningsurenModel::exists($this->id)) {
            $this->redirect(
                Model::createURLForAction('Index') . '&error=non-existing'
            );
        }

        $this->record = BackendOpeningsurenModel::get($this->id);
    }

    /**
     * Load the form
     */
    protected function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        $this->frm->addText('naam', $this->record['naam'], null, 'inputText title', 'inputTextError title');
        $this->frm->addText('maandagvoormiddag_open', $this->record['maandagvoormiddag_open']);
        $this->frm->addText('maandagvoormiddag_sluit', $this->record['maandagvoormiddag_sluit']);
        $this->frm->addText('maandagnamiddag_open', $this->record['maandagnamiddag_open']);
        $this->frm->addText('maandagnamiddag_sluit', $this->record['maandagnamiddag_sluit']);
        $this->frm->addText('dinsdagvoormiddag_open', $this->record['dinsdagvoormiddag_open']);
        $this->frm->addText('dinsdagvoormiddag_sluit', $this->record['dinsdagvoormiddag_sluit']);
        $this->frm->addText('dinsdagnamiddag_open', $this->record['dinsdagnamiddag_open']);
        $this->frm->addText('dinsdagnamiddag_sluit', $this->record['dinsdagnamiddag_sluit']);
        $this->frm->addText('woensdagvoormiddag_open', $this->record['woensdagvoormiddag_open']);
        $this->frm->addText('woensdagvoormiddag_sluit', $this->record['woensdagvoormiddag_sluit']);
        $this->frm->addText('woensdagnamiddag_open', $this->record['woensdagnamiddag_open']);
        $this->frm->addText('woensdagnamiddag_sluit', $this->record['woensdagnamiddag_sluit']);
        $this->frm->addText('donderdagvoormiddag_open', $this->record['donderdagvoormiddag_open']);
        $this->frm->addText('donderdagvoormiddag_sluit', $this->record['donderdagvoormiddag_sluit']);
        $this->frm->addText('donderdagnamiddag_open', $this->record['donderdagnamiddag_open']);
        $this->frm->addText('donderdagnamiddag_sluit', $this->record['donderdagnamiddag_sluit']);
        $this->frm->addText('vrijdagvoormiddag_open', $this->record['vrijdagvoormiddag_open']);
        $this->frm->addText('vrijdagvoormiddag_sluit', $this->record['vrijdagvoormiddag_sluit']);
        $this->frm->addText('vrijdagnamiddag_open', $this->record['vrijdagnamiddag_open']);
        $this->frm->addText('vrijdagnamiddag_sluit', $this->record['vrijdagnamiddag_sluit']);
        $this->frm->addText('zaterdagvoormiddag_open', $this->record['zaterdagvoormiddag_open']);
        $this->frm->addText('zaterdagvoormiddag_sluit', $this->record['zaterdagvoormiddag_sluit']);
        $this->frm->addText('zaterdagnamiddag_open', $this->record['zaterdagnamiddag_open']);
        $this->frm->addText('zaterdagnamiddag_sluit', $this->record['zaterdagnamiddag_sluit']);
        $this->frm->addText('zondagvoormiddag_open', $this->record['zondagvoormiddag_open']);
        $this->frm->addText('zondagvoormiddag_sluit', $this->record['zondagvoormiddag_sluit']);
        $this->frm->addText('zondagnamiddag_open', $this->record['zondagnamiddag_open']);
        $this->frm->addText('zondagnamiddag_sluit', $this->record['zondagnamiddag_sluit']);
        $this->frm->addCheckbox('wij_zijn_op_vakantie', $this->record['wij_zijn_op_vakantie'] == 'Y');
        $this->frm->addCheckbox('maandag_open', $this->record['maandag_open'] == 'Y');
        $this->frm->addCheckbox('dinsdag_open', $this->record['dinsdag_open'] == 'Y');
        $this->frm->addCheckbox('woensdag_open', $this->record['woensdag_open'] == 'Y');
        $this->frm->addCheckbox('vrijdag_open', $this->record['vrijdag_open'] == 'Y');
        $this->frm->addCheckbox('zondag_open', $this->record['zondag_open'] == 'Y');
        $this->frm->addCheckbox('zaterdag_open', $this->record['zaterdag_open'] == 'Y');
        $this->frm->addCheckbox('donderdag_open', $this->record['donderdag_open'] == 'Y');
        $this->frm->addText('sluitingsdagen', $this->record['sluitingsdagen']);

        // get categories
        $categories = BackendOpeningsurenModel::getCategories();
        $this->frm->addDropdown('category_id', $categories, $this->record['category_id']);

        // meta
        $this->meta = new Meta($this->frm, $this->record['meta_id'], 'naam', true);
        $this->meta->setUrlCallBack('Backend\Modules\Openingsuren\Engine\Model', 'getUrl', array($this->record['id']));

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


        $this->tpl->assign('item', $this->record);
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
                $item = array();
                $item['id'] = $this->id;
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
                $item['category_id'] = $this->frm->getField('category_id')->getValue();

                $item['meta_id'] = $this->meta->save();

                BackendOpeningsurenModel::update($item);
                $item['id'] = $this->id;

                $this->redirect(
                    Model::createURLForAction('Index') . '&report=edited&highlight=row-' . $item['id']
                );
            }
        }
    }
}
