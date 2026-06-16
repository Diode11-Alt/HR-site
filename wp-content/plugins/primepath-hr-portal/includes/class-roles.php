<?php
/**
 * Role Registration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PP_Roles {

    /**
     * Register Custom Roles
     */
    public static function register_roles() {
        // Employer Role
        add_role(
            'pp_employer',
            __( 'Employer', 'primepath-hr' ),
            array(
                'read'                     => true,
                'pp_post_jobs'             => true,
                'pp_view_own_applications' => true,
                'pp_manage_own_jobs'       => true,
            )
        );

        // Candidate Role
        add_role(
            'pp_candidate',
            __( 'Candidate', 'primepath-hr' ),
            array(
                'read'                     => true,
                'pp_apply_jobs'            => true,
                'pp_view_own_applications' => true,
                'pp_manage_profile'        => true,
            )
        );
    }
}
