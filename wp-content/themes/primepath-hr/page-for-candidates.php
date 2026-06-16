<?php
/**
 * Template Name: For Candidates
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Your Next Career Move Starts Here</h1>
        <p style="color: var(--gray); font-size: 1.2rem; max-width: 800px; margin: 0 auto 40px;">Thousands of UAE jobs. One smart platform. Zero hassle.</p>
        <a href="<?php echo esc_url( home_url( '/register/?role=candidate' ) ); ?>" class="btn btn-primary" style="font-size: 1.1rem; padding: 16px 32px;">Register Free</a>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container">
        <h2 class="section-title">Why Register With PrimePath?</h2>
        <div class="grid-3">
            <div style="padding: 30px; text-align: center; border: 1px solid var(--white-dim); border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px;">Free Forever</h3>
                <p style="color: var(--gray-dark);">It is completely free to register, build your profile, and apply to jobs.</p>
            </div>
            <div style="padding: 30px; text-align: center; border: 1px solid var(--white-dim); border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px;">Status Updates</h3>
                <p style="color: var(--gray-dark);">Get notified immediately when your application status changes.</p>
            </div>
            <div style="padding: 30px; text-align: center; border: 1px solid var(--white-dim); border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px;">Trusted Employers</h3>
                <p style="color: var(--gray-dark);">We only work with verified, reputable companies in the UAE.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: var(--navy-mid);">
    <div class="container text-center">
        <h2 class="section-title" style="color: var(--white);">Start Your Job Search Today</h2>
        <div style="margin-top: 30px;">
            <a href="<?php echo esc_url( home_url( '/register/?role=candidate' ) ); ?>" class="btn btn-primary">Register Now</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
