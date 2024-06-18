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

namespace CustomerManagementFrameworkBundle\RESTApi;

use Symfony\Component\HttpFoundation\Request;

interface CrudHandlerInterface
{
    /**
     * GET /
     *
     *
     * @return Response
     */
    public function listRecords(Request $request);

    /**
     * GET /{id}
     *
     *
     * @return Response
     */
    public function readRecord(Request $request);

    /**
     * POST /
     *
     *
     * @return Response
     */
    public function createRecord(Request $request);

    /**
     * PUT /{id}
     *
     * TODO support partial updates as we do now or demand whole object in PUT? Use PATCH for partial requests?
     *
     *
     * @return Response
     */
    public function updateRecord(Request $request);

    /**
     * DELETE /{id}
     *
     *
     * @return Response
     */
    public function deleteRecord(Request $request);
}
