import React, { useState } from 'react';
import { Helmet } from 'react-helmet-async';
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
    <div className="contact-page">
      <Helmet>
        <title>Contact Us | PrimePath UAE</title>
        <meta name="description" content="Contact PrimePath UAE for international recruitment inquiries, manpower supply, and overseas job assistance." />
      </Helmet>

      <section className="section bg-light">
        <div className="container">
          <div className="contact-grid" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4rem' }}>
            <div className="contact-info">
              <h1 style={{ color: 'var(--text-primary)' }}>Get In Touch</h1>
              <p style={{ marginBottom: '2rem' }}>Whether you're an employer looking to hire or a candidate seeking opportunities, our team is ready to assist you.</p>
              
              <div style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem', marginBottom: '3rem' }}>
                <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                  <div style={{ background: 'var(--accent-light)', padding: '1rem', borderRadius: '50%' }}>
                    <MapPin color="var(--accent-color)" />
                  </div>
                  <div>
                    <h4 style={{ margin: 0 }}>Headquarters</h4>
                    <p style={{ margin: 0 }}>Census Holdings Office, Dubai, UAE</p>
                  </div>
                </div>
                <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                  <div style={{ background: 'var(--accent-light)', padding: '1rem', borderRadius: '50%' }}>
                    <Phone color="var(--accent-color)" />
                  </div>
                  <div>
                    <h4 style={{ margin: 0 }}>Phone</h4>
                    <p style={{ margin: 0 }}><a href="tel:+971543632142" style={{textDecoration: 'none', color: 'inherit'}}>+971 54 363 2142</a></p>
                  </div>
                </div>
                <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                  <div style={{ background: 'var(--accent-light)', padding: '1rem', borderRadius: '50%' }}>
                    <Mail color="var(--accent-color)" />
                  </div>
                  <div>
                    <h4 style={{ margin: 0 }}>Email</h4>
                    <p style={{ margin: 0 }}>info@primepathuae.com</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="contact-form-container" style={{ background: 'white', padding: '3rem', borderRadius: '16px', boxShadow: 'var(--shadow-lg)' }}>
              <h2 style={{ marginBottom: '2rem' }}>Send Us a Message</h2>
              {status && <div style={{ padding: '1rem', background: '#dcfce7', color: '#16a34a', borderRadius: '8px', marginBottom: '1rem' }}>{status}</div>}
              
              <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
                <div className="form-group">
                  <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500 }}>Full Name</label>
                  <input type="text" name="name" required style={{ width: '100%', padding: '0.8rem', border: '1px solid #cbd5e1', borderRadius: '4px' }} placeholder="Your Name" />
                </div>
                <div className="form-group">
                  <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500 }}>Email Address</label>
                  <input type="email" name="email" required style={{ width: '100%', padding: '0.8rem', border: '1px solid #cbd5e1', borderRadius: '4px' }} placeholder="you@example.com" />
                </div>
                <div className="form-group">
                  <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500 }}>Phone Number</label>
                  <input type="tel" name="phone" required style={{ width: '100%', padding: '0.8rem', border: '1px solid #cbd5e1', borderRadius: '4px' }} placeholder="+971..." />
                </div>
                <div className="form-group">
                  <label style={{ display: 'block', marginBottom: '0.5rem', fontWeight: 500 }}>Message</label>
                  <textarea name="message" rows="4" required style={{ width: '100%', padding: '0.8rem', border: '1px solid #cbd5e1', borderRadius: '4px', resize: 'vertical' }} placeholder="How can we help you?"></textarea>
                </div>
                <button type="submit" disabled={loading} className="button button-primary" style={{ width: '100%' }}>{loading ? 'Submitting...' : 'Submit Inquiry'}</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
