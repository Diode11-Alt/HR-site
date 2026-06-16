<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function pp_job_board_shortcode() {
    ob_start();
    ?>
    <div class="job-board-container" style="max-width: var(--max-width); margin: 0 auto;">
        
        <!-- Search Bar -->
        <div style="background: var(--navy); padding: 20px; border-radius: var(--radius-lg); margin-bottom: 30px;">
            <input type="text" id="jb-search" placeholder="Search by job title or keyword..." style="width: 100%; padding: 15px; border-radius: var(--radius); border: none; font-size: 1.1rem;">
        </div>

        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;" class="jb-grid">
            
            <!-- Filters Sidebar -->
            <div style="background: var(--white); border-radius: var(--radius-lg); padding: 20px; box-shadow: var(--shadow-sm); height: fit-content;">
                <h3 style="margin-bottom: 20px; font-size: 1.2rem; border-bottom: 2px solid var(--gold); padding-bottom: 10px;">Filters</h3>
                
                <div style="margin-bottom: 20px;">
                    <h4 style="margin-bottom: 10px; font-size: 1rem;">Category</h4>
                    <select id="jb-category" style="width: 100%; padding: 10px; border-radius: var(--radius); border: 1px solid #ccc;">
                        <option value="">All Categories</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Finance">Finance</option>
                        <option value="HR">HR</option>
                        <option value="Logistics">Logistics</option>
                        <option value="IT">IT</option>
                        <option value="HSE">HSE</option>
                        <option value="Admin">Admin</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <h4 style="margin-bottom: 10px; font-size: 1rem;">Job Type</h4>
                    <select id="jb-type" style="width: 100%; padding: 10px; border-radius: var(--radius); border: 1px solid #ccc;">
                        <option value="">All Types</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
                
                <button id="jb-clear" class="btn btn-outline" style="width: 100%;">Clear Filters</button>
            </div>

            <!-- Job Listings -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 id="jb-count" style="font-size: 1.2rem; color: var(--navy);">Loading jobs...</h3>
                </div>
                
                <div id="jb-results" style="display: flex; flex-direction: column; gap: 15px;">
                    <!-- Jobs injected via AJAX -->
                </div>
            </div>
            
        </div>
    </div>

    <!-- Application Modal Placeholder -->
    <div id="apply-modal-container"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const resultsDiv = document.getElementById('jb-results');
        const countHeading = document.getElementById('jb-count');
        
        const fetchJobs = async () => {
            resultsDiv.innerHTML = '<div style="text-align: center; padding: 40px;">Loading...</div>';
            
            const formData = new FormData();
            formData.append('action', 'pp_filter_jobs');
            formData.append('pp_nonce', '<?php echo wp_create_nonce('pp_action'); ?>');
            formData.append('keyword', document.getElementById('jb-search').value);
            formData.append('category', document.getElementById('jb-category').value);
            formData.append('type', document.getElementById('jb-type').value);
            
            try {
                const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                
                if(data.success) {
                    resultsDiv.innerHTML = data.data.html;
                    countHeading.textContent = `Showing ${data.data.count} jobs`;
                    attachApplyListeners();
                } else {
                    resultsDiv.innerHTML = '<div style="padding: 20px; background: #fee2e2; color: #ef4444; border-radius: 6px;">Error loading jobs.</div>';
                }
            } catch (err) {
                resultsDiv.innerHTML = '<div style="padding: 20px; background: #fee2e2; color: #ef4444; border-radius: 6px;">Network Error.</div>';
            }
        };

        const attachApplyListeners = () => {
            document.querySelectorAll('.btn-apply').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.getAttribute('data-id');
                    const title = e.target.getAttribute('data-title');
                    openApplyModal(id, title);
                });
            });
        };

        const openApplyModal = (id, title) => {
            const container = document.getElementById('apply-modal-container');
            const isLoggedIn = <?php echo is_user_logged_in() && current_user_can('pp_apply_jobs') ? 'true' : 'false'; ?>;
            const isGuest = <?php echo !is_user_logged_in() ? 'true' : 'false'; ?>;
            
            if(isGuest) {
                container.innerHTML = `
                    <div style="position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; z-index:9999;">
                        <div style="background: white; padding: 30px; border-radius: var(--radius-lg); width: 100%; max-width: 400px; text-align: center;">
                            <h3 style="margin-bottom: 20px;">Login Required</h3>
                            <p style="margin-bottom: 30px; color: var(--gray-dark);">You must be logged in as a candidate to apply for jobs.</p>
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <button onclick="document.getElementById('apply-modal-container').innerHTML=''" class="btn btn-outline">Close</button>
                                <a href="<?php echo esc_url(home_url('/login')); ?>" class="btn btn-primary">Login / Register</a>
                            </div>
                        </div>
                    </div>
                `;
                return;
            }

            if(!isLoggedIn) {
                 alert("Only candidates can apply to jobs.");
                 return;
            }

            container.innerHTML = `
                <div style="position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; z-index:9999;">
                    <div style="background: white; padding: 40px; border-radius: var(--radius-lg); width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto;">
                        <h3 style="margin-bottom: 10px; font-size: 1.5rem;">Apply for</h3>
                        <h4 style="margin-bottom: 20px; color: var(--gold-dark);">${title}</h4>
                        
                        <form id="pp-apply-form" style="display: flex; flex-direction: column; gap: 15px;">
                            <input type="hidden" name="action" value="pp_submit_application">
                            <input type="hidden" name="job_id" value="${id}">
                            <input type="hidden" name="pp_nonce" value="<?php echo wp_create_nonce('pp_action'); ?>">
                            
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Phone Number <span style="color:red">*</span></label>
                                <input type="text" name="phone" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                            </div>
                            
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Total Years of Experience <span style="color:red">*</span></label>
                                <input type="number" name="experience" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);">
                            </div>
                            
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Cover Letter</label>
                                <textarea name="cover_letter" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: var(--radius);"></textarea>
                            </div>
                            
                            <div style="background: var(--white-dim); padding: 15px; border-radius: var(--radius);">
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Upload CV (PDF/DOCX) <span style="color:red">*</span></label>
                                <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
                                <p style="font-size: 0.8rem; color: var(--gray-dark); margin-top: 5px;">Max size: 5MB</p>
                            </div>
                            
                            <div id="apply-msg" style="display: none; padding: 10px; border-radius: var(--radius); font-size: 0.9rem;"></div>
                            
                            <div style="display: flex; gap: 10px; margin-top: 10px;">
                                <button type="button" onclick="document.getElementById('apply-modal-container').innerHTML=''" class="btn btn-outline" style="flex: 1;">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="flex: 1;">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            document.getElementById('pp-apply-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                const form = e.target;
                const btn = form.querySelector('button[type="submit"]');
                const msg = document.getElementById('apply-msg');
                
                btn.disabled = true;
                btn.textContent = 'Submitting...';
                
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
                        msg.textContent = 'Application submitted successfully!';
                        setTimeout(() => { document.getElementById('apply-modal-container').innerHTML=''; }, 2000);
                    } else {
                        msg.style.backgroundColor = 'var(--danger)';
                        msg.style.color = 'white';
                        msg.textContent = data.data || 'Failed to submit application.';
                    }
                } catch (err) {
                    msg.style.display = 'block';
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = 'Network error.';
                }
                
                btn.disabled = false;
                btn.textContent = 'Submit Application';
            });
        };

        // Event Listeners for filters
        document.getElementById('jb-search').addEventListener('input', fetchJobs); // Could debounce this
        document.getElementById('jb-category').addEventListener('change', fetchJobs);
        document.getElementById('jb-type').addEventListener('change', fetchJobs);
        document.getElementById('jb-clear').addEventListener('click', () => {
            document.getElementById('jb-search').value = '';
            document.getElementById('jb-category').value = '';
            document.getElementById('jb-type').value = '';
            fetchJobs();
        });

        // Initial fetch
        fetchJobs();
    });
    </script>
    
    <style>
    @media (max-width: 768px) {
        .jb-grid { grid-template-columns: 1fr !important; }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('pp_job_board', 'pp_job_board_shortcode');
