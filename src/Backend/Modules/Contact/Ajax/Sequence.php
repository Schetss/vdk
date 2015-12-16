<?php

namespace Backend\Modules\Contact\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Modules\Contact\Engine\Model as BackendContactModel;

/**
 * Alters the sequence of Contact articles
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Sequence extends AjaxAction
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
            if (BackendContactModel::exists($id)) {
                BackendContactModel::update($item);
            }
        }

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}
