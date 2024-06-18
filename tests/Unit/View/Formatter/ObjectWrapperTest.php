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

namespace CustomerManagementFrameworkBundle\Tests\Unit\View\Formatter;

use Codeception\Test\Unit;
use CustomerManagementFrameworkBundle\Tests\Fixtures\View\Formatter\NoToStringObject;
use CustomerManagementFrameworkBundle\Tests\Fixtures\View\Formatter\ToStringObject;
use CustomerManagementFrameworkBundle\View\Formatter\ObjectWrapper;

class ObjectWrapperTest extends Unit
{
    /**
     * @dataProvider scalarDataProvider
     */
    public function testScalarReturnsItsValue($value)
    {
        $wrapper = new ObjectWrapper($value);
        $this->assertEquals($value, $wrapper->__toString());
    }

    public function testToStringObjectReturnsItsValue()
    {
        $object  = new ToStringObject();
        $wrapper = new ObjectWrapper($object);

        $this->assertEquals(ToStringObject::TO_STRING_VALUE, $wrapper->__toString());
    }

    public function testNoToStringObjectReturnsClassName()
    {
        $object  = new NoToStringObject();
        $wrapper = new ObjectWrapper($object);

        $this->assertEquals(NoToStringObject::class, $wrapper->__toString());
    }

    public function scalarDataProvider()
    {
        return [
            'string'     => ['foo'],
            'int'        => [42],
            'float'      => [42.5],
            'null'       => [null],
            'bool:true'  => [true],
            'bool:false' => [false],
        ];
    }
}
