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
3. Because **Netlify** provides **HTTPS** support to the sites hosted in its domain while **infinityFree** does not provides **HTTPS** support on the sites hosted on its free tier. It only offer **HTTP**
support in the **free** tier.
4. So, we can't make a request to a **HTTP** site from a **HTTPS** site due to security measures.
5. Also **infinityFree** does not support **CORS** support in its **free** tier.

Therefore, the application is **not hosted online** but instead is created in the **local machine (localhost)**.

**Security:**
 Since the application is hosted on a **local machine**, it does not provide **HTTPS connection**. So, the data sent to the backend is not secure. It can be resolved by implementing a **HTTPS connection**.
