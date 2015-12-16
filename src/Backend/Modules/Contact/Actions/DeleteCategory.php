<?php

namespace Backend\Modules\Contact\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\Contact\Engine\Model as BackendContactModel;

/**
 * This action will delete a category
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class DeleteCategory extends ActionDelete
{
    /**
     * Execute the action
     */
    public function execute()
    {
        $this->id = $this->getParameter('id', 'int');

        // does the item exist
        if ($this->id == null || !BackendContactModel::existsCategory($this->id)) {
            $this->redirect(
                Model::createURLForAction('categories') . '&error=non-existing'
            );
        }

        // fetch the category
        $this->record = (array) BackendContactModel::getCategory($this->id);

        // delete item
        BackendContactModel::deleteCategory($this->id);

        // category was deleted, so redirect
        $this->redirect(
            Model::createURLForAction('categories') . '&report=deleted-category&var=' .
            urlencode($this->record['title'])
        );
    }
}
