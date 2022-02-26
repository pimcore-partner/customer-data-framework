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

namespace CustomerManagementFrameworkBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Pimcore\Db;
use Pimcore\Migrations\Migration\AbstractPimcoreMigration;
use Pimcore\Model\User;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171019130865 extends AbstractPimcoreMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $permissions = [
            'plugin_customermanagementframework_activityview' => 'plugin_cmf_perm_activityview',
            'plugin_customermanagementframework_customerview' => 'plugin_cmf_perm_customerview',
            'plugin_customermanagementframework_customer_automa' => 'plugin_cmf_perm_customer_automation_rules',
            'plugin_customermanagementframework_newsletter_enqu' => 'plugin_cmf_perm_newsletter_enqueue_all_customers',
        ];

        $this->migratePermissions($permissions);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $permissions = [
            'plugin_cmf_perm_activityview' => 'plugin_customermanagementframework_activityview',
            'plugin_cmf_perm_customerview' => 'plugin_customermanagementframework_customerview',
            'plugin_cmf_perm_customer_automation_rules' => 'plugin_customermanagementframework_customer_automa',
            'plugin_cmf_perm_newsletter_enqueue_all_customers' => 'plugin_customermanagementframework_newsletter_enqu',
        ];

        $this->migratePermissions($permissions, 'plugin_cmf_perm');
    }

    protected function migratePermissions($permissionsMapping, $permissionSearchKey = 'plugin_customermanagementframework')
    {
        $db = Db::get();

        foreach ($permissionsMapping as $source => $target) {

            //delete old permission
            $db->query('delete from users_permission_definitions where `key` = ?', [$source]);

            // create new permission
            if (!\Pimcore\Model\User\Permission\Definition::getByKey($target)) {
                $permission = new \Pimcore\Model\User\Permission\Definition();
                $permission->setKey($target);

                $res = new \Pimcore\Model\User\Permission\Definition\Dao();
                $res->configure();
                $res->setModel($permission);
                $res->save();
            }
        }

        // migrate users/roles
        $users = new User\Listing;
        $users->setCondition("permissions like '%$permissionSearchKey%");

        foreach ($db->fetchCol("select id from users where permissions like '%$permissionSearchKey%'") as $userId) {
            $user = User::getById($userId);

            if (!$user) {
                $user = User\Role::getById($userId);
            }
            if ($permissions = $user->getPermissions()) {
                foreach ($permissions as $key => $permission) {
                    if (isset($permissionsMapping[$permission])) {
                        $permissions[$key] = $permissionsMapping[$permission];
                    }
                }
                $user->setPermissions($permissions);
                $user->save();
            }
        }
    }
}
