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

interface SegmentAssignmentInterface
{
    /**
     * returns assigned segments' ids
     *
     * @return string[]
     */
    public function getSegmentIds(): array;

    /**
     * returns assigned Segments     *
     *
     */
    public function getSegments(): array;

    /**
     * returns the affiliated element's id
     *
     */
    public function getElementId(): string;

    /**
     * returns the affiliated element's type
     *
     */
    public function getElementType(): string;

    /**
     * returns whether the affiliated element breaks inheritance
     *
     */
    public function breaksInheritance(): bool;

    /**
     * @param string[] $segmentIds
     *
     */
    public function setSegmentIds(array $segmentIds): self;

    /**
     * @param SegmentAssignmentInterface[] $segments
     *
     */
    public function setSegments(array $segments): self;

    public function setElementId(string $id): self;

    public function setElementType(string $type): self;

    public function setBreaksInheritance(bool $breaks): self;
}
