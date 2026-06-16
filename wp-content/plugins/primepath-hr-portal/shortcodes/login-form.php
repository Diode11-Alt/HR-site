<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function pp_login_form_shortcode() {
    if ( is_user_logged_in() ) {
        if ( current_user_can('manage_options') ) {
            wp_redirect(admin_url());
        } elseif ( current_user_can('pp_post_jobs') ) {
            wp_redirect(home_url('/employer-portal'));
        } else {
            wp_redirect(home_url('/candidate-portal'));
        }
        exit;
    }

    ob_start();
    ?>
    <div style="max-width: 400px; margin: 0 auto; background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); color: var(--navy);">
        <h2 style="font-size: 2rem; margin-bottom: 20px; text-align: center;">Welcome Back</h2>
        <form id="pp-login-form" style="display: flex; flex-direction: column; gap: 15px;">
            <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
            <input type="hidden" name="action" value="pp_login_user">
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem;">
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="remember" value="true"> Remember Me
                </label>
                <a href="<?php echo esc_url(home_url('/forgot-password')); ?>" style="color: var(--gold-dark);">Forgot Password?</a>
            </div>
            
            <div id="login-msg" style="display: none; padding: 10px; border-radius: var(--radius); font-size: 0.9rem;"></div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Login</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 0.9rem;">Don't have an account? <a href="<?php echo esc_url(home_url('/register')); ?>">Register</a></p>
    </div>

    <script>
    document.getElementById('pp-login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const btn = form.querySelector('button');
        const msg = document.getElementById('login-msg');
        
        btn.disabled = true;
        btn.textContent = 'Logging in...';
        
        const formData = new FormData(form);
        
        try {
            const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            msg.style.display = 'block';
            if(data.success) {
                msg.style.backgroundColor = 'var(--success)';
                msg.style.color = 'white';
                msg.textContent = 'Success! Redirecting...';
                window.location.href = data.data.redirect;
            } else {
                msg.style.backgroundColor = 'var(--danger)';
                msg.style.color = 'white';
                msg.textContent = data.data || 'Invalid credentials.';
            }
        } catch (err) {
            msg.style.display = 'block';
            msg.style.backgroundColor = 'var(--danger)';
            msg.style.color = 'white';
            msg.textContent = 'Network error.';
        }
        
        btn.disabled = false;
        btn.textContent = 'Login';
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pp_login_form', 'pp_login_form_shortcode');
