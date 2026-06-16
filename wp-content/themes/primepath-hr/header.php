<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar">
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">PrimePath</a>
        
        <div class="nav-links">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'fallback_cb'    => false,
            ) );
            ?>
        </div>

        <div class="auth-links">
            <?php if ( is_user_logged_in() ) : ?>
                <?php if ( current_user_can( 'manage_options' ) ) : ?>
                    <a href="<?php echo esc_url( admin_url() ); ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">Dashboard</a>
                <?php elseif ( current_user_can( 'pp_post_jobs' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/employer-portal' ) ); ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">My Portal</a>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/candidate-portal' ) ); ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">My Portal</a>
                <?php endif; ?>
                <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem; border-color: var(--gray); color: var(--gray);">Logout</a>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="btn btn-outline" style="padding: 6px 16px; font-size: 0.85rem;">Login</a>
                <a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="btn btn-primary" style="padding: 6px 16px; font-size: 0.85rem;">Register</a>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-btn">☰</button>
    </div>
</nav>

<!-- Push content below fixed nav -->
<div style="height: var(--topbar-h);"></div>
