# SkillLink — SPEC.md

## 0. Mission

SkillLink is an existing Laravel monolithic web application that connects **clients** and **freelancers**. The objective of this specification is to guide an AI coding agent (OpenCode) to bring the existing application UI and UX in line with the provided Stitch/Figma design **without rebuilding the project from scratch and without breaking existing business logic**.

**Primary rule:** the existing Laravel application is the implementation source of truth for current behavior; the Cahier des Charges is the functional target; the Stitch design is the visual/UI source of truth when provided.

---

## 1. Source of truth and priority

Use the following priority order when making decisions:

1. Existing Laravel code and database behavior — preserve working functionality.
2. Cahier des Charges — functional requirements and expected scope.
3. MCD / MLD / MPD — database/domain structure, when provided.
4. Stitch/Figma design — visual/UI/UX reference, when provided.
5. This SPEC.md and AGENTS.md — execution rules for the agent.

If two sources conflict:
- do not silently invent a solution;
- inspect the existing code;
- explain the conflict;
- choose the smallest safe change;
- never delete working functionality merely to match a mockup.

**Important:** the current project archive contains the Cahier des Charges and Laravel code. MCD/MLD files and Stitch screens were not included in the supplied materials, so they must be treated as future inputs rather than guessed.

---

## 2. Project identity

**Project:** SkillLink  
**Type:** web platform for connecting clients and freelancers  
**Architecture:** Laravel monolith  
**Frontend:** Blade + TailwindCSS + HTML/CSS + small Vanilla JS interactions when necessary  
**Backend:** PHP + Laravel + Eloquent  
**Authentication:** Laravel Breeze  
**Roles/permissions:** Laratrust  
**Database:** MySQL  
**Async/notifications target:** Laravel Notifications, Events, Listeners, Jobs/Queues where appropriate  
**Testing:** PHPUnit / Laravel feature tests  
**Deployment target:** Docker + Docker Compose + GitHub Actions

The Cahier des Charges explicitly specifies Blade rather than a React frontend and TailwindCSS for the design.

---

## 3. Functional scope from the Cahier des Charges

### 3.1 Authentication

Users must be able to:
- register;
- login;
- logout;
- view profile;
- edit profile information.

Registration roles:
- Client
- Freelance

Admin has specific permissions.

### 3.2 Roles

#### Client
Can:
- create a mission;
- view own missions;
- edit own missions;
- delete own missions;
- view received offers;
- accept/reject offers;
- follow mission status;
- review a freelancer.

#### Freelance
Can:
- view available missions;
- search missions;
- view mission details;
- submit an offer;
- edit own offer;
- delete own offer;
- view own offers;
- view accepted missions;
- update mission status.

#### Admin
Can:
- view/manage users;
- view/manage missions;
- manage categories;
- delete a mission when necessary;
- view general statistics.

Laratrust is the role/permission mechanism required by the Cahier des Charges.

### 3.3 Mission

A mission contains:
- title;
- description;
- category;
- budget;
- deadline;
- status.

Expected statuses:
- `open`
- `in_progress`
- `completed`
- `cancelled`

### 3.4 Offers / applications

An offer contains:
- proposed price;
- message;
- submission date;
- status.

Expected statuses:
- pending
- accepted
- rejected

When an offer is accepted:
- the selected offer becomes accepted;
- other pending offers for the mission are rejected;
- the mission becomes `in_progress`;
- the freelancer is notified.

### 3.5 Reviews

After completion:
- client can review freelancer;
- rating is 1–5;
- comment is optional.

The current implementation also supports a freelancer reviewing the client.

### 3.6 Notifications

Important notification events include:
- new offer received;
- offer accepted;
- offer rejected;
- mission completed;
- new review.

Use Laravel's notification/event architecture where it already exists or where implementation is required.

### 3.7 Mission search

Freelancers should be able to filter/search by:
- keyword;
- category;
- budget;
- status.

---

## 4. Dashboard requirements

### Client dashboard

Must expose:
- total missions;
- open missions;
- missions in progress;
- completed missions;
- received offers;
- recent missions / quick access.

### Freelancer dashboard

