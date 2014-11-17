<?php
/**
* affiliates-role.php
*
* Copyright (c) 2014 "kento" Karim Rahimpur www.itthinx.com
*
* This code is released under the GNU General Public License.
* See COPYRIGHT.txt and LICENSE.txt.
*
* This code is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* This header and all notices must be kept intact.
*
* @author itthinx
* @package affiliates-role
* @since 1.0.0
*
* Plugin Name: Affiliates Role
* Plugin URI: http://www.itthinx.com/plugins/affiliates
* Description: Assigns the Affiliate role to new affiliate users. 
* Version: 1.0.0
* Author: itthinx
* Author URI: http://www.itthinx.com
* Donate-Link: http://www.itthinx.com
* License: GPLv3
*/

/**
 * Class handling automatic Affiliate role assignment.
 */
class Affiliates_Role {
	
	public static function init() {
		register_activation_hook(__FILE__, array( __CLASS__, 'activate' ) );
		add_action( 'affiliates_added_affiliate', array( __CLASS__, 'affiliates_added_affiliate' ) );
	}
	
	public static function activate() {
		add_role( 'affiliate', 'Affiliate', array(
			'read'         => true,
			'edit_posts'   => false,
			'delete_posts' => false
		) );
	}

	public static function affiliates_added_affiliate( $affiliate_id ) {
		if ( $user_id = affiliates_get_affiliate_user( $affiliate_id ) ) {
			if ( $user = get_user_by('id', $user_id ) ) {
				$user->set_role( 'affiliate' );
			}
		}
	}
}
Affiliates_Role::init();
