import React from 'react';
import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router-dom';
import { Building2, Users2, ShieldCheck, Zap } from 'lucide-react';

export default function Employers() {
  return (
    <div className="employers-page">
      <Helmet>
        <title>For Employers | Recruitment Solutions | PrimePath UAE</title>
        <meta name="description" content="Partner with PrimePath UAE for reliable workforce solutions, skilled manpower, and fast international recruitment processing." />
      </Helmet>

      <section className="section bg-light text-center" style={{ padding: '6rem 0' }}>
        <div className="container">
          <h1 className="hero-title" style={{ color: 'var(--text-primary)' }}>Enterprise-Grade Manpower Supply UAE</h1>
          <p className="hero-subtitle" style={{ margin: '0 auto', maxWidth: '800px', color: 'var(--text-secondary)' }}>
            Access a vast pool of vetted, skilled manpower. PrimePath UAE delivers rapid, compliant hiring solutions in Dubai to mobilize your workforce at scale.
          </p>
        </div>
      </section>

      <section className="section">
        <div className="container" style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '2rem' }}>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Users2 size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Zero-Risk Workforce Mobilization</h3>
            <p>We don't just forward resumes. We meticulously vet and supply dedicated professionals who are strictly evaluated to scale your operations.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Building2 size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Unrestricted Talent Access</h3>
            <p>Tap into an elite global database of certified manpower across 15+ complex industries, from heavy construction to specialized healthcare.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Zap size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Rapid Deployment Cycles</h3>
            <p>Time is revenue. Our agile hiring solutions cut through bureaucratic red tape to deliver the exact talent you need, exactly when the project demands it.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <ShieldCheck size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>End-to-End Compliance Management</h3>
            <p>Navigating international labor laws is high-risk. Our experts handle every visa, medical check, and contract, ensuring a 100% legally secure recruitment drive.</p>
          </div>
        </div>
      </section>

      <section className="section bg-white text-center">
        <div className="container">
          <h2>Ready to Build Your Team?</h2>
          <p style={{ margin: '1rem auto 2rem', maxWidth: '600px' }}>Contact our international recruitment specialists today to discuss your customized staffing solutions.</p>
          <Link to="/contact" className="button button-primary" style={{ padding: '1rem 3rem', fontSize: '1.2rem' }}>Request Recruitment Partnership</Link>
        </div>
      </section>
    </div>
  );
}
