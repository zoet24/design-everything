# Design Everything WordPress Theme

A custom WordPress theme for Design Everything featuring custom post types, animated carousels, and dynamic page introductions.

## Overview

Design Everything is a not-for-profit collective founded in 2024 with a mission to support emerging designers and to tackle issues we see within the design world. This website is built on WordPress with a custom theme. The site features:

- Custom post types: People, Platform, and Progress
- Home page carousel with loading animations
- Toggleable page introduction boxes
- Responsive navigation with dynamic backgrounds
- Mobile-responsive design

## Tech Stack

- **WordPress**
- **PHP**
- **SCSS** (compiled to CSS)
- **Vanilla JavaScript** (no jQuery)
- **Advanced Custom Fields (ACF)** - Free version

## File Structure

```
design-everything/
├── assets/
│   ├── fonts/           # Roobert font files
│   └── images/          # Logo, paper textures
├── inc/
│   ├── cpt.php         # Custom post type registration
│   ├── enqueue-scripts.php  # CSS/JS loading
│   ├── nav-walker.php  # Custom navigation walker
│   └── shortcodes.php  # Custom shortcodes
├── src/
│   ├── js/
│   │   ├── carousel.js      # Home carousel functionality
│   │   └── page-intros.js   # Toggle & navigation animations
│   └── scss/
│       ├── components/      # Nav, page intros, carousel
│       ├── cpts/           # People, Platform, Progress styles
│       ├── pages/          # Home page styles
│       └── _variables.scss  # Global variables
├── archive-de_person.php   # People archive template
├── archive-de_platform.php # Platform archive template
├── archive-de_progress.php # Progress archive template
├── single-de_person.php    # Single person template
├── front-page.php          # Home page template
├── header.php
├── footer.php
├── functions.php
└── style.css              # Compiled CSS (DO NOT EDIT DIRECTLY)
```

## Development Workflow

### Local Development Setup

1. **Prerequisites:**

   - Local WordPress environment (Local by Flywheel, MAMP, etc.)
   - Node.js and npm installed
   - SCSS compiler (Dart Sass recommended)

2. **Install the theme:**

```bash
   cd wp-content/themes/
   git clone [your-repo-url] design-everything
   cd design-everything
```

3. **Compile SCSS:**

   **Watch mode (auto-compile on save):**

```bash
   sass --watch src/scss/style.scss:style.css
```

**Single compile:**

```bash
   sass src/scss/style.scss style.css
```

4. **Activate the theme:**
   - WordPress Admin → Appearance → Themes
   - Activate "Design Everything"

### Making Changes Locally

#### Updating Styles

1. Edit SCSS files in `src/scss/`
2. SCSS compiles automatically if watch mode is running
3. Refresh browser to see changes (hard refresh: Ctrl+Shift+R / Cmd+Shift+R)

**Never edit `style.css` directly** - it gets overwritten when SCSS compiles!

#### Updating JavaScript

1. Edit files in `src/js/`
2. Hard refresh browser to clear cache
3. Check browser console for errors

#### Updating Templates

1. Edit PHP files in theme root or subdirectories
2. Save and refresh - changes appear immediately
3. Check for PHP errors in WordPress debug log

#### Adding New Custom Fields (ACF)

1. WordPress Admin → Custom Fields
2. Create/edit field groups
3. Export to PHP (recommended for version control):
   - Custom Fields → Tools → Export Field Groups
   - Copy generated PHP code
4. Add to `functions.php` or separate include file

### Git Workflow

```bash
# Check what changed
git status

# Stage changes
git add .

# Commit with message
git commit -m "Description of changes"

# Push to repository
git push origin main
```

**Important files to commit:**

- All `.php` files
- All `.scss` files in `src/`
- All `.js` files in `src/`
- Compiled `style.css` (for live site)
- Assets (fonts, images)

**Don't commit:**

- `node_modules/` (if using npm)
- `.DS_Store`
- Editor config files

## Deploying to Live Site

### WordPress Admin Upload

1. Zip the entire theme folder locally
2. WordPress Admin → Appearance → Themes → Add New → Upload Theme
3. Overwrite existing theme

**⚠️ Warning:** This replaces the entire theme - make backups first!

## Version Control

**Current Version:** 1.0

**Changelog:**

- v1.0 - Initial release with custom post types, carousel, responsive navigation
