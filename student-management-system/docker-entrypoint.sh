#!/bin/bash
set -e

PORT="${PORT:-10000}"

echo "Configuring Apache to listen on port ${PORT}..."

# Overwrite ports.conf
printf 'Listen %s\n' "${PORT}" > /etc/apache2/ports.conf

# Overwrite the default VirtualHost
{
  printf '<VirtualHost *:%s>\n' "${PORT}"
  printf '    DocumentRoot /var/www/html\n'
  printf '    <Directory /var/www/html>\n'
  printf '        AllowOverride All\n'
  printf '        Require all granted\n'
  printf '        Options -Indexes +FollowSymLinks\n'
  printf '    </Directory>\n'
  printf '    ErrorLog ${APACHE_LOG_DIR}/error.log\n'
  printf '    CustomLog ${APACHE_LOG_DIR}/access.log combined\n'
  printf '</VirtualHost>\n'
} > /etc/apache2/sites-available/000-default.conf

echo "Starting Apache on port ${PORT}..."
exec apache2-foreground
