# Casino Brand Toplist Crud

A simple PHP + MySQL CRUD app to manage and display a top list of brands, with geolocation-based filtering using the Cloudflare `CF-IPCountry` header.

---

## Project Structure

```

project-root/
├── docker/
│   ├── Dockerfile
│   └── docker-compose.yml
├── backend/
│   ├── src/
│   │   ├── BrandModel.php
│   │   ├── BrandController.php
│   │   ├── Database.php
│   │   └── database.sql
│   ├── index.php
│   └── composer.json
├── frontend/
│   ├── index.html
│   ├── manage.html
│   ├── style.css
│   ├── manage.css
│   ├── script.js
│   └── manage.js
└── README.md

````

---

## How to Run with Docker

1. Make sure Docker and Docker Compose are installed.

2. From the project root, run:

```bash
docker-compose -f docker/docker-compose.yml up --build
````

3. Access the app in your browser:

* Frontend listing: [http://localhost:8080/index.html](http://localhost:8080/index.html)
* Admin manage page: [http://localhost:8080/manage.html](http://localhost:8080/manage.html)
* Backend API: [http://localhost:8000/api/brands](http://localhost:8000/)

---

## Notes

* Backend is served by PHP 8 + Apache on port 8000.
* Frontend is served by Nginx on port 8080.
* Database is MySQL 8 with initial seed data from `backend/src/database.sql`.
* Backend sends CORS headers to allow API access from frontend.
* Frontend JavaScript calls backend API at `http://backend/` inside Docker network, and `http://localhost:8000/` from your browser.

---

## Running Without Docker

* Import `backend/src/database.sql` into your MySQL database.
* Configure database connection in `backend/src/Database.php`.
* Serve backend PHP files with your web server.
* Open frontend files in browser or serve via static server.
* Update frontend JS API URLs accordingly.

---

## API Endpoints

| Method | Endpoint | Description          |
| ------ | ------- | -------------------- |
| GET    | `/`  | Get list of brands   |
| POST   | `/`  | Create a new brand   |
| GET    | `/{id}` | Get a brand by ID    |
| PUT    | `/{id}` | Update a brand by ID |
| DELETE | `/{id}` | Delete a brand by ID |


