import { Link } from 'react-router-dom';
import { Linkedin, Twitter, Mail, MapPin } from 'lucide-react';
import './Footer.css';

export default function Footer() {
  return (
    <footer className="footer">
      <div className="container footer-grid">
        <div className="footer-brand">
          <Link to="/" className="footer-logo">
            Star<span>HR</span>
          </Link>
          <p className="footer-desc">
            Your premier global recruitment and manpower partner. Empowering workforce mobilization and connecting top talent to international markets since 2021.
          </p>
          <div className="social-links">
            <a href="#" aria-label="LinkedIn"><Linkedin size={20} /></a>
            <a href="#" aria-label="Twitter"><Twitter size={20} /></a>
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
              <Mail size={16} />
              <a href="mailto:hello@ascendhr.com">hello@ascendhr.com</a>
            </li>
            <li>
              <MapPin size={16} />
              <span>1200 Tech Ave, Suite 400<br/>San Francisco, CA 94107</span>
            </li>
          </ul>
        </div>
      </div>
      <div className="footer-bottom">
        <div className="container">
          <p>&copy; {new Date().getFullYear()} Star HR Agency. All rights reserved.</p>
          <div className="legal-links">
            <Link to="/privacy">Privacy Policy</Link>
            <Link to="/terms">Terms of Service</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
