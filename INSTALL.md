# Hakshan WordPress Theme — Installation Guide

## Requirements

- WordPress 6.0+
- PHP 7.4+
- No required plugins

---

## 1. Install the Theme

ZIP the entire repository root (the folder containing `style.css`, `functions.php`, `front-page.php`, etc.) as `hakshan.zip`. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**, upload the ZIP, and activate **Hakshan**.

Alternatively, copy the repo folder into `wp-content/themes/hakshan/` and activate from **Appearance → Themes**.

---

## 2. Create the Pages

Go to **Pages → Add New** and create one page for each of the following. Set the **Page Attributes → Template** dropdown to match. The slug is what the nav and footer link to — match it exactly.

| Page title | Slug        | Template     |
| ---------- | ----------- | ------------ |
| Home       | (any)       | Default      |
| Menu       | `menu`      | Menu         |
| Outlets    | `outlets`   | Outlets      |
| Our Story  | `story`     | Our Story    |
| Investors  | `investors` | Investors    |
| Contact    | `contact`   | Contact      |

Leave each page's content area empty — every template renders its own content.

---

## 3. Set the Homepage

Go to **Settings → Reading**:

- **Your homepage displays:** A static page
- **Homepage:** Home
- **Posts page:** (leave blank)

This activates `front-page.php`.

---

## 4. Navigation

The theme renders its own nav from `functions.php#hakshan_render_nav`. You do not need to configure **Appearance → Menus** — just create the six pages above with the slugs shown and the nav will work. A `primary` menu location is registered for future use.

---

## 5. Language Toggle

The theme ships with an in-page EN / 中 toggle in the top nav. The current language is persisted in `localStorage`. All bilingual copy is rendered inside `<span data-en>` / `<span data-zh>` pairs — edit the copy directly in the page templates.

---

## Theme structure

```
hakshan/
├── style.css                # Theme header (metadata)
├── index.php                # Generic fallback
├── header.php               # Loads <head> + renders nav
├── footer.php               # Renders footer + wp_footer
├── page.php                 # Default page template
├── front-page.php           # Homepage
├── page-menu.php            # Template: Menu
├── page-outlets.php         # Template: Outlets
├── page-story.php           # Template: Our Story
├── page-investors.php       # Template: Investors
├── page-contact.php         # Template: Contact
├── functions.php            # Setup, enqueue, nav + footer renderers
└── assets/
    ├── css/
    │   ├── styles.css       # Tokens, nav, drawer, footer, buttons
    │   └── inner.css        # Shared styles for inner pages
    ├── js/
    │   └── shell.js         # Lang toggle, reveal-on-scroll, drawer
    ├── fonts/               # Brother 1816 woff2 (8 files)
    └── brand/               # Logo PNGs
```

Page-specific CSS (homepage hero, outlets modal, investor bar chart, etc.) lives in a `<style>` block at the top of each page template, faithful to the original Claude Design handoff.
