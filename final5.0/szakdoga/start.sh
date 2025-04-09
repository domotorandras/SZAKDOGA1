#!/bin/bash
# Run migrations
/usr/bin/php artisan migrate --force

# Start the server
/usr/bin/php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
