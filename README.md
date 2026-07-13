<div align="center">

# 💸 Tricount

### Shared Expense Manager

**Split group expenses, settle up fairly.**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Apache](https://img.shields.io/badge/Apache-XAMPP-D22128?style=flat-square&logo=apache&logoColor=white)](https://www.apachefriends.org/)
[![Architecture](https://img.shields.io/badge/architecture-custom%20MVC-6E4AFF?style=flat-square)](#architecture)
[![License](https://img.shields.io/badge/license-MIT-22C55E?style=flat-square)](LICENSE)

</div>

---

A web application for splitting shared expenses within a group, in the spirit of [Tricount](https://www.tricount.com/). Users create a *tricount* (a shared expense book), invite participants, record who paid for what, and the application computes how much each person owes or is owed.

Built from scratch in PHP on a custom MVC framework — no Laravel, no Symfony, no Composer. Routing, ORM-less data mapping, templating, input sanitisation and session handling are all implemented by hand.

> Academic project — Programmation Web Back-end (PRWB), [EPFC](https://www.epfc.eu/), 2022–2023.

---

## Features

**Accounts**
- Sign-up with email, full name and IBAN
- Login / logout with server-side session management
- Edit profile, change password

**Tricounts**
- Create, edit and delete a shared expense book
- Add and remove participants (subscriptions)
- List all tricounts the user takes part in

**Operations**
- Record an expense: title, amount, date, who paid
- Edit and delete operations
- Split an expense across participants using **weighted repartitions** — a participant can carry a share of 1, 2, 3… rather than a flat equal split
- Reusable **repartition templates** so a recurring split doesn't have to be re-entered

**Balance**
- Per-tricount balance showing each participant's net position (paid vs. owed)

---

## Architecture

A classic front-controller MVC, implemented from the ground up.

```
index.php                  Front controller — single entry point
└── framework/
    ├── Router.php         Maps ?controller=x&action=y to a controller method;
    │                      sanitises $_GET / $_POST / $_REQUEST on every request
    ├── Controller.php     Base controller (auth guards, redirects)
    ├── Model.php          PDO connection + base data-access layer
    ├── View.php           Template rendering
    ├── Configuration.php  Reads config/*.ini
    └── Tools.php          Sanitisation & helpers

controller/                ControllerMain, ControllerTricount,
                           ControllerOperation, ControllerSettings, ControllerSetup
model/                     user, tricount, operation, repartition,
                           repartition_template, repartition_templates_items
view/                      One PHP template per use case
database/                  Schema + seed dumps
```

**Request lifecycle:** `index.php` → `Router::route()` → sanitise input → resolve controller/action → controller queries models via PDO → renders a view.

**Security measures implemented**
- All request input is recursively sanitised in the router before reaching a controller, with an explicit allow-list (`insafe_inputs`) for fields that must keep their raw markup
- Prepared statements throughout the data layer (PDO)
- Password hashing; auth guards on every protected action
- `.htaccess` in each internal directory to block direct HTTP access to source files

### Schema

`users` · `tricounts` · `subscriptions` (who participates in which tricount) · `operations` (an expense) · `repartitions` (a participant's weighted share of an operation) · `repartition_templates` + `repartition_template_items` (saved splits)

---

## Getting started

**Requirements:** PHP 8+, MySQL/MariaDB, Apache with `mod_rewrite`. A [XAMPP](https://www.apachefriends.org/) stack covers all three.

**1. Clone into your web root**

```bash
git clone https://github.com/abdessalems/prwb_2223_a10.git
```

**2. Create the database**

```bash
mysql -u root -p < database/prwb_2223_a10.sql
```

**3. Configure** — edit `config/dev.ini`:

```ini
[DB]
dbtype     = mysql
dbhost     = 127.0.0.1
dbname     = prwb_2223_a10
dbuser     = your_user
dbpassword = your_password

[Web]
web_root = "/prwb_2223_a10/"
```

**4. Serve it** — start Apache and MySQL, then open `http://localhost/prwb_2223_a10/`.

> The committed `config/dev.ini` ships with XAMPP's stock `root` / `root` credentials pointing at `127.0.0.1`. They are local development defaults only — change them for any non-local deployment.

---

## Project status

Delivered in three iterations as coursework, and feature-complete for the assignment's scope. It is a learning project, not production software: it has no automated test suite, no dependency manager, and no CI. The framework underneath it exists to demonstrate how MVC works rather than to compete with a real one.

Known rough edges at hand-in: the sign-up flow required a re-login before the session picked up the new user, participant removal in *edit tricount* was unreliable, and the balance view could desynchronise after certain operation edits.

---

## Team

| | |
|---|---|
| **Abdessalem Saadaoui** ([@abdessalems](https://github.com/abdessalems)) | Authentication, profile & password management, tricount listing, operation views, framework and routing work |
| **Yassine Houari** | Sign-up, add/edit/delete tricount, add/delete operation, balance view |

Group **A10** — the full commit history of both contributors is preserved in this repository.

---

## License

Released under the [MIT License](LICENSE). © 2023 Abdessalem Saadaoui & Yassine Houari.
