<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace CustomerManagementFrameworkBundle\Tests\Fixtures\View\Formatter;

class ToStringObject
{
    const TO_STRING_VALUE = 'I implement __toString()';

    /**
     * @return string
     */
    public function __toString()
    {
        return static::TO_STRING_VALUE;
    }
}
