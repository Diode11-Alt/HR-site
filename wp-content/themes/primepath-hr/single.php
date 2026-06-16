<?php
/**
 * Single Post Template
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container" style="max-width: 800px;">
        <div style="font-size: 0.9rem; color: var(--gold); text-transform: uppercase; font-weight: 600; margin-bottom: 20px;">
            <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo esc_html( $categories[0]->name );
            }
            ?>
        </div>
        <h1 style="font-size: 3rem; margin-bottom: 20px;"><?php the_title(); ?></h1>
        <div style="color: var(--gray); font-size: 0.95rem;">
            By <?php the_author(); ?> | <?php echo get_the_date(); ?>
        </div>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container" style="max-width: 800px;">
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom: 40px; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm);">
                <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto;' ) ); ?>
            </div>
        <?php endif; ?>
        
        <div style="font-size: 1.1rem; line-height: 1.8; color: #333;">
            <?php the_content(); ?>
        </div>
        
        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: bold; font-family: var(--font-display);">Share this post</div>
            <div style="display: flex; gap: 15px;">
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">LinkedIn</a>
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">WhatsApp</a>
            </div>
        </div>
        
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
