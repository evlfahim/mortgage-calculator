Laravel Mortgage Calculator
This is a Laravel-based Mortgage Loan Calculator application. It helps users estimate their monthly mortgage payments and provides an amortization schedule.

Prerequisites
PHP >= 8.3
Composer - Install Composer
MySQL or any other database supported by Laravel
Git - Install Git
Getting Started
Clone the repository to your local machine:

git clone https://github.com/evlfahim/mortgage-calculator.git
Install dependencies:

cd laravel-mortgage-calculator
composer install
Create a copy of the .env.example file and rename it to .env:

cp .env.example .env
Configure the .env file with your database details:

env:
DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Generate an application key:

php artisan key:generate
Run the database migrations and seed the database:

php artisan migrate --seed
Serve the application:

php artisan serve
The application will be available at http://localhost:8000.

Usage
Open your web browser and go to http://localhost:8000.
Use the Mortgage Loan Calculator to input loan details and calculate monthly payments.
Explore the amortization schedule and extra repayment schedule.

Testing:
The application includes a set of feature tests using Laravel's testing tools. These tests ensure that critical parts of the application, such as the loan calculation and the calculator page, function correctly. To run the tests, use the following commands:
php artisan test

Contributing
If you'd like to contribute to this project, please follow these steps:

Fork the repository.
Create a new branch: git checkout -b feature/your-feature-name
Make your changes and commit them: git commit -m 'Add some feature'
Push to the branch: git push origin feature/your-feature-name
Submit a pull request.
License
This project is licensed under the MIT License - see the LICENSE file for details.