<?php
/**
 * Updated Calculated Fields Script
 * Project Home: https://github.com/blak3r/sugarcrm-update-calculated-fields/
 *
 * Parts of this code are (c) 2013 Blake Robertson http://www.blakerobertson.com
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact Blake Robertson at http://wwww.blakerobertson.com/contact
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 */

// See the readme for complete instructions
// Modify the lines below
$module = "Quotes"; // Set the module where you calculated field is.
$order_by = ""; //
$where = ""; // If you want to filter the records to update, specify it here.  See SugarBean->getFullList for docs on how to

// Here's the documentation on get_full_list from: http://apidocs.sugarcrm.com/api/6.2.4/ce/db_data_SugarBean.html
//   get_full_list( string $order_by = "", string $where = "",  $check_dates = false, int $show_deleted = 0 ) : void
//   Returns a full (ie non-paged) list of the current object type.

// ------[ Do not modify anything below here ]--------------- //


if (!defined('sugarEntry') || !sugarEntry)
die('Not A Valid Entry Point');

require_once('include/utils.php');
require_once('include/export_utils.php');

$moduleBean = BeanFactory::getBean($module);

$page_length = 20;

for ($offset = 0; true; $offset += $page_length) {
    // Fetch paginated list part
	$list = $moduleBean->get_list($order_by, $where, $offset, -1, $page_length);
	if (count($list['list']) == 0) {
		break;
	}

	foreach($list['list'] as $b) {
		/** @var $b SugarBean */
		// These lines prevent the modified date and user from being changed.
		$b->update_date_modified = false;
		$b->update_modified_by = false;
		$b->tracker_visibility = false;
		$b->fill_in_relationship_fields();
		$b->save();
	}
};

print "Finished updating: {$list['row_count']} records.";
