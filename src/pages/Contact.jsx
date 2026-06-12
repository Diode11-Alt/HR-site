import { useState } from 'react';
import { Mail, Phone, MapPin, Send, CheckCircle } from 'lucide-react';
import './Page.css';
import './Contact.css';

export default function Contact() {
  const [formState, setFormState] = useState({
    name: '',
    email: '',
    company: '',
    service: 'recruiting',
    message: ''
  });
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    // Simulate API call
    setTimeout(() => {
      setSubmitted(true);
    }, 500);
  };

  const handleChange = (e) => {
    setFormState({
      ...formState,
      [e.target.name]: e.target.value
    });
  };

  return (
    <div className="page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Let's Align Your People Strategy</h1>
          <p className="page-subtitle">Schedule a consultation or ask us a question. We typically respond within 1 business day.</p>
        </div>
      </header>

      <section className="section bg-white">
        <div className="container">
          <div className="contact-grid">
            <div className="contact-form-container">
              {submitted ? (
                <div className="submission-success">
                  <CheckCircle size={64} className="success-icon" />
                  <h2>Message Received!</h2>
                  <p>Thank you for reaching out. An Ascend HR advisory consultant will review your information and contact you within 24 hours.</p>
                  <button 
                    onClick={() => {
                      setSubmitted(false);
                      setFormState({ name: '', email: '', company: '', service: 'recruiting', message: '' });
                    }} 
                    className="button button-primary"
                  >
                    Send Another Message
                  </button>
                </div>
              ) : (
                <form onSubmit={handleSubmit} className="contact-form">
                  <h2>Send a Message</h2>
                  <div className="form-group">
                    <label htmlFor="name">Full Name</label>
                    <input 
                      type="text" 
                      id="name" 
                      name="name" 
                      required 
                      value={formState.name} 
                      onChange={handleChange}
                      placeholder="Jane Doe"
                    />
                  </div>

                  <div className="form-group">
                    <label htmlFor="email">Email Address</label>
                    <input 
                      type="email" 
                      id="email" 
                      name="email" 
                      required 
                      value={formState.email} 
                      onChange={handleChange}
                      placeholder="jane@company.com"
                    />
                  </div>

                  <div className="form-group">
                    <label htmlFor="company">Company Name</label>
                    <input 
                      type="text" 
                      id="company" 
                      name="company" 
                      value={formState.company} 
                      onChange={handleChange}
                      placeholder="Acme Corp"
                    />
                  </div>

                  <div className="form-group">
                    <label htmlFor="service">I'm interested in...</label>
                    <select 
                      id="service" 
                      name="service" 
                      value={formState.service} 
                      onChange={handleChange}
                    >
                      <option value="recruiting">Executive Recruiting & Placement</option>
                      <option value="consulting">HR Strategic Consulting & Audit</option>
                      <option value="both">Both Recruiting & Consulting</option>
                      <option value="candidate">Applying for open roles / Career inquiry</option>
                    </select>
                  </div>

                  <div className="form-group">
                    <label htmlFor="message">How can we help you?</label>
                    <textarea 
                      id="message" 
                      name="message" 
                      rows="5" 
                      required 
                      value={formState.message} 
                      onChange={handleChange}
                      placeholder="Tell us about your organization and goals..."
                    />
                  </div>

                  <button type="submit" className="button button-primary submit-btn">
                    Submit Inquiry <Send size={16} />
                  </button>
                </form>
              )}
            </div>

            <div className="contact-info-panel">
              <h2>Contact Details</h2>
              <p className="info-intro">Prefer direct communication? Reach out to our offices or email us directly.</p>
              
              <div className="info-list">
                <div className="info-item">
                  <Mail className="info-icon" />
                  <div>
                    <h3>Email Us</h3>
                    <a href="mailto:hello@ascendhr.com">hello@ascendhr.com</a>
                  </div>
                </div>

                <div className="info-item">
                  <Phone className="info-icon" />
                  <div>
                    <h3>Call Us</h3>
                    <a href="tel:+14155550199">+1 (415) 555-0199</a>
                  </div>
                </div>

                <div className="info-item">
                  <MapPin className="info-icon" />
                  <div>
                    <h3>Office Address</h3>
                    <span>1200 Tech Ave, Suite 400<br/>San Francisco, CA 94107</span>
                  </div>
                </div>
              </div>

              <div className="map-placeholder">
                <div className="glass-panel">
                  <span className="map-label">San Francisco HQ</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
