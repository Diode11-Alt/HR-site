<?php
/**
 * Upload Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PP_Upload {

    /**
     * Handle CV Upload
     * @param array $file $_FILES['file']
     * @return string|WP_Error URL on success, WP_Error on failure
     */
    public static function handle_cv_upload( $file ) {
        if ( empty( $file['name'] ) ) {
            return new WP_Error( 'empty', 'No file provided.' );
        }

        // Check size (Max 5MB)
        if ( $file['size'] > 5 * 1024 * 1024 ) {
            return new WP_Error( 'size', 'File size exceeds 5MB limit.' );
        }

        // Check mime type (PDF/DOCX only)
        $allowed_mimes = array(
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        );
        $wp_filetype = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'], $allowed_mimes );
        
        if ( ! $wp_filetype['ext'] || ! $wp_filetype['type'] ) {
            return new WP_Error( 'type', 'Invalid file type. Only PDF and DOC/DOCX are allowed.' );
        }

        // Ensure upload directory exists
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/primepath-cvs';
        
        if ( ! file_exists( $custom_dir ) ) {
            wp_mkdir_p( $custom_dir );
            // Create .htaccess to deny direct access
            file_put_contents( $custom_dir . '/.htaccess', 'Deny from all' );
            file_put_contents( $custom_dir . '/index.php', '<?php // Silence is golden.' );
        }

        // Rename file
        $ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
        $new_filename = 'cv_' . get_current_user_id() . '_' . time() . '.' . $ext;
        $target_file = $custom_dir . '/' . $new_filename;

        // Move file
        if ( move_uploaded_file( $file['tmp_name'], $target_file ) ) {
            // We return the relative path so we can reconstruct it, or the full URL if we need to link it
            // Since .htaccess blocks public access, admins will download via a special script or we just use relative path
            return $upload_dir['baseurl'] . '/primepath-cvs/' . $new_filename;
        }

        return new WP_Error( 'upload_failed', 'Failed to move uploaded file.' );
    }
}
