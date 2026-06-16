import './Page.css';

export default function Terms() {
  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Terms of Service</h1>
          <p className="page-subtitle">Last updated: June 12, 2026</p>
        </div>
      </header>

      <section className="section bg-white">
        <div className="container" style={{ maxWidth: '800px' }}>
          <h2>1. Acceptable Use</h2>
          <p>By accessing the PrimePath UAE portal and candidate job board, you agree to submit only accurate, truthful, and non-deceptive employment history, resume data, and contact information.</p>

          <h2>2. Relationship of Parties</h2>
          <p>Submitting an application through this site does not constitute an offer of employment or establish an employer-employee relationship between you and PrimePath UAE. We act strictly as an advisory intermediary and recruiting partner for our corporate clients.</p>

          <h2>3. Disclaimers</h2>
          <p>While we make every effort to verify job postings and client transparency, we are not responsible for final employment contract terms, workplace environments, or employer decisions.</p>

          <h2>4. Governing Law</h2>
          <p>These terms are governed by the laws of the State of California, without regard to its conflict of law principles.</p>
        </div>
      </section>
    </div>
  );
}
