# Clarification Questions for PrimePath Architecture

To proceed with building the backend on your cPanel, please review and answer the following questions:

### 1. WordPress vs. Pure PHP
I noticed you have a WordPress plugin file (`primepath-inquiry-manager.php`). Do you plan to install WordPress on your cPanel to act as the backend administration panel (where you log in to see leads)? 
*Or* do you want the entire site to be 100% custom React + pure PHP, with no WordPress involved at all?

### 2. Database Status
Have you already created a MySQL database on your cPanel for PrimePath, or would you like me to use the `cpanel-mcp` to automatically create one for you?

### 3. Deployment Directory
When we make the site live, are we deploying this to the root `public_html` of `primepathuae.com`, or to a subfolder/subdomain?

### 4. Email Sending
Do you have an email address created on cPanel (like `info@primepathuae.com`) ready to receive notifications when a new lead submits the form?
