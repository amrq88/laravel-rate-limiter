
# Laravel Rate Limiter

This project implements a rate limiter for a Laravel application, providing protection against excessive requests and potential abuse.

## Features

- Simple integration with Laravel framework.
- Configurable request limits.
- Middleware for applying rate limits on specific routes.

## Installation

1. Clone the repository:

```sh
git clone https://github.com/amrq88/laravel-rate-limiter.git
cd laravel-rate-limiter
```

2. Install dependencies:

```sh
composer install
```

3. Copy the example environment file and update your environment variables:

```sh
cp .env.example .env
php artisan key:generate
```

4. Run the migrations:

```sh
php artisan migrate
```

## Configuration

You can configure the rate limiter settings in the `config/rate_limiter.php` file. 

```php
return [
    'limits' => [
        'default' => [
            'max_attempts' => 60,
            'decay_minutes' => 1,
        ],
        // Add other rate limit configurations here
    ],
];
```

## Usage

Apply the rate limiter middleware to your routes in `routes/web.php` or `routes/api.php`:

```php
use App\Http\Middleware\RateLimiter;

Route::middleware([RateLimiter::class])->group(function () {
    Route::get('/your-route', [YourController::class, 'yourMethod']);
});
```

## Contributing

If you would like to contribute, please fork the repository and make changes as you'd like. Pull requests are warmly welcome.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries, please contact [Amr Qawasmeh](mailto:amrq88@gmail.com).

---
