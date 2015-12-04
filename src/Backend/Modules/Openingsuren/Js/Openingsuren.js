/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * Interaction for the Openingsuren module
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
jsBackend.openingsuren =
{
    // constructor
    init: function()
    {
        // do meta
        if ($('#dag').length > 0) $('#dag').doMeta();

    }
}

$(jsBackend.openingsuren.init);
