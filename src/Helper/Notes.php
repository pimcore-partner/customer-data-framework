<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace CustomerManagementFrameworkBundle\Helper;

use Pimcore\Model\Element\ElementInterface;

class Notes
{
    /**
     * @param ElementInterface $element
     * @param                  $type
     * @param                  $title
     * @param null $description
     *
     * @return \Pimcore\Model\Element\Note
     */
    public static function createNote(ElementInterface $element, $type, $title, $description = null)
    {
        $note = new \Pimcore\Model\Element\Note();
        $note->setElement($element);
        $note->setDate(time());
        $note->setType($type);
        $note->setTitle($title);
        $note->setDescription($description);

        return $note;
    }
}
