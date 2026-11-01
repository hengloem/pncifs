**THIS PROJECT IS NOT SUITABLE FOR PRODUCTION**

The objective of this project is to provide training materials for the NGO Passerelles numériques http://passerellesnumeriques.org/en/

This is an educational project developed in PHP/MySQL under an MIT licence.

It contains a prototype for managing students internships.

`PNC Interns Follow-up` is a server-rendered web application that tracks a student's internship from
start to finish: weekly/tutor follow-up surveys, tutor and admin follow-up reports, reminders, and the
final report and presentation files each student submits at the end of the internship.

---

## Features

### Roles

| Role | What they do |
| --- | --- |
| **Administrator** | Manages all accounts (students, tutors, supervisors), batches/promotions, surveys and reminders; follows up on any student as a tutor; reviews all final reports and presentations. |
| **Tutor** | Follows up the surveys of the students assigned to them, writes follow-up reports, and reviews the final reports and presentations of their students. |
| **Student** | Registers with a batch code, fills in published surveys, receives survey reminders, and uploads their final report and presentation. |
| **Supervisor** | Company-side contact of the internship, stored on the student record (company, position, department, e-mail, phone) and shown to students and staff. Supervisor records have no sign-in of their own. |

### Functional areas

- **Authentication** — e-mail/password sign-in (bcrypt hashes), account suspension, last-connection
  date, forgotten-password e-mail, and self-registration for students using a batch code.
- **Batches / promotions** — one record per year with internship start and end dates, a registration
  code, and the final report / final presentation template files for that batch.
- **Surveys** — admins create surveys for a batch (title, description, deadline, questions with an order
  and a mandatory flag), publish them, and students answer, save drafts and submit. Two survey types are
  seeded: *Tutor Follow-up* and *Weekly Follow-up*.
- **Follow-up and reports** — tutors (and admins acting as tutors) see the answers of their students and
  leave follow-up reports on individual answers.
- **Reminders** — admins send survey reminder e-mails to all students or to a selection; the reminder page
  lists the students who have not completed a survey, and students get a "new reminder" badge in the
  navigation.
- **Final report / final presentation** — students upload their files; admins and tutors browse them by
  batch, download them, and delete them. Admins also upload the templates students must use.
- **Profiles** — users can open their own profile and change their password; admins can edit and delete
  accounts and reset a student's password.
- **Student ↔ tutor association** — admins assign tutors to students per batch.
- **Responsive UI** — Bootstrap 5 with a custom lilac theme, off-canvas sidebar on phones, and DataTables
  lists that scroll horizontally on narrow screens.

---

## Tech stack

- **Framework:** CodeIgniter 3.0.3 (MVC), PHP 7.4
- **Database:** MySQL 5.7 (tables: `users`, `students`, `tutors`, `supervisor`, `batch`, `survey`,
  `questions`, `answers`, `reports`, `reminder`, `surveytypes`)
- **Server:** Apache with `mod_rewrite` (`.htaccess` routes everything through `index.php`)
- **Frontend:** server-rendered PHP views — Bootstrap 5.3 (CDN), Tailwind CSS (Play CDN, utilities only),
  jQuery 2.2.1, DataTables, bootstrap-datepicker, Font Awesome 4.2, SB Admin 2 theme, MetisMenu
- **Custom stylesheets** (`assets/css/`): `bootstrap-compat.css` (Bootstrap 3 class shims),
  `tailwind-redesign.css`, `lilac-content.css`, `forms-layout.css`, `list-table.css`, `modern-dark.css`

---

## Project structure

```
index.php                  CodeIgniter front controller
application/
  config/                  app, database, routes and e-mail configuration
  controllers/             one controller per functional area (see below)
  models/                  one model per area, all queries live here
  views/                   page templates grouped by area + templates/ (header, menu, footer)
  helpers/                 utils_helper.php (checkLogin, getUserContextData, sanitize),
                           menu_icon_helper.php
  libraries/               google.php and OAuthC.php (optional Google sign-in)
assets/                    Bootstrap, jQuery, DataTables, datepicker, Font Awesome, theme CSS/JS
sql/pncifs.sql             schema + demo data; auto-imported on first container start
uploads/                   uploaded final presentations
uploads_report/            uploaded final reports
system/                    CodeIgniter core (do not edit)
```

Main controllers: `Connection` (login/register), `Home` (dashboard), `Batchs`, `Surveys`,
`StudentSurveys`, `SurveysByTutor`, `Survey_by_admin`, `View_student_survey`, `Reminder_admin`,
`Reminder_Student`, `StudentsUsers`, `TutorsUsers`, `SupervisorUsers`, `StudentsTutorsAssoc`,
`Final_Report`, `Final_pres`, `Student_final_report`, `Student_final_pres`, `Tutor_final_report`,
`Tutor_final_presentation`, `Tutor_follow_by_admin`, `Upload`.

---

## Getting started

### With Docker (recommended)

```bash
docker compose -f docker-compose.base44.yml up -d --build
```

The app is then served on **http://localhost:3000**. Two services are started:

- **web** — `php:7.4-apache` with the `mysqli` extension and `mod_rewrite`; the repository is mounted
  at `/var/www/html`, so code changes are picked up on the next request.
- **db** — `mysql:5.7`, database `pncifs`, initialized from `sql/pncifs.sql` on first start.

The database volume is only seeded once. To re-import the seed data, remove the volume and start again:

