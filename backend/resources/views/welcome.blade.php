<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News API Backend</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6 mr-2 bg-gray-100 dark:bg-gray-800 sm:rounded-lg">
                            <h1 class="text-4xl sm:text-5xl text-gray-800 dark:text-white font-extrabold tracking-tight">
                                Welcome to the News API Backend!
                            </h1>
                            <p class="text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400 mt-2">
                                Your one-stop solution for managing and serving news data.
                            </p>
                        </div>
                        <div class="p-6 mt-6 text-center">
                            <h1 class="text-2xl sm:text-3xl text-gray-800 dark:text-white font-extrabold tracking-tight">
                                Getting Started
                            </h1>
                            <p class="text-normal text-lg sm:text-xl font-medium text-gray-600 dark:text-gray-400 mt-2">
                                To get started, please refer to the documentation.
                            </p>
                            <div class="mt-4">
                                <a href="https://your-documentation-link.com" class="text-blue-500 hover:text-blue-700 font-semibold">Read the documentation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>