<?php

namespace Backend\Modules\Producten\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Modules\Producten\Engine\Model as BackendProductenModel;

/**
 * Alters the sequence of Producten articles
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class SequenceCategories extends AjaxAction
{
    public function execute()
    {
        parent::execute();

        // get parameters
        $newIdSequence = trim(\SpoonFilter::getPostValue('new_id_sequence', null, '', 'string'));

        // list id
        $ids = (array) explode(',', rtrim($newIdSequence, ','));

        // loop id's and set new sequence
        foreach ($ids as $i => $id) {
            $item['id'] = $id;
            $item['sequence'] = $i + 1;

            // update sequence
            if (BackendProductenModel::existsCategory($id)) {
                BackendProductenModel::updateCategory($item);
            }
        }

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}
