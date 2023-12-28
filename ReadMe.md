# Project Overview

This project is a news application with a separate frontend and backend. The backend is designed using the SOLID, DRY, and KISS principles, combined with a service and repository pattern. Although it is currently monolithic, it can be easily broken down into microservices due to its modular nature. The frontend is designed using an atomic approach, where each component is broken down and reused. We have also utilized the Context API and custom hooks for state management and side effects.

## Backend(check Readme in backend folder)

### Design Principles

- **SOLID**: The backend is designed using SOLID principles to ensure that it is easy to maintain, understand, and scale.
- **DRY (Don't Repeat Yourself)**: We have ensured that the codebase is DRY, meaning there is minimal repetition of code.
- **KISS (Keep It Simple, Stupid)**: The KISS principle has been followed to keep the codebase simple and understandable.

### Architecture

The backend follows a service and repository pattern. This ensures that the business logic and data access rules are separated, making the codebase easier to manage and scale.

Although the backend is currently monolithic, it is designed in such a way that it can be easily broken down into microservices if needed. This is due to the modular nature of the codebase.

## Frontend(check Readme in frontend folder)

The frontend is designed using an atomic approach. This means that each component is broken down into smaller, reusable parts. This approach helps in maintaining consistency across the application and makes it easier to manage and update components.

We have used the Context API for state management. This allows us to share state across multiple components without prop drilling.

Custom hooks are used for handling side effects in the application. This helps in reusing logic across different components and makes the codebase cleaner and easier to understand.

## Getting Started

### With Docker:

1. copy the .env.example file to .env and fill in the necessary environment variables.(for demo purpose .env.example is the actual .env)
2. Run `docker-compose up -d` (in detach mode), this will spin off a docker container and install all the necessary dependencies.
3. The backend will be served on port 8000.
4. The frontend will be served on port 5173.
5. Visit `http://localhost:5173`.

### Without Docker:

1. Go to the backend folder and run `composer install & php artisan migrate & php artisan serve`.
2. Then go to the frontend folder and run `npm install & npm run dev`.
3. Visit `http://localhost:5173`.

## Running the tests

### Backend:

Go to the backend folder and run `composer test`.

### Frontend:

Go to the frontend folder and run `npm test`.

## Future Work

While the project is currently functional and robust, there are several enhancements and features that could be implemented in the future. Due to time constraints, these have not been included in the current version, but they represent potential areas for growth and improvement.

1. **Redux**: Although the Context API has been used for state management, Redux could be introduced for more complex state management scenarios. Redux offers a more structured approach to state management and could be beneficial as the application grows.

2. **Redis**: Redis could be used for caching and session management, improving the performance and scalability of the application.

3. **Additional Use Cases**: There are numerous other use cases that could be implemented to enhance the functionality of the application. These could include more complex filtering options, user authentication, and personalized news feeds.

These are just a few of the potential enhancements that could be made. The project has been designed with scalability and extensibility in mind, and these future improvements would further enhance its capabilities.

