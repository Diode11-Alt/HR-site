<?php
/**
 * Template Name: About Us
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <p style="color: var(--gold); text-transform: uppercase; font-size: 0.85rem; letter-spacing: 2px;">Home &rarr; About Us</p>
        <h1 style="font-size: 3.5rem; margin-top: 10px;">About PrimePath UAE</h1>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container grid-3" style="grid-template-columns: 1fr 1fr; align-items: center;">
        <div>
            <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Our Story</h2>
            <p style="color: var(--gray-dark); font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">Founded with a vision to streamline recruitment in the fast-paced UAE market, PrimePath has grown into a trusted partner for both global enterprises and local startups. We understand that behind every successful business is a team of dedicated professionals.</p>
            <p style="color: var(--gray-dark); font-size: 1.1rem; line-height: 1.8;">Our bespoke approach ensures that we don't just fill vacancies—we forge long-lasting partnerships that drive organizational success.</p>
        </div>
        <div style="background: var(--white-dim); min-height: 400px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: var(--gray);">
            [Office Image Placeholder]
        </div>
    </div>
</section>

<section class="section-padding" style="background: var(--navy-mid);">
    <div class="container">
        <div class="grid-3" style="grid-template-columns: 1fr 1fr;">
            <div style="background: var(--navy); padding: 40px; border-radius: var(--radius); border-left: 4px solid var(--gold);">
                <h3 style="font-size: 2rem; margin-bottom: 15px;">Our Mission</h3>
                <p style="color: var(--gray); font-size: 1.1rem;">To connect UAE's best talent with its best opportunities, fostering growth for individuals and organizations alike.</p>
            </div>
            <div style="background: var(--navy); padding: 40px; border-radius: var(--radius); border-left: 4px solid var(--gold);">
                <h3 style="font-size: 2rem; margin-bottom: 15px;">Our Vision</h3>
                <p style="color: var(--gray); font-size: 1.1rem;">To be the most trusted, innovative, and impactful recruitment partner in the GCC region.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
