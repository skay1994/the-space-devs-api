## Installation and Usage

Follow the instructions below to install and use the project:

1. Clone this repository to your local machine:

```bash
git clone https://github.com/skay1994/the-space-devs-api the-space-devs-api
```

2. Navigate to the project directory:

```bash
cd the-space-devs-api
```

3. Start the server using Docker Compose:
```bash
docker-compose up -d
```

4. Access container ssh:
```bash
docker exec -it server /bin/sh
```

5. Inside the container, run the following command to install project dependencies using Composer:

```bash
composer install
```


6. Run the migrations to create the database tables:

```bash
php artisan migrate
```

7. Run the cron command to import data from The Space Devs project:

```bash
php artisan the-space-devs:launch-import
```

8. Access the API in your browser or API client:

```
http://localhost:8080
```

## API Endpoints

The following endpoints are available in the REST API:

- `POST /api/login`: Creates a new user token with email and password
- `POST /api/logout`: Removes a user token currently logged in
- `GET /api/`: Returns a message "REST Back-end Challenge 20210221 Running"
- `PUT /api/launchers/:launchId`: Responsible for receiving updates made
- `DELETE /api/launchers/:launchId`: Removes a launch from the database
- `GET /api/launchers/:launchId`: Retrieves information about a specific launch from the database
- `GET /api/launchers`: Lists the launchers from the database in a paginated manner
