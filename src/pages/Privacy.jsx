import './Page.css';

export default function Privacy() {
  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Privacy Policy</h1>
          <p className="page-subtitle">Last updated: June 12, 2026</p>
        </div>
      </header>

      <section className="section bg-white">
        <div className="container" style={{ maxWidth: '800px' }}>
          <h2>1. Information We Collect</h2>
          <p>We collect information you provide directly to us when submitting contact inquiries, applying for jobs on our candidates board, or using the candidate tracking portal. This includes name, email, phone number, resume, employment history, and company details.</p>

          <h2>2. How We Use Your Information</h2>
          <p>We use the collected data to coordinate job placements, evaluate applicant suitability, facilitate communication with employer organizations, and provide strategic fractional HR consulting services.</p>

          <h2>3. Data Security & Sharing</h2>
          <p>Your resume and personal details are never shared with any employer without your explicit, written consent. We implement top-tier encryption and access controls to secure candidate data databases.</p>

          <h2>4. Your Rights</h2>
          <p>You can request to update, purge, or retrieve your profile data at any time by contacting our privacy compliance team at <a href="mailto:primepathhrservices@gmail.com">primepathhrservices@gmail.com</a>.</p>
        </div>
      </section>
    </div>
  );
}
