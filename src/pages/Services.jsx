import React from 'react';
import { Helmet } from 'react-helmet-async';
import { Briefcase, Building, CheckCircle, Globe2, FileText, Users2, Plane, GraduationCap, Map } from 'lucide-react';

const EMPLOYER_SERVICES = [
  { icon: <Users2 />, name: 'Mass Hiring & Talent Acquisition' },
  { icon: <Globe2 />, name: 'International Recruitment' },
  { icon: <CheckCircle />, name: 'Candidate Screening & Verification' },
  { icon: <Building />, name: 'Interview Coordination' },
  { icon: <FileText />, name: 'Visa & Documentation Support' },
  { icon: <Briefcase />, name: 'End-to-End Recruitment Solutions' },
];

const SEEKER_SERVICES = [
  { icon: <Plane />, name: 'Overseas Job Opportunities' },
  { icon: <GraduationCap />, name: 'Career Guidance & Resume Support' },
  { icon: <Users2 />, name: 'Interview Preparation' },
  { icon: <Building />, name: 'Employer Matching' },
  { icon: <Map />, name: 'Visa Guidance & Deployment' },
];

export default function Services() {
  return (
    <div className="services-page">
      <Helmet>
        <title>Our Services | PrimePath UAE</title>
        <meta name="description" content="Comprehensive international recruitment services for both employers looking for skilled manpower and candidates seeking overseas jobs." />
      </Helmet>

      <section className="section bg-light text-center" style={{ padding: '6rem 0' }}>
        <div className="container">
          <h1 className="hero-title" style={{ color: 'var(--text-primary)' }}>Our Services</h1>
          <p className="hero-subtitle" style={{ margin: '0 auto', maxWidth: '800px', color: 'var(--text-secondary)' }}>
            From turnkey global talent acquisition to executive visa management, we provide highly specialized recruitment solutions engineered for scale.
          </p>
        </div>
      </section>

      <section className="section">
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem' }}>
            
            {/* For Employers */}
            <div style={{ background: '#f8fafc', padding: '3rem', borderRadius: '16px', borderTop: '6px solid var(--text-primary)' }}>
              <h2 style={{ color: 'var(--text-primary)', marginBottom: '2rem' }}>For Employers</h2>
              <p style={{ marginBottom: '2rem' }}>We engineer reliable, scalable, and meticulously vetted manpower pipelines to ensure your international operations thrive without interruption.</p>
              <div style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
                {EMPLOYER_SERVICES.map(s => (
                  <div key={s.name} style={{ display: 'flex', alignItems: 'center', gap: '1rem', background: 'white', padding: '1rem', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
                    <div style={{ color: 'var(--text-primary)' }}>{s.icon}</div>
                    <strong style={{ color: 'var(--text-primary)' }}>{s.name}</strong>
                  </div>
                ))}
              </div>
            </div>

            {/* For Job Seekers */}
            <div style={{ background: '#fef3c7', padding: '3rem', borderRadius: '16px', borderTop: '6px solid var(--accent-color)' }}>
              <h2 style={{ color: 'var(--text-primary)', marginBottom: '2rem' }}>For Job Seekers</h2>
              <p style={{ marginBottom: '2rem' }}>We leverage our exclusive corporate network to place you in high-value overseas roles, backing you with dedicated migration and interview support.</p>
              <div style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
                {SEEKER_SERVICES.map(s => (
                  <div key={s.name} style={{ display: 'flex', alignItems: 'center', gap: '1rem', background: 'white', padding: '1rem', borderRadius: '8px', boxShadow: 'var(--shadow-sm)' }}>
                    <div style={{ color: 'var(--accent-color)' }}>{s.icon}</div>
                    <strong style={{ color: 'var(--text-primary)' }}>{s.name}</strong>
                  </div>
                ))}
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  );
}
