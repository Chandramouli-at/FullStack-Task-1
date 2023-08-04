# FullStack-Task-1
A web application created for users.
It contains the following pages:
1. Home
2. Registration
3. Login
4. Profile

**Work Flow:**  Register -> Login -> Profile

# Tech Stack
The following tech stack is used to create this project:
1. HTML
2. CSS & BootStrap
3. JS
4. PHP
5. Redis
6. MongoDB
7. MySQL

# Code Format
The following methods are used to create this project.
1. **HTML, JS, CSS,** and **PHP** code are created in separate files, none of the codes co-exist in the same file.
2. **Jquery AJAX** is used for interacting with the backend without using form submission.
3. **CSS & BootStrap** is used in order to maintain page responsiveness.
4. **MySQL** is used for storing the registered data and **MongoDB** is used for storing the details of the user profiles.
5. **Prepared statements** in MySQL are used instead of simple SQL statements.
6. The login session is maintained on the browser's **localstorage** without using a PHP session.
7. **Redis** is used to store the session information in the backend.

# Issues

**Composer:**
 While installing the **MongoDB** extension in PHP, it showed the error "Class Not Found".
So, to resolve that **Composer** is used to install the MongoDB extension.

**Hosting:**
1. Tried hosting the frontend in **Netlify** and the backend in **InfinityFree** (free tier).
2. But it didn't work. It can't make HTTP requests from the frontend to the backend.
3. Because **Netlify** provides **HTTPS** support to the sites hosted in its domain while **infinityFree** does not provides **HTTPS** support on the sites hosted on its free tier. It only offers **HTTP**
support in the **free** tier.
4. So, we can't make a request to a **HTTP** site from a **HTTPS** site due to security measures.
5. Also **infinityFree** does not support **CORS** support in its **free** tier.

Therefore, the application is **not hosted online** but instead is created in the **local machine (localhost)**.

**Security:**
 Since the application is hosted on a **local machine**, it does not provide a **HTTPS connection**. So, the data sent to the backend is not secure. It can be resolved by implementing a **HTTPS connection**.

 # Installation
 To run the application you need these to be installed on your local machine:
 1. PHP
 2. MySQL
 3. MongoDB
 4. Redis
 5. Composer(In my case, Manual installation of the MongoDB extension had many issues. So, I used Composer to install MongoDB).

**PHP**
1. One easiest way to install PHP is **XAMPP**. XAMPP is a widely used package that includes Apache, PHP, MySQL, and Perl.
2. Another way is to install **PHP manually** from the official website [PHP Download](https://windows.php.net/download/).
3. Add the path to the environment variables.

**MySQL**
1. **XAMPP** also has MySQL in it. You can use that to connect PHP with MySQL.
2. Or you can download and install **MySQL workbench** on your local machine from the official website [MySQL Download](https://dev.mysql.com/downloads/).

**MongoDB**
1. You can use **MongoDB cloud** online by creating an account in it and initializing a cluster.
2. Or you can download and install **MongoDB Compass** on your local machine from the official website [MongoDB Compass](https://www.mongodb.com/products/compass).

**Redis**
1. You can download and install **Redis** on your local machine from the official website [Redis Download](https://redis.io/).
2. Add the path to the environment variables.

**Composer**
1. You can download and install **Composer** from the official website [Composer Download](https://getcomposer.org/download/).
2. You can also install **Composer** using command-line tools.
3. Add the path to the environment variables.

# How to Run?
To run the application you have to follow these:
1. Start the PHP server
2. Start the Redis Server
3. Start the MySQL Server
4. Start the MongoDB Server(No need, if MongoDB Cloud is used).
5. Ensure that you have the **.env** file.
6. Ensure that you run `composer install` once. (No need to install every time. Install only at the first time)

**Start PHP Server**
1. If you are using **XAMPP**, start the PHP server in the XAMPP.
2. If you are using a **command prompt**, use the command `php -S localhost:port` in the source directory. You can specify the port. (If you want to start the php server from any directory, make sure you put the path of **PHP** in the environment variables). (If the server is not starting, make sure you have no other PHP process running in the background. This can be checked in the **process** tab in the task manager.)

**Start Redis Server**
1. You can start the **Redis** server as a startup service. This can be done during the installation of the Redis.
2. If you are using a **command prompt**, use the command `redis-server` from the source directory. (If you want to start the Redis server from any directory, make sure you put the path of **Redis** in the path in the environment variables). (If the server is not starting, make sure you have no other Redis process running in the background. This can be checked in the **process** tab in the task manager.)

**Start MySQL Server**
1. If you are using **XAMPP**, start the MySQL server in the XAMPP.
2. Use **MySQL workbench**, if you run it on the local machine.
3. Make sure you have the required host details and database details and store them in the `.env` file. 

**Start MongoDB Server**
1. Use **MongoDB Compass**, if you run it on the local machine or **MongoDB Cloud** if you want it online.
2. Make sure you have the required host details and database details and store them in the `.env` file.

**.env File**
1. Make sure you have the `.env` file in the `php/` directory.
2. Add the required details for the **configuration** of **MySQL** and **MongoDB**. (The names of the keys must be the same in both the code and the .env file).
3. The keys used in this `.env` file are `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`, `MONGO_CLUSTER`, `MONGO_DATABASE`, `MONGO_COLLECTION`.

**Composer Files**
1. To connect **MongoDB** with the **PHP**. Use the command `composer install` once. It installs the necessary dependencies used to connect MongoDB with PHP. (If "composer: command not found", make sure you have the composer path in the environment variables)
