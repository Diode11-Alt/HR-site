# PrimePath HR — COMPLETE Website + Portal Build Plan
### Agent-Ready · PHP/WordPress · cPanel · No Jargon · Full Build

---

## WHAT IS BEING BUILT

A complete professional website + HR portal system at **primepathuae.com**

### Public Website (Anyone Can See)
| Page | URL | Purpose |
|---|---|---|
| Home | / | Hero, stats, services, CTA — converts visitors |
| Jobs | /jobs/ | Browse all active job listings |
| For Employers | /for-employers/ | Convince companies to post jobs on PrimePath |
| For Candidates | /for-candidates/ | Convince job seekers to register |
| About Us | /about/ | Company story, team, mission |
| Contact | /contact/ | Inquiry form + office details |
| Blog | /blog/ | News, hiring tips, UAE job market updates |

### Protected Portals (Login Required)
| Portal | URL | Who Uses It |
|---|---|---|
| Candidate Portal | /candidate-portal/ | Job seekers — apply, track applications, profile |
| Employer Portal | /employer-portal/ | Companies — post jobs, view applicants |
| Admin Panel | /wp-admin/ | Rohan — manages everything |

### Auth Pages
| Page | URL |
|---|---|
| Login | /login/ |
| Register | /register/ |
| Forgot Password | /forgot-password/ |

---

## DESIGN SYSTEM (Use Everywhere — Zero Hardcoded Colors)

```css
:root {
  /* Brand Colors */
  --gold: #C9A84C;
  --gold-light: #E8C96A;
  --gold-dark: #A6882A;
  --navy: #0D1B2A;
  --navy-mid: #162233;
  --navy-light: #1E3048;
  --slate: #2D4A6B;

  /* Neutral */
  --white: #F7F5F0;
  --white-dim: #E8E4DC;
  --gray: #94A3B8;
  --gray-dark: #64748B;

  /* Status */
  --success: #22C55E;
  --danger: #EF4444;
  --warning: #F59E0B;
  --info: #3B82F6;

  /* Typography */
  --font-display: 'Playfair Display', Georgia, serif;
  --font-body: 'Inter', system-ui, sans-serif;

  /* Spacing & Shape */
  --radius: 6px;
  --radius-lg: 12px;
  --shadow: 0 4px 24px rgba(0,0,0,0.3);
  --shadow-sm: 0 2px 8px rgba(0,0,0,0.15);
  --sidebar-w: 260px;
  --topbar-h: 64px;
  --max-width: 1200px;
}
```

**Google Fonts import (add to every CSS file top):**
```css
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap');
```

**Global reset:**
```css
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--navy); color: var(--white); font-family: var(--font-body); }
a { color: var(--gold); text-decoration: none; }
img { max-width: 100%; height: auto; display: block; }
```

---

## WORDPRESS THEME FILE STRUCTURE

```
wp-content/themes/primepath-hr/
│
├── style.css                        ← Theme declaration header (required by WordPress)
├── functions.php                    ← Enqueue styles/scripts, register menus, theme support
├── index.php                        ← Fallback template
├── 404.php                          ← Not found page
│
├── ── PUBLIC PAGES ──
├── front-page.php                   ← Home page
├── page-for-employers.php           ← /for-employers/ template
├── page-for-candidates.php          ← /for-candidates/ template
├── page-about.php                   ← /about/ template
├── page-contact.php                 ← /contact/ template
├── page-login.php                   ← /login/ template
├── page-register.php                ← /register/ template
├── page-forgot-password.php         ← /forgot-password/ template
├── page.php                         ← Generic page (for portal pages using shortcodes)
│
├── ── BLOG ──
├── home.php                         ← Blog listing page
├── single.php                       ← Single blog post
├── archive.php                      ← Category/tag archives
│
├── ── TEMPLATE PARTS (reusable HTML snippets) ──
├── header.php                       ← Site-wide navigation bar
├── footer.php                       ← Site-wide footer
├── template-parts/
│   ├── nav-public.php               ← Public site nav links
│   ├── nav-portal.php               ← Portal sidebar nav links
│   ├── job-card.php                 ← Single job card (used on /jobs/ and portals)
│   ├── stat-card.php                ← Stat card block (used in dashboards)
│   ├── modal.php                    ← Reusable modal shell
│   ├── badge.php                    ← Status badge pill
│   ├── alert.php                    ← Success/error alert message
│   └── pagination.php               ← Page navigation for job listings and blog
│
└── assets/
    ├── css/
    │   ├── main.css                 ← All public site styles
    │   ├── portal.css               ← Employer + Candidate portal styles
    │   └── admin-custom.css         ← WordPress admin panel overrides
    ├── js/
    │   ├── main.js                  ← Public site JS (mobile menu, smooth scroll)
    │   ├── portal.js                ← Portal JS (tabs, modals, AJAX calls)
    │   └── admin.js                 ← Admin charts + admin AJAX
    └── images/
        └── logo.svg                 ← PrimePath logo (agent: leave placeholder)
```

