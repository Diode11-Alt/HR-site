import React from 'react';
import { Helmet } from 'react-helmet-async';
import { Target, Eye, Heart, ShieldCheck, Zap, Handshake, Users, Award } from 'lucide-react';

const VALUES = [
  { icon: <ShieldCheck size={32} color="var(--accent-color)" />, name: 'Integrity' },
  { icon: <Eye size={32} color="var(--accent-color)" />, name: 'Transparency' },
  { icon: <Award size={32} color="var(--accent-color)" />, name: 'Professionalism' },
  { icon: <Target size={32} color="var(--accent-color)" />, name: 'Compliance' },
  { icon: <Heart size={32} color="var(--accent-color)" />, name: 'Trust' },
  { icon: <Zap size={32} color="var(--accent-color)" />, name: 'Speed' },
  { icon: <Handshake size={32} color="var(--accent-color)" />, name: 'Long-Term Partnerships' },
  { icon: <Users size={32} color="var(--accent-color)" />, name: 'Candidate Success' },
  { icon: <Award size={32} color="var(--accent-color)" />, name: 'Employer Satisfaction' }
];

export default function About() {
  return (
    <div className="about-page">
      <Helmet>
        <title>About Us | PrimePath UAE</title>
        <meta name="description" content="PrimePath UAE's mission is to connect talented individuals with life-changing international career opportunities while helping employers build reliable workforces." />
      </Helmet>

      <section className="section bg-light" style={{ padding: '6rem 0' }}>
        <div className="container text-center">
          <h1 className="hero-title" style={{ color: 'var(--text-primary)' }}>About PrimePath UAE</h1>
          <p className="hero-subtitle" style={{ margin: '0 auto', maxWidth: '800px', color: 'var(--text-secondary)' }}>
            As a leading international recruitment company in Dubai, we don't just fill vacancies—we architect high-performing global teams and accelerate professional careers.
          </p>
        </div>
      </section>

      <section className="section">
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '4rem' }}>
            <div>
              <h2 style={{ display: 'flex', alignItems: 'center', gap: '1rem', color: 'var(--text-primary)' }}>
                <Target color="var(--accent-color)" size={32} /> Our Mission
              </h2>
              <p style={{ fontSize: '1.2rem', lineHeight: '1.8' }}>
                To bridge the gap between global enterprises and specialized talent, building compliant, highly productive workforces for employers while securing transformative overseas careers for dedicated professionals.
              </p>
            </div>
            <div>
              <h2 style={{ display: 'flex', alignItems: 'center', gap: '1rem', color: 'var(--text-primary)' }}>
                <Eye color="var(--accent-color)" size={32} /> Our Vision
              </h2>
              <p style={{ fontSize: '1.2rem', lineHeight: '1.8' }}>
                To be the definitive recruitment partner in the UAE and beyond—recognized by top-tier employers and elite candidates for our unyielding transparency, strict compliance, and long-term partnership approach.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section className="section bg-light">
        <div className="container">
          <h2 className="section-title text-center">Our Core Values</h2>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '2rem', marginTop: '3rem' }}>
            {VALUES.map(v => (
              <div key={v.name} className="value-card text-center" style={{ background: 'white', padding: '2rem', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
                <div style={{ marginBottom: '1rem' }}>{v.icon}</div>
                <h4 style={{ margin: 0, color: 'var(--text-primary)' }}>{v.name}</h4>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
