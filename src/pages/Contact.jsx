import React, { useState } from 'react';
import SEOHead from '../components/SEOHead';
import { Mail, Phone, MapPin } from 'lucide-react';
import './Contact.css';

export default function Contact() {
  const [status, setStatus] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);

    const formData = {
      name: e.target.name.value,
      email: e.target.email.value,
      phone: e.target.phone.value,
      message: e.target.message.value
    };

    try {
      const response = await fetch('/api/contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      
      const result = await response.json();
      setStatus(result.message || 'Inquiry submitted.');
      if (result.status === 'success') {
        e.target.reset();
      }
    } catch (error) {
      console.error(error);
      setStatus('Unable to connect to the server. Please try again later.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <SEOHead 
        title="Contact Us | PrimePath HR"
        description="Contact PrimePath HR for international recruitment inquiries, corporate hiring solutions, and executive search services."
        keywords="Contact PrimePath HR, UAE Recruitment Agency Contact, Dubai Staffing Phone Number"
      />

      <main>
        <section className="section bg-workspace">
          <div className="container">
            <div className="contact-grid" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 'var(--spacing-64)' }}>
              
              <article className="contact-info">
                <h1>Get In Touch</h1>
                <p>
                  Whether you are an enterprise seeking scalable hiring infrastructure or an executive professional pursuing deployment, our team is ready to consult.
                </p>
                
                <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--spacing-32)', marginTop: 'var(--spacing-32)' }}>
                  <div style={{ display: 'flex', alignItems: 'center', gap: 'var(--spacing-16)' }}>
                    <div style={{ padding: 'var(--spacing-16)', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }}>
                      <MapPin color="var(--primary)" />
                    </div>
                    <div>
                      <h2 style={{ margin: 0, fontSize: '18px' }}>Headquarters</h2>
                      <p style={{ margin: 0, fontSize: '14px' }}>Census Holdings Office, Dubai, UAE</p>
                    </div>
                  </div>
                  
                  <div style={{ display: 'flex', alignItems: 'center', gap: 'var(--spacing-16)' }}>
                    <div style={{ padding: 'var(--spacing-16)', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }}>
                      <Phone color="var(--primary)" />
                    </div>
                    <div>
                      <h2 style={{ margin: 0, fontSize: '18px' }}>Phone</h2>
                      <p style={{ margin: 0, fontSize: '14px' }}>
                        <a href="tel:+971543632142" style={{ textDecoration: 'none', color: 'inherit' }}>+971 54 363 2142</a>
                      </p>
                    </div>
                  </div>
                  
                  <div style={{ display: 'flex', alignItems: 'center', gap: 'var(--spacing-16)' }}>
                    <div style={{ padding: 'var(--spacing-16)', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }}>
                      <Mail color="var(--primary)" />
                    </div>
                    <div>
                      <h2 style={{ margin: 0, fontSize: '18px' }}>Email</h2>
                      <p style={{ margin: 0, fontSize: '14px' }}>primepathhrservices@gmail.com</p>
                    </div>
                  </div>
                </div>
              </article>

              <article className="contact-form-container" style={{ background: '#FFFFFF', padding: 'var(--spacing-32)', borderRadius: 'var(--border-radius-md)', border: '1px solid var(--border-light)' }}>
                <h2 style={{ fontSize: '24px', marginBottom: 'var(--spacing-32)' }}>Send Us a Message</h2>
                {status && <div style={{ padding: 'var(--spacing-16)', background: 'var(--bg-workspace)', color: 'var(--primary)', borderRadius: 'var(--border-radius-sm)', marginBottom: 'var(--spacing-16)', border: '1px solid var(--border-light)' }}>{status}</div>}
                
                <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: 'var(--spacing-16)' }}>
                  <div className="form-group">
                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: 600 }}>Full Name</label>
                    <input type="text" name="name" required style={{ width: '100%', padding: '12px', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }} placeholder="Corporate Identifier or Name" />
                  </div>
                  <div className="form-group">
                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: 600 }}>Email Address</label>
                    <input type="email" name="email" required style={{ width: '100%', padding: '12px', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }} placeholder="contact@enterprise.com" />
                  </div>
                  <div className="form-group">
                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: 600 }}>Phone Number</label>
                    <input type="tel" name="phone" required style={{ width: '100%', padding: '12px', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)' }} placeholder="+971..." />
                  </div>
                  <div className="form-group">
                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: 600 }}>Message</label>
                    <textarea name="message" rows="4" required style={{ width: '100%', padding: '12px', border: '1px solid var(--border-light)', borderRadius: 'var(--border-radius-sm)', resize: 'vertical' }} placeholder="Specify your resourcing requirements..."></textarea>
                  </div>
                  <button type="submit" disabled={loading} className={`button button-primary ${loading ? 'skeleton-loading' : 'btn-hover'}`} style={{ width: '100%', marginTop: 'var(--spacing-16)' }}>
                    {loading ? 'Processing...' : 'Submit Inquiry'}
                  </button>
                </form>
              </article>

            </div>
          </div>
        </section>
      </main>
    </>
  );
}
