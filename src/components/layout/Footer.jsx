import { Link } from 'react-router-dom';
import { Linkedin, Facebook, Twitter, Mail, MapPin, Phone } from 'lucide-react';
import './Footer.css';

export default function Footer() {
  return (
    <footer className="footer">
      <div className="container footer-grid">
        <div className="footer-brand">
          <Link to="/" className="footer-logo">
            <img src="/logo.png" alt="PrimePath UAE" style={{ height: '40px', display: 'block', marginBottom: '1rem' }} />
          </Link>
          <p className="footer-desc">
            Your premier global recruitment and manpower partner. Empowering workforce mobilization and connecting top talent to international markets.
          </p>
          <div className="social-links" style={{ display: 'flex', gap: '1rem', marginTop: '1rem' }}>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" style={{ color: 'var(--text-secondary)' }}>
              <Linkedin size={24} />
            </a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" style={{ color: 'var(--text-secondary)' }}>
              <Facebook size={24} />
            </a>
          </div>
        </div>

        <div className="footer-links">
          <h3>Destinations</h3>
          <ul>
            <li><Link to="/candidates">Work in Poland</Link></li>
            <li><Link to="/candidates">Work in Croatia</Link></li>
            <li><Link to="/candidates">Work in Romania</Link></li>
            <li><Link to="/candidates">Work in UAE & Gulf</Link></li>
          </ul>
        </div>

        <div className="footer-links">
          <h3>Candidates</h3>
          <ul>
            <li><Link to="/candidates">Active Vacancies</Link></li>
            <li><Link to="/portal">Visa Tracker</Link></li>
            <li><Link to="/resources">Salary Benchmark</Link></li>
            <li><Link to="/about">Legal Documents</Link></li>
          </ul>
        </div>

        <div className="footer-contact">
          <h3>Contact</h3>
          <ul>
            <li>
              <Phone size={16} />
              <a href="tel:+971543632142">+971 54 363 2142</a>
            </li>
            <li>
              <Mail size={16} />
              <a href="mailto:primepathhrservices@gmail.com">primepathhrservices@gmail.com</a>
            </li>
            <li>
              <MapPin size={16} />
              <span>Census Holdings Office<br/>Dubai, United Arab Emirates</span>
            </li>
          </ul>
        </div>
      </div>
      <div className="footer-bottom">
        <div className="container">
          <p>&copy; {new Date().getFullYear()} PrimePath UAE. All rights reserved.</p>
          <div className="legal-links">
            <Link to="/privacy">Privacy Policy</Link>
            <Link to="/terms">Terms of Service</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