Must expose:
- available missions;
- submitted offers;
- accepted offers;
- missions in progress;
- completed missions;
- quick access to available missions.

### Admin dashboard

Must expose:
- total users;
- total clients;
- total freelancers;
- total missions;
- completed missions;
- management access to users, missions and categories.

---

## 5. Current Laravel implementation discovered in the supplied archive

### 5.1 Models

Existing domain models:
- `User`
- `Role`
- `Permission`
- `Mission`
- `Category`
- `Application`
- `Review`

### 5.2 Important model relations

`Mission`:
- belongsTo `User` as `client`;
- belongsTo `Category`;
- hasMany `Application`;
- hasMany `Review`.

`Application`:
- belongsTo `Mission`;
- belongsTo `User` as `freelance`.

`Review`:
- belongsTo `Mission`;
- belongsTo `User` as `reviewer`;
- belongsTo `User` as `reviewee`.

`Category`:
- hasMany `Mission`.

`User`:
- uses `HasRolesAndPermissions`;
- uses Laravel notifications.

### 5.3 Existing controllers

Current controllers include:
- `DashboardController`
- `MissionController`
- `FreelanceMissionController`
- `ApplicationController`
- `ClientApplicationController`
- `ReviewController`
- `AdminUserController`
- `AdminMissionController`
- `AdminCategoryController`
- `ProfileController`
- Breeze authentication controllers.

### 5.4 Existing routes

Important named routes currently include:
- `home`
- `dashboard`
- `profile.edit`
- `profile.update`
- `profile.destroy`
- `client.dashboard`
- `freelance.dashboard`
- `admin.dashboard`
- `missions.index`
- `missions.create`
- `missions.store`
- `missions.show`
- `missions.edit`
- `missions.update`
- `missions.destroy`
- `freelance.missions.index`
- `freelance.missions.apply`
- `freelance.missions.complete`
- `freelance.applications.index`
- `client.applications.index`
- `client.applications.accept`
- `client.applications.reject`
- `client.missions.review`
- `freelance.missions.review-client`
- admin users/missions/categories routes
- `notifications.read`

### 5.5 Existing Blade pages

Current UI pages include:

**Public/auth**
- `welcome.blade.php`
- `auth/login.blade.php`
- `auth/register.blade.php`
- password/reset/verification pages

**Client**
- `client/dashboard.blade.php`
- `missions/index.blade.php`
- `missions/create.blade.php`
- `missions/edit.blade.php`
- `missions/show.blade.php`
- `client/applications/index.blade.php`

**Freelancer**
- `freelance/dashboard.blade.php`
- `freelance/missions/index.blade.php`
- `freelance/applications/index.blade.php`

**Admin**
- `admin/dashboard.blade.php`
- `admin/users/index.blade.php`
- `admin/missions/index.blade.php`
- `admin/categories/index.blade.php`
- `admin/categories/create.blade.php`
- `admin/categories/edit.blade.php`

**Shared**
- `layouts/app.blade.php`
- `layouts/guest.blade.php`
- `layouts/navigation.blade.php`
- reusable Blade components
- `profile/edit.blade.php`

---

## 6. Current database state

Existing migrations cover:
- users;
- cache;
- jobs;
- Laratrust tables;
- missions;
- applications;
- categories;
- mission/category relation;
- proposed application price;
- reviews;
- notifications.

Current `missions` structure includes:
- `client_id`
- `category_id`
- `title`
- `description`
- `budget`
- `deadline`
- `status`

Current mission statuses:
- `open`
- `in_progress`
- `completed`
- `cancelled`

Current `applications` structure includes:
- `mission_id`
- `freelance_id`
- `cover_letter`
- `status`
- `proposed_price`

There is a unique constraint preventing the same freelancer from applying twice to the same mission.

Current reviews contain:
- `mission_id`
- `reviewer_id`
- `reviewee_id`
- `rating`
- `comment`

There is a unique constraint preventing the same reviewer from reviewing the same mission twice.

---

## 7. Current business logic that MUST be preserved

Do not remove or bypass these protections while redesigning the UI:

### Mission ownership
A client can only view/edit/delete their own missions.

