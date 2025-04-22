# Sr. Full Stack Developer Assessment For DWebPixel

**Objective:**

We are developing a Job Portal web application where administrators can create job postings, and users can view these postings from their dashboards. The app uses a Role and Permissions system to manage user and admin functionality. Authentication is already implemented and functional.

Kindly clone this repository, complete the assigned task, and upload the code to a **new public repository** under your GitHub profile. Once done, please share the link to this new repository as a reply to the assessment-related email you received from our HR team.


---

**Notes:**

Icons and Logos shown in job post card as already provided. Use Icon component to display the icons

**Admin Email**: admin@example.com | **Admin Password**: password

**User Email**: user@example.com | **User Password**: password
# DWebPixel-assesment

**Project Setup Steps:**

To get the project up and running on your local machine, please follow these steps:

1.  **Clone the Repository:**
    Open your terminal or command prompt and navigate to the directory where you want to clone the project. Then, run the following command:
    ```bash
    git clone <repository_url>
    ```
    *(Replace `<repository_url>` with the actual URL of the repository you cloned.)*

2.  **Copy Environment File:**
    Navigate into the project directory in your terminal:
    ```bash
    cd DWebPixel-assesment
    ```
    Copy the contents of the `.env.example` file into a new `.env` file using the following command:
    ```bash
    cp .env.example .env
    ```

3.  **Install Composer Dependencies:**
    Next, you need to install the PHP dependencies using Composer. Make sure you have Composer installed on your system. Run the following command in the project directory:
    ```bash
    composer install
    ```
    This command will download and install all the PHP packages listed in the `composer.json` file, creating the `vendor` folder.

4.  **Generate Application Key:**
    Generate a unique application key for your Laravel application by running the Artisan command:
    ```bash
    php artisan key:generate
    ```
    This command will update the `APP_KEY` value in your `.env` file.

5.  **Create SQLite Database File:**
    Create an empty SQLite database file. You can do this using the `touch` command in your terminal:
    ```bash
    touch database/database.sqlite
    ```
    Ensure you are in the root directory of your project when running this command.

6.  **Install Node Dependencies:**
    Install the required Node.js packages by running:
    ```bash
    npm install
    ```
    This command will download and install all the necessary packages listed in the `package.json` file, creating the `node_modules` folder.

7.  **Generate Database Schema and Seed Initial Data:**
    The project is configured to use an SQLite database. Run the following Artisan command to create the database tables and seed initial data (including admin and user credentials):
    ```bash
    php artisan migrate:fresh --seed
    ```
    This command will:
    * Run all the migrations to create the database schema in the `database/database.sqlite` file.
    * Execute the seeders, which will populate the database with initial data.

8.  **Create Storage Link:**
    Create a symbolic link to make the uploaded files accessible from the `public` directory:
    ```bash
    php artisan storage:link
    ```

9.  **Run Development Servers:**
    Open two separate terminal windows or tabs.

    **In the first terminal, start the Laravel development server:**
    ```bash
    php artisan serve
    ```
    This will typically run the application at `http://127.0.0.1:8000`.

    **In the second terminal, start the Vite development server for frontend assets:**
    ```bash
    npm run dev
    ```
    This will compile your Vue.js components and other frontend assets and enable hot module replacement for a smoother development experience.

**After completing these steps, you should be able to access the application in your web browser (usually at `http://127.0.0.1:8000`) and start working on the assessment task. You can log in using the provided credentials.**