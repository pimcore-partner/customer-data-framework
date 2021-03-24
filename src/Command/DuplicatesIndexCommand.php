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

use CustomerManagementFrameworkBundle\DuplicatesIndex\DuplicatesIndexInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DuplicatesIndexCommand extends AbstractCommand
{

    /**
     * @var DuplicatesIndexInterface
     */
    protected $duplicatesIndex;

    /**
     * @param DuplicatesIndexInterface $duplicatesIndex
     */
    public function __construct(DuplicatesIndexInterface $duplicatesIndex)
    {
        parent::__construct();
        $this->duplicatesIndex = $duplicatesIndex;
    }


    protected function configure()
    {
        $this->setName('cmf:duplicates-index')
            ->setDescription('Handles the duplicate search index')
            ->addOption('recreate', 'r', null, 'recreate index (total index will be deleted and recreated)')
            ->addOption('calculate', 'c', null, 'calculate potential duplicates')
            ->addOption('analyze', 'a', null, 'analyze false postives (used for calculating potential duplicates)');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->getLogger();


        if ($input->getOption('analyze')) {
            $this->duplicatesIndex->setAnalyzeFalsePositives(true);
        } else {
            $this->duplicatesIndex->setAnalyzeFalsePositives(false);
        }

        if ($input->getOption('recreate')) {
            $logger->notice('start recreate index');
            $this->duplicatesIndex->recreateIndex();
            $logger->notice('finished recreate index');
        }

        if ($input->getOption('calculate')) {
            $logger->notice('start calculating potential duplicates');
            $this->duplicatesIndex->calculatePotentialDuplicates($output);
            $logger->notice('finished calculating potential duplicates');
        }

        return 0;
    }
}
