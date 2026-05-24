# Hakshan WordPress Theme — Installation Guide

## Requirements

- WordPress 6.0+
- PHP 8.0+
- No required plugins (ACF, WPML, Contact Form 7, etc.)

---

## 1. Install the Theme

Copy the `hakshan/` folder into `wp-content/themes/`, then go to **Appearance → Themes** and activate **Hakshan**.

---

## 2. Create Pages

Go to **Pages → Add New** and create one page for each of the following. Assign the template shown in the **Page Attributes → Template** dropdown.

| Page Title | Slug | Template |
|---|---|---|
| Home | `/` (set as front page — see step 3) | *Front Page* (auto-applied) |
| Menu | `menu` | Menu |
| Outlets | `outlets` | Outlets |
| Our Story | `story` | Our Story |
| Contact | `contact` | Contact |
| Investors | `investors` | Investors |

**Leave page content blank** — all content is rendered by the template.

---

## 3. Set the Homepage

Go to **Settings → Reading** and set:

- **Your homepage displays:** A static page
- **Homepage:** Home
- **Posts page:** (leave blank or set to a blog page you don't need)

---

## 4. Set the Navigation Menu

Go to **Appearance → Menus**. Create a menu named `Primary` and add your six pages. Assign it to the **Primary Navigation** location.

> The theme also hard-codes the nav from the pages array in `header.php` — if you do not assign a menu, nav still renders. The menu location is optional.

---

## 5. Set the Reservation Email Address

Go to **Settings → Hakshan Settings** and enter the email address where reservation notifications should be sent. If left blank, reservations are sent to the WordPress admin email.

---

## 6. Add Menu Items (Optional — theme ships with static fallback content)

The Menu page works immediately with static dish content. To manage dishes via WordPress:

1. Go to **Menu Items → Add New**
2. Enter the English dish name as the post title
3. Enter the excerpt as the English description
4. Set the **Dish Category** taxonomy (matching one of the seven slugs below)
5. Add a featured image (recommended: 560×560 px, square)
6. Under **Dish Details** meta box: add the Chinese name and Chinese description
7. Use **Page Attributes → Order** to sort dishes within a category

### Dish Category Slugs

Create these categories under **Menu Items → Dish Categories** exactly as shown:

| Category Name (EN) | Slug |
|---|---|
| Signatures | `signatures` |
| Salt & Smoke | `salt-smoke` |
| Braised | `braised` |
| Yong Tau Foo | `yong-tau-foo` |
| Rice & Noodles | `rice-noodles` |
| Soups & Wines | `soups-wines` |
| Sweet | `sweet` |

---

## 7. Add Outlets (Optional — theme ships with static fallback content)

The Outlets page works immediately with static content for all nine locations. To manage outlets via WordPress:

1. Go to **Outlets → Add New**
2. Enter the outlet name (e.g. `USJ Taipan`) as the post title
3. Add a featured image (recommended: 760×570 px, landscape)
4. Use **Page Attributes → Order** to sort outlets in the carousel and grid
5. Fill in the **Outlet Details** meta box fields:

| Field | Notes |
|---|---|
| Chinese Name | e.g. `客善 USJ` |
| City | e.g. `Subang Jaya` |
| Address | Full street address |
| Hours | e.g. `Tue–Sun · 11:00 — 22:00` |
| Seats | e.g. `64 seats + 12 outdoor` |
| Phone | e.g. `+60 3-5612 3456` |
| Google Maps URL | Full maps.google.com link |

The outlet `slug` (set in the URL field when editing the post) is used as the modal hash key — e.g. the outlet with slug `usj` opens via `#usj` in the URL. Keep slugs short and lowercase.

---

## 8. Image Sizes

The theme registers these image sizes. WordPress will generate them automatically when images are uploaded, or you can run a regeneration plugin (e.g. Regenerate Thumbnails) after adding sizes.

| Size name | Dimensions | Used for |
|---|---|---|
| `outlet-card` | 760 × 570 | Outlet grid, outlet carousel |
| `dish-card` | 560 × 560 | Menu dishes |
| `portrait` | 600 × 800 | Story page portraits |
| `gallery-thumb` | 800 × 1000 | Homepage gallery |

---

## 9. AJAX Reservation Form

The contact page reservation form submits via AJAX to WordPress's `admin-ajax.php`. On success:

- An email is sent to the address configured in **Settings → Hakshan Settings**
- A confirmation email is sent to the customer (if they provided an email)
- The form resets

No external form plugin is required. WP Mail must be configured — on most hosts it works out of the box. For reliable delivery, install a transactional mail plugin such as **WP Mail SMTP** and connect it to your mail provider.

---

## 10. SEO

The theme outputs proper `<title>` tags via `add_theme_support('title-tag')`. For meta descriptions and Open Graph tags, install **Yoast SEO** or **Rank Math** — both are compatible.

---

## Theme Structure

```
hakshan/
├── style.css               # Theme declaration
├── index.php               # Fallback
├── header.php              # Nav + mobile drawer
├── footer.php              # Footer columns
├── page.php                # Generic page template
├── front-page.php          # Homepage
├── page-menu.php           # Menu page (Template: Menu)
├── page-outlets.php        # Outlets page (Template: Outlets)
├── page-story.php          # Our Story page (Template: Our Story)
├── page-contact.php        # Contact page (Template: Contact)
├── page-investors.php      # Investors page (Template: Investors)
├── functions.php           # Theme setup, CPTs, AJAX, helpers
└── assets/
    ├── css/
    │   ├── styles.css      # Global styles, tokens, nav, footer
    │   └── inner.css       # Inner page styles
    ├── js/
    │   ├── shell.js        # Lang toggle, reveal, drawer, menu TOC
    │   └── site.js         # Carousels, outlet modal, reservation form
    ├── fonts/              # Brother 1816 woff2 files
    └── brand/              # Logo PNGs
```
