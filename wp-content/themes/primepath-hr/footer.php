<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>PrimePath</h4>
                <p style="color: var(--gray); font-size: 0.9rem;">The UAE's Premier HR & Recruitment Agency.</p>
            </div>
            
            <div>
                <h4>Quick Links</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'fallback_cb'    => false,
                ) );
                ?>
            </div>
            
            <div>
                <h4>Portals</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/employer-portal' ) ); ?>">Employer Login</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/candidate-portal' ) ); ?>">Candidate Login</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/register' ) ); ?>">Register Account</a></li>
                </ul>
            </div>
            
            <div>
                <h4>Contact</h4>
                <ul style="color: var(--gray); font-size: 0.9rem;">
                    <li>Email: contact@primepathuae.com</li>
                    <li>Phone: +971 4 123 4567</li>
                    <li>Dubai, UAE</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            &copy; <?php echo date('Y'); ?> PrimePath UAE. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
