<?php

namespace Backend\Modules\CallToAction\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Modules\CallToAction\Engine\Model as BackendCallToActionModel;

/**
 * Alters the sequence of Call To Action articles
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
            if (BackendCallToActionModel::exists($id)) {
                BackendCallToActionModel::update($item);
            }
        }

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}