---

## WORDPRESS PLUGIN FILE STRUCTURE

```
wp-content/plugins/primepath-hr-portal/
│
├── primepath-hr-portal.php          ← Main plugin file (plugin header + init)
├── uninstall.php                    ← Cleanup on plugin delete
│
├── includes/
│   ├── class-database.php           ← Create/manage custom DB tables
│   ├── class-roles.php              ← Register custom user roles
│   ├── class-shortcodes.php         ← Register all shortcodes
│   ├── class-ajax.php               ← Register all AJAX handlers
│   ├── class-email.php              ← All email notification functions
│   ├── class-security.php           ← Nonce helpers, permission checks
│   └── class-upload.php             ← CV file upload handler
│
├── admin/
│   ├── class-admin-menu.php         ← Register WP admin menu pages
│   ├── views/
│   │   ├── dashboard.php            ← Admin dashboard HTML
│   │   ├── jobs.php                 ← Jobs management HTML
│   │   ├── applications.php         ← Applications management HTML
│   │   ├── candidates.php           ← Candidates management HTML
│   │   ├── employers.php            ← Employers management HTML
│   │   ├── inquiries.php            ← Inquiries management HTML
│   │   └── settings.php             ← Settings page HTML
│   └── assets/
│       ├── admin-style.css
│       └── admin-script.js
│
└── shortcodes/
    ├── job-board.php                ← [pp_job_board] output
    ├── employer-portal.php          ← [pp_employer_portal] output
    ├── candidate-portal.php         ← [pp_candidate_portal] output
    ├── login-form.php               ← [pp_login_form] output
    └── register-form.php            ← [pp_register_form] output
```

---

## DATABASE TABLES

### Table: `{prefix}_pp_jobs`
```sql
CREATE TABLE {prefix}_pp_jobs (
  id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  employer_id     BIGINT UNSIGNED NOT NULL,
  title           VARCHAR(255) NOT NULL,
  company         VARCHAR(255) NOT NULL,
  location        VARCHAR(255) NOT NULL,
  type            ENUM('full-time','part-time','contract') NOT NULL,
  category        VARCHAR(100) NOT NULL,
  salary          VARCHAR(100),
  description     LONGTEXT NOT NULL,
  requirements    TEXT,
  status          ENUM('pending','published','closed','rejected') DEFAULT 'pending',
  deadline        DATE,
  posted_date     DATETIME DEFAULT CURRENT_TIMESTAMP,
  views           INT DEFAULT 0
);
```