```bash
docker compose -f docker-compose.base44.yml down -v
docker compose -f docker-compose.base44.yml up -d
```

Uploaded files are written to `uploads/` and `uploads_report/`, which must be writable by the web server
(the compose setup fixes their ownership at startup).

### Without Docker

1. PHP 7.4 with the `mysqli` extension, and MySQL 5.7.
2. Create an empty database and import `sql/pncifs.sql`.
3. Point the web server at the repository root and enable `mod_rewrite` (Apache `AllowOverride All`), so
   `.htaccess` routes requests through `index.php`.
4. Make `application/cache`, `application/logs`, `uploads` and `uploads_report` writable by the server user.
5. Configure the database connection, either through the `DB_HOST`, `DB_USER` and `DB_PASS` environment
   variables (read in `application/config/database.php`) or by editing that file.

### Test accounts

Seeded from `sql/pncifs.sql` (same as `Permission.txt`):

| Role | E-mail | Password |
| --- | --- | --- |
| Admin | `benoit.pitet@passerellesnumeriques.org` | `123456` |
| Tutor | `sopheak.huy@passerellesnumeriques.org` | `123` |
| Student | `heng.loem@student.passerellesnumeriques.org` | `12345` |

---

## Configuration notes

- `$config['base_url'] = '/'` in `application/config/config.php` so that redirects stay on the current
  host (required behind a reverse proxy).
- The session ID length is pinned to 40 hex characters (`session.sid_length=40`,
  `session.sid_bits_per_character=4`) because CodeIgniter 3 validates cookies that way, while PHP 7.4 no
  longer honours `session.hash_function`.
- MySQL runs with `--sql-mode=` (legacy `GROUP BY` queries) and `--lower_case_table_names=1`
  (mixed-case table names); the latter must be set before the data directory is initialized.
- Mixed-case controller filenames are mapped explicitly in `application/config/routes.php` so they
  resolve on case-sensitive filesystems.
- Stylesheets edited in `assets/css/` are cache-busted with `?v=<filemtime>` in `templates/header.php`.

---

## Deployment

This app is rendered by PHP and needs MySQL, so it cannot run on Netlify itself. Netlify is the
public front door (domain + TLS): it proxies every request to an origin server that runs the app.

### 1. Origin server (PHP + MySQL)

Build and run this repo's `Dockerfile` on any container host (Render, Railway, Fly, Cloud Run, a VPS…):

```bash
docker build -t pncifs .
docker run -d -p 80:80 \
  -e DB_HOST=<host> -e DB_USER=<user> -e DB_PASS=<password> \
  -v pncifs-uploads:/var/www/html/uploads \
  -v pncifs-uploads-report:/var/www/html/uploads_report \
  pncifs
```

The container runs Apache in CodeIgniter's `production` environment (`SetEnv CI_ENV production`, so
errors are hidden and `db_debug` is off). Database settings come from `DB_HOST` / `DB_USER` / `DB_PASS`
(see `application/config/database.php`).

The database must be MySQL 5.7 started with `--sql-mode=` and `--lower_case_table_names=1`
(AGENTS.md #2 and #7), seeded from `sql/pncifs.sql` — that file is excluded from the image by
`.dockerignore`. Keep `uploads/` and `uploads_report/` on persistent volumes, otherwise uploaded
reports and presentations are lost on redeploy.

### 2. Netlify front door

`netlify.toml` proxies `/*` to the origin and publishes only a placeholder page. Replace `PHP_ORIGIN`
with the origin's https URL, then deploy:

```bash
netlify deploy --prod
```

Point the site's custom domain at Netlify. Because the proxy keeps the browser on the Netlify host,
the app's relative `base_url` (`/`) and its session cookie work without further configuration. The
origin receives Netlify's `Host` header, so it must accept that hostname (Apache does; a host-checking
platform has to allow the Netlify domain).

Limits of this setup: Netlify's proxy times out after 26 seconds, and every request — including
`assets/` — is forwarded to the origin, so the origin serves all traffic.

## Known limitations

- Legacy stack (CodeIgniter 3, PHP 7.4, MySQL 5.7) — this is teaching/demo material, not hardened software.
- Survey reminder e-mails send through Google SMTP (`application/config/email.php`) using the signed-in
  admin's address and typed password; they fail without valid SMTP credentials.
- Optional Google (OAuth2) sign-in is present in `Connection::loginOAuth2()` but is disabled unless the
  `oauth2_*` config items and the provider library are configured.
- Supervisor accounts can be created and edited, but there is no supervisor portal; the supervisor
  navigation branch in `templates/menu.php` is never reached at login.

## Credits

### Third party libraries and components

We thank the following open source projects for the components used by this project

#### Backend

* CodeIgniter MVC framework http://www.codeigniter.com/

#### Frontend

* Bootstrap 5 (with a Bootstrap 3 compatibility layer for the legacy views) https://getbootstrap.com/
* Tailwind CSS (Play CDN) https://tailwindcss.com/
* JQuery 2 and JQuery-UI
* sb-admin-2 Bootstrap theme http://startbootstrap.com/template-overviews/sb-admin-2/
* Datatable https://datatables.net/
* DatePicker for bootstrap https://github.com/eternicode/bootstrap-datepicker
* Font Awesome 4.2 http://fontawesome.io/
* MetisMenu http://mm.onokumus.com/
