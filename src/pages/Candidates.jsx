import React from 'react';
import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router-dom';
import { Plane, GraduationCap, Map, Users } from 'lucide-react';

export default function Candidates() {
  return (
    <div className="candidates-page">
      <Helmet>
        <title>For Job Seekers | Overseas Jobs | PrimePath UAE</title>
        <meta name="description" content="PrimePath UAE helps candidates secure overseas employment opportunities with professional guidance, visa support, and precise employer matching." />
      </Helmet>

      <section className="section bg-light text-center" style={{ padding: '6rem 0', background: 'var(--text-primary)', color: 'white' }}>
        <div className="container">
          <h1 className="hero-title" style={{ color: 'white' }}>Unlock Exclusive Overseas Jobs in the UAE & Europe</h1>
          <p className="hero-subtitle" style={{ margin: '0 auto', maxWidth: '800px', color: '#cbd5e1' }}>
            We don’t just find you a job—we orchestrate your entire international career. Secure verified overseas employment opportunities with total transparency and zero hidden fees.
          </p>
        </div>
      </section>

      <section className="section">
        <div className="container" style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '2rem' }}>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Plane size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Verified Overseas Contracts</h3>
            <p>Gain direct access to exclusive, government-approved overseas jobs in the UAE, Saudi Arabia, and thriving European markets.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Users size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Precision Career Matching</h3>
            <p>You are more than a resume. We actively advocate for your specific skills, matching you directly with elite global employers who value your expertise.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <GraduationCap size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Executive Interview Coaching</h3>
            <p>Walk into your interview with total confidence. Receive comprehensive resume optimization and targeted coaching from our recruitment veterans.</p>
          </div>
          <div style={{ padding: '2rem', background: 'white', borderRadius: '8px', border: '1px solid #e2e8f0', boxShadow: 'var(--shadow-sm)' }}>
            <Map size={40} color="var(--accent-color)" style={{ marginBottom: '1rem' }} />
            <h3>Stress-Free Visa Processing</h3>
            <p>Forget the bureaucratic nightmare. Our dedicated migration team manages your entire deployment journey—from complex visa documentation to final flight ticketing.</p>
          </div>
        </div>
      </section>

      <section className="section bg-light text-center">
        <div className="container">
          <h2>Ready for Your Next Big Move?</h2>
          <p style={{ margin: '1rem auto 2rem', maxWidth: '600px' }}>Register with us today to start applying for jobs globally.</p>
          <Link to="/portal" className="button button-primary" style={{ padding: '1rem 3rem', fontSize: '1.2rem' }}>Apply for Opportunities</Link>
        </div>
      </section>
    </div>
  );
}
