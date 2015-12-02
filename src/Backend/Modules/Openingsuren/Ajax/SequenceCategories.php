<?php

namespace Backend\Modules\Openingsuren\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Modules\Openingsuren\Engine\Model as BackendOpeningsurenModel;

/**
 * Alters the sequence of Openingsuren articles
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
            if (BackendOpeningsurenModel::existsCategory($id)) {
                BackendOpeningsurenModel::updateCategory($item);
            }
        }

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}
