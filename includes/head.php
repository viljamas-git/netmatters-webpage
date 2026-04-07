<!DOCTYPE html>
<!--
HEAD PARTIAL GUIDE
- This include opens the HTML document and injects all global <head> assets.
- It also starts the visual page shell container used by every route.
- Pages include this file first so metadata, CSS, and font resources are always consistent.
-->
<!--
FIX NOTES (HTML) — Short comments describing what was fixed for failed checks.
Fix 01: Corrected the DOCTYPE so HTML validation starts from standards mode.
Fix 02: Normalised folder-based asset paths (css/img/fonts) to keep structure logical.
Fix 03: Closed previously unclosed tags and removed invalid nesting reported by W3C validator.
Fix 04: Replaced hard-coded absolute references with local relative paths where needed.
Fix 05: Updated font file references in markup-linked assets to remove 404-related console errors.
Fix 06: Consolidated to one shared page-width container pattern to keep alignment consistent.
Fix 07: Ensured all actionable elements are semantic links/buttons so pointer cursor styling can apply.
Fix 08: Reworked header markup grouping so logo, CTAs, search and burger align per breakpoint.
Fix 09: Updated burger button markup to use span bars for animation-ready structure.
Fix 10: Added/adjusted classes for desktop search input + button border-radius split.
Fix 11: Added breakpoint-specific utility classes for iPad landscape to show search icon only.
Fix 12: Added breakpoint-specific utility classes for iPad portrait to hide support/contact buttons.
Fix 13: Added mobile-only phone icon/header item wrappers to match required visible controls.
Fix 14: Simplified nav item markup so icons and labels exist for every primary service item.
Fix 15: Added dropdown container markup under each nav item to support hover persistence.
Fix 16: Ensured dropdown content is nested inside trigger item for stable hover/cursor interactions.
Fix 17: Removed duplicate inner container on banner content to align with global content width.
Fix 18: Added semantic wrapper classes for banner overlay and text alignment by breakpoint.
Fix 19: Added arrow icon element inside hero button markup to match required button content.
Fix 20: Reworked services section heading/link wrapper so title and link sit on opposing sides.
Fix 21: Added consistent card internals (icon/title/text/button wrappers) for centered spacing.
Fix 22: Added accreditation logo wrappers with BW/colour pair elements for hover/click swapping.
Fix 23: Added missing icon span in About CTA buttons so arrow icon can be styled by CSS.
Fix 24: Added latest-news category badge markup and card meta wrappers for consistent layout.
Fix 25: Added client tooltip structure (panel, pointer, CTA) directly within each client logo item.
-->
<html lang="en-GB">
<head>
	<meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="ROBOTS" content="NOINDEX,NOFOLLOW"> 
	<title>Full Service Digital Agency | Cambridgeshire & Norfolk | Netmatters</title>
	<link rel="icon" type="image/x-icon" href="img/branding/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body<?= isset($pageClass) && $pageClass ? ' class="' . htmlspecialchars($pageClass, ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
