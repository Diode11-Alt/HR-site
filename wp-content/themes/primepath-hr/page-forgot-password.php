<?php
/**
 * Template Name: Forgot Password
 */
get_header(); ?>

<section class="section-padding" style="background: var(--navy-mid); min-height: 80vh; display: flex; align-items: center;">
    <div class="container" style="width: 100%;">
        <div style="max-width: 400px; margin: 0 auto; background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); color: var(--navy); text-align: center;">
            <h2 style="font-size: 2rem; margin-bottom: 20px;">Forgot Password</h2>
            <p style="color: var(--gray-dark); margin-bottom: 30px;">Enter your email address and we'll send you a link to reset your password.</p>
            
            <form action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post" style="display: flex; flex-direction: column; gap: 15px;">
                <div>
                    <input type="text" name="user_login" id="user_login" placeholder="Email Address" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/login/?reset=1' ) ); ?>">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Reset Link</button>
            </form>
            
            <p style="margin-top: 20px; font-size: 0.9rem;"><a href="<?php echo esc_url( home_url( '/login' ) ); ?>">Back to Login</a></p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
