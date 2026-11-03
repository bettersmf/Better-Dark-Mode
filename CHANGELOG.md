# Changelog

## 0.1.0h

- Packaging-only corrective release.
- Rebuilt the release as a complete install/upgrade package after the published 0.1.0g GitHub asset was found to be incomplete.
- Includes the full 0.1.0g runtime, stylesheet, JavaScript, language file, admin icons, installer, and uninstaller.
- Adds direct upgrade support from 0.1.0g.
- No runtime behavior changes from 0.1.0g.

## 0.1.0g

- Fixed the reply border-radius not being visually applied in 0.1.0f.
- Applied the 8px radius directly to the visible `.post_wrapper` shell.
- Clipped inner poster/postarea backgrounds inside the rounded shell.
- Preserved the working reply padding from 0.1.0f.
- Added direct upgrade support from 0.1.0f.

## 0.1.0f

- Added an 8px radius to topic/reply post shells in dark mode.
- Added 10px × 12px post-wrapper padding so poster/user-info content no longer sits against the edge.
- Added tighter mobile post-wrapper padding below 720px.
- Scoped the change to `#forumposts` so unrelated dark-mode surfaces are unaffected.
- Added direct upgrade support from 0.1.0e.

## 0.1.0e

- Darkened SMF error, warning, and info boxes while preserving clear semantic colors.
- Fixed nested dropdown/menu hover states that flashed pale/white and made text unreadable.
- Added explicit dark-mode surfaces and hover states for topic/reply quick-action buttons including Quote, Quick Edit, and More.
- Darkened quick-action flyout menus and their hover states.
- Added direct upgrade support from 0.1.0d.

## 0.1.0d

- Fixed SMF GenericMenu tab-context warnings in the Better Dark Mode administration area.
- Added an explicit Settings subsection and active tab context.
- Retained the SMF 2.1 ManageServer.php settings compatibility fix.

## 0.1.0c

- Hardened the Better Dark Mode admin-area menu registration.

## 0.1.0b

- Fixed administration settings loading on SMF 2.1.x by using ManageServer.php instead of the undefined SUBSDIR constant.

## 0.1.0a

- Added Better Gallery dark-mode button contrast compatibility.

## 0.1.0

- Initial public build.
- Added Curve2 dark-mode styling.
- Added System / Light / Dark modes.
- Added remembered visitor toggle with sun/moon states.
- Added administration settings.
- Added Curve/Curve2-only option.
