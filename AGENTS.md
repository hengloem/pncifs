# PNC Follow-up — Base44 Development Notes

## Overview
CodeIgniter 3 (PHP 7.4) + MySQL 5.7 application for managing student internships.

## Running the app
```bash
docker compose -f docker-compose.base44.yml up -d --build
```
The web app is served on **port 3000** (mapped to Apache port 80 inside the container).

## Architecture
- **web** service: `php:7.4-apache` with `mysqli` extension and `mod_rewrite` enabled. Source is bind-mounted at `/var/www/html`.
- **db** service: `mysql:5.7` with SQL mode disabled (`--sql-mode=`) for compatibility with legacy GROUP BY queries. Database `pncifs` is auto-initialized from `sql/pncifs.sql`.

## Key fixes applied for this environment
1. **Session ID length mismatch**: CI3's Session library validates session cookies against `/^[0-9a-f]{40}$/` (SHA-1), but PHP 7.4 ignores the deprecated `session.hash_function` ini setting and generates 32-char IDs. Fixed by setting `session.sid_length=40` and `session.sid_bits_per_character=4` in `/usr/local/etc/php/conf.d/session-sid.ini` (baked into Dockerfile).
2. **MySQL 5.7 only_full_group_by**: Legacy queries select non-aggregated columns with GROUP BY. Fixed by starting MySQL with empty SQL mode.
3. **Case-sensitive filenames**: Renamed model and controller files to `ucfirst` naming (e.g., `Students_model.php`, `Connection.php`) for Linux compatibility.
4. **PHP 7.4 compatibility**: Fixed null count() and undefined index issues in Connection.php and Students_model.php.
5. **Relative base_url**: Set `$config['base_url'] = '/'` in config.php so CI3 redirects use relative URLs (e.g., `Location: /connection/login`). Absolute URLs with the sandbox internal host would be unreachable by the browser through the preview proxy.
6. **Case-sensitive controller routing**: Six controllers have mixed-case filenames (e.g., `SupervisorUsers.php`) that CI3's `ucfirst()` URL matching can't resolve on Linux. Added regex routes in `routes.php` (e.g., `$route['supervisorusers(.*)'] = 'SupervisorUsers$1';`) for: `Final_Report`, `Reminder_Student`, `StudentsUsers`, `SupervisorUsers`, `TutorsUsers`, `StudentsTutorsAssoc`.
7. **Case-sensitive table names**: MySQL on Linux is case-sensitive for table names by default, but the app (originally developed on Windows) uses mixed-case table references. Fixed by starting MySQL with `--lower_case_table_names=1`. Requires a fresh DB volume (the setting must be present at initialization).

## Test credentials
- **Admin**: `benoit.pitet@passerellesnumeriques.org` / `admin123`
- The admin password is set via `password_hash('admin123', PASSWORD_DEFAULT)` — re-apply after DB volume reset. See the `docker compose exec` PHP one-liner in this session's history.

## Login flow
1. `/` redirects to `/connection/login` (307) via `checkLogin()` helper if no session.
2. `Connection::login()` validates credentials against `users` table (bcrypt via `password_verify`).
3. On success, sets session data (id, firstname, is_admin, etc.) and redirects to `/`.

## Known issues
- Email/SMTP functionality requires valid credentials not configured in this environment.
- OAuth2 (Google) login requires API credentials not configured.

## No external secrets required
The app boots without any external API keys. All infrastructure credentials are local (MySQL root password in compose).
