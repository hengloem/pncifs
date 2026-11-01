FROM php:7.4-apache

# mysqli for CodeIgniter's database driver, mod_rewrite for the .htaccess routes.
RUN docker-php-ext-install mysqli \
 && a2enmod rewrite \
 && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# 40-char hex session IDs, required by CI3's Session library (see AGENTS.md #1),
# and production mode for index.php (hides errors, disables db_debug).
RUN printf 'session.sid_length = 40\nsession.sid_bits_per_character = 4\n' > /usr/local/etc/php/conf.d/session-sid.ini \
 && printf 'SetEnv CI_ENV production\n' > /etc/apache2/conf-enabled/ci-env.conf

WORKDIR /var/www/html
COPY . .

# Directories the app writes to at runtime.
RUN mkdir -p application/cache application/logs uploads uploads_report \
 && chown -R www-data:www-data application/cache application/logs uploads uploads_report

EXPOSE 80
