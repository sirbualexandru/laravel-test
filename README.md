
### test example: WebApp Jobs posting

# Develop a small app (Jobs posting/apply application).

## It should include next features:

1. 2 types of users : Employer and Candidate (with registration).
2. Job posting (Mandatory inputs : Job name, Job Category, Experience, Salary, Description ).
3. Job applying. A candidate can click apply button and it automatically will be registered as candidate to current job. Candidate in his profile will need to indicate next: Name, Surname, Phone, Email, Address, Experience, Skills description, Wanted salary (optional).
4. Employer will be able to see the list of candidates that apply to his jobs offers.
5. Develop on MVC framework Laravel 5.*.
6. Try to use OOP. Classes, Interfaces, Inheritance, encapsulation implementation will be a great plus.


## For install this app:

1. Clone app from repository
2. Make: composer install.
3. Make .env file from example file: .env.example and set your DB credentials and create your DB.
4. Install migrations and seeds: 
	php artisan migrate
	php artisan db:seed

## For testing
###- For testing are created 2 roles : 
#### email employer@test.com    | password employer
#### email candidate@test.com   | password candidate

###- You can create new users through the registration form. It's important to choose the role from employer and candidate.
