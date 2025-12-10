# Osol Task API

A robust RESTful API for managing tasks and categories, built with Laravel. This application provides a backend service to create, read, update, and delete tasks, organize them into categories, and filter them based on priority and completion status.

## Table of Contents
- [Setup Instructions](#setup-instructions)
- [Environment Configuration](#environment-configuration)
- [API Documentation](#api-documentation)
- [Database Design](#database-design)
- [Assumptions](#assumptions)
- [Testing](#testing)

## Setup Instructions

Follow these steps to get the project up and running on your local machine.

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL or compatible database

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Drrrose/Osolutions-task
   cd Osolutions
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   ```

3. **Environment Setup:**
   Copy the example environment file to create your local configuration.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Configure Database & Token:**
   Open the `.env` file and update your database credentials and the API authentication token.
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   # Set your static API Token here
   TOKEN=my-secret-token-123
   ```

6. **Run Migrations and Seeders:**
   Create the database tables and populate them with initial data.
   ```bash
   php artisan migrate --seed
   ```

7. **Start the Server:**
   ```bash
   php artisan serve
   ```
   The API will be accessible at `http://localhost:8000/api`.

## Environment Configuration

The application relies on standard Laravel `.env` configuration. Key custom variables include:

*   **`TOKEN`**: A static string used for Bearer Token authentication. This must match the token sent in the `Authorization` header of your requests.

## API Documentation

The API adheres to RESTful principles. All responses are in JSON format.

### Authentication
All endpoints require a Bearer Token.
**Header:** `Authorization: Bearer <your-configured-token>`

### Endpoints

#### Categories

*   **List Categories**
    *   `GET /categories`
    *   Returns a list of all available task categories.

*   **Get Single Category**
    *   `GET /categories/{id}`
    *   Returns details for a specific category.

#### Tasks

*   **List Tasks**
    *   `GET /tasks`
    *   **Query Parameters:**
        *   `priority` (optional): Filter by priority (e.g., `high`, `medium`, `low`).
        *   `completed` (optional): Filter by status (`1` for completed, `0` for pending).
    *   **Example:** `GET /tasks?priority=high&completed=0`

*   **Create Task**
    *   `POST /tasks`
    *   **Body (JSON):**
        ```json
        {
            "title": "Finish Backend Assessment",
            "description": "Write documentation and generate postman collection",
            "priority": "high",
            "category_id": 1,
            "due_date": "2025-12-30"
        }
        ```

*   **Get Single Task**
    *   `GET /tasks/{id}`
    *   Returns details for a specific task.

*   **Update Task**
    *   `PATCH /tasks/{id}`
    *   **Body (JSON):**
        ```json
        {
            "title": "Update: Finished Assessment",
            "completed": true
        }
        ```

*   **Delete Task**
    *   `DELETE /tasks/{id}`
    *   Removes a task permanently.

## Database Design

The database consists of two primary tables to manage the core logic:

1.  **`categories`**
    *   `id`: Primary Key.
    *   `name`: Name of the category (e.g., Work, Personal).
    *   `color`: Hex code or string for UI display.
    *   `icon_url`: URL for category icon.
    *   `image_filter` & `image_seed_offset`: Used for frontend image generation/display logic.

2.  **`tasks`**
    *   `id`: Primary Key.
    *   `title`: Short title of the task.
    *   `description`: Detailed explanation.
    *   `priority`: String value (e.g., "high", "medium").
    *   `category_id`: Foreign Key referencing `categories(id)`.
    *   `due_date`: Date when the task is due.
    *   `completed`: Boolean status (`0` or `1`).
    *   `image_url`: Optional image attachment.

**Relationships:**
*   A **Category** has many **Tasks**.
*   A **Task** belongs to one **Category**.

## Assumptions

*   **Authentication:** The system uses a simple static Bearer Token mechanism for authentication, suitable for service-to-service communication or simple client access, rather than a full user session/OAuth system (like Sanctum or Passport).
*   **User Scope:** The current implementation treats tasks as global resources accessible to anyone with the valid API token. There is no `user_id` on the tasks table, implying a single-tenant or shared workspace model.
*   **Priority:** Task priority is implemented as a simple string field allowing flexibility, rather than a strict database ENUM.

## Testing

### Automated Tests
Run the included Laravel Feature and Unit tests using Artisan:
```bash
php artisan test
```

### Manual Testing (Postman)
A Postman collection is included in the root directory: `Osol Task API.postman_collection.json`.

1.  Open Postman.
2.  Import the `Osol Task API.postman_collection.json` file.
3.  Set the `base_url` collection variable to `http://localhost:8000/api`.
4.  Set the `token` collection variable to the value you defined in your `.env` file (e.g., `my-secret-token-123`).
5.  Run the requests to verify API functionality.