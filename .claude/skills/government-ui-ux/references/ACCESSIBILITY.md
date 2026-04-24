# Accessibility Checklist for Government Websites

## Keyboard Navigation
- [ ] All interactive elements reachable via Tab key
- [ ] Tab order is logical (left→right, top→bottom)
- [ ] Shift+Tab moves backward
- [ ] Focus outline visible (no outline removal with `outline: none`)
- [ ] Skip links work: "Skip to main content"
- [ ] Modals trap focus inside when open
- [ ] Escape key closes modals/menus

## Color & Contrast
- [ ] Text contrast ≥ 4.5:1 (AA level, normal text < 18.5px)
- [ ] Large text contrast ≥ 3:1 (≥ 18.5px or ≥ 14px bold)
- [ ] UI components (buttons, borders) ≥ 3:1 contrast
- [ ] No information conveyed by color alone
- [ ] Test with WebAIM, Axe, or Chrome DevTools
- [ ] Simulator: Use Coblis or Chrome color-blindness filter

## Semantic HTML & ARIA
- [ ] Use native HTML elements first (`<button>`, `<a>`, `<nav>`)
- [ ] Headings use H1–H6 (no skipping: H1 → H3)
- [ ] Form labels associated: `<label for="id">` or role="label"
- [ ] List structure: `<ul>`, `<ol>`, `<li>` for lists
- [ ] Main content in `<main>`, navigation in `<nav>`, regions in `<section>`
- [ ] Use `aria-label`, `aria-labelledby`, `aria-describedby` sparingly
- [ ] Live regions with `aria-live="polite"` for alerts

## Forms
- [ ] Labels visible above or inside inputs
- [ ] Required fields marked (`*` + text or aria-required="true")
- [ ] Errors linked to fields via `aria-invalid` + `aria-describedby`
- [ ] Error messages specific (not "Error on form")
- [ ] Placeholder text not substitute for label
- [ ] Radio/checkbox connected to labels (`<label><input></label>`)
- [ ] Input type correct (email, tel, date, number)

## Images & Media
- [ ] All images have alt text
- [ ] Alt text is descriptive (not "image of building", but "City Hall entrance")
- [ ] Decorative images have empty alt: `alt=""`
- [ ] Complex images (charts) have text description nearby
- [ ] Video captions/subtitles for dialogue
- [ ] Audio transcript provided
- [ ] Animated GIFs accessible via text and control

## Mobile & Touch
- [ ] Touch targets ≥ 44×44 pixels
- [ ] Spacing between targets (24px+ recommended)
- [ ] No hover-only interactions (must have alternative)
- [ ] Responsive text (not pinch-zoom required)
- [ ] Landscape/portrait both usable

## Screen Reader Testing
- [ ] Test with NVDA (Windows), JAWS, or VoiceOver (Mac/iOS)
- [ ] Page structure makes sense read aloud
- [ ] Headings navigable (H key in screen readers)
- [ ] Form fields announced with labels
- [ ] Links have descriptive text (not "Click here")
- [ ] Tables have headers (`<th>`) and captions (`<caption>`)

## Performance
- [ ] Page load < 3 seconds on 4G (Lighthouse)
- [ ] Lighthouse Accessibility score ≥ 90
- [ ] No console accessibility errors
- [ ] `prefers-reduced-motion` respected (no auto-play)

## Tools
- Wave: https://wave.webaim.org/
- Axe DevTools: https://www.deque.com/axe/devtools/
- Lighthouse: Built into Chrome DevTools (Audit tab)
- NVDA: Free screen reader for Windows
