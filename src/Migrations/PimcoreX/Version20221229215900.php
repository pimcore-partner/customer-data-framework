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

namespace CustomerManagementFrameworkBundle\Migrations\PimcoreX;

use Doctrine\DBAL\Schema\Schema;
use Pimcore\Migrations\BundleAwareMigration;

class Version20221229215900 extends BundleAwareMigration
{
    protected function getBundleName(): string
    {
        return 'PimcoreCustomerManagementFrameworkBundle';
    }

    public function up(Schema $schema): void
    {
        $deletionsTable = $schema->getTable('plugin_cmf_deletions');

        if ($deletionsTable->getPrimaryKey()) {
            $deletionsTable->dropPrimaryKey();
        }

        $this->addSql('SET foreign_key_checks = 0');
        $this->addSql('ALTER TABLE `plugin_cmf_deletions` ADD PRIMARY KEY (`id`, `entityType`, `type`);');
        $this->addSql('SET foreign_key_checks = 1');
    }

    public function down(Schema $schema): void
    {
        $deletionsTable = $schema->getTable('plugin_cmf_deletions');

        if ($deletionsTable->getPrimaryKey()) {
            $deletionsTable->dropPrimaryKey();
        }
    }
}
