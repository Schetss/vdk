<?php

namespace Backend\Modules\DeHandswagens\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\DeHandswagens\Engine\Model as BackendDeHandswagensModel;
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
        if ($this->id == null || !BackendDeHandswagensModel::exists($this->id)) {
            $this->redirect(
                Model::createURLForAction('Index') . '&error=non-existing'
            );
        }

        $this->record = BackendDeHandswagensModel::get($this->id);
    }

    /**
     * Load the form
     */
    protected function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        $this->frm->addText('titel', $this->record['titel'], null, 'inputText title', 'inputTextError title');
        $this->frm->addText('subtitel', $this->record['subtitel']);
        $this->frm->addEditor('tekst', $this->record['tekst']);
        $this->frm->addFile('pdffile');
        $this->frm->addCheckbox('verkocht', $this->record['verkocht'] == 'Y');
        $this->frm->addImage('afbeelding');
        $this->frm->addText(
            'tags', BackendTagsModel::getTags($this->URL->getModule(),
            $this->record['id']), null, 'inputText tagBox', 'inputTextError tagBox'
        );

        // meta
        $this->meta = new Meta($this->frm, $this->record['meta_id'], 'titel', true);
        $this->meta->setUrlCallBack('Backend\Modules\DeHandswagens\Engine\Model', 'getUrl', array($this->record['id']));

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

            $fields['titel']->isFilled(Language::err('FieldIsRequired'));

            // validate meta
            $this->meta->validate();

            if ($this->frm->isCorrect()) {
                $item = array();
                $item['id'] = $this->id;
                $item['language'] = Language::getWorkingLanguage();

                $item['titel'] = $fields['titel']->getValue();
                $item['subtitel'] = $fields['subtitel']->getValue();
                $item['tekst'] = $fields['tekst']->getValue();

                // the file path
                $filePath = FRONTEND_FILES_PATH . '/' . $this->getModule() . '/files';

                // create folders if needed
                if (!\SpoonDirectory::exists($filePath)) {
                    \SpoonDirectory::create($filePath);
                }

                // file provided?
                if ($fields['pdffile']->isFilled()) {
                    // build the file name

                    /**
                     * @TODO when meta is added, use the meta in the file name
                     */
                    $item['pdffile'] = time() . '.' . $fields['pdffile']->getExtension();

                    // upload the file
                    $fields['pdffile']->moveFile($filePath . '/' . $item['pdffile']);
                }
                $item['verkocht'] = $fields['verkocht']->getChecked() ? 'Y' : 'N';

                // the image path
                $imagePath = FRONTEND_FILES_PATH . '/' . $this->getModule() . '/afbeelding';

                // create folders if needed
                if (!\SpoonDirectory::exists($imagePath . '/600x600')) {
                    \SpoonDirectory::create($imagePath . '/600x600');
                }
                if (!\SpoonDirectory::exists($imagePath . '/source')) {
                    \SpoonDirectory::create($imagePath . '/source');
                }

                // image provided?
                if ($fields['afbeelding']->isFilled()) {
                    // build the image name
                    $item['afbeelding'] = $this->meta->getUrl() . '.' . $fields['afbeelding']->getExtension();

                    // upload the image & generate thumbnails
                    $fields['afbeelding']->generateThumbnails($imagePath, $item['afbeelding']);
                }

                $item['meta_id'] = $this->meta->save();

                BackendDeHandswagensModel::update($item);
                $item['id'] = $this->id;

                // save the tags
                BackendTagsModel::saveTags($item['id'], $fields['tags']->getValue(), $this->URL->getModule());

                $this->redirect(
                    Model::createURLForAction('Index') . '&report=edited&highlight=row-' . $item['id']
                );
            }
        }
    }
}
