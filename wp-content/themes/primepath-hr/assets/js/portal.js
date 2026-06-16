document.addEventListener('DOMContentLoaded', () => {
    
    // Tab Switching
    const navLinks = document.querySelectorAll('.portal-nav a[data-tab]');
    const tabs = document.querySelectorAll('.portal-tab');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Remove active classes
            navLinks.forEach(l => l.classList.remove('active'));
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add active class
            link.classList.add('active');
            const targetId = link.getAttribute('data-tab');
            const targetTab = document.getElementById('tab-' + targetId);
            if(targetTab) {
                targetTab.classList.add('active');
            }
        });
    });

    // Profile Form Submission
    const profileForm = document.getElementById('pp-profile-form');
    if(profileForm) {
        profileForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = profileForm.querySelector('button');
            const msg = document.getElementById('profile-msg');
            
            btn.disabled = true;
            btn.textContent = 'Saving...';
            
            const formData = new FormData(profileForm);
            
            try {
                // Determine ajax url from window or assume relative if missing
                // WP usually passes it, but we can rely on standard path
                const ajaxurl = '/wp-admin/admin-ajax.php';
                const res = await fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                
                msg.style.display = 'block';
                if(data.success) {
                    msg.style.backgroundColor = 'var(--success)';
                    msg.style.color = 'white';
                    msg.textContent = 'Profile updated successfully!';
                } else {
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = data.data || 'Failed to update profile.';
                }
            } catch (err) {
                msg.style.display = 'block';
                msg.style.backgroundColor = 'var(--danger)';
                msg.style.color = 'white';
                msg.textContent = 'Network error.';
            }
            
            btn.disabled = false;
            btn.textContent = 'Save Profile';
            
            setTimeout(() => { msg.style.display = 'none'; }, 3000);
        });
    }
});
