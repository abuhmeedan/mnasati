## How to Run This Project

1. **Clone the repository**

    ```bash
    git clone <your-repo-url>
    cd mnasati
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Copy and configure environment file**

    ```bash
    cp .env.example .env
    ```

    Edit `.env` and set your database credentials (e.g. `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Run migrations and seeders**

    ```bash
    php artisan migrate --seed
    ```

6. **Build frontend assets**

    ```bash
    npm run build
    ```

    Or for development:

    ```bash
    npm run dev
    ```

7. **Start the development server**
    ```bash
    php artisan serve
    ```
    Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

**Default Admin Login:**

-   Email: `admin@abuhmeedan.com`
-   Password: `Ww1234567`

**Default User Login:**

-   Email: `waleed@abuhmeedan.com`
-   Password: `Ww1234567`

---

**Notes:**

-   Make sure your database is running and accessible.
-   For admin features, log in with the admin credentials.
