# cPanel Lead Capture Analysis (Without Supabase)

Based on the files we reviewed in your custom `cpanel-mcp` setup (specifically `primepath-inquiry-manager.php` and `index.js`), here is the full analysis of how we can securely capture leads and employer inquiries from our React frontend directly into your cPanel hosting.

## 1. The Role of the MCP (Clarification)
The `cpanel-mcp` you built is incredibly powerful. It allows **me (the AI agent)** to securely automate your cPanel (upload files, create databases, list directories) via the cPanel UAPI. 

However, **a public website cannot use the MCP to save data**. The MCP requires your secret cPanel Token (`CPANEL_TOKEN`). If we put that in the React website code, anyone on the internet could see it and take full control of your server. 

Therefore, the MCP will be used by me to **deploy** your site and **setup the database**, but the actual lead capture needs to happen via a secure API script hosted on cPanel.

## 2. How We Will Capture Leads (The Architecture)

Since we are avoiding Supabase and relying 100% on your cPanel, the architecture will work like this:

### Step A: The Frontend (React/Vite)
When an employer fills out the form on `primepathuae.com/contact` and clicks submit, the React app will send a `POST` request (containing Name, Email, Phone, Message) to a specific URL on your server (e.g., `https://primepathuae.com/api/contact.php`).

### Step B: The Backend API (cPanel + PHP)
We will host a small, secure PHP script (`contact.php`) on your cPanel. 
This script will:
1. Receive the data securely from the React app.
2. Connect to a MySQL Database hosted on your cPanel.
3. Insert the lead into an `inquiries` table.
4. Send an automatic notification email to `info@primepathuae.com` using cPanel's native mail server.

### Step C: The Management Dashboard (WordPress or Custom PHP)
To view the leads, you have two choices based on the code I found in your folders:
- **Use WordPress:** I see you wrote `primepath-inquiry-manager.php`, which is a WordPress plugin that intercepts emails and saves inquiries to a database (`wp_primepath_inquiries`) with an admin panel. If we install WordPress on your cPanel, we can use this plugin as the backend!
- **Use Custom PHP:** We can build a simple, password-protected `admin.php` page on your cPanel to view the MySQL database directly, avoiding WordPress entirely.

## 3. How We Will Achieve This (Action Plan)

1. **Use MCP to Create Database:** I will use the `cpanel_execute_uapi` tool in your MCP to automatically create a new MySQL database and user on your cPanel.
2. **Write the API Script:** I will write the `api/contact.php` script and place it in your Vite project's `public` folder, so it gets uploaded alongside the React build.
3. **Connect React:** I will update the `Contact.jsx` form to `fetch('/api/contact.php', { method: 'POST' ... })`.
4. **Deploy:** I will build the React app (`npm run build`) and use your `cpanel_save_file` tool to upload the static HTML/JS/CSS and the PHP script to your `public_html` directory.

## Summary
By using this architecture, you completely own your data. There are no monthly fees to Supabase, no external dependencies, and all leads are saved directly to your own cPanel MySQL database.
