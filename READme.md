Laravel Task Allocation Application
This application fetches to-do task information from two separate providers and assigns them to the development team on a weekly basis. The tasks are then displayed on the main page.

Requirements
PHP 8.0 or higher
Composer
Laravel 11
MySQL or any other database supported by Laravel
Features
Fetches tasks from two separate providers.
Allocates tasks to developers based on their capacity and the task's difficulty.
Displays the weekly task schedule for each developer.
Shows the minimum number of weeks required to complete all tasks.

Installation
Clone the repository:

bash
Copy code
git clone https://github.com/your-username/laravel-task-allocation.git
cd laravel-task-allocation
Install dependencies:

bash
Copy code
composer install
npm install
npm run build
Set up environment variables:

Copy .env.example to .env and configure your database and other environment variables:

bash
Copy code
cp .env.example .env
Update the .env file with your database credentials and other required configurations.

Run migrations:

bash
Copy code
php artisan migrate
Seed the database:

You can use seeders to populate the database with sample data:

bash
Copy code
php artisan db:seed --class=TaskSeeder
Run the application:

bash
Copy code
php artisan serve
Visit http://localhost:8000 in your browser to view the application.

Usage
Fetch Tasks Command
The application includes a command to fetch tasks from the providers. You can run this command manually or schedule it to run automatically.

Manual Execution
To fetch tasks manually, run:

bash
Copy code
php artisan fetch:tasks
Automatic Scheduling
To schedule the command to run weekly, you need to set up a cron job.

Open the crontab configuration:


### Points that need to be done for usage

1 - If you want to create a new API than you need to create new Provider in app/services directory.

2 - The coming data should be structured in a way like if it's a task then 

[
    {
        "id":1,
        "name":"Design Database",
        "duration":5,
        "difficulty":3
    }
]





bash
Copy code
crontab -e
Add the following line to run the Laravel scheduler every minute:

bash
Copy code
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
Replace /path-to-your-project with the actual path to your Laravel project directory.

Task Allocation Logic
The task allocation logic is handled by the TaskAllocator service. It allocates tasks to developers based on their capacity and the task's difficulty level.

Models and Database Structure
Developer: Represents a developer. Each developer has a capacity which defines the work they can complete in 1 hour.
Task: Represents a task fetched from the providers. Each task has a name, duration, and difficulty level.
DeveloperTask: Represents the pivot table for the many-to-many relationship between developers and tasks.
Seeder



License
This project is licensed under the MIT License - see the LICENSE file for details.

This README provides an overview of the project, setup instructions, and details on how to use the key features. Adjust the sections as needed to fit your project's specifics and add any additional details that may be relevant.






