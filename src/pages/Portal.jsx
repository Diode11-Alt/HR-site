import { useState } from 'react';
import { CheckCircle2, Circle, Clock, FileText, UserCircle, Play, Square, Mic, AlertTriangle } from 'lucide-react';
import './Page.css';
import './Portal.css';

// ----------------------------------------------------
// SUB-COMPONENT: Language Sandbox & Vocal Verifier
// ----------------------------------------------------
const LanguageSandbox = () => {
  const [isPlaying, setIsPlaying] = useState(false);
  const [isRecording, setIsRecording] = useState(false);
  const [accuracy, setAccuracy] = useState(null);

  const nativePhrase = "السلام عليكم ورحمة الله وبركاته";
  const phonetic = "As-salamu alaykum wa rahmatullahi wa barakatuh";
  const translation = "Peace be upon you, and the mercy of Allah and His blessings.";

  const handlePlayAudio = () => {
    setIsPlaying(true);
    // Simulate audio playback duration
    setTimeout(() => {
      setIsPlaying(false);
    }, 2000);
  };

  const handleRecordVoice = () => {
    setIsRecording(true);
    setAccuracy(null);
    // Simulate recording duration and then verify
    setTimeout(() => {
      setIsRecording(false);
      setAccuracy(Math.floor(Math.random() * 15) + 82); // Generates 82% to 96%
    }, 2500);
  };

  return (
    <div className="language-sandbox">
      <div className="sandbox-header">
        <span className="sandbox-meta">[ CORE DRILL // LANGUAGE SANDBOX ]</span>
        <span className="sandbox-badge">
          <span className="badge-pulse-node" />
          ACTIVE PRACTICE
        </span>
      </div>

      <h3 className="sandbox-title">Site Safety & Greetings</h3>
      <p className="sandbox-desc">
        Master essential conversational protocols for your deployment in Riyadh, Saudi Arabia.
      </p>

      <div className="phrase-card">
        <div className="phrase-arabic">
          {nativePhrase}
        </div>
        <div className="phrase-phonetic">
          {phonetic}
        </div>
        <div className="phrase-translation">
          <span className="translation-label">Literal Translation</span>
          <p>"{translation}"</p>
        </div>
      </div>

      <div className="sandbox-actions">
        <button 
          onClick={handlePlayAudio}
          className={`sandbox-btn ${isPlaying ? 'active' : ''}`}
        >
          <div className="btn-left">
            <div className="btn-icon-circle">
              {isPlaying ? <Square size={16} fill="currentColor" /> : <Play size={16} fill="currentColor" />}
            </div>
            <div className="btn-label-box">
              <span className="btn-meta">LISTEN</span>
              <span className="btn-main">Native Audio</span>
            </div>
          </div>
          
          <div className="wave-bars">
            {[1, 2, 3, 4, 3, 2, 3, 4, 1].map((val, idx) => (
              <span 
                key={idx} 
                className={`wave-bar ${isPlaying ? 'playing' : ''}`}
                style={{ 
                  height: isPlaying ? `${val * 4}px` : '4px',
                  animationDelay: `${idx * 0.08}s`
                }}
              />
            ))}
          </div>
        </button>

        <button 
          onClick={handleRecordVoice}
          className={`sandbox-btn record-btn ${isRecording ? 'recording' : ''}`}
        >
          <div className="btn-left">
            <div className="btn-icon-circle">
              <Mic size={16} />
            </div>
            <div className="btn-label-box">
              <span className="btn-meta">SPEAK & VERIFY</span>
              <span className="btn-main">
                {isRecording ? 'Recording Voice...' : 'Record Phrase'}
              </span>
            </div>
          </div>

          {accuracy !== null && (
            <div className="accuracy-badge">
              <span className="accuracy-num">{accuracy}%</span>
              <span className="accuracy-label">Match</span>
            </div>
          )}
        </button>
      </div>

      {accuracy !== null && (
        <div className="vocal-evaluation">
          <div className="eval-header">
            <span>[ SYSTEM EVALUATION ]</span>
            <span className="eval-result font-mono">PASSED</span>
          </div>
          <p className="eval-log">// MATCH: {accuracy}% similarity to native standard.</p>
          <p className="eval-log">// VOCAL DURATION: 1.48s // HZ PITCH VARIANCE: OPTIMAL</p>
          <p className="eval-suggestion">
            Excellent cadence. Pronunciation satisfies local linguistic parameters.
          </p>
        </div>
      )}
    </div>
  );
};

// ----------------------------------------------------
// SUB-COMPONENT: Ingestion Upload & File Audit Ledger
// ----------------------------------------------------
const UploadAuditLedger = () => {
  const uploads = [
    {
      id: "upl-091",
      timestamp: "2026-06-12T08:14:22Z",
      fileName: "PASSPORT_SCAN_FINAL.PDF",
      size: "3.1 MB",
      type: "PASSPORT",
      ocrStatus: "COMPLETED",
      ocrDetails: "PASSPORT NO: N9285028 // EXPIRY: 2034-04-18 // DOB: 1996-10-12",
      status: "APPROVED"
    },
    {
      id: "upl-084",
      timestamp: "2026-06-11T14:30:05Z",
      fileName: "MEDICAL_REPORT_RTL.PDF",
      size: "5.4 MB",
      type: "HEALTH REPORT",
      ocrStatus: "COMPLETED",
      ocrDetails: "HOSPITAL: KATHMANDU DIAGNOSTICS // BLOOD GROUP: O+ // RESULT: FIT",
      status: "APPROVED"
    },
    {
      id: "upl-079",
      timestamp: "2026-06-08T09:02:11Z",
      fileName: "PASSPORT_SCAN_BLURRY.PDF",
      size: "2.8 MB",
      type: "PASSPORT",
      ocrStatus: "FAILED",
      ocrDetails: "OCR ERROR: CORRUPT CHARACTERS // LOW CONTRAST IN ZONE B",
      status: "REJECTED",
      errorDetails: "OCR Verification Suspended: Resolution mismatch detected. Passport photo region unreadable. Please capture under direct lighting without glare and re-upload."
    }
  ];

  return (
    <div className="upload-audit-ledger font-mono">
      <div className="ledger-header">
        <span className="ledger-meta">[ PORTAL SYSTEM // FILE AUDIT LEDGER ]</span>
        <span className="ledger-version">UPL_LOGS: v1.0.4 // INGESTION GATEWAY: ACTIVE</span>
      </div>

      <div className="ledger-title-sec">
        <span className="ledger-pulse" />
        <h3>Chronological Document Auditing</h3>
      </div>

      <div className="ledger-list">
        {uploads.map((log) => (
          <div 
            key={log.id} 
            className={`ledger-item ${log.status === 'APPROVED' ? 'approved' : 'rejected'}`}
          >
            <div className="item-meta-bar">
              <div className="meta-left">
                <span className="log-id">{log.id}</span>
                <span>//</span>
                <span>{log.timestamp}</span>
              </div>
              <div className="meta-right">
                <span>SIZE: {log.size}</span>
                <span>//</span>
                <span className={`status-pill ${log.status === 'APPROVED' ? 'approved' : 'rejected'}`}>
                  {log.status}
                </span>
              </div>
            </div>

            <div className="item-file-bar">
              <span className="file-name">{log.fileName}</span>
              <span className="file-type-tag">{log.type}</span>
            </div>

            <div className="ocr-log-box">
              <div className="ocr-header">
                <span>OCR EXTRACTOR ENGINE</span>
                <span className={log.ocrStatus === 'COMPLETED' ? 'text-lime' : 'text-red'}>
                  {log.ocrStatus}
                </span>
              </div>
              <p className="ocr-details">{log.ocrDetails}</p>
            </div>

            {log.status === 'REJECTED' && log.errorDetails && (
              <div className="audit-error-box font-sans">
                <div className="error-title-row">
                  <AlertTriangle size={14} />
                  <span>Audit Failure Alert:</span>
                </div>
                <p className="error-text">{log.errorDetails}</p>
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  );
};

// ----------------------------------------------------
// MAIN COMPONENT: Portal
// ----------------------------------------------------
const APPLICATIONS = [
  {
    id: 1,
    role: 'Warehouse Staff & Packer',
    company: 'EuroLogistics Sp. z o.o. (Poland)',
    status: 'medical', // applied, interview, medical, visa, mobilized
    appliedDate: 'May 10, 2026',
    nextStep: 'Work Permit received. Submitting visa file to Embassy on June 18.',
  },
  {
    id: 2,
    role: 'Hospitality Commis Chef',
    company: 'Bucharest Grand Hotel & Spa (Romania)',
    status: 'interview',
    appliedDate: 'May 28, 2026',
    nextStep: 'Employer interview passed. Medical screening appointment on June 15.',
  }
];

export default function Portal() {
  const renderStatusTracker = (status) => {
    const stages = [
      { id: 'applied', label: 'Documents Sourced' },
      { id: 'interview', label: 'Interview Passed' },
      { id: 'medical', label: 'Medical Clearance' },
      { id: 'visa', label: 'Visa Approved' },
      { id: 'mobilized', label: 'Departure Set' }
    ];

    const statusMap = {
      applied: 0,
      interview: 1,
      medical: 2,
      visa: 3,
      mobilized: 4
    };

    const currentStageIndex = statusMap[status] ?? 0;

    return (
      <div className="status-tracker">
        {stages.map((stage, index) => {
          const isCompleted = index <= currentStageIndex;
          const isCurrent = index === currentStageIndex;
          
          return (
            <div key={stage.id} className={`tracker-step ${isCompleted ? 'completed' : ''} ${isCurrent ? 'current' : ''}`}>
              <div className="step-icon">
                {isCompleted ? <CheckCircle2 size={24} /> : <Circle size={24} />}
              </div>
              <span className="step-label">{stage.label}</span>
              {index < stages.length - 1 && <div className="step-line" />}
            </div>
          );
        })}
      </div>
    );
  };

  return (
    <div className="page portal-page">
      <header className="page-header">
        <div className="container">
          <h1 className="page-title">Candidate Visa Tracker Portal</h1>
          <p className="page-subtitle">Track your visa status, medical checks, and departure schedules transparently.</p>
        </div>
      </header>

      <section className="section">
        <div className="container">
          <div className="portal-grid">
            <div className="portal-main">
              <h2>Your Active Applications & Visas</h2>
              <div className="application-list">
                {APPLICATIONS.map(app => (
                  <div key={app.id} className="application-card">
                    <div className="app-header">
                      <div>
                        <h3>{app.role}</h3>
                        <span className="app-company">{app.company}</span>
                      </div>
                      <span className="app-date">Registered: {app.appliedDate}</span>
                    </div>
                    
                    {renderStatusTracker(app.status)}
                    
                    <div className="app-next-step">
                      <Clock size={16} />
                      <strong>Next Step:</strong> {app.nextStep}
                    </div>
                  </div>
                ))}
              </div>

              {/* Ingested upload ledger */}
              <UploadAuditLedger />
            </div>

            <aside className="portal-sidebar">
              <div className="glass-panel profile-panel">
                <UserCircle size={48} className="profile-icon" />
                <h3>Ram Kumar Thapa</h3>
                <p className="candidate-id">Candidate ID: SH-2026-9042</p>
                <button className="button button-outline full-width">Upload New Documents</button>
              </div>

              {/* Language Sandbox integration */}
              <LanguageSandbox />
              
              <div className="glass-panel resource-panel">
                <FileText size={24} className="resource-icon" />
                <h3>Pre-Departure Guide</h3>
                <p>Read important information about labor laws, climate, and culture in Europe.</p>
                <button className="button button-primary full-width">Download Handbook</button>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </div>
  );
}
