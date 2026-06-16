<?php
/**
 * Template Name: For Employers
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Find The Right Talent For Your Business — Fast</h1>
        <p style="color: var(--gray); font-size: 1.2rem; max-width: 800px; margin: 0 auto 40px;">PrimePath connects you with pre-screened, UAE-ready candidates across all industries.</p>
        <a href="<?php echo esc_url( home_url( '/register/?role=employer' ) ); ?>" class="btn btn-primary" style="font-size: 1.1rem; padding: 16px 32px;">Start Posting Jobs</a>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container">
        <h2 class="section-title">The Problem We Solve</h2>
        <div class="grid-3">
            <div style="background: var(--white-dim); padding: 30px; border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px; color: var(--danger);">Problem 1</h3>
                <p style="color: var(--gray-dark);">Wasting hours screening unqualified CVs that don't match your requirements.</p>
            </div>
            <div style="background: var(--white-dim); padding: 30px; border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px; color: var(--danger);">Problem 2</h3>
                <p style="color: var(--gray-dark);">Candidates who don't show up for interviews or leave within the first month.</p>
            </div>
            <div style="background: var(--white-dim); padding: 30px; border-radius: var(--radius);">
                <h3 style="margin-bottom: 15px; color: var(--danger);">Problem 3</h3>
                <p style="color: var(--gray-dark);">No time or dedicated HR resources to manage recruitment in-house.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: var(--navy-mid);">
    <div class="container text-center">
        <h2 class="section-title" style="color: var(--white);">Ready to Post Your First Job?</h2>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 30px;">
            <a href="<?php echo esc_url( home_url( '/register/?role=employer' ) ); ?>" class="btn btn-primary">Register as Employer</a>
            <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="btn btn-outline">Employer Login</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
