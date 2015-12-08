/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * Interaction for the de handswagens module
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
jsBackend.de_handswagens =
{
    // constructor
    init: function()
    {
        // do meta
        if ($('#titel').length > 0) $('#titel').doMeta();

    }
}

$(jsBackend.de_handswagens.init);
