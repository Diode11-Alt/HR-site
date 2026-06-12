import { useState } from 'react';
import { Search, MapPin, DollarSign, Clock, Users, Building, Tag } from 'lucide-react';
import { Link } from 'react-router-dom';
import './Page.css';
import './Candidates.css';

const MOCK_DEMANDS = [
  {
    id: 1,
    title: 'Warehouse Packers & General Staff',
    location: 'Poland (Europe)',
    salary: 'PLN 4,000 - 4,800 / Month',
    type: 'Full-Time (2 Year Contract)',
    vacancies: 80,
    benefits: 'Free Accommodation, Transportation & Insurance',
    processingTime: '3-4 Months',
    domain: 'Logistics'
  },
  {
    id: 2,
    title: 'Hospitality Staff (Commis, Waiters & Housekeeping)',
    location: 'Romania (Europe)',
    salary: 'USD 800 - 1,000 / Month',
    type: 'Full-Time (Renewable)',
    vacancies: 45,
    benefits: 'Free Food, Accommodation & Airfare',
    processingTime: '3 Months',
    domain: 'Hospitality'
  },
  {
    id: 3,
    title: 'Scaffolding Carpenters & Masons',
    location: 'Croatia (Europe)',
    salary: 'EUR 900 - 1,100 / Month',
    type: 'Full-Time (Contract)',
    vacancies: 60,
    benefits: 'Accommodation & Medical Coverage provided',
    processingTime: '3 Months',
    domain: 'Construction'
  },
  {
    id: 4,
    title: 'Security Officers (DPS/SIRA)',
    location: 'Dubai, UAE',
    salary: 'AED 2,240 / Month',
    type: 'Full-Time (2 Year Contract)',
    vacancies: 120,
    benefits: 'Free Accommodation, Medical & Duty Transport',
    processingTime: '45 Days',
    domain: 'Security'
  },
  {
    id: 5,
    title: 'Fruit Harvesters & Agricultural Labor',
    location: 'Portugal (Europe)',
    salary: 'EUR 850 - 950 / Month',
    type: 'Seasonal (9 Month Contract)',
    vacancies: 50,
    benefits: 'Shared Accommodation & Local Commute provided',
    processingTime: '3 Months',
    domain: 'Agriculture'
  },
  {
    id: 6,
    title: 'Assistant Nurses & Elderly Caregivers',
    location: 'Germany (Europe)',
    salary: 'EUR 2,200 - 2,600 / Month',
    type: 'Full-Time (Permanent)',
    vacancies: 30,
    benefits: 'Language Training Sponsored, Relocation Allowance',
    processingTime: '6 Months',
    domain: 'Healthcare'
  }
];

const DOMAINS = [
  { id: 'all', label: 'All Sectors' },
  { id: 'Logistics', label: 'Logistics & Warehouse' },
  { id: 'Hospitality', label: 'Hospitality & F&B' },
  { id: 'Construction', label: 'Construction & Civil' },
  { id: 'Security', label: 'Security & Facilities' },
  { id: 'Agriculture', label: 'Agriculture & Farming' },
  { id: 'Healthcare', label: 'Healthcare & Nursing' }
];

export default function Candidates() {
  const [searchTerm, setSearchTerm] = useState('');
  const [activeDomain, setActiveDomain] = useState('all');

  const filteredDemands = MOCK_DEMANDS.filter(demand => {
    const matchesSearch = demand.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          demand.location.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesDomain = activeDomain === 'all' || demand.domain === activeDomain;
    return matchesSearch && matchesDomain;
  });

  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Active Job Vacancies & Demands</h1>
          <p className="page-subtitle">Browse government-approved international recruitment demands. Safe pathways, direct contracts, and verified wages.</p>
        </div>
      </header>

      <section className="section bg-white">
        <div className="container">
          {/* Domain Filter Buttons */}
          <div className="filter-buttons flex-wrap justify-center mb-md">
            {DOMAINS.map(domain => (
              <button 
                key={domain.id}
                className={`filter-btn ${activeDomain === domain.id ? 'active' : ''}`}
                onClick={() => setActiveDomain(domain.id)}
              >
                {domain.label}
              </button>
            ))}
          </div>

          {/* Sourcing Search bar */}
          <div className="search-bar">
            <Search className="search-icon" size={20} />
            <input 
              type="text" 
              placeholder="Search by country, sector, or job title..." 
              className="search-input"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
            <button className="button button-primary">Search Demands</button>
          </div>

          <div className="job-board">
            <div className="job-list">
              {filteredDemands.length > 0 ? (
                filteredDemands.map((demand) => (
                  <div key={demand.id} className="job-card">
                    <div className="job-card-header">
                      <h3>{demand.title}</h3>
                      <div className="demand-header-badges">
                        <span className="domain-pill">
                          <Tag size={12} /> {demand.domain}
                        </span>
                        <div className="demand-qty-badge">
                          <Users size={14} /> {demand.vacancies} Openings
                        </div>
                      </div>
                    </div>
                    <div className="job-details">
                      <div className="job-detail">
                        <MapPin size={16} /> <strong>Destination:</strong> {demand.location}
                      </div>
                      <div className="job-detail highlight">
                        <DollarSign size={16} /> <strong>Salary:</strong> {demand.salary}
                      </div>
                      <div className="job-detail">
                        <Building size={16} /> <strong>Benefits:</strong> {demand.benefits}
                      </div>
                      <div className="job-detail">
                        <Clock size={16} /> <strong>Processing:</strong> {demand.processingTime} • {demand.type}
                      </div>
                    </div>
                    <div className="job-actions">
                      <Link to="/contact" className="button button-primary">Apply Now / Submit CV</Link>
                      <Link to="/portal" className="button button-outline">Track Visa Status</Link>
                    </div>
                  </div>
                ))
              ) : (
                <div className="no-results text-center py-lg bg-light rounded border">
                  <p>No active demands found matching your query. Please contact our main office for details.</p>
                </div>
              )}
            </div>
            
            <aside className="job-sidebar">
              <div className="glass-panel sidebar-panel">
                <h3>Required Application Documents</h3>
                <p>When applying for active demands, please ensure you submit:</p>
                <ul className="feature-list">
                  <li>Original Passport (Minimum 1-year validity)</li>
                  <li>Academic Certificates & Trade Test Records</li>
                  <li>Recent Passport Size Photos (White background)</li>
                  <li>Detailed Curriculum Vitae (CV)</li>
                  <li>Previous work experience certificate scans</li>
                </ul>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </div>
  );
}
