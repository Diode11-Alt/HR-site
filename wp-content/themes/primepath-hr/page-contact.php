<?php
/**
 * Template Name: Contact
 */
get_header(); ?>

<section class="hero section-padding" style="background: var(--navy); text-align: center;">
    <div class="container">
        <h1 style="font-size: 3.5rem;">Contact Us</h1>
        <p style="color: var(--gray); font-size: 1.2rem;">We're here to help. Reach out to us today.</p>
    </div>
</section>

<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container grid-3" style="grid-template-columns: 1fr 1fr;">
        <!-- Left: Contact Info -->
        <div>
            <h2 style="font-size: 2.5rem; margin-bottom: 30px;">Get In Touch</h2>
            
            <div style="margin-bottom: 30px;">
                <h4 style="font-size: 1.2rem; margin-bottom: 10px; color: var(--gold-dark);">Office Address</h4>
                <p style="color: var(--gray-dark); line-height: 1.6;">Dubai Media City<br>Building 10, Office 402<br>Dubai, UAE</p>
            </div>
            
            <div style="margin-bottom: 30px;">
                <h4 style="font-size: 1.2rem; margin-bottom: 10px; color: var(--gold-dark);">Contact Info</h4>
                <p style="color: var(--gray-dark); line-height: 1.6;">Phone: +971 4 123 4567<br>Email: info@primepathuae.com</p>
            </div>
            
            <div style="margin-bottom: 30px;">
                <h4 style="font-size: 1.2rem; margin-bottom: 10px; color: var(--gold-dark);">Working Hours</h4>
                <p style="color: var(--gray-dark); line-height: 1.6;">Monday - Friday: 9:00 AM - 6:00 PM GST<br>Saturday - Sunday: Closed</p>
            </div>
            
            <a href="https://wa.me/97141234567" class="btn" style="background: #25D366; color: white; display: inline-flex; align-items: center; gap: 10px;">
                WhatsApp Us
            </a>
        </div>
        
        <!-- Right: Inquiry Form -->
        <div style="background: var(--white-dim); padding: 40px; border-radius: var(--radius-lg);">
            <h3 style="font-size: 1.8rem; margin-bottom: 20px;">Send an Inquiry</h3>
            <form id="pp-contact-form" style="display: flex; flex-direction: column; gap: 15px;">
                <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
                <input type="hidden" name="action" value="pp_contact_form">
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Full Name</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email</label>
                        <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Phone</label>
                        <input type="text" name="phone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                    </div>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">I am a...</label>
                    <select name="type" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                        <option value="employer">Employer looking to hire</option>
                        <option value="candidate">Candidate looking for a job</option>
                        <option value="general">General Inquiry</option>
                    </select>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Subject</label>
                    <input type="text" name="subject" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Message</label>
                    <textarea name="message" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);"></textarea>
                </div>
                
                <div id="contact-msg" style="display: none; padding: 12px; border-radius: var(--radius); font-weight: 500;"></div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('pp-contact-form');
    if(form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = form.querySelector('button');
            const msg = document.getElementById('contact-msg');
            
            btn.textContent = 'Sending...';
            btn.disabled = true;
            
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
                    msg.textContent = 'Thank you! We will get back to you within 24 hours.';
                    form.reset();
                } else {
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = data.data || 'An error occurred. Please try again.';
                }
            } catch (err) {
                msg.style.display = 'block';
                msg.style.backgroundColor = 'var(--danger)';
                msg.style.color = 'white';
                msg.textContent = 'Network error. Please try again.';
            }
            
            btn.textContent = 'Send Inquiry';
            btn.disabled = false;
        });
    }
});
</script>

<?php get_footer(); ?>
