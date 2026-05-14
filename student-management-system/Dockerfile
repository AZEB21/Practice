# ── PHP 8.2 + Apache — optimised for Render ───────────────────────────────────
FROM php:8.2-apache

# Install both MySQL and PostgreSQL PDO drivers
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application files into the web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy and enable the entrypoint that wires up $PORT at runtime
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Render injects $PORT (default 10000)
EXPOSE 10000

CMD ["/usr/local/bin/docker-entrypoint.sh"]
