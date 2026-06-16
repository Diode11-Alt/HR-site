<?php
/**
 * Front Page Template
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero section-padding" style="background: var(--navy); color: var(--white); min-height: 80vh; display: flex; align-items: center;">
    <div class="container grid-3" style="grid-template-columns: 1fr 1fr; align-items: center;">
        <div>
            <span style="color: var(--gold); text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem; font-weight: 600;">UAE's Premier HR & Recruitment Agency</span>
            <h1 style="font-size: 3.5rem; line-height: 1.1; margin: 20px 0;">We Connect UAE's Best Talent With Its Best Companies</h1>
            <p style="color: var(--gray); font-size: 1.1rem; margin-bottom: 30px;">Expert recruitment solutions for Dubai, Abu Dhabi, and the wider GCC. Finding the perfect fit, faster.</p>
            <div style="display: flex; gap: 16px;">
                <a href="<?php echo esc_url( home_url( '/jobs' ) ); ?>" class="btn btn-primary">Browse Jobs &rarr;</a>
                <a href="<?php echo esc_url( home_url( '/for-employers' ) ); ?>" class="btn btn-outline">Post a Job</a>
            </div>
        </div>
        
        <div style="background: var(--navy-mid); padding: 40px; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.05);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div>
                    <div style="color: var(--gold); font-size: 2.5rem; font-family: var(--font-display); font-weight: bold;">500+</div>
                    <div style="color: var(--gray); font-size: 0.9rem;">Placements</div>
                </div>
                <div>
                    <div style="color: var(--gold); font-size: 2.5rem; font-family: var(--font-display); font-weight: bold;">200+</div>
                    <div style="color: var(--gray); font-size: 0.9rem;">Employers</div>
                </div>
                <div>
                    <div style="color: var(--gold); font-size: 2.5rem; font-family: var(--font-display); font-weight: bold;">1000+</div>
                    <div style="color: var(--gray); font-size: 0.9rem;">Candidates</div>
                </div>
                <div>
                    <div style="color: var(--gold); font-size: 2.5rem; font-family: var(--font-display); font-weight: bold;">5 Yrs</div>
                    <div style="color: var(--gray); font-size: 0.9rem;">Experience</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section-padding" style="background: var(--white); color: var(--navy);">
    <div class="container">
        <h2 class="section-title">Simple. Fast. Effective.</h2>
        <div class="grid-3">
            <div style="text-align: center;">
                <div style="width: 64px; height: 64px; background: var(--navy-light); color: var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 20px;">1</div>
                <h3>Post Your Job</h3>
                <p style="color: var(--gray-dark);">Submit your requirements in minutes through our secure employer portal.</p>
            </div>
            <div style="text-align: center;">
                <div style="width: 64px; height: 64px; background: var(--navy-light); color: var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 20px;">2</div>
                <h3>We Match Candidates</h3>
                <p style="color: var(--gray-dark);">Our experts screen thousands of profiles to find your perfect match.</p>
            </div>
            <div style="text-align: center;">
                <div style="width: 64px; height: 64px; background: var(--navy-light); color: var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 20px;">3</div>
                <h3>Hire With Confidence</h3>
                <p style="color: var(--gray-dark);">Interview pre-vetted professionals ready to join your team.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section-padding" style="background: var(--navy-mid);">
    <div class="container">
        <h2 class="section-title" style="color: var(--white);">What We Do</h2>
        <div class="grid-3">
            <?php
            $services = [
                ['Permanent Recruitment', 'Finding long-term talent committed to your business growth.'],
                ['Contract Staffing', 'Flexible workforce solutions for your short-term projects.'],
                ['Executive Search', 'Headhunting C-level leaders who can transform your company.'],
                ['HR Consulting', 'Expert advice on UAE labor laws, policies, and structures.'],
                ['Payroll Management', 'Accurate, compliant, and on-time payroll processing.'],
                ['Visa & PRO Services', 'Hassle-free visa processing and government liaison.']
            ];
            foreach ($services as $svc) :
            ?>
            <div style="background: var(--navy); padding: 30px; border-radius: var(--radius); border-top: 4px solid transparent; transition: 0.3s; cursor: pointer;" onmouseover="this.style.borderColor='var(--gold)'" onmouseout="this.style.borderColor='transparent'">
                <h3 style="margin-bottom: 10px;"><?php echo esc_html($svc[0]); ?></h3>
                <p style="color: var(--gray);"><?php echo esc_html($svc[1]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-padding" style="background: var(--gold); color: var(--navy); text-align: center;">
    <div class="container">
        <h2 style="font-family: var(--font-display); font-size: 2.5rem; margin-bottom: 20px;">Ready to Find Your Next Star Employee?</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px;">Join 200+ UAE companies who trust PrimePath for their recruitment needs.</p>
        <a href="<?php echo esc_url( home_url( '/for-employers' ) ); ?>" class="btn" style="background: var(--navy); color: var(--white);">Post a Job Today</a>
    </div>
</section>

<?php get_footer(); ?>
