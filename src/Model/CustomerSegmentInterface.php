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

namespace CustomerManagementFrameworkBundle\Model;

use Pimcore\Model\DataObject\CustomerSegmentGroup;
use Pimcore\Model\Element\AbstractElement;
use Pimcore\Model\Element\ElementInterface;

interface CustomerSegmentInterface extends ElementInterface
{
    public function getName(): ?string;

    /**
     *
     * @return $this
     */
    public function setName(?string $name);

    public function getReference(): ?string;

    /**
     *
     * @return $this
     */
    public function setReference(?string $reference);

    /**
     * @return CustomerSegmentGroup|null
     */
    public function getGroup(): ?AbstractElement;

    /**
     * @param CustomerSegmentGroup|null $group
     *
     * @return $this
     */
    public function setGroup(?AbstractElement $group);

    public function getCalculated(): ?bool;

    /**
     *
     * @return $this
     */
    public function setCalculated(bool $calculated);

    public function getUseAsTargetGroup(): ?bool;

    public function getTargetGroup(): ?string;

    /**
     *
     * @return $this
     */
    public function setTargetGroup(?string $targetGroup);

    /**
     * @return array
     */
    public function getDataForWebserviceExport();
}
