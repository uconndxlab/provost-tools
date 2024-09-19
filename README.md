## Jobs

Admin functionality requires two things:

1. A user with the `can_admin` column set to `true`.
2. The laravel queue worker running.

To run the queue worker, run the following command:

```bash
php artisan queue:work
```