<?php

namespace Backend\Modules\Carousel\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Carousel\Engine\Model as BackendCarouselModel;

/**
 * This is the delete-action, it deletes an item
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Delete extends ActionDelete
{
    /**
     * Execute the action
     */
    public function execute()
    {
        $id = $this->getParameter('id', 'int');

        // does the item exist
        if ($id === null || !BackendCarouselModel::exists($id)) {
             $this->redirect(BackendModel::createURLForAction('Index') . '&error=non-existing');
        }

        parent::execute();

        $record = (array) BackendCarouselModel::get($id);
        BackendCarouselModel::delete($id);

        $this->redirect(
            BackendModel::createURLForAction('Index') . '&report=deleted&var=' .
            urlencode($this->record['title'])
        );
    }
}

