# Event Ticketing System API

A RESTful API for managing users, events, and bookings in an event ticketing system. Built with Node.js, Express, and MongoDB.

## Features

- User registration and login with JWT authentication
- Role-based access (user and admin)
- Create, read, update, and delete events (admin only)
- Book event tickets (user only)
- Secure booking validation with seat availability checks
- Catch-all 404 error handling with HTML and JSON responses

## Tech Stack

- Node.js
- Express
- MongoDB with Mongoose
- JWT (JSON Web Tokens)
- dotenv

## Folder Structure

├── controller/
├── middleware/
├── model/
├── routes/
├── config/
├── view/
├── server.js
├── .env
├── package.json

## Installation

1. Clone the repository
2. Run `npm install`
3. Add your `.env` file with `DATABASE_URI` and `ACCESS_TOKEN_SECRET`
4. Start the server: npm start

## API Base URL

`https://hlaing-653i.onrender.com/`

## License

This project is for educational purposes only.
