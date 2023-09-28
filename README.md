
# Laravel Booking System

A Laravel application for booking seats on trips.

## Description

The Laravel Booking System is an application that allows users to book seats for specific trips. This README provides documentation for the `bookSeat` method, which handles seat bookings in the system.
## Installation

To get started with this Laravel project, follow these steps:

1. **Clone the Repository**: Clone this repository to your local machine using Git:

    ```bash
    git clone https://github.com/AbdallahMostafa/bus-booking-system
    ```
2. **Install Dependencies**: Navigate to the project's root directory and install the 
Build the containers and their Depedenecies:

    ```bash
    cd bus-booking-system
    bash init.sh
    ```
3. **Create Environment File**: Copy the `.env.example` file to `.env` and update it with your configuration settings such as database connection, app key, and other environment-specific variables:

    ```bash
    cp .env.example .env
    ```
4. **Generate Application Key (Docker)**: If you are running the Laravel project within a Docker container, you can generate the application key by executing the following command within the container:

   ```bash
   docker exec -it laravel php artisan key:generate

## Register User API

This endpoint allows users to register a new account.

### Request

- **Method**: POST
- **Endpoint**: `/api/register`
- **Headers**:
  - `Content-Type` (string): `application/json`

#### Request Body

The request body should contain JSON data with the following fields:

- `name` (string, required): The name of the user.
- `email` (string, required): The email address of the user.
- `password` (string, required): The user's password.

Example Request:

```json
POST /api/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```
## User Login API

This endpoint allows registered users to log in and obtain an authentication token.

### Request

- **Method**: POST
- **Endpoint**: `/api/login`
- **Headers**:
  - `Content-Type` (string): `application/json`

#### Request Body

The request body should contain JSON data with the following fields:

- `email` (string, required): The email address of the user.
- `password` (string, required): The user's password.

Example Request:

```json
POST /api/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

# Available Seats API

The "Available Seats" API provides information about the available seats on a specific trip between two stations. It allows you to check which seats are available for booking.

## Endpoint

- **URL**: `/api/available-seats`
- **HTTP Method**: GET
- **Headers**:
  - `Authorization` (string): A Bearer token for authentication.

## Request Parameters

- `departure_location_id` (string, required): The name of the departure station.
- `arrival_location_id` (string, required): The name of the arrival station.

## Response

- **HTTP Status Code**: 200 (OK)
- **Content Type**: JSON

### Successful Response

If there are available seats for booking, the API will respond with a JSON object containing an array of available seat numbers.

Example:
```json
{
  "available_seats": [1, 2, 3, 4, 5]
}
```
# Book Seats API

The `bookSeat` method is used to book a seat for a user on a specific trip.

### Request

- **Method**: POST
- **Endpoint**: `/api/book-seat`
- **Headers**:
  - `Authorization` (string): A Bearer token for authentication.

- **Parameters**:

  - `departure_location_id` (string): The name of the departure station.
  - `arrival_location_id` (string): The name of the arrival station.
  - `seat_id` (int): The ID of the seat to be booked.

### Response

#### Success Response

- **Status Code**: 200 OK
- **Data**:
  - `Booked Successfully` (object): Details of the reservation.

#### Error Response

- **Status Code**: 401 Unauthorized
- **Data**:
  - `error` (string): Error message indicating that the token is invalid.

- **Status Code**: 422 Unprocessable Entity
- **Data**:
  - `message` (string): Error message indicating that the seat is already booked or unavailable.

- **Status Code**: 500 Internal Server Error
- **Data**:
  - `message` (string): Error message indicating that an error occurred while booking the seat.

```POST /api/book-seat
Content-Type: application/json
Authorization: Bearer your-auth-token

{
  "departure_location_id": "Cairo",
  "arrival_location_id": "Asyut",
  "seat_id": 1
}
```
