import { useState } from 'react';
import { Download, FileText, BookOpen, AlertCircle } from 'lucide-react';
import './Page.css';
import './Resources.css';

const RESOURCES = [
  {
    id: 1,
    title: '2026 Executive Compensation & Salary Guide',
    desc: 'Benchmark compensation packages for C-suite, VP, and Director level roles across North American tech and logistics firms.',
    category: 'salary',
    type: 'PDF Guide • 24 Pages',
    icon: <FileText size={24} />
  },
  {
    id: 2,
    title: 'Acing the Behavioral Interview: Guide for Candidates',
    desc: 'Master the STAR method and prepare structural responses for leadership-level behavioral interviews.',
    category: 'guides',
    type: 'Handbook • 12 Pages',
    icon: <BookOpen size={24} />
  },
  {
    id: 3,
    title: 'California & New York Labor Law Compliance Playbook',
    desc: 'A summary of the critical changes in pay transparency, remote work policies, and contractor classification laws for 2026.',
    category: 'compliance',
    type: 'Checklist • 8 Pages',
    icon: <AlertCircle size={24} />
  },
  {
    id: 4,
    title: 'Reducing Employee Turnover: Strategic Retention Playbook',
    desc: 'An actionable roadmap for building professional development paths and retention programs that work.',
    category: 'guides',
    type: 'PDF Playbook • 18 Pages',
    icon: <BookOpen size={24} />
  }
];

export default function Resources() {
  const [activeCategory, setActiveCategory] = useState('all');

  const filteredResources = activeCategory === 'all' 
    ? RESOURCES 
    : RESOURCES.filter(r => r.category === activeCategory);

  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Resource Library</h1>
          <p className="page-subtitle">Expert guides, regulatory playbooks, and compensation reports compiled by our senior consulting advisors.</p>
        </div>
      </header>

      <section className="section bg-white">
        <div className="container">
          {/* Category Filter Buttons */}
          <div className="filter-buttons">
            <button 
              className={`filter-btn ${activeCategory === 'all' ? 'active' : ''}`}
              onClick={() => setActiveCategory('all')}
            >
              All Resources
            </button>
            <button 
              className={`filter-btn ${activeCategory === 'salary' ? 'active' : ''}`}
              onClick={() => setActiveCategory('salary')}
            >
              Salary Guides
            </button>
            <button 
              className={`filter-btn ${activeCategory === 'guides' ? 'active' : ''}`}
              onClick={() => setActiveCategory('guides')}
            >
              Hiring & Interview Guides
            </button>
            <button 
              className={`filter-btn ${activeCategory === 'compliance' ? 'active' : ''}`}
              onClick={() => setActiveCategory('compliance')}
            >
              Compliance Updates
            </button>
          </div>

          {/* Resources Grid */}
          <div className="resources-grid">
            {filteredResources.map((res) => (
              <div key={res.id} className="resource-card">
                <div className="resource-header">
                  <div className="resource-icon-box">{res.icon}</div>
                  <span className="resource-type">{res.type}</span>
                </div>
                <h3>{res.title}</h3>
                <p>{res.desc}</p>
                <div className="resource-footer">
                  <button className="button button-outline download-btn">
                    Download Resource <Download size={16} />
                  </button>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
