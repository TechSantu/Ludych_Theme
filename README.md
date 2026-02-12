# Ludych Theme

**Theme Name:** Ludych Theme  
**Theme URI:** https://ludych-v2.webcrazeo.in/  
**Author:** DevSantu  
**Author URI:** https://webcrazeo.in/  
**Description:** A modern, clean, and responsive theme.  
**Version:** 1.0  
**License:** GNU General Public License v2 or later  
**Text Domain:** ludych-theme

## Overview
Ludych Technology is a premium, high-impact WordPress theme designed for modern digital agencies. It features a refined design aesthetic, modular template parts, and fully dynamic content management via ACF.

## Key Features
- Dynamic Packages Page: Fully refactored to use modular template parts and ACF repeater fields.
- Premium UI/UX: Sophisticated shadows, sharp borders (12px radius), and modern typography.
- SEO Optimized: Built-in JSON-LD Schema markup for FAQs, Services/Offers, and Breadcrumbs.
- Mobile Responsive: Custom-tailored styles for mobile devices, including fixed header overlaps and optimized spacing.
- Calendly Integration: Integrated meeting scheduler on the contact page.
- Dynamic Backgrounds: Support for ACF-managed background images and colors.

## Tech Stack
- WordPress Core
- ACF (Advanced Custom Fields): For dynamic content management.
- Bootstrap 5: For responsive grid and components.
- Vanilla CSS: Premium design tokens and micro-interactions.
- FontAwesome 6: For high-quality vector icons.
- JSON-LD: For structured data and rich search results.

## File Structure
```
Ludych_Theme/
├── assets/                 # Styles, Scripts, and Images
├── inc/                    # Theme functions and handlers
├── templates/              # Custom Page Templates
│   ├── packages.php        # Modular Packages Page
│   └── contact-us.php      # Dynamic Contact Page
├── template-parts/         # Reusable HTML sections
│   ├── common/             # Global components (Header, Footer, Banners)
│   └── packages/           # Packages Page specific parts (Hero, Intro, Pricing, FAQ)
└── functions.php           # Core theme logic
```

## Packages Page Configuration (ACF)
The Packages page (templates/packages.php) is built using modular template parts. To manage content, create a "Packages Page Fields" group in ACF and assign it to the "Packages Page" template.

### Field Mapping:
- Hero Section: packages_hero_background, packages_hero_kicker, packages_hero_title, packages_hero_subtitle
- Intro Section: packages_intro_badge, packages_intro_title, packages_intro_description, packages_intro_image
- Pricing Packages (Repeater): packages_pricing_packages (name, description, price, price_label, features, outcome, is_featured)
- FAQ (Repeater): packages_faqs (question, answer)

## SEO & Schema
The theme automatically generates JSON-LD schema for:
- BreadcrumbList: Improved navigation in SERPs.
- Service & Offers: Rich snippets for pricing and agency services.
- FAQPage: Expandable results in Google Search.

## Deployment
Theme is configured for FTP deployment via GitHub Actions (see .ftp-deploy-sync-state.json).

---
Developed by Ludych Technology Agency | 2026
