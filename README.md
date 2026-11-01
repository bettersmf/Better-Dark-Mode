# Better Dark Mode 0.1.0g — Reply Radius Fix

- Fixes the reply border-radius not being visually applied in 0.1.0f.
- Applies the 8px radius directly to the visible `.post_wrapper` shell.
- Clips inner poster/postarea backgrounds inside the rounded shell.
- Preserves the working reply padding introduced in 0.1.0f.
- Adds direct upgrade support from 0.1.0f.

# Better Dark Mode 0.1.0f — Topic/Reply Shell Polish

- Adds a subtle 8px radius to topic and reply post shells in dark mode.
- Adds internal post-wrapper padding so poster/user-info content no longer rides the edge.
- Keeps the existing darker reply background unchanged.
- Uses slightly tighter spacing on mobile.
- Scoped to `#forumposts`, leaving board rows, admin panels, portal blocks, and light mode untouched.
- Adds direct upgrade support from 0.1.0e.

# Better Dark Mode 0.1.0e — Contrast State Polish

- Darkens SMF error, warning, and info boxes while preserving clear semantic colors.
- Fixes nested dropdown/menu hover states that flashed pale/white and made text unreadable.
- Gives topic/reply quick-action buttons (Quote, Quick Edit, More, etc.) explicit dark-mode surfaces and hover states.
- Darkens quick-action flyout menus and their hover states.
- Adds direct upgrade support from 0.1.0d.

# Better Dark Mode 0.1.0d — GenericMenu Tab Context Hotfix

Fixes PHP warnings from `Themes/default/GenericMenu.template.php` when Better Dark Mode is opened in the admin area.

Root cause:
- Better Dark Mode was registered as a bare single-page admin area.
- SMF GenericMenu can still enter the tab renderer for the selected area and expects a valid subsection/tab_data structure.
- That left GenericMenu reading null tab context and produced array-offset / foreach warnings.

Fix:
- Adds a real `settings` subsection.
- Forces the single-page admin route to `sa=settings`.
- Explicitly populates the active SMF menu object's `current_subsection` and `tab_data`.
- Uses the same robust menu-context discovery pattern as Better Tags.
- Retains the previous ManageServer.php settings hotfix, Gallery contrast compatibility, custom icon, and all dark-mode behavior.
