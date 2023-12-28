# Backend Architecture and Approach

The backend is designed as a monolithic structure, but its modular nature allows for potential microservice architecture if required. I've leveraged Laravel's built-in Sanctum authentication to secure the application.

## Design Patterns and Dependency Management

I've adopted the Service and Repository patterns to ensure a clean, scalable, and testable codebase.

- **Service Pattern**: Encapsulates all business logic, ensuring that the controllers remain lean and primarily handle request/response tasks.
- **Repository Pattern**: Abstracts the data layer, enhancing the application's flexibility to changes in the data source.

I've also employed Dependency Injection throughout the codebase to ensure loosely coupled classes and easier testing. This strategy allows me to substitute dependencies without modifying the class that uses them.

For instance, the `ElasticsearchClient` class demonstrates my use of Dependency Injection to boost performance. By binding the `ElasticsearchClient` to the service container, I reuse the same instance across the application, reducing the overhead of creating a new client for each request. This strategy also offers the flexibility to alter the Elasticsearch host or port without modifying the classes that use the client.

## Services

- `ScrapeNewsService`: Responsible for scraping news from various sources and storing them in the database.
- `IndexNewsService`: Responsible for indexing the news in Elasticsearch.
- `SearchNewsService`: Responsible for searching the news in Elasticsearch.
- `NewsFeedService`: Responsible for personalizing the news for the user.

## Repositories

- `UserPreferencesRepository`: Handles user preferences.

## Schedulers

- `NewsScrape`: Dispatches `NewsScrapeJob` every hour at 15 minutes past the hour, utilizing `ScrapeNewsService` to scrape news from various sources and store them in the database.
- `IndexNews`: Dispatches `IndexNewsJob` every hour at 17 minutes past the hour, utilizing `IndexNewsService` to index the news in Elasticsearch.

## Database

- `users`: Stores user details.
- `user_preferences`: Stores user preferences.
- `news`: Stores news.
- `jobs`: Stores jobs.

## Hacks

- Each migration includes a check for table existence to avoid errors when running migrations, particularly useful when deploying on the production server.
- Instead of `$request->validation`, I've utilized Laravel's `FormRequest` for more readable and maintainable code.