### Table: `{prefix}_pp_applications`
```sql
CREATE TABLE {prefix}_pp_applications (
  id               BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  job_id           BIGINT UNSIGNED NOT NULL,
  candidate_id     BIGINT UNSIGNED NOT NULL,
  candidate_name   VARCHAR(255) NOT NULL,
  candidate_email  VARCHAR(255) NOT NULL,
  candidate_phone  VARCHAR(50),
  experience       VARCHAR(100),
  cover_letter     TEXT,
  cv_url           VARCHAR(500),
  status           ENUM('applied','under_review','shortlisted','rejected') DEFAULT 'applied',
  applied_on       DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Table: `{prefix}_pp_inquiries`
```sql
CREATE TABLE {prefix}_pp_inquiries (
  id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(255) NOT NULL,
  email        VARCHAR(255) NOT NULL,
  phone        VARCHAR(50),
  type         ENUM('employer','candidate','general') NOT NULL,
  subject      VARCHAR(255) NOT NULL,
  message      TEXT NOT NULL,
  status       ENUM('new','in_progress','replied') DEFAULT 'new',
  received_on  DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Table: `{prefix}_pp_saved_jobs`
```sql
CREATE TABLE {prefix}_pp_saved_jobs (
  id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  candidate_id BIGINT UNSIGNED NOT NULL,
  job_id       BIGINT UNSIGNED NOT NULL,
  saved_on     DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

---

## USER ROLES

```php
// Register on plugin activation
pp_employer:
  - read
  - pp_post_jobs
  - pp_view_own_applications
  - pp_manage_own_jobs

pp_candidate:
  - read
  - pp_apply_jobs
  - pp_view_own_applications
  - pp_manage_profile
```

---

## PAGE 1 — HOME PAGE (`front-page.php`)

### Section 1: Navigation Bar (header.php)
- Logo left (Playfair Display, gold text "PrimePath")
- Nav links: Home | Jobs | For Employers | For Candidates | About | Blog
- Right side: Login button (gold outlined) + Post a Job button (gold filled)
- Mobile: hamburger menu → slides down full-width nav
- Sticky on scroll with slight shadow

### Section 2: Hero
- Full-width, navy background
- Left side:
  - Small label: "UAE's Premier HR & Recruitment Agency" (gold, uppercase, small)
  - H1: "We Connect UAE's Best Talent With Its Best Companies" (Playfair Display, very large)
  - Subtext: Professional 2-line description of PrimePath
  - Two CTA buttons: "Browse Jobs →" (gold filled) | "Post a Job" (outlined)
- Right side: statistics block
  - 500+ Placements | 200+ Employers | 1000+ Candidates | 5 Years Experience
  - Each stat: large gold number + label below

### Section 3: How It Works
- Section title: "Simple. Fast. Effective." (Playfair Display)
- 3 steps in a row:
  - Step 1: Post Your Job (icon + title + 2-line description)
  - Step 2: We Match Candidates (icon + title + 2-line description)
  - Step 3: Hire With Confidence (icon + title + 2-line description)
- Arrow connectors between steps on desktop

### Section 4: Services
- Section title: "What We Do"
- 6 service cards in a 3×2 grid:
  - Permanent Recruitment
  - Contract Staffing
  - Executive Search
  - HR Consulting
  - Payroll Management
  - Visa & PRO Services
- Each card: icon (SVG) + title + 2-line description
- Card background: var(--navy-mid), gold top border on hover

### Section 5: Industries We Serve
- Section title: "Industries We Cover"
- Horizontal scrolling tag/chip list (or 4-column grid):
  - Oil & Gas | Construction | Engineering | Finance | Logistics
  - Healthcare | IT & Tech | Hospitality | Retail | Education | HSE | Admin

### Section 6: Why Choose PrimePath
- Two columns: left = large gold quote text / right = bullet list
- Left: "We don't just fill roles — we build careers and companies."
- Right bullets:
  - Deep UAE market expertise
  - Dedicated account managers
  - Fast turnaround (avg 7 days to shortlist)
  - Verified candidate database
  - End-to-end support

### Section 7: Featured Jobs (Latest 6)
- Section title: "Latest Opportunities"
- 3-column grid of job cards (pulled live from database)
- Each card: Title, Company, Location, Salary, Type badge, "Apply Now" button
- "View All Jobs →" button below grid

### Section 8: Testimonials
- Section title: "What Our Clients Say"
- 3 quote cards in a row
- Each card: quote text + name + company + role (Employer or Candidate tag)
- Gold quotation mark styling

### Section 9: CTA Banner
- Full-width dark section
- "Ready to Find Your Next Star Employee?"
- Subtext: "Join 200+ UAE companies who trust PrimePath for their recruitment needs."
- Button: "Post a Job Today" (gold, large)

### Section 10: Footer (footer.php)
- Logo + tagline
- 4 columns: Quick Links | For Employers | For Candidates | Contact Info
- Bottom bar: copyright + Privacy Policy + Terms of Use

---

## PAGE 2 — JOBS PAGE (`/jobs/`)

Shortcode: `[pp_job_board]`

### Layout:
- Top: Search bar (full width) — search by job title or keyword
- Below: Two-column layout
  - Left column (280px): Filter sidebar
  - Right column: Job listings

### Filter Sidebar:
- Category (checkboxes): Engineering | Finance | HR | Logistics | IT | HSE | Admin | Other
- Job Type (radio): All | Full-time | Part-time | Contract
- Location (text input)
- Salary Range (dropdown): Any | 3k-6k AED | 6k-10k AED | 10k-20k AED | 20k+
- Clear Filters button

### Job Listings:
- Results count: "Showing 24 jobs"
- Sort by: Newest | Salary (High to Low) | Deadline
- Job cards (list style, full width):
  - Left: Company logo placeholder circle
  - Middle: Job title (bold serif) + Company + Location + Type badge + Salary
  - Right: Deadline + "Apply Now" button
  - Hover: gold left border
- Pagination: 10 per page

### Apply Modal (opens on "Apply Now"):
- Job title at top
- Fields: Cover Letter (textarea) | CV Upload (PDF only, max 5MB) | Phone Number
- If not logged in: "Please login or register to apply" + Login button
- If logged in as candidate: show form
- Submit: AJAX, show success message, modal stays open with confirmation

---

## PAGE 3 — FOR EMPLOYERS (`/for-employers/`)

Template: `page-for-employers.php`

### Section 1: Hero
- Headline: "Find The Right Talent For Your Business — Fast"
- Subtext: "PrimePath connects you with pre-screened, UAE-ready candidates across all industries."
- CTA: "Start Posting Jobs" button (links to /register/?role=employer)

### Section 2: The Problem We Solve
- 3 pain points in cards:
  - "Wasting hours screening unqualified CVs"
  - "Candidates who don't show up or leave within a month"
  - "No time to manage recruitment in-house"

### Section 3: How PrimePath Helps Employers
- 4 steps with icons:
  1. Create your employer account (free)
  2. Post your job in under 5 minutes
  3. Receive pre-screened applications
  4. Interview and hire with confidence

### Section 4: What You Get
- Feature comparison table: PrimePath vs Doing It Yourself vs Other Agencies
  - Speed | Quality | Cost | Support | Screening | UAE Compliance

### Section 5: Pricing / Packages (if applicable)
- 3 cards: Basic (free) | Professional | Enterprise
- Or: "Contact us for custom pricing" if no set pricing

### Section 6: Employer Testimonials
- 2-3 quotes from UAE companies

### Section 7: CTA
- "Ready to Post Your First Job?"
- Register as Employer button + Login button

---

## PAGE 4 — FOR CANDIDATES (`/for-candidates/`)

Template: `page-for-candidates.php`

### Section 1: Hero
- Headline: "Your Next Career Move Starts Here"
- Subtext: "Thousands of UAE jobs. One smart platform. Zero hassle."
- CTA: "Register Free" button

### Section 2: Why Register
- 4 benefit cards:
  - Free to register and apply
  - Get notified when your status changes
  - Trusted employers only
  - Career support and guidance

### Section 3: How It Works for Candidates
- 3 steps: Register → Browse & Apply → Get Hired

### Section 4: Browse by Category
- 8 category cards with icons:
  - Engineering | Finance | Oil & Gas | IT | Logistics | HSE | Admin | Healthcare

### Section 5: Latest Jobs Preview
- 6 job cards (live from DB)
- "See All Jobs" button

### Section 6: Candidate Testimonials
- 2-3 quotes from placed candidates

### Section 7: CTA
- "Start Your Job Search Today" → Register button

---

## PAGE 5 — ABOUT US (`/about/`)

Template: `page-about.php`

### Section 1: Hero
- Headline: "About PrimePath UAE"
- Breadcrumb: Home → About

### Section 2: Our Story
- 2-column: left = heading + paragraphs, right = image
- Who we are, when founded, what we stand for

### Section 3: Mission & Vision
- 2 cards side by side
- Mission: "To connect UAE's best talent with its best opportunities"
- Vision: "To be the most trusted recruitment partner in the GCC"

### Section 4: Our Values
- 4 value cards: Integrity | Speed | Quality | Partnership

### Section 5: The Team
- 3-4 team member cards
- Photo placeholder + Name + Title + LinkedIn icon

### Section 6: Numbers
- 4 stat counters: 500+ Placements | 200+ Clients | 5 Years | 15+ Industries

---

## PAGE 6 — CONTACT (`/contact/`)

Template: `page-contact.php`

### Layout: Two columns

**Left column — Contact Info:**
- Office Address (Dubai, UAE)
- Phone Number
- Email Address
- WhatsApp button (green, links to wa.me/...)
- Working hours: Mon–Fri 9am–6pm GST
- Google Maps embed (iframe)

**Right column — Inquiry Form:**
- Fields: Full Name | Email | Phone | I am a... (Employer / Candidate / Other) | Subject | Message
- Submit button: "Send Inquiry"
- On submit: AJAX → saves to `pp_inquiries` table + sends email to admin
- Success message: "Thank you! We'll get back to you within 24 hours."

---

## PAGE 7 — BLOG (`/blog/`)

Uses WordPress built-in blog system.

### Blog listing (home.php):
- Section title: "News & Insights"
- 3-column grid of post cards
- Each card: Featured image | Category tag | Title | Excerpt | Date | "Read More →"
- Sidebar: Recent Posts | Categories | Search

### Single post (single.php):
- Featured image full width
- Title (Playfair Display, large)
- Author + Date + Category
- Post content (styled: headings, blockquotes, lists)
- Share buttons: LinkedIn | WhatsApp | Copy Link
- Related posts section (3 cards below)

---

## AUTH PAGES

### Login Page (`page-login.php`) — Shortcode: `[pp_login_form]`
- Centered card on navy background
- PrimePath logo at top
- Email + Password fields
- "Remember Me" checkbox
- Login button (gold)
- Links: "Forgot Password?" | "Don't have an account? Register"
- On success: redirect based on role
  - admin → /wp-admin/
  - employer → /employer-portal/
  - candidate → /candidate-portal/
- On fail: show error message in red

### Register Page (`page-register.php`) — Shortcode: `[pp_register_form]`
- Two role selector cards at top: "I am looking for talent" (Employer) | "I am looking for a job" (Candidate)
- Based on selection, show relevant fields:
  - **Employer fields:** Company Name | Full Name | Email | Phone | Password | Confirm Password
  - **Candidate fields:** Full Name | Email | Phone | Current Job Title | Experience (years) | Password | Confirm Password
- Terms checkbox: "I agree to the Terms of Use and Privacy Policy"
- Register button (gold)
- Already have account? Login link
- On success: auto-login + redirect to correct portal

### Forgot Password (`page-forgot-password.php`)
- Email field
- "Send Reset Link" button
- Uses WordPress wp_lostpassword_url() native system

---

## CANDIDATE PORTAL — Shortcode: `[pp_candidate_portal]`

**Access rule:** If not logged in → redirect to /login/?redirect=candidate-portal

### Layout:
- Left: fixed sidebar (260px) with nav links
- Right: main content area with topbar + page content

### Sidebar Nav Links:
- Dashboard
- Browse Jobs
- My Applications
- My Profile
- Saved Jobs
- Logout

### Dashboard Tab:
- Topbar: "Welcome back, [Name]" + notification bell
- Stat cards row:
  - Jobs Applied | Under Review | Shortlisted | Saved Jobs
- Recent Applications table (last 5):
  - Job Title | Company | Status badge | Applied On | Actions
- "Shortlisted" rows highlighted with green left border

### Browse Jobs Tab:
- Same job board as public /jobs/ page but Apply button is pre-connected to logged-in account
- No need to enter name/email — just cover letter + CV + phone

### My Applications Tab:
- Full table: Job Title | Company | Applied On | Status | Actions
- Status badges: applied (blue) | under_review (yellow) | shortlisted (green) | rejected (red)
- Actions: Eye → view full application details in modal
- Shortlisted rows: green left border + "🎉 You've been shortlisted!" banner

### My Profile Tab:
- Form Section 1 — Personal Info:
  - Full Name | Email (read-only) | Phone | Location | Nationality
  - Current Title | Years of Experience | Skills (comma-separated tags)
  - Save button → AJAX update
- Form Section 2 — CV:
  - Show current CV: filename + "Download" link
  - Upload new CV button (PDF only, max 5MB)
  - Upload replaces current CV

### Saved Jobs Tab:
- Grid of saved job cards
- "Remove" button on each card
- If no saved jobs: "No saved jobs yet. Browse Jobs →"

---

## EMPLOYER PORTAL — Shortcode: `[pp_employer_portal]`

**Access rule:** If not logged in → redirect to /login/?redirect=employer-portal

### Sidebar Nav Links:
- Dashboard
- Post a Job
- My Jobs
- Applications
- Company Profile
- Logout

### Dashboard Tab:
- Topbar: "Welcome, [Company Name]" + notification bell
- Stat cards:
  - Active Jobs | Total Applications | Shortlisted Candidates | Pending Approval
- Recent Jobs table (last 5): Title | Status | Applications Count | Posted | Actions
- Recent Applications table (last 5): Candidate | Job | Status | Applied On

### Post a Job Tab:
- Full form:
  - Job Title (text)
  - Location (text)
  - Job Type (dropdown: Full-time / Part-time / Contract)
  - Salary Range (text)
  - Category (dropdown: Engineering / HR / Finance / Logistics / HSE / IT / Admin / Other)
  - Application Deadline (date picker)
  - Job Description (large textarea — min 100 chars)
  - Requirements (textarea — one per line)
- Submit button: "Submit for Approval"
- On success: "Job submitted! Admin will review and publish within 24 hours."
- Submitted job appears in My Jobs with status "Pending"

### My Jobs Tab:
- Table: Title | Category | Type | Status | Posted | Applications | Deadline | Actions
- Actions:
  - Eye → view job details modal
  - Edit → only if status is pending or published (not closed/rejected)
  - Close → mark as closed (confirm dialog)
- Status badges: pending (yellow) | published (green) | closed (gray) | rejected (red)

### Applications Tab:
- Filter: by Job (dropdown of employer's own jobs)
- Table: Candidate Name | Experience | Applied On | Status | Actions
- Actions:
  - Eye → Full application modal (cover letter + CV download link + phone + email)
  - Status dropdown → shortlist / reject / mark under review
- AJAX status update — no page reload

### Company Profile Tab:
- Form: Company Name | Industry | Company Size | Website | Address | Description | Logo upload
- Save button

---

## ADMIN PANEL (WordPress Dashboard)

All accessible from /wp-admin/ under "PrimePath HR" menu.

### Admin Menu:
```
PrimePath HR
├── 📊 Dashboard
├── 💼 Jobs
├── 📋 Applications
├── 👤 Candidates
├── 🏢 Employers
├── 📩 Inquiries          ← shows badge with count of new inquiries
└── ⚙️ Settings
```

### Admin Dashboard:
- Top row stat cards (large numbers):
  - Total Jobs | Active Jobs | Total Applications | Pending Review
  - Total Candidates | Total Employers | New Inquiries | Placements This Month
- Chart (Chart.js bar chart): last 6 months of Applications vs Placements
- Bottom: recent inquiries table (new ones highlighted gold)

### Jobs Management:
- Filter bar: Status | Category | Employer | Date Range
- Table: Title | Company | Category | Status | Posted | Deadline | Applications Count | Actions
- Actions:
  - ✅ Approve → status = published (sends email to employer)
  - ❌ Reject → status = rejected (sends email to employer)
  - ✏️ Edit → inline edit modal
  - 🗑️ Delete → confirm dialog

### Applications Management:
- Filter: Job | Status | Date Range
- Table: Candidate | Job Applied | Experience | Status | Applied On | Actions
- Actions:
  - Eye → full application modal
  - Status dropdown → any status change
  - Download CV link

### Candidates Management:
- Table: Name | Email | Phone | Applications Count | Registered Date | Actions
- Actions:
  - Eye → modal showing all their applications
  - Suspend / Activate account

### Employers Management:
- Table: Company | Email | Jobs Posted | Active Jobs | Status | Joined | Actions
- Actions:
  - Eye → modal showing all their jobs
  - Suspend / Activate account

### Inquiries Management:
- Table: Name | Type | Subject | Status | Received | Actions
- New inquiries: gold left border on row
- Actions:
  - Eye → modal with full message + reply by email button
  - Mark as Replied / In Progress
  - 🗑️ Delete → confirm

### Settings:
- Tab 1 — General: Site name, contact email, WhatsApp number, address
- Tab 2 — SMTP: Host, Port, Username, Password, From Name, From Email, Test Email button
- Tab 3 — Profile: Rohan's name, email, change password
- Tab 4 — Roles: Static read-only table showing permissions per role

---

## EMAIL NOTIFICATIONS

All sent using WordPress `wp_mail()` with SMTP settings from Settings page.

| Event | Recipient | Subject |
|---|---|---|
| New application received | Employer | "New application for [Job Title]" |
| Application status changed | Candidate | "Your application status has been updated" |
| Job approved by admin | Employer | "Your job '[Title]' is now live!" |
| Job rejected by admin | Employer | "Update on your job posting '[Title]'" |
| New inquiry submitted | Admin | "New inquiry from [Name]" |
| New employer registered | Admin | "New employer registered: [Company]" |
| New candidate registered | Admin | "New candidate registered: [Name]" |
| Password reset | User | Standard WordPress reset email (styled) |

---

## ALL AJAX ACTIONS

| Action Hook | Triggered By | Does What |
|---|---|---|
| `pp_submit_application` | Candidate clicks Apply | Saves application to DB, sends email to employer |
| `pp_save_job` | Candidate clicks Save Job | Adds to pp_saved_jobs table |
| `pp_unsave_job` | Candidate clicks Remove | Removes from pp_saved_jobs |
| `pp_update_profile` | Candidate saves profile | Updates WP user meta |
| `pp_upload_cv` | Candidate uploads CV | Saves file, updates user meta with URL |
| `pp_post_job` | Employer submits form | Saves job with status=pending, emails admin |
| `pp_update_job` | Employer edits job | Updates job in DB |
| `pp_close_job` | Employer closes job | Sets status=closed |
| `pp_update_app_status` | Employer changes status | Updates status, emails candidate |
| `pp_update_company_profile` | Employer saves profile | Updates company meta |
| `pp_filter_jobs` | User applies filters | Returns filtered job HTML |
| `pp_admin_update_job_status` | Admin approves/rejects | Updates job, emails employer |
| `pp_admin_delete_job` | Admin deletes job | Removes from DB |
| `pp_admin_update_app_status` | Admin changes status | Updates application |
| `pp_admin_delete_inquiry` | Admin deletes inquiry | Removes from DB |
| `pp_admin_update_inquiry_status` | Admin marks replied | Updates inquiry status |
| `pp_contact_form` | Visitor submits contact | Saves to pp_inquiries, emails admin |

**All AJAX actions must:**
1. Verify nonce: `wp_verify_nonce($_POST['pp_nonce'], 'pp_nonce_action')`
2. Check login where required: `is_user_logged_in()`
3. Check role where required: `current_user_can('pp_post_jobs')`
4. Sanitize all inputs
5. Use `$wpdb->prepare()` for all queries
6. Return: `wp_send_json_success($data)` or `wp_send_json_error($message)`

---

## SECURITY RULES

1. Every form: `wp_nonce_field('pp_action', 'pp_nonce')`
2. Every AJAX handler: verify nonce before anything else
3. Employers: always filter DB queries by `employer_id = get_current_user_id()`
4. Candidates: always filter by `candidate_id = get_current_user_id()`
5. Admin pages: `if (!current_user_can('manage_options')) wp_die('Access denied');`
6. File uploads: check mime type (PDF/DOCX only), max 5MB, rename on upload
7. CV storage: `/wp-content/uploads/primepath-cvs/` — NOT publicly browsable (add .htaccess)
8. All DB inputs: `sanitize_text_field()`, `sanitize_email()`, `absint()`, `$wpdb->prepare()`
9. All HTML outputs: `esc_html()`, `esc_attr()`, `esc_url()`
10. SQL: NEVER concatenate user input directly into queries

---

## WORDPRESS PAGES TO CREATE IN WP ADMIN

Go to Pages → Add New and create all of these:

| Page Title | Slug | Template | Shortcode |
|---|---|---|---|
| Home | / | front-page.php | none |
| Jobs | /jobs/ | page.php | `[pp_job_board]` |
| For Employers | /for-employers/ | page-for-employers.php | none |
| For Candidates | /for-candidates/ | page-for-candidates.php | none |
| About Us | /about/ | page-about.php | none |
| Contact | /contact/ | page-contact.php | none |
| Candidate Portal | /candidate-portal/ | page.php | `[pp_candidate_portal]` |
| Employer Portal | /employer-portal/ | page.php | `[pp_employer_portal]` |
| Login | /login/ | page-login.php | `[pp_login_form]` |
| Register | /register/ | page-register.php | `[pp_register_form]` |
| Forgot Password | /forgot-password/ | page-forgot-password.php | none |

---

## NAVIGATION MENUS TO SET UP

### Primary Nav (public site):
Home | Jobs | For Employers | For Candidates | About | Blog | Contact

### Auth Nav (top right of header):
- If NOT logged in: Login | Register (as Employer)
- If logged in as candidate: My Portal | Logout
- If logged in as employer: My Portal | Logout
- If logged in as admin: Dashboard | Logout

### Footer Nav:
Column 1: Home | About | Blog | Contact
Column 2: Post a Job | Employer Portal | Employer Login
Column 3: Browse Jobs | Candidate Portal | Candidate Login
Column 4: Privacy Policy | Terms of Use | [Phone] | [Email]

---

## RESPONSIVE BREAKPOINTS

```css
/* Mobile first */
@media (min-width: 640px)  { /* small tablets */ }
@media (min-width: 768px)  { /* tablets */ }
@media (min-width: 1024px) { /* desktop */ }
@media (min-width: 1280px) { /* wide desktop */ }
```

Rules:
- Mobile: single column everything, hamburger menu, stacked stat cards
- Tablet: 2-column grids, collapsible sidebar in portals
- Desktop: full layout, fixed sidebar, 3-column grids

---

## DEPLOY TO CPANEL CHECKLIST

- [ ] Upload plugin folder to `/wp-content/plugins/primepath-hr-portal/`
- [ ] Activate plugin in WP Admin → Plugins
- [ ] Plugin activation runs `register_activation_hook` → creates DB tables + roles
- [ ] Upload theme folder to `/wp-content/themes/primepath-hr/`
- [ ] Activate theme in WP Admin → Appearance → Themes
- [ ] Create all pages (table above) with correct slugs and shortcodes
- [ ] Set up menus in Appearance → Menus
- [ ] Configure SMTP in PrimePath HR → Settings → SMTP
- [ ] Send test email from Settings page
- [ ] Set permalink structure: Settings → Permalinks → Post name (`/%postname%/`)
- [ ] Test: public can browse jobs without login
- [ ] Test: guest clicking Apply redirects to login
- [ ] Test: candidate can register, login, apply
- [ ] Test: employer can register, login, post a job
- [ ] Test: admin sees new job as pending, approves it
- [ ] Test: employer gets email when job approved
- [ ] Test: candidate gets email when application status changes
- [ ] Test: contact form saves inquiry and emails admin
- [ ] Test: all pages look correct on mobile

---

## AGENT CODING ORDER

Build in this exact order. Do not skip. After each item, output what was created.

```
PLUGIN FOUNDATION
1.  primepath-hr-portal.php         Main plugin file, plugin header, includes loader
2.  includes/class-database.php     Create all 4 DB tables on activation
3.  includes/class-roles.php        Register pp_employer and pp_candidate roles
4.  includes/class-security.php     Nonce helpers, permission check functions
5.  includes/class-upload.php       CV file upload handler

THEME FOUNDATION
6.  style.css                       Theme declaration + full design system CSS
7.  functions.php                   Enqueue scripts/styles, register menus, image support
8.  assets/css/main.css             Full public site styles (nav, hero, cards, footer, blog)
9.  assets/js/main.js               Mobile menu toggle, smooth scroll, sticky nav
10. header.php                      Navigation bar (logo, links, auth buttons, mobile menu)
11. footer.php                      Footer (4 columns, copyright bar)

PUBLIC PAGES
12. front-page.php                  Home page (all 9 sections)
13. page-for-employers.php          For Employers page (all sections)
14. page-for-candidates.php         For Candidates page (all sections)
15. page-about.php                  About Us page
16. page-contact.php                Contact page + inquiry form
17. home.php                        Blog listing page
18. single.php                      Single blog post template
19. index.php                       Generic fallback template
20. 404.php                         Not found page

AUTH PAGES
21. shortcodes/login-form.php       [pp_login_form] — login form + redirect logic
22. shortcodes/register-form.php    [pp_register_form] — role selector + registration
23. page-login.php                  Login page template
24. page-register.php               Register page template
25. page-forgot-password.php        Forgot password template
26. includes/class-ajax.php         pp_login_user, pp_register_user AJAX actions

JOB BOARD
27. shortcodes/job-board.php        [pp_job_board] — job cards, filters, search
28. template-parts/job-card.php     Reusable job card HTML
29. template-parts/modal.php        Reusable modal shell
30. includes/class-ajax.php         pp_filter_jobs, pp_submit_application AJAX

CANDIDATE PORTAL
31. shortcodes/candidate-portal.php [pp_candidate_portal] — full portal with tabs
32. assets/css/portal.css           Portal styles (sidebar, topbar, tabs, tables, stat cards)
33. assets/js/portal.js             Tab switching, modal open/close, all AJAX calls
34. includes/class-ajax.php         pp_save_job, pp_unsave_job, pp_update_profile, pp_upload_cv

EMPLOYER PORTAL
35. shortcodes/employer-portal.php  [pp_employer_portal] — full portal with tabs
36. includes/class-ajax.php         pp_post_job, pp_update_job, pp_close_job, pp_update_app_status, pp_update_company_profile

EMAIL NOTIFICATIONS
37. includes/class-email.php        All email functions (triggered from AJAX handlers)
38. Connect emails to all AJAX handlers that need them

ADMIN PANEL
39. admin/class-admin-menu.php      Register PrimePath HR menu in wp-admin
40. admin/views/dashboard.php       Stats + chart + recent tables
41. admin/views/jobs.php            Jobs management table + actions
42. admin/views/applications.php    Applications table + status management
43. admin/views/candidates.php      Candidates table
44. admin/views/employers.php       Employers table
45. admin/views/inquiries.php       Inquiries table (gold highlight for new)
46. admin/views/settings.php        4-tab settings page
47. admin/assets/admin-style.css    Admin panel styles
48. admin/assets/admin-script.js    Chart.js chart + admin AJAX calls
49. includes/class-ajax.php         All admin AJAX actions

FINAL PASS
50. Responsive CSS pass             Make every page work on mobile
51. Security audit                  Check nonces, capability checks, sanitization on every form/AJAX
52. Test all email notifications
53. Deploy checklist (run through table above)
```

---

## AGENT RULES

1. Never hardcode colors — use CSS variables only
2. Every form must have `wp_nonce_field()` — no exceptions
3. Every AJAX handler must call `wp_verify_nonce()` as the very first thing
4. All DB queries use `$wpdb->prepare()` — never raw string concatenation
5. Employers only see their own data — filter by `employer_id = get_current_user_id()`
6. Candidates only see their own data — filter by `candidate_id = get_current_user_id()`
7. All PHP functions prefixed `pp_` to avoid conflicts
8. No jQuery — use Vanilla JS and native `fetch()` for all AJAX
9. After completing each numbered item, state: "✅ [Item name] complete — [file path]"
10. If something is unclear, ask before writing code — not after
11. CV uploads stored in `/wp-content/uploads/primepath-cvs/` with a `.htaccess` deny-all in that folder
12. Every page must work on mobile — test at 375px width mentally before finishing
13. Never push to cPanel live site without confirmation from Rohan
```