### Freelance application
A freelancer can apply only to an open mission and cannot apply twice to the same mission.

### Application acceptance
Only the mission owner/client can accept or reject an application.

On acceptance:
1. application becomes `accepted`;
2. other pending applications become `rejected`;
3. mission becomes `in_progress`;
4. accepted freelancer receives a notification.

### Mission completion
A freelancer can mark a mission complete only if:
- they have an accepted application for that mission;
- mission is currently `in_progress`.

### Reviews
A client can review only their own completed mission and only when an accepted freelancer exists.

A freelancer can review the client only when:
- they are assigned to the mission;
- their application is accepted;
- mission is completed.

### Role protection
Keep role middleware and authorization checks intact.

---

## 8. UI/UX implementation rules

When Stitch/Figma screens are provided, reproduce their visual language as closely as practical:

### Layout
Implement:
- desktop layout;
- tablet behavior;
- mobile behavior;
- navbar;
- sidebar where shown by the design;
- consistent page containers;
- consistent spacing.

### Components
Prefer reusable Blade components for:
- navbar;
- sidebar;
- buttons;
- cards;
- badges/status;
- forms;
- inputs;
- alerts;
- tables;
- modals;
- pagination;
- empty states;
- loading/disabled states where relevant.

Do not duplicate the same large HTML/Tailwind block across many pages if a reusable Blade component is appropriate.

### Visual consistency
Centralize repeated visual decisions:
- colors;
- typography;
- border radius;
- shadows;
- spacing;
- status badge styles;
- buttons;
- form controls.

Do not introduce a second design system unless necessary.

### Data
Never replace real Laravel data with hard-coded fake dashboard numbers or fake missions in production views.

Use:
- controller-provided data;
- Eloquent relations;
- Blade loops;
- existing route names.

### Forms
Every form must preserve:
- correct HTTP method;
- CSRF;
- validation errors;
- old input where appropriate;
- success/error feedback.

### Navigation
Every navigation action must use an existing valid named route or a route explicitly added for a required feature.

Never invent route names.

---

## 9. Stitch integration protocol

When Stitch screenshots/export are supplied:

For each screen:
1. Identify the corresponding existing Blade view.
2. Identify the shared layout/components used by the screen.
3. Compare structure.
4. Compare typography.
5. Compare spacing.
6. Compare colors.
7. Compare cards/tables/forms/buttons.
8. Compare responsive behavior.
9. Map every visible action to a real Laravel route.
10. Map every visible data field to real backend data.
11. Implement the smallest set of changes necessary.
12. Test the page.
13. Check desktop and mobile.

### Page mapping target

Expected main screens from the Cahier des Charges:
1. Landing Page
2. Login
3. Register
4. Client Dashboard
5. Create Mission
6. Mission List
7. Mission Details
8. Offers List
9. Freelancer Dashboard
10. Freelancer Profile
11. Admin Dashboard

Mobile adaptations include:
- home;
- login;
- register;
- mission list;
- mission details;
- dashboard;
- profile.

---

## 10. Missing/partial scope to audit before implementation

The Cahier des Charges contains requirements that are not necessarily fully implemented in the current archive. OpenCode must audit these before claiming completion:

- editing/deleting a freelancer's own offer;
- full offer details and comparison UX;
- mission status workflow completeness;
- mission cancellation;
- freelancer profile/content fields;
- notification coverage beyond application acceptance;
- admin permissions beyond role middleware;
- statistics UI;
- pagination;
- complete responsive design;
- Events/Listeners/Jobs/Queues usage where required;
- Docker/Nginx/Compose completeness;
- GitHub Actions CI/CD;
- deployment documentation;
- README completeness;
- full test coverage required by the Cahier des Charges.

**Do not implement all missing backend features automatically during a pure UI task.** First identify them, then implement only when the task/phase explicitly includes them.

---

## 11. Testing requirements

After UI changes:
- run the relevant feature tests;
- run route verification when routes were changed;
- run Laravel tests;
- run frontend build when assets were changed.

