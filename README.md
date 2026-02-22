# bloodbank---donor
Full-stack PHP Blood Bank Management System

Project Overview
The Blood Bank Management System is a full-stack PHP & MySQL application designed to manage blood donors, blood requests, and provide live tracking of donors.

This system allows:

Donors to register, login, and update their profile

Donors to request blood (with rare blood types marked as high priority)

Admins to view all donors and blood requests

Admins to track live donor locations on Google Maps

Admins to send SMS notifications to donors for urgent requests

Admins to add/remove donors and remove requests

The application has a professional UI with a background image and is mobile-friendly.

Features
Donor Side
Donor Registration with location tracking

Donor Login & Dashboard

Blood Request Submission

Rare blood requests flagged HIGH priority

Profile update including alternate phone number

Admin Side
Admin Login & Dashboard

View all registered donors

View all blood requests

Live donor map with clickable markers

Send SMS notifications to donors

Remove donors and remove requests

Professional UI
Background image for a modern look

Responsive forms & tables

Color-coded buttons for actions

Tech Stack
Frontend: HTML, CSS, JavaScript, Google Maps API

Backend: PHP 8.2

Database: MySQL

SMS Integration: Fast2SMS API

Screenshots
Home Page


Donor Dashboard


Admin Dashboard


Live Donor Map


Replace placeholders with actual screenshots before publishing.

Setup Instructions
1. Prerequisites
XAMPP / WAMP / LAMP installed

PHP 8.2+

MySQL

Google Maps API key

Fast2SMS API key

2. Clone the repository
Bash

git clone https://github.com/YOUR_USERNAME/bloodbank-management.git
3. Move to htdocs
Copy the cloned folder to C:\xampp\htdocs\bloodbank

4. Import Database
Open phpMyAdmin → http://localhost/phpmyadmin/

Create database bloodbank (or use the included SQL file)

Import bloodbank.sql (included in the repository)

5. Configure API Keys
Google Maps API: replace YOUR_GOOGLE_MAP_API in dashboard_admin.php

Fast2SMS API: replace YOUR_FAST2SMS_API_KEY in send_sms.php

6. Run the Project
Open browser and go to:

Plain text

http://localhost/bloodbank/index.php
Admin Credentials:

Username: admin

Password: 1234

Folder Structure
Plain text

bloodbank/
│ index.php
│ db.php
│ login_admin.php
│ login_donor.php
│ register_donor.php
│ dashboard_admin.php
│ dashboard_donor.php
│ remove_donor.php
│ remove_request.php
│ get_donors.php
│ send_sms.php
│ bloodbank.sql
│ assets/
│    background.jpg
Future Enhancements
Add email notifications

Add analytics dashboard for blood requests

Implement role-based access control

Mobile app integration

License
This project is open source and free to use for learning and educational purposes.

