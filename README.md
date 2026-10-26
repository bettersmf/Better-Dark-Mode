# Better Dark Mode

**A clean, native-feeling dark mode for SMF 2.1.x Curve2.**

Better Dark Mode adds an optional dark appearance layer to Simple Machines Forum without editing Curve2's core theme files. It is designed to keep SMF familiar while making long browsing and administration sessions easier on the eyes.

> **Keep Curve2 familiar. Make it darker. Make it better.**

## Features

- Native-feeling dark mode tuned for SMF 2.1.x Curve2
- System / Light / Dark default modes
- Visitor-accessible sun/moon toggle
- Remembers each visitor's choice in the browser
- Early bootstrap helps prevent the bright white flash during page load
- Dark styling for boards, topics, posts, forms, buttons, popups, pagination and the administration area
- Consistent blue/steel selected navigation states
- Optional Curve/Curve2-only protection
- Better Gallery button compatibility
- No Curve2 core theme file edits
- Clean SMF integration-hook install/uninstall behavior

## Current Version

**0.1.0d**

This build includes the SMF GenericMenu admin tab-context hotfix and the previous Better Gallery contrast and admin settings fixes.

## Compatibility

- Simple Machines Forum **2.1.x**
- Developed and tested on modern SMF 2.1 releases
- PHP 8.x friendly
- Designed primarily for the stock **Curve2** theme and Curve-derived themes

Better Dark Mode can be restricted to Curve/Curve2 from its administration settings.

## Installation

1. Download the latest Better Dark Mode package from the GitHub **Releases** section.
2. In SMF, open **Administration Center → Main → Package Manager → Download Packages**.
3. Upload the Better Dark Mode ZIP.
4. Install the package normally.
5. Open **Administration Center → Configuration → Better Dark Mode → Settings**.
6. Choose the default color mode and whether visitors may use the light/dark toggle.

## Settings

Better Dark Mode currently provides four simple controls:

- **Enable Better Dark Mode**
- **Default color mode:** System preference, Light, or Dark
- **Show visitor toggle**
- **Only apply to Curve / Curve2**

The goal is to stay focused rather than turn dark mode into another theme editor.

## How It Works

Better Dark Mode uses SMF integration hooks to load its stylesheet, JavaScript and early page bootstrap. It does not require modifications to Curve2's PHP template files.

A visitor's manual Light/Dark choice is stored locally in the browser. If no manual choice has been made and the administrator selects **System preference**, Better Dark Mode follows the visitor's operating-system preference.

## Better Gallery Compatibility

Better Dark Mode includes targeted compatibility styling for Better Gallery controls so Gallery toolbar and action buttons remain readable and consistent in dark mode.

## Project Structure

```text
Sources/
  BetterDarkMode.php

Themes/default/
  css/
    better_dark_mode.css
  images/admin/
    better_dark_mode.png
    big/
      better_dark_mode.png
  languages/
    BetterDarkMode.english.php
  scripts/
    better_dark_mode.js

better_dark_mode_install.php
better_dark_mode_uninstall.php
package-info.xml
```

## Support & More Better SMF MODs

Better Dark Mode is part of the **Better SMF** project.

Visit **https://bettersmf.com/** for support, discussion, downloads and the rest of the Better SMF MOD ecosystem.

## Development Philosophy

Better SMF MODs are built around a simple idea:

**Keep SMF familiar. Make it better.**

Better Dark Mode follows that philosophy by adding the feature without redesigning the forum or replacing Curve2's established workflow.

## License

A project license will be published separately. Until then, all rights are reserved unless otherwise stated.
