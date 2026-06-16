import React from 'react';
import { Briefcase, Building2 } from 'lucide-react';

export default function IndustryCard({ title }) {
  return (
    <div style={{
      background: 'white',
      border: '1px solid #e2e8f0',
      borderRadius: '8px',
      padding: '1.5rem',
      display: 'flex',
      alignItems: 'center',
      gap: '1rem',
      transition: 'all 0.3s ease',
      cursor: 'pointer',
      boxShadow: 'var(--shadow-sm)'
    }}
    onMouseEnter={(e) => { e.currentTarget.style.borderColor = 'var(--accent-color)'; e.currentTarget.style.transform = 'translateY(-2px)'; }}
    onMouseLeave={(e) => { e.currentTarget.style.borderColor = '#e2e8f0'; e.currentTarget.style.transform = 'translateY(0)'; }}
    >
      <div style={{ background: 'var(--accent-light)', padding: '0.5rem', borderRadius: '4px' }}>
        <Building2 color="var(--accent-color)" size={24} />
      </div>
      <h4 style={{ margin: 0, fontSize: '1.1rem', color: 'var(--text-primary)' }}>{title}</h4>
    </div>
  );
}
