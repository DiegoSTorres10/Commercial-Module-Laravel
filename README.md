# Commercial Module Laravel
## Overview
Commercial Module Laravel is a Laravel 8 project designed for business management. It integrates Laravel authentication, Bootstrap, Livewire, FullCalendar, and DomPDF to create a comprehensive system. The project includes a custom middleware, seeders, and factories for data generation. Modules such as Clients, Providers, Warehouse, and Products/Services are incorporated for streamlined business operations.

## Features

### Authentication and User Management
#### Login:
Secure authentication system to access each module.

#### User Registration:
Register new users with details such as name, email, role, password, and access modules (Clients, Providers, Warehouse, Products/Services).

------------


### Clients Module
#### Client Management:
CRUD operations for clients, including adding, editing, and deleting clients with delivery and billing addresses.

#### Follow-ups:
Schedule and track client follow-ups for needed revisions.

#### Quotations:
Create quotations for client purchases with the ability to print the information.

#### Sales:
Manage sales to clients or without registered clients, including printable sales receipts.


------------


### Products/Services Module
#### Product/Service Management:
CRUD operations with basic information, supplier details, currency type, supplier cost, and suggested price list.

#### Export to PDF:
Export product/service information to a PDF document.


------------


### Providers Module
#### Provider Management:
CRUD operations for providers.

------------


### Warehouse Module
#### Warehouse Management:
CRUD operations for warehouses with essential information.

#### Movement Registration:
Record product/service movements, including reasons, with printable receipts.

#### Inventory Query:
Query products/services in inventory with filters for warehouse, products, product classifier, or type (product or service).


## Installation and Usage
Clone the Repository:
- git clone https://github.com/DiegoSTorres10/Commercial-Module-Laravel.git
- cd Commercial-Module-Laravel


## Configure the Environment:

- Copy the .env.example file to .env and configure the necessary settings, including the database connection and application key.

Example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed

#### Start the Laravel Server:
php artisan serve
Access the Application:
Visit http://localhost:8000 in your browser to explore the Commercial Module Laravel.


------------



## Technologies Used
- Laravel 8: A PHP web application framework for building robust applications.
- Bootstrap: A front-end framework for responsive and mobile-first web development.
- Livewire: A full-stack framework for Laravel that makes building dynamic interfaces simple.
- FullCalendar: A JavaScript event calendar for displaying and managing events.
- DomPDF: A PHP library for generating PDF documents.
