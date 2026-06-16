<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function pp_register_form_shortcode() {
    if ( is_user_logged_in() ) {
        wp_redirect(home_url());
        exit;
    }

    $preselect_role = isset($_GET['role']) && $_GET['role'] === 'employer' ? 'employer' : 'candidate';

    ob_start();
    ?>
    <div style="max-width: 600px; margin: 0 auto; background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); color: var(--navy);">
        <h2 style="font-size: 2rem; margin-bottom: 30px; text-align: center;">Create Your Account</h2>
        
        <!-- Role Selection -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
            <div class="role-selector <?php echo $preselect_role === 'candidate' ? 'active' : ''; ?>" data-role="candidate" style="border: 2px solid <?php echo $preselect_role === 'candidate' ? 'var(--gold)' : '#ccc'; ?>; padding: 20px; border-radius: var(--radius); text-align: center; cursor: pointer;">
                <h3 style="font-size: 1.2rem; margin-bottom: 5px;">I am a Candidate</h3>
                <p style="font-size: 0.85rem; color: var(--gray-dark);">Looking for a job</p>
            </div>
            <div class="role-selector <?php echo $preselect_role === 'employer' ? 'active' : ''; ?>" data-role="employer" style="border: 2px solid <?php echo $preselect_role === 'employer' ? 'var(--gold)' : '#ccc'; ?>; padding: 20px; border-radius: var(--radius); text-align: center; cursor: pointer;">
                <h3 style="font-size: 1.2rem; margin-bottom: 5px;">I am an Employer</h3>
                <p style="font-size: 0.85rem; color: var(--gray-dark);">Looking to hire</p>
            </div>
        </div>

        <form id="pp-register-form" style="display: flex; flex-direction: column; gap: 15px;">
            <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
            <input type="hidden" name="action" value="pp_register_user">
            <input type="hidden" id="reg-role" name="role" value="<?php echo esc_attr($preselect_role); ?>">
            
            <div id="company-field" style="<?php echo $preselect_role === 'employer' ? '' : 'display: none;'; ?>">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Company Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="company_name" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Full Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="full_name" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email Address <span style="color:var(--danger)">*</span></label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Phone Number</label>
                <input type="text" name="phone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
            </div>

            <div id="candidate-fields" style="<?php echo $preselect_role === 'candidate' ? '' : 'display: none;'; ?>">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Current Job Title</label>
                    <input type="text" name="job_title" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Years of Experience</label>
                    <input type="number" name="experience" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" name="password" required minlength="8" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Confirm Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" name="password_confirm" required minlength="8" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
            </div>
            
            <div style="font-size: 0.9rem; margin-top: 10px;">
                <label style="display: flex; align-items: start; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="terms" required style="margin-top: 3px;">
                    <span>I agree to the <a href="#" style="color: var(--gold-dark);">Terms of Use</a> and <a href="#" style="color: var(--gold-dark);">Privacy Policy</a>.</span>
                </label>
            </div>
            
            <div id="register-msg" style="display: none; padding: 10px; border-radius: var(--radius); font-size: 0.9rem;"></div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px; padding: 15px; font-size: 1.1rem;">Create Account</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 0.9rem;">Already have an account? <a href="<?php echo esc_url(home_url('/login')); ?>">Login here</a></p>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectors = document.querySelectorAll('.role-selector');
        const roleInput = document.getElementById('reg-role');
        const companyField = document.getElementById('company-field');
        const candidateFields = document.getElementById('candidate-fields');
        const companyInput = companyField.querySelector('input');

        selectors.forEach(sel => {
            sel.addEventListener('click', () => {
                selectors.forEach(s => s.style.borderColor = '#ccc');
                sel.style.borderColor = 'var(--gold)';
                
                const role = sel.getAttribute('data-role');
                roleInput.value = role;
                
                if (role === 'employer') {
                    companyField.style.display = 'block';
                    companyInput.setAttribute('required', 'required');
                    candidateFields.style.display = 'none';
                } else {
                    companyField.style.display = 'none';
                    companyInput.removeAttribute('required');
                    candidateFields.style.display = 'block';
                }
            });
        });

        document.getElementById('pp-register-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const btn = form.querySelector('button');
            const msg = document.getElementById('register-msg');
            
            const pwd = form.querySelector('[name="password"]').value;
            const pwdConf = form.querySelector('[name="password_confirm"]').value;
            
            if (pwd !== pwdConf) {
                msg.style.display = 'block';
                msg.style.backgroundColor = 'var(--warning)';
                msg.style.color = '#fff';
                msg.textContent = 'Passwords do not match.';
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Creating account...';
            
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
                    msg.textContent = 'Account created successfully! Redirecting...';
                    window.location.href = data.data.redirect;
                } else {
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = data.data || 'Registration failed.';
                }
            } catch (err) {
                msg.style.display = 'block';
                msg.style.backgroundColor = 'var(--danger)';
                msg.style.color = 'white';
                msg.textContent = 'Network error.';
            }
            
            btn.disabled = false;
            btn.textContent = 'Create Account';
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pp_register_form', 'pp_register_form_shortcode');
