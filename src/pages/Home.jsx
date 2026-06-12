import { Link } from 'react-router-dom';
import { ArrowRight, CheckCircle2, Globe, FileCheck, HardHat, Compass } from 'lucide-react';
import './Home.css';

const DESTINATIONS = [
  {
    name: 'Poland',
    jobs: 'Warehouse, Food Production, Manufacturing',
    image: 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=500&q=80',
    visaTime: '3-4 Months'
  },
  {
    name: 'Croatia',
    jobs: 'Construction, Hospitality, Agriculture',
    image: 'https://images.unsplash.com/photo-1555992336-03a23c7b20eb?auto=format&fit=crop&w=500&q=80',
    visaTime: '2-3 Months'
  },
  {
    name: 'Romania',
    jobs: 'General Labor, Logistics, Hospitality',
    image: 'https://images.unsplash.com/photo-1568292342316-60aa3d36f4b3?auto=format&fit=crop&w=500&q=80',
    visaTime: '3 Months'
  },
  {
    name: 'UAE & Gulf',
    jobs: 'Security, Retail, F&B, Facilities Management',
    image: 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=500&q=80',
    visaTime: '1 Month'
  }
];

const SECTORS = [
  {
    icon: <HardHat className="solution-icon" size={32} />,
    title: 'Industrial & Construction',
    desc: 'Welders, masons, carpenters, and factory packers for top European and Middle-Eastern infrastructure projects.'
  },
  {
    icon: <Globe className="solution-icon" size={32} />,
    title: 'Hospitality & F&B',
    desc: 'Waiters, chefs, housekeepers, and receptionists for luxury hotel chains, resorts, and restaurants globally.'
  },
  {
    icon: <Compass className="solution-icon" size={32} />,
    title: 'Logistics & Agriculture',
    desc: 'Forklift operators, delivery drivers, warehouse staff, and agricultural pickers with seasonal contracts.'
  }
];

export default function Home() {
  return (
    <div className="home">
      {/* Hero Banner Section */}
      <section className="hero section">
        <div className="container hero-container">
          <div className="hero-content">
            <h1 className="hero-title">Your Trusted Pathway to Global Careers.</h1>
            <p className="hero-subtitle">
              We connect skilled and industrious workers to government-approved employment opportunities across Europe, the Gulf, and East Asia. Legally secure, fully transparent, and professionally managed.
            </p>
            <div className="hero-actions">
              <Link to="/candidates" className="button button-primary">View Active Job Demands</Link>
              <Link to="/employers" className="button button-outline">For International Employers</Link>
            </div>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="stats bg-white border-bottom">
        <div className="container stats-container">
          <div className="stat-card">
            <h2>10,000+</h2>
            <p>Workers Placed</p>
          </div>
          <div className="stat-card">
            <h2>15+</h2>
            <p>Destinations</p>
          </div>
          <div className="stat-card">
            <h2>98%</h2>
            <p>Visa Success Rate</p>
          </div>
          <div className="stat-card">
            <h2>100%</h2>
            <p>Government Approved</p>
          </div>
        </div>
      </section>

      {/* Destinations Section */}
      <section className="destinations section">
        <div className="container">
          <h2 className="section-title text-center">Top Global Destinations</h2>
          <p className="section-subtitle-center text-center">
            Explore the countries currently hiring. We offer complete assistance from selection to departure.
          </p>
          <div className="destinations-grid">
            {DESTINATIONS.map((dest, idx) => (
              <div key={idx} className="dest-card">
                <div className="dest-image">
                  <img src={dest.image} alt={dest.name} />
                  <span className="dest-visa">{dest.visaTime} Processing</span>
                </div>
                <div className="dest-info">
                  <h3>{dest.name}</h3>
                  <p>{dest.jobs}</p>
                  <Link to="/candidates" className="card-link">View Demands <ArrowRight size={16} /></Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Sector Overview Section */}
      <section className="solutions section bg-white">
        <div className="container">
          <h2 className="section-title text-center">Staffing Categories & Sectors</h2>
          <p className="section-subtitle-center text-center">Providing highly motivated, certified, and vetted talent across key global industries.</p>
          <div className="solutions-grid">
            {SECTORS.map((sector, idx) => (
              <div key={idx} className="solution-card">
                {sector.icon}
                <h3>{sector.title}</h3>
                <p>{sector.desc}</p>
                <Link to="/candidates" className="card-link">View Vacancies <ArrowRight size={16} /></Link>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Recruitment Process Section */}
      <section className="methodology section">
        <div className="container">
          <h2 className="section-title text-center">Our Recruitment & Visa Process</h2>
          <p className="section-subtitle-center text-center">We manage every step ethically and transparently to ensure compliance with all labor laws.</p>
          <div className="process-steps">
            <div className="process-step">
              <div className="step-number">01</div>
              <h3>Demand & Sourcing</h3>
              <p>We receive official Demand Letters from verified employers and acquire government permission to recruit.</p>
            </div>
            <div className="process-step">
              <div className="step-number">02</div>
              <h3>Interview & Selection</h3>
              <p>Candidates undergo practical trade testing, background checks, and formal interviews by the employer.</p>
            </div>
            <div className="process-step">
              <div className="step-number">03</div>
              <h3>Visa & Deployment</h3>
              <p>We coordinate medical reports, visa processing, insurance, pre-departure briefings, and flight ticketing.</p>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="cta-section section">
        <div className="container cta-container">
          <h2>Looking for Qualified Workers?</h2>
          <p>Partner with Star HR Agency for bulk staffing, trade testing, and end-to-end recruitment services.</p>
          <Link to="/employers" className="button button-primary">Sponsor a Recruitment Drive</Link>
        </div>
      </section>
    </div>
  );
}
