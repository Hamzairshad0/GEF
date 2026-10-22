# Ghazali Education Foundation — website

A rebuild of [ghazalifoundation.org](https://ghazalifoundation.org) on **Laravel 13 + Blade + Tailwind CSS v4 + vanilla JS**.
All pages, URLs and content from the original WordPress site are preserved; the design, home page hero slider and interactions are new.

## Quick start

Run these one at a time (Windows PowerShell 5.1 doesn't support `&&`):

```powershell
composer install
npm install
npm run build
copy .env.example .env          # skip if .env already exists
php artisan key:generate        # skip if .env already has an APP_KEY
php artisan migrate --seed      # imports all crawled content + creates the admin user
php artisan serve
```

> **SQLite on Windows:** if you see `could not find driver`, enable `extension=pdo_sqlite` in `C:\php84\php.ini`
> (or switch `DB_CONNECTION` to `mysql` in `.env`). Without changing `php.ini` you can run the site with
> `php -d extension=pdo_sqlite -S 127.0.0.1:8000 -t public server.php`.
>
> If a page still shows old content after an update, run `php artisan optimize:clear`.

Admin panel: `/admin` — the login is `ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env` (if `ADMIN_PASSWORD` is empty, the seeder generates one and prints it).

Run tests: `php artisan test`

## Deploying to Vercel

The repo is set up for Vercel with the community PHP runtime (`vercel-php`, PHP 8.4): see `vercel.json` and `api/index.php`.
Every push to `main` redeploys automatically through the GitHub Action in `.github/workflows/deploy-vercel.yml`
(used instead of Vercel's own Git connection, because the Vercel account is linked to a different GitHub account).

**Before every push:** run `npm run build`, then commit `public/build`. Vercel serves the prebuilt CSS/JS and does not run Node.

One-time setup:

1. **Database** — Vercel's disk is read-only, so SQLite can't be used in production. In Vercel go to *Storage → Create → Neon (Postgres)*, free plan, and connect it to the project.
2. **Connect GitHub to Vercel with a token** (no Git import needed):
   - Vercel: create a token at *Account Settings → Tokens* (scope: the Digitales team).
   - Vercel: copy the **Project ID** (*gef → Settings → General*) and the **Team ID** (*Team Settings → General*).
   - GitHub `Hamzairshad0/GEF`: *Settings → Secrets and variables → Actions → New repository secret*, add
     `VERCEL_TOKEN`, `VERCEL_PROJECT_ID`, `VERCEL_ORG_ID` (the Team ID).
   - In the Vercel project keep Framework Preset = *Other*; `vercel.json` sets everything else.
3. **Environment variables** (*Settings → Environment Variables*):

   | Name | Value |
   |---|---|
   | `APP_KEY` | the `APP_KEY` line from your local `.env` (or a new one from `php artisan key:generate --show`) |
   | `APP_URL` | your Vercel URL, e.g. `https://gef.vercel.app` |
   | `DB_CONNECTION` | `pgsql` |
   | `DB_URL` | the Neon connection string (`postgresql://…?sslmode=require`) |

4. **Create tables and load the content** into Neon, from your computer (PowerShell, inside this folder):

   ```powershell
   $env:DB_CONNECTION="pgsql"; $env:DB_URL="postgresql://...your Neon URL..."; $env:ADMIN_PASSWORD="choose-a-strong-password"
   php -d extension=pdo_pgsql artisan migrate --seed --force
   ```

5. **Deploy** — push to `main`, or run it by hand from GitHub *Actions → Deploy to Vercel → Run workflow*.

Limits on Vercel: admin **image uploads** are disabled (read-only disk) — add images to `public/uploads` in the repo instead. Text edits, slides, donations, messages and volunteer forms all work.

## What's where

| Area | Files |
|---|---|
| Routes (same paths as the old site) | `routes/web.php` |
| Organisation details, nav data, donation causes, milestones, schools by province | `config/ghazali.php` |
| Pages | `resources/views/pages/*` |
| Home hero slider | `resources/views/partials/home/hero.blade.php` + `initHero()` in `resources/js/app.js` |
| Design tokens (colours, fonts, animations) | `resources/css/app.css` (`@theme`) |
| Admin panel | `app/Http/Controllers/Admin/*`, `resources/views/admin/*` |
| Seed content crawled from the live site | `database/seeders/data/*.json`, `database/seeders/ContentSeeder.php` |
| Images (mirrored from the live site) | `public/uploads/**` |

### Content model

- **posts** — programs, departments, causes (`campaign`), success stories and blogs, split by `type`. Each keeps its original URL prefix (`/our-programs/…`, `/our-departments/…`, `/our-campaigns/…`, `/our-achievements/…`, `/blog/…`).
- **hero_slides** — home page slider (managed under *Admin → Hero slides*).
- **people** (board, ambassadors), **documents** (newsletters, annual/audit reports, etaleem magazine), **galleries / gallery_images**, **videos**.
- **donations**, **contact_messages**, **volunteer_applications** — submissions from the public forms, visible in the admin inbox.

### Notes

- Donations are stored as *pledges* (the original site had no payment gateway). Staff follow up and mark them `contacted` / `received` in the admin. A gateway (JazzCash, Easypaisa, Stripe…) can be added in `SubmissionController::donate`.
- PDFs and the five home page program videos are still linked from `ghazalifoundation.org/wp-content/uploads/…`. Copy them into `public/uploads` before the old site is switched off.
- Post bodies are trusted HTML entered by admins and rendered unescaped.
