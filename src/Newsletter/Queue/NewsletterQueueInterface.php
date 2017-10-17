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

namespace CustomerManagementFrameworkBundle\Newsletter\Queue;

use CustomerManagementFrameworkBundle\Model\CustomerInterface;
use CustomerManagementFrameworkBundle\Model\NewsletterAwareCustomerInterface;
use CustomerManagementFrameworkBundle\Newsletter\ProviderHandler\NewsletterProviderHandlerInterface;
use CustomerManagementFrameworkBundle\Newsletter\Queue\Item\NewsletterQueueItemInterface;

interface NewsletterQueueInterface
{
    const OPERATION_UPDATE = 'update';
    const OPERATION_DELETE = 'delete';

    /**
     * @param CustomerInterface $customer
     * @param $operation
     * @param string|null $email
     *
     * @return void
     */
    public function enqueueCustomer(NewsletterAwareCustomerInterface $customer, $operation, $email = null, $immediateAsyncProcessQueueItem = false);

    /**
     * @param NewsletterProviderHandlerInterface[] $newsletterProviderHandler
     * @param bool $forceAllCustomers
     * @param bool $forceUpdate
     *
     * @return void
     */
    public function processQueue(array $newsletterProviderHandler, $forceAllCustomers = false, $forceUpdate = false);

    /**
     * @param array $newsletterProviderHandler
     * @param NewsletterQueueItemInterface $newsletterQueueItem
     *
     * @return void
     */
    public function syncSingleQueueItem(array $newsletterProviderHandler, NewsletterQueueItemInterface $newsletterQueueItem);

    /**
     * @param NewsletterQueueItemInterface $item
     *
     * @return void
     */
    public function removeFromQueue(NewsletterQueueItemInterface $item);

    /**
     * @return void
     */
    public function enqueueAllCustomers();

    /**
     * @return int
     */
    public function getQueueSize();
}
