<?php

namespace Backend\Modules\Afleveringen\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\Afleveringen\Engine\Model as BackendAfleveringenModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;
use Backend\Modules\Afleveringen\Engine\Helper as BackendAfleveringenHelper;


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

        // add fineuploader (ajax file uploader)
        $this->header->addJS('fineuploader/header.js');
        $this->header->addJS('fineuploader/util.js');
        $this->header->addJS('fineuploader/button.js');
        $this->header->addJS('fineuploader/handler.base.js');
        $this->header->addJS('fineuploader/handler.form.js');
        $this->header->addJS('fineuploader/handler.xhr.js');
        $this->header->addJS('fineuploader/uploader.basic.js');
        $this->header->addJS('fineuploader/dnd.js');
        $this->header->addJS('fineuploader/uploader.js');
        $this->header->addJS('fineuploader/jquery-plugin.js');
        $this->header->addCSS('fineuploader.css');

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

        $this->frm->addHidden('uploaded_images');
        $this->frm->addText('titel', null, null, 'inputText title', 'inputTextError title');
        $this->frm->addDate('datum_date');
        $this->frm->addTime('datum_time');
        $this->frm->addImage('afbeelding');
        $this->frm->addText('tags', null, null, 'inputText tagBox', 'inputTextError tagBox');

        // get categories
        $categories = BackendAfleveringenModel::getCategories();
        $this->frm->addDropdown('category_id', $categories);

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
            $fields['category_id']->isFilled(Language::err('FieldIsRequired'));

            // validate meta
            $this->meta->validate();

            if ($this->frm->isCorrect()) {
                // build the item
                $item = array();
                $item['language'] = Language::getWorkingLanguage();
                $item['titel'] = $fields['titel']->getValue();
                $item['datum'] = Model::getUTCDate(
                    null,
                    Model::getUTCTimestamp(
                        $this->frm->getField('datum_date'),
                        $this->frm->getField('datum_time')
                    )
                );

                // the image path
                $imagePath = FRONTEND_FILES_PATH . '/' . $this->getModule() . '/afbeelding';

                // create folders if needed
                if (!\SpoonDirectory::exists($imagePath . '/400x300')) {
                    \SpoonDirectory::create($imagePath . '/400x300');
                }
                if (!\SpoonDirectory::exists($imagePath . '/800x600')) {
                    \SpoonDirectory::create($imagePath . '/800x600');
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
                $item['sequence'] = BackendAfleveringenModel::getMaximumSequence() + 1;
                $item['category_id'] = $this->frm->getField('category_id')->getValue();

                $item['meta_id'] = $this->meta->save();

                // insert it
                $item['id'] = BackendAfleveringenModel::insert($item);

                // get images from the hidden field
                $files = array();
                if ($fields['uploaded_images']->isFilled()) {
                    $images = json_decode(html_entity_decode($fields['uploaded_images']->getValue()));
                    $uploadedImages = array();
                    foreach ($images as $image) {
                        $files[$image->id] = $image->uploadName;
                    }
                }

                // get images from the session
                if (!empty($files)) {
                    $fromSession = \SpoonSession::get('uploadedFiles');
                    foreach ($fromSession as $sImage) {
                        // check if the file is available in the files array
                        if (in_array($sImage['uploadName'], $files) && empty($sImage['warning'])) {
                            $uploadedImages[] = $sImage['uploadName'];
                            BackendAfleveringenHelper::imageRename(
                                $this->getModule(),
                                $sImage['uploadName'],
                                $sImage['uploadName'],
                                '',
                                '/uploaded_images',
                                BackendAfleveringenHelper::$imageSizes,
                                true
                            );

                            $photoId = BackendAfleveringenModel::insertImage(
                                array(
                                    'afleveringen_id' => $item['id'],
                                    'name' => $sImage['uploadName'],
                                    'sequence' => $sImage['Index']
                                )
                            );
                        }
                        Model::imageDelete(
                            $this->getModule(), $sImage['uploadName'],
                            'uploaded_images', BackendAfleveringenHelper::$tempFileSizes
                        );
                    }
                    \SpoonSession::delete('uploadedFiles');
                }

                // save the tags
                BackendTagsModel::saveTags($item['id'], $fields['tags']->getValue(), $this->URL->getModule());

                $this->redirect(
                    Model::createURLForAction('Index') . '&report=added&highlight=row-' . $item['id']
                );
            }
        }
    }
}
