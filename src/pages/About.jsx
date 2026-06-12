import { Link } from 'react-router-dom';
import { Shield, Target, Award, Heart } from 'lucide-react';
import './Page.css';
import './About.css';

const VALUES = [
  {
    icon: <Shield size={32} />,
    title: 'Absolute Integrity',
    desc: 'Transparent salary disclosures, honest feedback, and ethical consulting practice is our default state.'
  },
  {
    icon: <Target size={32} />,
    title: 'Precision Matching',
    desc: 'We look beyond the resume keywords. We map for behavioral alignment, culture fit, and long-term retention.'
  },
  {
    icon: <Award size={32} />,
    title: 'Excellence in Action',
    desc: 'Our rigorous screening protocols ensure you only meet candidates who are ready and highly capable.'
  },
  {
    icon: <Heart size={32} />,
    title: 'People First',
    desc: 'Businesses are built by human beings. We honor and respect both sides of the hiring equation.'
  }
];

const TEAM = [
  {
    name: 'Sarah Jenkins',
    role: 'Managing Partner & Executive Search',
    image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'
  },
  {
    name: 'David Kojo',
    role: 'Principal HR Consultant',
    image: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80'
  },
  {
    name: 'Elena Rostova',
    role: 'Director of Talent Acquisition',
    image: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80'
  }
];

export default function About() {
  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Bridging Human Potential & Business Excellence</h1>
          <p className="page-subtitle">We are a boutique human resources consultancy built on trust, transparency, and data-driven recruiting solutions.</p>
        </div>
      </header>

      {/* Story Section */}
      <section className="section bg-white">
        <div className="container">
          <div className="content-grid">
            <div className="content-text">
              <h2>Our Story</h2>
              <p>Founded in 2021, Ascend HR arose from a simple observation: traditional recruiting was broken. High-volume agencies treated human beings like commodities, and compliance-only consultants failed to understand business growth dynamics.</p>
              <p>We built Ascend HR to offer a high-touch, consultative alternative. We partner with growing enterprises to build tailored recruitment machines, secure tier-one executive leadership, and implement clean, bulletproof compliance frameworks.</p>
            </div>
            <div className="content-image">
              <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Team collaborating in a modern office" />
            </div>
          </div>
        </div>
      </section>

      {/* Values Section */}
      <section className="section">
        <div className="container">
          <h2 className="section-title text-center">Our Core Values</h2>
          <div className="values-grid">
            {VALUES.map((val, idx) => (
              <div key={idx} className="value-card">
                <div className="value-icon">{val.icon}</div>
                <h3>{val.title}</h3>
                <p>{val.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Team Section */}
      <section className="section bg-white">
        <div className="container">
          <h2 className="section-title text-center">Meet the Leadership</h2>
          <div className="team-grid">
            {TEAM.map((member, idx) => (
              <div key={idx} className="team-card">
                <div className="team-image">
                  <img src={member.image} alt={member.name} />
                </div>
                <div className="team-info">
                  <h3>{member.name}</h3>
                  <span className="team-role">{member.role}</span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="cta-section section">
        <div className="container cta-container">
          <h2>Partner with us today.</h2>
          <p>Get in touch to learn more about our fractional HR advisory and executive search plans.</p>
          <Link to="/contact" className="button button-primary">Contact Our Advisors</Link>
        </div>
      </section>
    </div>
  );
}
