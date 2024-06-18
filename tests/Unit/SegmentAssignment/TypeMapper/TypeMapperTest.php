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

namespace CustomerManagementFrameworkBundle\Tests\Unit\SegmentAssignment\TypeMapper;

use Codeception\Test\Unit;
use CustomerManagementFrameworkBundle\SegmentAssignment\TypeMapper\TypeMapper;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document;

class TypeMapperTest extends Unit
{
    /**
     * @var TypeMapper
     */
    private $sut = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new TypeMapper();
    }

    public function testGetTypeStringByObject()
    {
        $objects = [new Document(), new Asset(), new DataObject()];
        $expected = ['document', 'asset', 'object'];
        $actual = array_map(function ($item) {
            return $this->sut->getTypeStringByObject($item);
        }, $objects);

        self::assertSame($expected, $actual);
    }
}
