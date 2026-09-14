<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.
</laravel-boost-guidelines>
SkillLink — AGENTS.md

Purpose

You are the coding agent working on the existing SkillLink Laravel application.

Your job is to implement requested changes safely, incrementally, and in accordance with SPEC.md.

Do not rebuild the application. Do not replace Blade with React. Do not break existing backend functionality merely to reproduce a design.

1. Mandatory first step

Before changing application code, inspect:

SPEC.md

README.md

composer.json

package.json

routes/web.php

routes/auth.php

app/Models/

app/Http/Controllers/

app/Http/Requests/

app/Http/Middleware/

database/migrations/

database/seeders/

resources/views/

resources/css/

resources/js/

tests/

If the requested task is a UI redesign, first identify the existing Blade page corresponding to the target design.

2. Existing stack

PHP 8.3+

Laravel 13.x

Blade

TailwindCSS

Vite

MySQL

Laravel Breeze

Laratrust

Eloquent ORM

Laravel Notifications

PHPUnit / Laravel tests

Use the existing stack unless the user explicitly requests a justified change.

3. Critical architecture rule

SkillLink is a Laravel monolith.

Preferred flow:

Browser → Route → Controller → Request/Service logic → Eloquent → MySQL → Blade

Do not introduce React/Vue/Next.js for the frontend.

4. UI rule

When a Stitch/Figma design is available:

treat it as the visual source of truth;

reproduce layout, spacing, typography, colors, cards, forms, tables, badges and responsive behavior;

keep Laravel Blade;

connect every action to a real route;

connect every displayed value to real backend data;

preserve validation and authorization.

Do not create fake dashboard numbers or fake missions to make a screenshot look correct.

5. Backend safety

Never weaken:

authentication;

Laratrust roles;

authorization;

ownership checks;

Form Request validation;

CSRF protection;

mission/application status rules.

For UI work, prefer changing Blade/Tailwind first.

Only change controllers/models/routes/database when the requested feature genuinely requires it.

6. Known roles

Three roles exist:

admin

client

freelance

Use the existing role middleware and Laratrust implementation.

Do not invent alternative role names.

7. Known important route names

Use existing route names where possible:

home

dashboard

profile.edit

profile.update

profile.destroy

client.dashboard

freelance.dashboard

admin.dashboard

missions.index

missions.create

missions.store

missions.show

missions.edit

missions.update

missions.destroy

freelance.missions.index

freelance.missions.apply

freelance.missions.complete

freelance.applications.index

client.applications.index

client.applications.accept

client.applications.reject

client.missions.review

freelance.missions.review-client

admin users/missions/categories routes

notifications.read

Before using a route in Blade, verify it exists with php artisan route:list.

8. Business rules to preserve

Missions

A client may only modify/delete their own mission.

Applications

A freelancer:

can apply only to an open mission;

cannot apply twice to the same mission.

Accepting an offer

The mission owner:

accepts the selected application;

pending alternatives become rejected;

mission becomes in_progress;

accepted freelancer gets a notification.

Completing

Only the assigned freelancer can complete an in_progress mission.

Reviews

Reviews are allowed only after completion and only for the relevant users.

9. Blade/Tailwind implementation

Prefer reusable components for repeated UI:

buttons;

inputs;

labels;

badges;

cards;

alerts;

modals;

tables;

empty states;

pagination;

navigation.

Keep class names readable.

Do not create giant duplicated Blade files when a component makes the code clearer.

Keep JavaScript minimal and use Vanilla JS/Alpine only where already appropriate.

10. Modification protocol

For every non-trivial task:

Before

inspect relevant files;

identify dependencies;

state planned files;

identify risks.

During

make the smallest coherent change;

preserve route names;

preserve controller contracts;

preserve authorization;

preserve validation.

After

Run appropriate checks.

Examples:

php artisan route:list
php artisan test
npm run build

For formatting:

vendor/bin/pint

Only run commands relevant to the change when possible.

11. UI page workflow

For each Stitch screen:

Find matching Blade view.

Find matching controller/route.

Identify data available to the view.

Reproduce structure and design.

Make components reusable.

Connect buttons/forms to real routes.

Handle loading/empty/error/success states.

Test.

Check mobile/tablet/desktop.

Never stop at a static visual reproduction if the page already has real functionality.

12. Do not silently expand scope

The Cahier des Charges contains requirements that may be incomplete in the current implementation.

If the current task is UI-only:

do not implement unrelated missing backend features;

report them separately.

If the requested feature needs backend work:

implement only what is necessary;

preserve existing architecture.

13. No destructive actions without justification

Do not:

delete migrations;

drop tables;

remove models/controllers;

remove routes;

replace working authentication;

reset the database;

rewrite the project from scratch.

If a destructive database operation is genuinely required, explain it before doing it.

14. MCD / MLD / Stitch inputs

When MCD/MLD or Stitch files are supplied later:

inspect them;

compare them with the current implementation;

do not guess missing relationships or fields;

explicitly report discrepancies.

For Stitch:

use exact visual reference where possible;

do not invent pages that are not required.

15. First command / first response

The first task in a new OpenCode session should be:

Read SPEC.md and AGENTS.md, inspect the existing project, and perform a read-only audit. Do not modify files.

The audit must report:

architecture;

authentication;

roles;

routes;

models;

controllers;

Blade views;

migrations;

tests;

implemented features;

missing features;

UI/design mapping;

proposed Phase 1 file changes.

Then wait for approval to implement.

16. Final response format

After implementation, report:

Changed

file/path — what changed

Behavior

what the user can now do

Verification

commands/tests executed

result

Remaining

known limitations or requirements not implemented

Never claim a feature is complete if it was not tested or implemented.
