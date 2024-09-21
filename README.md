## Jobs

Admin functionality requires two things:

1. A user with the `can_admin` column set to `true`.
2. The laravel queue worker running.

To run the queue worker, run the following command:

```bash
php artisan queue:work
```

In production, you need supervisor installed.  A sample configuration file:

```conf
[program:pt-laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/site/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=your-user
numprocs=4
redirect_stderr=true
stdout_logfile=/path/to/site/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisor reread
sudo supervisor update
sudo supervisor start pt-laravel-worker:*
```