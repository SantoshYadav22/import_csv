# Contact Management Application

This Laravel application allows users to import and export contacts from Excel files (CSV or XLSX format). It includes user authentication, CRUD operations for the Contact module, navigation, and sorting of results.

## Features

- User Authentication
- CRUD Structure for Contacts
- Import Contacts from CSV/XLSX Files
- Export Contacts to CSV/XLSX Files
- Pagination and Navigation
- Sorting of Contact Results

## Requirements

- PHP >= 7.4
- Composer
- Laravel 10.x
- MySQL or any other database supported by Laravel

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/SantoshYadav22/import_csv.git
    cd contact-management
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. Configure your database in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=contact_manager
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. Run migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6. Serve the application:

    ```bash
    php artisan serve
    ```

## Usage

### User Authentication

- Register a new account or log in with existing credentials.

### Managing Contacts

- Navigate to the Contacts section to create, view, edit, or delete contacts.
- Use the import functionality to upload contacts from CSV or XLSX files.
- Use the export functionality to download contacts in Excel format.
- Navigate through the contact records using pagination links.
- Sort contacts by different columns to organize the data as needed.

### Importing Contacts

- Go to the import page and select a CSV or XLSX file.
- Ensure the file contains the correct columns: `name`, `email`, `phone`.
- Click "Import" to upload the contacts.

### Exporting Contacts

- Click the "Export" button to download the contact list in Excel format.

## Pagination and Sorting

- The contact list supports pagination for easy navigation through records.
- Sorting functionality allows sorting by different columns.

### Note

Ensure you have the required permissions and access to the necessary files and environment to run this application successfully.
