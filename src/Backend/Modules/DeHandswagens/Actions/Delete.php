<?php

namespace Backend\Modules\DeHandswagens\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\DeHandswagens\Engine\Model as BackendDeHandswagensModel;

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
        if ($id === null || !BackendDeHandswagensModel::exists($id)) {
            return $this->redirect(
                Model::createURLForAction('Index') . '&error=non-existing'
            );
        }

        parent::execute();

        $record = (array) BackendDeHandswagensModel::get($id);
        BackendDeHandswagensModel::delete($id);

        $this->redirect(
            Model::createURLForAction('Index') . '&report=deleted&var=' .
            urlencode($record['title'])
        );
    }
}
