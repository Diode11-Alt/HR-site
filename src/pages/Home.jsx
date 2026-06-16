import React from 'react';
import { Link } from 'react-router-dom';
import { Helmet } from 'react-helmet-async';
import { ArrowRight, CheckCircle2, Shield, FastForward, Globe, Star } from 'lucide-react';
import './Home.css';
import CountryCard from '../components/CountryCard';
import IndustryCard from '../components/IndustryCard';

const COUNTRIES = [
  { name: 'United Arab Emirates (UAE)', code: 'AE' },
  { name: 'Saudi Arabia (KSA)', code: 'SA' },
  { name: 'Bulgaria', code: 'BG' },
  { name: 'Romania', code: 'RO' },
  { name: 'Malta', code: 'MT' },
  { name: 'Greece', code: 'GR' },
  { name: 'Hungary', code: 'HU' },
  { name: 'Slovakia', code: 'SK' },
  { name: 'Croatia', code: 'HR' }
];

const INDUSTRIES = [
  'Construction', 'Hospitality', 'Hotels & Resorts', 'Restaurants',
  'Healthcare', 'Manufacturing', 'Logistics', 'Transportation',
  'Retail', 'Facility Management', 'Security Services', 'Oil & Gas',
  'Engineering', 'Agriculture', 'Domestic Services'
];

export default function Home() {
  return (
    <div className="home">
      <Helmet>
        <title>PrimePath UAE | International Recruitment Company Dubai</title>
        <meta name="description" content="PrimePath UAE connects employers and qualified job seekers through ethical, transparent, and professional recruitment services. Global Recruitment Services in Dubai." />
        <meta name="keywords" content="Recruitment Agency UAE, International Recruitment Company Dubai, Overseas Jobs UAE, Manpower Supply UAE, Hiring Solutions Dubai, Global Recruitment Services" />
      </Helmet>

      {/* Hero Section */}
      <section className="hero section">
        <div className="container hero-container">
          <div className="hero-content text-center" style={{ margin: '0 auto', maxWidth: '800px' }}>
            <h1 className="hero-title">Connecting Elite Talent With Global Opportunities</h1>
            <p className="hero-subtitle">
              PrimePath UAE is a premier international recruitment agency in Dubai, partnering with leading enterprises to build compliant, high-performing workforces while unlocking secure, life-changing overseas jobs for professionals.
            </p>
            <div className="hero-actions" style={{ justifyContent: 'center' }}>
              <Link to="/employers" className="button button-primary">Hire Talent</Link>
              <Link to="/candidates" className="button button-outline" style={{ background: 'white' }}>Find Jobs</Link>
            </div>
          </div>
        </div>
      </section>

      {/* Key Statistics */}
      <section className="stats bg-white border-bottom">
        <div className="container stats-container" style={{ display: 'flex', justifyContent: 'space-around', flexWrap: 'wrap', gap: '2rem' }}>
          <div className="stat-card text-center">
            <h2 style={{ color: 'var(--accent-color)' }}>9+</h2>
            <p>Global Destinations</p>
          </div>
          <div className="stat-card text-center">
            <h2 style={{ color: 'var(--accent-color)' }}>15+</h2>
            <p>Industries Served</p>
          </div>
          <div className="stat-card text-center">
            <h2 style={{ color: 'var(--accent-color)' }}>100%</h2>
            <p>Ethical Recruitment</p>
          </div>
          <div className="stat-card text-center">
            <h2 style={{ color: 'var(--accent-color)' }}>24/7</h2>
            <p>Support</p>
          </div>
        </div>
      </section>

      {/* Why Choose Us */}
      <section className="section bg-light">
        <div className="container">
          <h2 className="section-title text-center">Why Choose PrimePath</h2>
          <p className="section-subtitle-center text-center">We bring excellence to international manpower supply.</p>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '2rem', marginTop: '3rem' }}>
            <div className="solution-card text-center" style={{ padding: '2rem', background: 'white', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
              <Shield size={40} color="var(--accent-color)" style={{ margin: '0 auto 1rem' }} />
              <h3>Ethical & Transparent</h3>
              <p>We adhere to strict international compliance and labor laws.</p>
            </div>
            <div className="solution-card text-center" style={{ padding: '2rem', background: 'white', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
              <Globe size={40} color="var(--accent-color)" style={{ margin: '0 auto 1rem' }} />
              <h3>Global Network</h3>
              <p>Extensive reach across Europe, UAE, and Saudi Arabia.</p>
            </div>
            <div className="solution-card text-center" style={{ padding: '2rem', background: 'white', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
              <FastForward size={40} color="var(--accent-color)" style={{ margin: '0 auto 1rem' }} />
              <h3>Fast Processing</h3>
              <p>Streamlined visa and documentation support for quick deployment.</p>
            </div>
          </div>
        </div>
      </section>

      {/* Countries Served */}
      <section className="section">
        <div className="container">
          <h2 className="section-title text-center">Countries We Recruit For</h2>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem', marginTop: '3rem' }}>
            {COUNTRIES.map(c => <CountryCard key={c.code} name={c.name} code={c.code} />)}
          </div>
        </div>
      </section>

      {/* Industries Served */}
      <section className="section bg-light">
        <div className="container">
          <h2 className="section-title text-center">Industries Served</h2>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem', marginTop: '3rem' }}>
            {INDUSTRIES.map(i => <IndustryCard key={i} title={i} />)}
          </div>
        </div>
      </section>

      {/* Trusted By Banner */}
      <section className="section bg-white" style={{ padding: '4rem 0', borderTop: '1px solid #e2e8f0' }}>
        <div className="container text-center">
          <p style={{ color: 'var(--text-secondary)', fontSize: '0.9rem', textTransform: 'uppercase', letterSpacing: '1px', marginBottom: '2rem' }}>Trusted By Leading Global Enterprises</p>
          <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', flexWrap: 'wrap', gap: '4rem', opacity: 0.6, filter: 'grayscale(100%)' }}>
            <h3 style={{ margin: 0, fontFamily: 'var(--font-heading)', color: 'var(--text-primary)' }}>Census Holdings</h3>
            <h3 style={{ margin: 0, fontFamily: 'var(--font-heading)', color: 'var(--text-primary)' }}>Fortune First</h3>
            <h3 style={{ margin: 0, fontFamily: 'var(--font-heading)', color: 'var(--text-primary)' }}>Global Tech</h3>
            <h3 style={{ margin: 0, fontFamily: 'var(--font-heading)', color: 'var(--text-primary)' }}>BuildCorp UAE</h3>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="cta-section section" style={{ background: 'var(--text-primary)', color: 'white', textAlign: 'center' }}>
        <div className="container cta-container">
          <h2 style={{ color: 'white' }}>Ready to Start Your Journey?</h2>
          <p style={{ color: '#cbd5e1' }}>Whether you are an employer looking for manpower or a candidate seeking overseas opportunities, PrimePath is here to help.</p>
          <div style={{ marginTop: '2rem', display: 'flex', gap: '1rem', justifyContent: 'center' }}>
            <Link to="/contact" className="button button-primary">Contact Us Now</Link>
            <Link to="/services" className="button button-outline" style={{ color: 'white', borderColor: 'white' }}>Explore Services</Link>
          </div>
        </div>
      </section>
    </div>
  );
}
