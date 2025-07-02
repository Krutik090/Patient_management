```markdown
# 🏥 Patient Management System (PHP + MySQL)

A web-based patient management system built using PHP and MySQL. This project allows hospitals or clinics to efficiently manage patient records, appointments, and medical information through a clean and functional interface.

---

## 📌 Overview

Managing patient records manually is outdated and error-prone. This application offers a simple web portal that stores, retrieves, updates, and deletes patient data from a MySQL database. It’s ideal for small clinics, educational demonstrations, or as a base for a more advanced health system.

---

## 🚀 Features

- Add new patients with relevant details
- View patient list with basic details
- Update existing patient information
- Delete patient records
- Fully built using core PHP and MySQL
- Simple web interface (HTML/CSS + Bootstrap)

---

## 🗂 Directory Map


Patient\_management/
├── config/                 # Database connection script
├── css/                    # Stylesheets
├── js/                     # JavaScript files
├── index.php               # Dashboard or home page
├── add\_patient.php         # Form to add new patients
├── edit\_patient.php        # Edit form
├── delete\_patient.php      # Record deletion
├── view\_patients.php       # Table/list view of all patients
├── db.sql                  # MySQL dump file for database setup
├── README.md               # Project documentation
└── LICENSE                 # License info


---

## ⚙️ Technologies Used

- PHP 7+
- MySQL
- HTML5, CSS3
- Bootstrap (for UI styling)
- JavaScript (for interactivity)

---

## 🛠️ How to Run Locally

1. **Clone this repo**
   ```bash
   git clone https://github.com/Krutik090/Patient_management.git
   cd Patient_management
````

2. **Import the database**

   * Open phpMyAdmin (or MySQL CLI)
   * Create a new database, e.g., `patient_db`
   * Import the `db.sql` file into it

3. **Configure database connection**

   * Edit `config/db.php` or similar file
   * Update the database name, username, and password

4. **Run the project**

   * Start Apache and MySQL (e.g., via XAMPP/LAMP/WAMP)
   * Navigate to `http://localhost/Patient_management/`

---

## ✅ To-Do (Suggestions)

* [ ] Add user authentication (admin login)
* [ ] Search/filter functionality
* [ ] Export patient records to PDF or Excel
* [ ] Add patient medical history & reports

---

## 📄 License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.

---

## 👤 Author

**Krutik Thakar**
🔗 GitHub: [@Krutik090](https://github.com/Krutik090)

---

## 🤝 Contributions

Pull requests and ideas are welcome. Feel free to fork and improve the system for your needs.

---

## ⭐ Support

If you found this project useful, don’t forget to give it a ⭐ on GitHub!

````

---

## `LICENSE` File (MIT License)

Create a file named `LICENSE` in the root directory and paste this:

```text
MIT License

Copyright (c) 2025 Krutik Thakar

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell      
copies of the Software, and to permit persons to whom the Software is          
furnished to do so, subject to the following conditions:                       

The above copyright notice and this permission notice shall be included in     
all copies or substantial portions of the Software.                            

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR     
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,       
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE    
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER         
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,  
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE  
SOFTWARE.
````
