# PNC Follow-up

Student internship management system for [Passerelles numériques](https://www.passerellesnumeriques.org/en/), built as an educational project under the MIT license.

> ⚠️ **This project is not suitable for production.** It is a training prototype for managing student internships.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 7.4 with CodeIgniter 3 MVC framework |
| Database | MySQL 5.7 |
| Frontend | Bootstrap 5.3.3, jQuery 2, jQuery UI, DataTables, SB-Admin-2 theme, Font Awesome, MetisMenu |
| Server | Apache with mod_rewrite |

## Features

- **Authentication** — Login, logout, password reset, registration
- **User management** — Admin, Tutor, and Student roles with separate profile management
- **Batch management** — Internship periods with start/end dates and report/presentation templates
- **Weekly surveys** — Students submit weekly follow-up surveys; tutors and admins review responses
- **Final reports & presentations** — Upload and review final internship reports and presentation slides
- **Reminders** — Admin and student reminders for pending tasks
- **Supervisor management** — Track internship supervisors
- **Student-tutor associations** — Link students to their tutors
- **File uploads** — Report and presentation file uploads with template distribution

## Prerequisites

- [Docker](https://www.docker.com/) and Docker Compose

## Getting Started

### 1. Build and run

```bash
docker compose -f docker-compose.base44.yml up -d --build
```

The app is served on **http://localhost:3000**.

### 2. Database

The MySQL database (`pncifs`) is auto-initialized from `sql/pncifs.sql` on first run. No manual migration step is needed.

If you need a fresh database (e.g., after changing MySQL settings), remove the volume first:

```bash
docker compose -f docker-compose.base44.yml down -v
docker compose -f docker-compose.base44.yml up -d --build
```

### 3. Test credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `benoit.pitet@passerellesnumeriques.org` | `admin123` |
| Tutor | `sopheak.huy@passerellesnumeriques.org` | `123` |
| Student | `heng.loem@student.passerellesnumeriques.org` | `12345` |

> The admin password is stored as a bcrypt hash. If the database volume is reset, re-apply the password via:
> ```bash
> docker compose -f docker-compose.base44.yml exec web php -r "require '/var/www/html/index.php'; \$ci =& get_instance(); \$ci->load->database(); \$ci->db->where('Email', 'benoit.pitet@passerellesnumeriques.org')->update('users', ['Password' => password_hash('admin123', PASSWORD_DEFAULT)]);"
> ```

## Project Structure

```
├── application/
│   ├── config/          # CodeIgniter config (routes, database, etc.)
│   ├── controllers/     # MVC controllers (one per feature area)
│   ├── models/          # MVC models (database access)
│   ├── views/           # MVC views organized by feature
│   └── core/            # Custom core classes
├── assets/              # Frontend assets (CSS, JS, images, libraries)
│   ├── css/             # Theme & compatibility stylesheets
│   └── js/              # Bootstrap 5 compatibility shim
├── sql/                 # Database schema & seed data
├── uploads/             # Uploaded files (reports, presentations)
├── uploads_report/      # Report file uploads
├── docker-compose.base44.yml  # Docker Compose dev environment
├── Dockerfile.base44          # PHP 7.4-Apache image definition
└── index.php            # CodeIgniter entry point
```

## Development

The Docker setup uses a **bind-mounted source** — changes to PHP, CSS, or JS files are reflected immediately without rebuilding. Apache runs inside the container with the repo mounted at `/var/www/html`.

To view logs:

```bash
docker compose -f docker-compose.base44.yml logs -f web
docker compose -f docker-compose.base44.yml logs -f db
```

## Known Issues

- **Email/SMTP** — Not configured; password reset and notification emails won't send.
- **OAuth2 (Google login)** — Requires API credentials not configured in this environment.

## Credits

### Third-party libraries

- [CodeIgniter 3](https://www.codeigniter.com/) — MVC PHP framework
- [Bootstrap 5.3.3](https://getbootstrap.com/) — Frontend component library
- [SB-Admin-2](https://startbootstrap.com/template-overviews/sb-admin-2/) — Admin theme
- [DataTables](https://datatables.net/) — Interactive HTML tables
- [bootstrap-datepicker](https://github.com/eternicode/bootstrap-datepicker) — Date picker
- [Font Awesome](https://fontawesome.com/) — Icon toolkit
- [MetisMenu](https://github.com/onokumus/metismenu) — Sidebar menu
- [jQuery](https://jquery.com/) & [jQuery UI](https://jqueryui.com/)

## License

MIT License — see [license.txt](license.txt).
