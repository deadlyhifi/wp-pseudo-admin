<?php
/*
Plugin Name: Pseudo Admin Role
Description: Add a role, called Ådministrator, that gives clients just enough power.
Version:     1.0
Plugin URI:  https://github.com/deadlyhifi/wp-pseudo-admin
Author:      Tom de Bruin
Author URI:  http://deadlyhifi.com/
License:     GPL v2 or later

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

defined( 'ABSPATH' ) or die();

function add_client_admin_role() {
    if ($woocommerce = get_role('shop_manager')) {
        $role = $woocommerce;
    } else {
        $role = get_role('editor');
    }

    $capabilities = $role->capabilities;

    // Add Caps
    $capabilities['list_users'] = true;
    $capabilities['edit_users'] = true;
    $capabilities['add_users'] = true;
    $capabilities['create_users'] = true;
    $capabilities['remove_users'] = true;

    add_role(
        'client_admin',
        __( 'Ådministrator' ),
        $capabilities
    );
}

register_activation_hook( __FILE__, 'add_client_admin_role' );

function remove_client_admin_role() {
    $users = get_users('role=client_admin');

    // Switch role on existing users
    foreach( $users as $user ) {
        echo $user->data->ID;

        $u = new WP_User( $user->data->ID );

        // Remove role
        $u->remove_role( 'client_admin' );

        // Add Role
        if( $woocommerce = get_role( 'shop_manager' ) ) {
            $u->add_role( 'shop_manager' );
        } else {
            $u->add_role( 'editor' );
        }
    }

    remove_role( 'client_admin' );
}

register_deactivation_hook( __FILE__, 'remove_client_admin_role' );
