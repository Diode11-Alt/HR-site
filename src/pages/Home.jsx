
import { Link } from 'react-router-dom';
import SEOHead from '../components/SEOHead';


export default function Home() {
  return (
    <>
      <SEOHead 
        title="PrimePath HR | Premier Talent Acquisition & Executive Search Dubai"
        description="PrimePath HR connects market-leading organizations with top-tier professional talent. Discover bespoke corporate staffing solutions and executive search services across the UAE."
        keywords="PrimePath HR Recruitment, Staffing Solutions, Talent Acquisition Agency UAE, Executive Search"
      />
      <main>
        {/* Hero Section */}
        <section className="section bg-light" style={{ padding: 'var(--spacing-64) 0' }}>
          <div className="container" style={{ textAlign: 'center', maxWidth: '800px' }}>
            <h1>Strategic Talent Acquisition for Enterprise Scalability</h1>
            <p>
              In high-growth commercial markets, organizational success is dictated by workforce capability. PrimePath HR serves as a premier talent acquisition agency, engineering strategic corporate deployment pathways that connect executive professionals with market-leading enterprises across the United Arab Emirates.
            </p>
            <div style={{ marginTop: 'var(--spacing-32)', display: 'flex', gap: 'var(--spacing-16)', justifyContent: 'center' }}>
              <Link to="/employers" className="button button-primary btn-hover">Hire Talent</Link>
              <Link to="/candidates" className="button button-outline btn-hover">Find Jobs</Link>
            </div>
          </div>
        </section>

        {/* Trusted By Banner */}
        <section className="section bg-white" style={{ borderBottom: '1px solid var(--border-light)', padding: 'var(--spacing-32) 0' }}>
          <div className="container text-center">
            <p style={{ color: 'var(--text-secondary)', fontSize: '14px', textTransform: 'uppercase', letterSpacing: '1px', marginBottom: 'var(--spacing-16)' }}>Trusted By Leading Global Enterprises</p>
            <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', flexWrap: 'wrap', gap: 'var(--spacing-64)', opacity: 0.6, filter: 'grayscale(100%)' }}>
              <span style={{ fontSize: '24px', fontWeight: '700', color: 'var(--primary)' }}>Census Holdings</span>
              <span style={{ fontSize: '24px', fontWeight: '700', color: 'var(--primary)' }}>Fortune First</span>
              <span style={{ fontSize: '24px', fontWeight: '700', color: 'var(--primary)' }}>Global Tech</span>
              <span style={{ fontSize: '24px', fontWeight: '700', color: 'var(--primary)' }}>BuildCorp UAE</span>
            </div>
          </div>
        </section>

        {/* Core Services */}
        <section className="section bg-white">
          <div className="container">
            <h2 style={{ textAlign: 'center' }}>End-to-End Human Resource Consulting Services</h2>
            
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: 'var(--spacing-32)', marginTop: 'var(--spacing-64)' }}>
              <article style={{ padding: 'var(--spacing-32)', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-md)' }}>
                <h3>Executive Search & Leadership Placement</h3>
                <p>
                  Our consultative headhunting framework leverages deep industry intelligence to secure specialized leadership talent capable of driving corporate innovation.
                </p>
              </article>
              <article style={{ padding: 'var(--spacing-32)', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-md)' }}>
                <h3>Workforce Management & Permanent Recruitment</h3>
                <p>
                  From agile temporary staffing initiatives to permanent resource expansion, we deliver rigorous candidate screening procedures that ensure comprehensive cultural alignment and optimal operational performance.
                </p>
              </article>
            </div>
          </div>
        </section>

      </main>
    </>
  );
}
