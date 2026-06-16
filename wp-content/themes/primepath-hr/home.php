<?php
/**
 * Blog Listing Template (home.php is used for the posts page)
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px;">News & Insights</h1>
        <p style="color: var(--gray); font-size: 1.2rem;">Expert advice, UAE market trends, and PrimePath updates.</p>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container grid-3">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div style="background: var(--white-dim); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 200px; object-fit: cover;' ) ); ?>
                    </a>
                <?php else: ?>
                    <div style="width: 100%; height: 200px; background: var(--navy-mid);"></div>
                <?php endif; ?>
                
                <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                    <div style="font-size: 0.85rem; color: var(--gold-dark); text-transform: uppercase; font-weight: 600; margin-bottom: 10px;">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo esc_html( $categories[0]->name );
                        }
                        ?>
                    </div>
                    <h3 style="margin-bottom: 10px; font-size: 1.4rem;">
                        <a href="<?php the_permalink(); ?>" style="color: var(--navy);"><?php the_title(); ?></a>
                    </h3>
                    <div style="color: var(--gray-dark); margin-bottom: 20px; line-height: 1.6;">
                        <?php the_excerpt(); ?>
                    </div>
                    <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(0,0,0,0.1); padding-top: 15px;">
                        <span style="font-size: 0.85rem; color: var(--gray-dark);"><?php echo get_the_date(); ?></span>
                        <a href="<?php the_permalink(); ?>" style="font-weight: 600; color: var(--gold-dark); font-size: 0.9rem;">Read More &rarr;</a>
                    </div>
                </div>
            </div>
        <?php endwhile; else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <div class="container" style="margin-top: 40px; display: flex; justify-content: center;">
        <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => '&larr; Prev',
            'next_text' => 'Next &rarr;',
        ) );
        ?>
    </div>
</section>

<?php get_footer(); ?>
