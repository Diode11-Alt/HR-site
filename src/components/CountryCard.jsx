

export default function CountryCard({ name, code }) {
  return (
    <div style={{
      background: 'white',
      border: '1px solid #e2e8f0',
      borderRadius: '8px',
      padding: '1.5rem',
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      justifyContent: 'center',
      textAlign: 'center',
      gap: '1rem',
      transition: 'all 0.3s ease',
      boxShadow: 'var(--shadow-sm)'
    }}
    onMouseEnter={(e) => { e.currentTarget.style.boxShadow = 'var(--shadow-md)'; e.currentTarget.style.transform = 'translateY(-4px)'; }}
    onMouseLeave={(e) => { e.currentTarget.style.boxShadow = 'var(--shadow-sm)'; e.currentTarget.style.transform = 'translateY(0)'; }}
    >
      <img 
        src={`https://flagcdn.com/w80/${code.toLowerCase()}.png`} 
        alt={`${name} Flag`} 
        style={{ width: '64px', height: 'auto', borderRadius: '4px', boxShadow: '0 2px 4px rgba(0,0,0,0.1)' }} 
      />
      <h4 style={{ margin: 0, fontSize: '1.1rem', color: 'var(--text-primary)' }}>{name}</h4>
    </div>
  );
}
