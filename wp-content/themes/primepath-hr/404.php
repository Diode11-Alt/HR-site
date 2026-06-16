<?php
/**
 * 404 Template
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center; min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div style="font-size: 6rem; color: var(--gold); font-family: var(--font-display); font-weight: bold; margin-bottom: 20px;">404</div>
        <h1 style="font-size: 2.5rem; margin-bottom: 20px;">Page Not Found</h1>
        <p style="color: var(--gray); font-size: 1.2rem; margin-bottom: 40px;">The page you are looking for doesn't exist or has been moved.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Return Home</a>
    </div>
</section>

<?php get_footer(); ?>
