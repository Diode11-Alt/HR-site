<?php
/**
 * Generic Fallback Template (index.php)
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; margin-bottom: 20px;"><?php single_post_title(); ?></h1>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy); min-height: 50vh;">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        else :
            echo '<p>No content found.</p>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
