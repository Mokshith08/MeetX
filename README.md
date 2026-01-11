<h1 align="center">
  <img src="https://readme-typing-svg.demolab.com?font=Poppins&size=30&duration=4000&pause=1000&color=004AAD&center=true&vCenter=true&width=700&lines=MeetX+-+Meeting+Room+Booking+Platform"/>
</h1>

<p align="center">
  <strong>A modern, user-friendly meeting room booking system designed for academic and real-world use</strong>
</p>

---

## 📌 Overview

**MeetX** is a smart and intuitive meeting room booking web application designed to manage meeting room reservations efficiently within an organization. The system enables authenticated users to book rooms, manage bookings through a personalized dashboard, and calculate booking charges based on time duration — all through a clean, responsive interface.

This project is developed as a **DBMS Application-Oriented Mini Project**, demonstrating practical implementation of database concepts such as entity relationships, CRUD operations, and data integrity.

---

## 🎯 Problem Statement

Manual or unstructured meeting room booking often results in scheduling conflicts, poor utilization, and lack of accountability.  
**MeetX** addresses these challenges by providing a structured, reliable, and easy-to-use booking workflow.

---

## ✨ Key Features

### 🔐 Authentication
- User registration and login
- Session-based access control
- Validation for invalid or missing accounts

### 📅 Booking Management
- Date & time-based room booking
- Multiple meeting room options
- Input validation to prevent invalid bookings

### 💰 Fare Calculation
- Automatic calculation based on booking duration
- Hour-based pricing logic
- Fare preview before confirmation

### 📊 Dashboard
- View all bookings in one place
- Edit and delete bookings
- Profile information display

### 🧾 Summary & Invoice
- Booking summary before confirmation
- Invoice generation after booking
- Downloadable invoice format

### ⚠️ Error Handling
- User-friendly UI-based error messages
- Handling invalid navigation and missing data
- Network/offline detection

---

## 🛠️ Technology Stack

| Layer | Technologies |
|------|-------------|
| 🌐 Frontend | HTML, CSS, JavaScript |
| ⚙️ Backend | PHP |
| 🎨 Styling | Flexbox, CSS Grid, Responsive Design |
| 💾 Data Storage | Browser Storage (localStorage, sessionStorage) |
| 🧠 Architecture | Client-side simulation of DBMS operations |

---

## 🧠 DBMS Concepts Implemented

- Entity modeling (Users, Rooms, Bookings)
- One-to-Many relationships (User → Bookings)
- CRUD operations (Create, Read, Update, Delete)

---

## 🔄 Application Workflow

1. User registers or logs in.
2. Booking details are entered (date, time, purpose).
3. Meeting room is selected.
4. System validates inputs and calculates fare.
5. Booking summary is displayed.
6. Booking is confirmed and stored.
7. User manages bookings via dashboard.

---

## ▶️ How to Run

### Method 1: Without Backend (Typically for UI experience)
1. Open `index.html` in any modern web browser.
2. Register or log in to start using the application.

> Uses browser storage; no server or database required.

---

### Method 2: Using XAMPP (Recommended)
1. Copy the project folder to `xampp/htdocs/MeetX`.
2. Start **Apache** and **MySQL** in XAMPP.
3. Open `http://localhost/MeetX/index.html`.

---

## 📂 Project Structure

```
MeetX
│
├── backend/                     🗄️ Backend (PHP + MySQL)
│   ├── booking.php              
│   ├── calcFare.php             
│   ├── config.php               
│   ├── crud.php                 
│   ├── getRooms.php             
│   ├── invoice.php              
│   ├── login.php                
│   ├── logout.php               
│   ├── me.php                  
│   ├── mybookings.php           
│   ├── register.php            
│   └── session.php              
│
├── frontend/                    🎨 Frontend (HTML + CSS + JS)
│   ├── dashboard.html           
│   ├── editBooking.html         
│   ├── index.html               
│   ├── login.html               
│   ├── meet.html                
│   ├── pdf.html                 
│   ├── register.html            
│   ├── rooms.html               
│   └── summary.html             
├── img/                         🖼️ Favicon
│   ├── FullLogo.jpg
│   ├── icon.jpg
│   ├── hero.webp
│   └── avatar.jpg
│
├── vendor/                      📦 Composer dependencies
│
├── composer.json                # Composer configuration
├── composer.lock                # Composer lock file
│
└── README.md                    📘 Project documentation
```

---

## 📄 Project Report & Documentation

The complete academic documentation is included in this repository.

📘 **DBMS Mini Project Report**  
`report/MeetX.pdf`

The report includes:
- Abstract
- Literature Review
- Problem Statement & Objectives
- System Architecture
- Database Schema Diagram
- Functional & Non-Functional Requirements
- Results & Screenshots
- Conclusion & Future Scope

---

## 📱 UI & Responsiveness

- Fully responsive on desktop, tablet, and mobile
- Consistent and clean UI design
- Focus on usability and accessibility

---

## 🚀 Future Enhancements

- Admin role for managing rooms and users
- Email notifications

---

## 📄 License

This project is intended for educational and academic purposes only.
