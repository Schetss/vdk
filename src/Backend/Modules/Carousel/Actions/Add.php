<?php

namespace Backend\Modules\Carousel\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\Carousel\Engine\Model as BackendCarouselModel;
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

        $this->frm->addText('titel', null, null, 'inputText title', 'inputTextError title');
        $this->frm->addText('subtitel');
        $this->frm->addImage('afbeelding');
        $this->frm->addCheckbox('toon_dit_bericht');
        $this->frm->addText('tags', null, null, 'inputText tagBox', 'inputTextError tagBox');

        // meta
        $this->meta = new Meta($this->frm, null, 'titel', true);

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

            $fields['titel']->isFilled(Language::err('FieldIsRequired'));
            else $fields['afbeelding']->addError(Language::err('FieldIsRequired'));

            // validate meta
            $this->meta->validate();

            if ($this->frm->isCorrect()) {
                // build the item
                $item = array();
                $item['language'] = Language::getWorkingLanguage();
                $item['titel'] = $fields['titel']->getValue();
                $item['subtitel'] = $fields['subtitel']->getValue();

                // the image path
                $imagePath = FRONTEND_FILES_PATH . '/' . $this->getModule() . '/afbeelding';

                // create folders if needed
                if (!\SpoonDirectory::exists($imagePath . '/940x400')) {
                    \SpoonDirectory::create($imagePath . '/940x400');
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
                $item['toon_dit_bericht'] = $fields['toon_dit_bericht']->getChecked() ? 'Y' : 'N';
                $item['sequence'] = BackendCarouselModel::getMaximumSequence() + 1;

                $item['meta_id'] = $this->meta->save();

                // insert it
                $item['id'] = BackendCarouselModel::insert($item);

                // save the tags
                BackendTagsModel::saveTags($item['id'], $fields['tags']->getValue(), $this->URL->getModule());

                $this->redirect(
                    Model::createURLForAction('Index') . '&report=added&highlight=row-' . $item['id']
                );
            }
        }
    }
}
