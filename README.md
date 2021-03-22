Assignment 01 : Mini CRM\
Built using Laravel 8

-   [x] Basic Laravel Auth: ability to log in as administrator
-   [x] Use database seeds to create first user with email admin@admin.com and password “password”
-   [x] CRUD functionality (Create / Read / Update / Delete) for two menu items: Companies and Employees.
-   [x] Companies DB table consists of these fields: Name (required), email, logo (minimum 100×100), website
-   [x] Employees DB table consists of these fields: First name (required), last name (required), Company (foreign key to Companies), email, phone
-   [x] Use database migrations to create those schemas above
-   [x] Store companies logos in storage/app/public folder and make them accessible from public
-   [x] Use basic Laravel resource controllers with default methods – index, create, store etc.
-   [x] Use Laravel’s validation function, using Request classes
-   [x] Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page
-   [x] Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to register
-   [x] Use Datatables.net library to show table – with or without server-side rendering
-   [x] Use more complicated front-end theme like AdminLTE
-   [x] Email notification: send email whenever new company is entered (use Mailgun or Mailtrap)
-   [x] Make the project multi-language (using resources/lang folder)
-   [x] Basic testing with phpunit
