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

namespace CustomerManagementFrameworkBundle\Command;

use CustomerManagementFrameworkBundle\ActionTrigger\Queue\QueueInterface;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ActionTriggerQueueCommand extends AbstractCommand
{
    use LockableTrait;

    const LOCK_KEY = 'cmf_actiontrigger_queue';

    /**
     * @var QueueInterface
     */
    protected $actionTriggerQueue;

    public function __construct(QueueInterface $actionTriggerQueue)
    {
        parent::__construct();
        $this->actionTriggerQueue = $actionTriggerQueue;
    }


    protected function configure()
    {
        $this->setName('cmf:process-actiontrigger-queue')
            ->setDescription('Process entries from action trigger queue');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->lock(self::LOCK_KEY);

        try {
            $this->actionTriggerQueue->processQueue();
        } catch (\Exception $e) {
            $this->getLogger()->error($e->getMessage());
        }

        $this->release();

        return 0;
    }
}
