import { useState } from 'react';
import { Helmet } from 'react-helmet-async';
import { Lock, UserCircle } from 'lucide-react';
import './Page.css';

export default function Portal() {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleLogin = (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');
    
    // Simulate login attempt then show "Coming Soon" or generic error
    setTimeout(() => {
      setLoading(false);
      setError('The Candidate Portal is currently undergoing scheduled maintenance. Please check back later or contact support.');
    }, 1500);
  };

  return (
    <div className="portal-page">
      <Helmet>
        <title>Candidate Portal | PrimePath UAE</title>
        <meta name="description" content="Secure login portal for PrimePath UAE candidates." />
      </Helmet>

      <section className="section bg-light" style={{ minHeight: '80vh', display: 'flex', alignItems: 'center' }}>
        <div className="container" style={{ maxWidth: '500px', margin: '0 auto' }}>
          
          <div style={{ background: 'white', padding: '3rem', borderRadius: '16px', boxShadow: 'var(--shadow-lg)', textAlign: 'center' }}>
            <div style={{ background: 'var(--accent-light)', width: '80px', height: '80px', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center', margin: '0 auto 2rem' }}>
              <Lock size={40} color="var(--accent-color)" />
            </div>
            
            <h2 style={{ color: 'var(--text-primary)', marginBottom: '0.5rem' }}>Candidate Portal</h2>
            <p style={{ color: 'var(--text-secondary)', marginBottom: '2rem' }}>Log in to track your visa and application status.</p>

            {error && (
              <div style={{ padding: '1rem', background: '#fee2e2', color: '#991b1b', borderRadius: '8px', marginBottom: '2rem', fontSize: '0.95rem' }}>
                {error}
              </div>
            )}

            <form onSubmit={handleLogin} style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem', textAlign: 'left' }}>
              <div>
                <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500, color: 'var(--text-primary)' }}>Candidate ID</label>
                <div style={{ position: 'relative' }}>
                  <UserCircle size={20} color="#cbd5e1" style={{ position: 'absolute', left: '12px', top: '50%', transform: 'translateY(-50%)' }} />
                  <input 
                    type="text" 
                    required 
                    placeholder="e.g. PP-2026-XXXX" 
                    style={{ width: '100%', padding: '0.8rem 0.8rem 0.8rem 2.5rem', border: '1px solid #cbd5e1', borderRadius: '4px', boxSizing: 'border-box' }}
                  />
                </div>
              </div>

              <div>
                <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500, color: 'var(--text-primary)' }}>Password / Passport Number</label>
                <div style={{ position: 'relative' }}>
                  <Lock size={20} color="#cbd5e1" style={{ position: 'absolute', left: '12px', top: '50%', transform: 'translateY(-50%)' }} />
                  <input 
                    type="password" 
                    required 
                    placeholder="Enter your password" 
                    style={{ width: '100%', padding: '0.8rem 0.8rem 0.8rem 2.5rem', border: '1px solid #cbd5e1', borderRadius: '4px', boxSizing: 'border-box' }}
                  />
                </div>
              </div>

              <button 
                type="submit" 
                disabled={loading}
                className="button button-primary" 
                style={{ width: '100%', marginTop: '1rem', display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '0.5rem' }}
              >
                {loading ? 'Authenticating...' : 'Secure Login'}
              </button>
            </form>

            <div style={{ marginTop: '2rem', paddingTop: '2rem', borderTop: '1px solid #e2e8f0', color: 'var(--text-secondary)', fontSize: '0.9rem' }}>
              Don't have an account? <br/> Contact your recruitment manager for access.
            </div>
          </div>

        </div>
      </section>
    </div>
  );
}
