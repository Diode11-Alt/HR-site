
import { Link } from 'react-router-dom';
import SEOHead from '../components/SEOHead';

export default function Employers() {
  return (
    <>
      <SEOHead 
        title="Corporate Hiring Solutions & Workforce Management | PrimePath HR"
        description="Maximize operational output with customized human resource consulting from PrimePath HR. We manage the full recruitment lifecycle for your business."
        keywords="Corporate Hiring Solutions, Workforce Scalability, Recruitment Lifecycle, Recruitment Process Outsourcing"
      />
      <main>
        <section className="section" style={{ background: 'var(--primary)', color: 'white', padding: 'var(--spacing-64) 0' }}>
          <div className="container" style={{ textAlign: 'center', maxWidth: '800px' }}>
            <h1 style={{ color: 'white' }}>Enterprise Hiring Infrastructure Built for Growth</h1>
            <p style={{ color: 'var(--bg-workspace)' }}>
              Mitigate the complexities of talent discovery. PrimePath HR delivers end-to-end corporate hiring solutions designed to optimize your recruitment lifecycle, minimize time-to-hire metrics, and elevate workforce retention rates.
            </p>
            <div style={{ marginTop: 'var(--spacing-32)' }}>
              <Link to="/contact" className="button button-primary btn-hover">Partner With Us</Link>
            </div>
          </div>
        </section>

        <section className="section bg-white">
          <div className="container">
            <h2 style={{ textAlign: 'center' }}>Data-Driven Selection Methods</h2>
            <p style={{ textAlign: 'center', margin: '0 auto var(--spacing-64) auto', maxWidth: '800px' }}>
              We function as a direct extension of your internal human resource operations. By combining extensive candidate evaluation methods with advanced parsing logic, we ensure your vacancy pipeline receives elite, pre-screened talent across specialized domains.
            </p>

            <article style={{ padding: 'var(--spacing-32)', background: 'var(--bg-workspace)', borderRadius: 'var(--border-radius-md)', border: '1px solid var(--border-light)' }}>
              <h3>Automated Talent Management Architecture</h3>
              <p>
                Enterprise clients gain access to our custom digital portal interfaces. Streamline applicant evaluations, access comprehensive verified assessment data, and monitor candidate visa processing updates via a centralized dashboard.
              </p>
            </article>
          </div>
        </section>
      </main>
    </>
  );
}
