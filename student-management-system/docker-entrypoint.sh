#!/bin/bash
# docker-entrypoint.sh
# Render injects $PORT at runtime. Apache must listen on that port.

PORT="${PORT:-10000}"

# Rewrite Apache's port configuration
cat > /etc/apache2/ports.conf <<EOF
Listen ${PORT}
EOF

# Rewrite the default VirtualHost to use the dynamic port
cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:${PORT}>
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        AllowOverride All
        Require all granted
        Options -Indexes +FollowSymLinks
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

echo "Starting Apache on port ${PORT}..."
exec apache2-foreground
