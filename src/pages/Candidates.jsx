import React from 'react';
import { Link } from 'react-router-dom';
import SEOHead from '../components/SEOHead';

export default function Candidates() {
  return (
    <>
      <SEOHead 
        title="Exclusive Employment Opportunities & Career Portal | PrimePath HR"
        description="Accelerate your career path in the Middle East. Submit your resume to the PrimePath HR job portal and secure placements with leading organizations."
        keywords="Employment Opportunities UAE, Job Portal Dubai, Active Recruitment, Resume Submission"
      />
      <main>
        <section className="section" style={{ background: 'var(--primary)', color: 'white', padding: 'var(--spacing-64) 0' }}>
          <div className="container" style={{ textAlign: 'center', maxWidth: '800px' }}>
            <h1 style={{ color: 'white' }}>Empowering Your Corporate Career Progression</h1>
            <p style={{ color: 'var(--bg-workspace)' }}>
              Access targeted international career development. PrimePath HR provides professional candidates with unlisted employment opportunities across specialized economic sectors within the Middle Eastern market.
            </p>
            <div style={{ marginTop: 'var(--spacing-32)' }}>
              <Link to="/contact" className="button button-primary btn-hover">Submit Resume</Link>
            </div>
          </div>
        </section>

        <section className="section bg-white">
          <div className="container">
            <h2 style={{ textAlign: 'center' }}>Dedicated Career Asset Synchronization</h2>
            <p style={{ textAlign: 'center', margin: '0 auto var(--spacing-64) auto', maxWidth: '800px' }}>
              We offer transparent representation to ensure your professional profile is positioned accurately before decision-makers at target enterprises.
            </p>

            <article style={{ padding: 'var(--spacing-32)', background: 'var(--bg-workspace)', borderRadius: 'var(--border-radius-md)', border: '1px solid var(--border-light)' }}>
              <h3>Real-Time Application Tracking Integration</h3>
              <p>
                Utilize our dedicated digital ecosystem to handle your resume submissions securely. Monitor the progression of live corporate selections, track interview itineraries, and check your deployment documentation steps seamlessly.
              </p>
            </article>
          </div>
        </section>
      </main>
    </>
  );
}