Minimum functional scenarios to protect:
- registration;
- login;
- mission creation;
- mission update;
- mission ownership authorization;
- application creation;
- duplicate application prevention;
- application acceptance;
- application rejection;
- mission completion;
- review creation;
- role authorization;
- unauthenticated dashboard protection.

The Cahier des Charges explicitly requires access tests such as:
- freelancer cannot modify another user's mission;
- client cannot create an offer;
- unauthenticated user cannot access dashboard;
- normal user cannot access admin features.

---

## 12. Safe-change policy

### MUST NOT
- rebuild the Laravel project;
- replace Blade with React/Vue;
- remove Breeze;
- remove Laratrust;
- remove existing routes because a mockup does not show them;
- remove migrations/models/controllers that are still required;
- hard-code production data;
- disable authorization;
- bypass Form Requests;
- remove CSRF;
- weaken ownership checks;
- silently change database schema;
- install large dependencies without justification.

### SHOULD
- reuse existing controllers/models/routes;
- improve Blade structure;
- create reusable components;
- improve Tailwind classes;
- improve responsive behavior;
- preserve existing validation;
- add tests for meaningful changes;
- keep changes focused and reversible.

---

## 13. Execution phases for OpenCode

### Phase 0 — Read-only audit
Do not modify files.

Produce:
- architecture summary;
- current routes;
- current models/relations;
- current views;
- current auth/roles;
- current tests;
- missing requirements;
- design-to-view mapping once design files exist.

### Phase 1 — Design foundation
Implement:
- global layout;
- typography;
- design tokens/classes;
- navbar;
- sidebar;
- buttons;
- inputs;
- cards;
- badges;
- alerts;
- table styles;
- responsive container system.

### Phase 2 — Public and authentication UI
Implement:
- landing page;
- login;
- register;
- verification/reset screens if covered by design.

Do not change authentication behavior unless required to make the UI functional.

### Phase 3 — Client
Implement:
- client dashboard;
- missions list;
- create/edit mission;
- mission details;
- received offers;
- accept/reject UI;
- review UI.

### Phase 4 — Freelancer
Implement:
- freelancer dashboard;
- available missions;
- filters/search;
- mission details;
- application form;
- own applications;
- accepted missions;
- completion action;
- profile UI.

### Phase 5 — Admin
Implement:
- admin dashboard;
- users;
- missions;
- categories;
- relevant management actions.

### Phase 6 — Notifications and UX polish
Implement/review:
- notification display;
- read action;
- success/error feedback;
- empty states;
- confirmation dialogs;
- loading/disabled states.

### Phase 7 — Responsive QA
Verify:
- mobile;
- tablet;
- desktop;
- keyboard/focus states;
- long text;
- empty data;
- validation errors.

### Phase 8 — Tests and final audit
Run tests/build and verify:
- no broken named routes;
- no missing Blade variables;
- no authorization regression;
- no obvious console/build errors;
- no fake data accidentally left in production views.

---

## 14. Definition of done

A UI task is complete only when:
- the target Blade page matches the supplied Stitch design closely;
- the page is connected to real Laravel data;
- existing functionality remains usable;
- authorization remains intact;
- validation/error/success states work;
- responsive layout works;
- relevant tests pass;
- assets build successfully when applicable;
- no unnecessary backend changes were introduced.

---

## 15. Agent communication format

Before modifying:
- state what files will change;
- explain why;
- identify any uncertainty.

After modifying:
- list changed files;
- summarize behavior changes;
- list tests/commands run;
- list remaining issues.

If a requirement cannot be implemented safely:
- stop that part;
- explain the blocker;
- do not invent a workaround that changes business behavior.

---

## 16. First instruction to OpenCode

Start with a **read-only audit**.

Do not modify any application file until the audit is complete.

Read:
- `SPEC.md`
- `AGENTS.md`
- `README.md`
- `composer.json`
- `package.json`
- routes
- models
- controllers
- requests
- migrations
- Blade views
- tests

Then report:
1. current architecture;
2. implemented features;
3. missing/incomplete features;
4. route/view mapping;
5. security/authorization risks;
6. UI redesign plan;
7. exact files that would change in Phase 1.

Only after that wait for the implementation instruction.
