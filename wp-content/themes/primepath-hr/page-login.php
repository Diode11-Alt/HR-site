<?php
/**
 * Template Name: Login Page
 */
get_header(); ?>

<section class="section-padding" style="background: var(--navy-mid); min-height: 80vh; display: flex; align-items: center;">
    <div class="container" style="width: 100%;">
        <?php echo do_shortcode('[pp_login_form]'); ?>
    </div>
</section>

<?php get_footer(); ?>
