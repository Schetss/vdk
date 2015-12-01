<?php

namespace Backend\Modules\Afleveringen\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Meta;
use Backend\Core\Engine\Model;
use Backend\Modules\Afleveringen\Engine\Model as BackendAfleveringenModel;
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
        if ($this->id == null || !BackendAfleveringenModel::exists($this->id)) {
            $this->redirect(
                Model::createURLForAction('Index') . '&error=non-existing'
            );
        }

        $this->record = BackendAfleveringenModel::get($this->id);
        $this->record['images'] = BackendAfleveringenModel::getImages($this->id);

    }

    /**
     * Load the form
     */
    protected function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        $this->frm->addHidden('uploaded_images', htmlentities(json_encode($this->record['images'])));
        $this->frm->addText('titel', $this->record['titel'], null, 'inputText title', 'inputTextError title');
        $this->frm->addDate('datum_date', $this->record['datum']);
        $this->frm->addTime('datum_time', date('H:i', $this->record['datum']));
        $this->frm->addImage('afbeelding');
        $this->frm->addText(
            'tags', BackendTagsModel::getTags($this->URL->getModule(),
            $this->record['id']), null, 'inputText tagBox', 'inputTextError tagBox'
        );

        // get categories
        $categories = BackendAfleveringenModel::getCategories();
        $this->frm->addDropdown('category_id', $categories, $this->record['category_id']);

        // meta
        $this->meta = new Meta($this->frm, $this->record['meta_id'], 'titel', true);
        $this->meta->setUrlCallBack('Backend\Modules\Afleveringen\Engine\Model', 'getUrl', array($this->record['id']));

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
            $fields['category_id']->isFilled(Language::err('FieldIsRequired'));

            // validate meta
            $this->meta->validate();

            if ($this->frm->isCorrect()) {
                $item = array();
                $item['id'] = $this->id;
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
                $item['category_id'] = $this->frm->getField('category_id')->getValue();

                $item['meta_id'] = $this->meta->save();

                BackendAfleveringenModel::update($item);
                $item['id'] = $this->id;

                // get images from the hidden field
                $files = array();
                if ($fields['uploaded_images']->isFilled()) {
                    $images = json_decode(html_entity_decode($fields['uploaded_images']->getValue()));
                    $uploadedImages = array();
                    foreach ($images as $image) {
                        $files[$image->id] = $image->uploadName;
                    }
                }

                // check existing images first
                foreach ($this->record['images'] as $key => $image) {
                    // if the file isn't in the uploaded files array anymore, delete it
                    if (!array_key_exists('_' . $key, $files)) {
                        BackendAfleveringenModel::deleteImage($key);
                        Model::imageDelete(
                            $this->getModule(), $image['uploadName'], null,
                            BackendAfleveringenHelper::$tempFileSizes
                        );
                    } else {
                        // update the sequence if it changed
                        $underscored = '_' . $key;
                        if ($this->record['images'][$key]['sequence'] != $images->$underscored->sequence){
                            BackendAfleveringenModel::updateImage(array(
                                'id' => $key,
                                'sequence' => $images->$underscored->sequence
                            ));
                        }
                        unset($files['_' . $key]);
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
                    Model::createURLForAction('Index') . '&report=edited&highlight=row-' . $item['id']
                );
            }
        }
    }
}
