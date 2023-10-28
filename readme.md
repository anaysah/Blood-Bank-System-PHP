This is php project on
# Blood Bank System

The Blood Bank System is a web-based application designed to manage blood donation and distribution processes. It provides a platform for hospitals, donors, and receivers to effectively coordinate blood supply, request blood samples, and ensure the availability of blood products.

# Demo Accounts
these are some emails and password to login and test the application
- **Hospital**
    - cityhospital@example.com securepass
    - safecare@example.com password123
- **Receiver**
    - karen@example.com karenpass

you can see more sample accounts in sampleData folder

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript, Bootstrap

- **Backend**: PHP, MySQL

## File Stuture

- **includes**: This folder has all the files which are not used for frontend and only for backend processes
- **sampleData**: This folder has php files to add sample data into the receiver and hospitale table
- **templates**: This folder has all the templates which are included in other files. Files in this folder is not direclty used for frontend
- **auth**: Login and Register page

## Installation

1. Clone the repository: `git clone https://github.com/anaysah/Blood-Bank-System-PHP.git`

2. Configure the database settings in `dbh.inc.php`. This file is responsible for database connectivity

3. Import the SQL schema into your MySQL database from `bloodbanksystem.sql`.

4. Use xampp and place the whole directory in htdocs or use a local development environment.

5. Access the application in your web browser.

## License

This project is open-source and available under the [MIT License](LICENSE.md).