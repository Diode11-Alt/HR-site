import { Link } from 'react-router-dom';
import { CheckCircle2 } from 'lucide-react';
import './Page.css';

export default function Employers() {
  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">International Manpower Sourcing</h1>
          <p className="page-subtitle">We partner with global employers to source, test, and mobilize qualified personnel at scale.</p>
        </div>
      </header>

      {/* Bulk Sourcing */}
      <section className="section bg-white">
        <div className="container">
          <div className="content-grid">
            <div className="content-text">
              <h2>Bulk Recruitment & Sourcing</h2>
              <p>We maintain an active candidate database of over 50,000 skilled and semi-skilled profiles across various industrial fields. Our local mobilization network allows us to recruit hundreds of candidates within short deadlines.</p>
              <ul className="feature-list">
                <li><CheckCircle2 size={20} className="icon-accent" /> Targeted recruitment drives in major hubs</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Rigorous pre-screening & reference verifications</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Complete handling of local advertising and approvals</li>
              </ul>
            </div>
            <div className="content-image">
              <img src="https://images.unsplash.com/photo-1521737711867-e3b90478788a?auto=format&fit=crop&w=800&q=80" alt="Recruiters conducting candidate screening" />
            </div>
          </div>
        </div>
      </section>

      {/* Trade Testing */}
      <section className="section">
        <div className="container">
          <div className="content-grid reverse">
            <div className="content-text">
              <h2>Trade Testing & Skill Verification</h2>
              <p>We ensure that candidates hold the precise capabilities required for your projects. In partnership with technical institutes, we conduct practical trade testing matching European and Middle-Eastern benchmarks.</p>
              <ul className="feature-list">
                <li><CheckCircle2 size={20} className="icon-accent" /> Practical trade evaluation (welding, electrical, plumbing)</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Language proficiency & basic English training</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Pre-departure hospitality and safety bootcamps</li>
              </ul>
            </div>
            <div className="content-image">
              <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80" alt="Skills verification and trade testing evaluation" />
            </div>
          </div>
        </div>
      </section>

      {/* End-to-end mobilization */}
      <section className="section bg-white">
        <div className="container">
          <div className="content-grid">
            <div className="content-text">
              <h2>Compliance & Mobilization</h2>
              <p>Visa processing and international mobilization require meticulous paperwork. We handle all legalities under local and host-country regulations to ensure hassle-free deployment.</p>
              <ul className="feature-list">
                <li><CheckCircle2 size={20} className="icon-accent" /> Acquiring government permissions & labor clearances</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Embassy coordination & visa application submissions</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Mandatory medical screenings & insurance coverages</li>
                <li><CheckCircle2 size={20} className="icon-accent" /> Pre-departure orientation briefings & flight ticketing</li>
              </ul>
            </div>
            <div className="content-image">
              <img src="https://images.unsplash.com/photo-1449034446853-66c86144b0ad?auto=format&fit=crop&w=800&q=80" alt="Sourcing operations overview" />
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="cta-section section">
        <div className="container cta-container">
          <h2>Need a Reliable Manpower Partner?</h2>
          <p>Sponsor a recruitment drive with us. Send us your manpower demand letter today.</p>
          <Link to="/contact" className="button button-primary">Contact Sourcing Officers</Link>
        </div>
      </section>
    </div>
  );
}
