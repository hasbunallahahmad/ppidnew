---
name: government-ui-ux
description: 'UI/UX for government websites and applications, especially landing pages. Use when building public-sector interfaces, designing landing pages, creating government forms, working on accessibility compliance, or improving information architecture for citizen-facing digital services.'
argument-hint: 'Feature, page section, or accessibility concern to address'
user-invocable: true
---

# Government Website UI/UX & Landing Page Design

## When to Use

This skill applies to:
- **Landing page creation** for government agencies or public services
- **Hero sections, cards, CTAs** that need clarity and accessibility
- **Public-facing forms** and data collection interfaces
- **Information hierarchy** for complex government services
- **Accessibility compliance** (WCAG 2.1 AA/AAA standards)
- **Performance optimization** for public citizens (varying devices/connectivity)
- **Government site components** (headers, navigation, footers)

## Core Principles

### 1. **Accessibility First (WCAG 2.1 AA Minimum)**
- All interactive elements keyboard navigable (Tab/Enter)
- Color contrast ≥ 4.5:1 for text; ≥ 3:1 for UI components
- Semantic HTML (`<button>`, `<nav>`, `<main>`, `<footer>`)
- ARIA labels for icons and hidden text
- Focus visible on all focusable elements (outline visible, not removed)
- Form labels associated with inputs (`<label for="id">`)

### 2. **Mobile-First Responsive Design**
- Design mobile view first, then scale up
- Touch targets ≥ 44×44px (WCAG 2.5.5)
- Responsive breakpoints: 320px, 768px, 1024px, 1280px+
- Avoid horizontal scroll on mobile
- Test on real devices (not just browser DevTools)

### 3. **Clear Information Architecture**
- **80/20 rule**: 80% of citizens use 20% of services → prominently feature top tasks
- **Progressive disclosure**: Hide advanced options, show essential info first
- **Scannable content**: Short paragraphs (3-4 sentences), bulleted lists, headers
- **Breadcrumbs** for navigation clarity on dense sites
- **Consistent naming** (use citizen-friendly terms, not jargon)

### 4. **Performance & Accessibility for Low-Bandwidth Users**
- Load time target: **< 3 seconds** on 4G (3Mbps)
- Images: Optimize (WebP + PNG fallback), use srcset for responsive
- Avoid heavy animations; use `prefers-reduced-motion`
- Minimize JavaScript; prioritize server-side rendering
- Compress assets gzip/brotli enabled

### 5. **Typography & Readability**
- Base font size ≥ 16px for body text
- Line height 1.5–1.6 for body
- Line length 50–75 characters (optimal readability)
- Sans-serif fonts for screen (Helvetica, Arial, Segoe UI, system fonts)
- Adequate whitespace (padding/margins) to avoid cognitive overload
- Dark text on light background (WCAG contrast required)

### 6. **CTA Placement & Visibility**
- Primary CTA in viewport (above fold) on landing page
- Use color that stands out (typically brand color with contrast)
- CTA text clear: "Apply Now", "Learn More", not "Click Here"
- Distinguish primary vs. secondary actions
- CTA within 2–3 clicks from entry point

### 7. **Security & Data Privacy**
- HTTPS enforced (no mixed content)
- Privacy policy and terms visible in footer
- No tracking without explicit consent
- Clear data handling practices
- Form validation: client-side for UX, server-side for security

---

## Landing Page Creation Workflow

### Phase 1: Discovery & Planning
1. **Identify top citizen tasks** (surveys, analytics, research)
2. **Define job-to-be-done**: Why do citizens visit? What action do they take?
3. **Create user persona**: Government service recipient, device, literacy level
4. **Outline messaging**: Hero headline, 2–3 key value propositions
5. **Plan CTA flow**: Single clear action (e.g., "Apply for Permit")

### Phase 2: Information Architecture
1. **Hero section**: Agency name + clear value statement + primary CTA
2. **Key services section**: 3–4 most common tasks (cards or list)
3. **How it works / process**: Steps and timeline for citizen journey
4. **FAQs**: Address common questions and concerns
5. **Call-to-action section**: Reinforce primary CTA before footer
6. **Footer**: Legal links, accessibility statement, contact

### Phase 3: Accessibility & Design
1. **Use semantic HTML**: `<section>`, `<article>`, `<nav>`, `<footer>`, `<main>`
2. **Test with keyboard-only navigation** (Tab, Shift+Tab, Enter)
3. **Add skip links** (`<a href="#main">Skip to main content</a>`)
4. **Use ARIA** only when semantic HTML insufficient
5. **Color contrast check**: Use WebAIM or Axe tools
6. **Test with screen reader** (NVDA, JAWS, VoiceOver)

### Phase 4: Responsive & Performance
1. **Mobile UI**: Single-column layout, large touch targets
2. **Tablet UI**: 2-column begin, larger cards
3. **Desktop UI**: Multi-column, full-width capabilities
4. **Image optimization**: Lazy load, responsive srcset, alt text
5. **Font optimization**: System fonts or preloaded web fonts (limit to 2–3)
6. **Minify CSS/JS**, enable gzip compression

### Phase 5: Testing & Iteration
1. **Accessibility audit**: [WebAIM Wave](https://wave.webaim.org/), [Axe DevTools](https://www.deque.com/axe/devtools/)
2. **Lighthouse CI**: Target 90+ on Accessibility and Performance
3. **Mobile device testing**: iOS Safari, Android Chrome
4. **User testing**: 5–8 citizens representative of audience
5. **Monitor real-world performance**: Real User Monitoring (RUM) via analytics

---

## Design Checklist

### Hero Section
- [ ] Headline clearly states government agency/service
- [ ] Supporting subheading explains key benefit
- [ ] Primary CTA button prominent and high contrast
- [ ] Hero image has alt text; avoid stock images when possible
- [ ] Mobile: Stack vertically, never horizontal scroll

### Typography
- [ ] Base font size ≥ 16px
- [ ] Line height 1.5–1.6
- [ ] Paragraph line length 50–75 chars (not too wide)
- [ ] Heading hierarchy consistent (H1 → H2 → H3, no skips)
- [ ] Links underlined or visually distinct (not color-only)

### Forms
- [ ] Labels positioned above or inside inputs (not placeholder-only)
- [ ] Required fields marked clearly (* or "required")
- [ ] Error messages specific and linked to field
- [ ] Success confirmation visible and clear
- [ ] Submit button text specific: "Submit Application" (not "Submit")

### Navigation
- [ ] Main nav item active state clearly indicated
- [ ] Mobile menu (hamburger) labels the button `aria-label="Menu"`
- [ ] Focus outline always visible (no outline removal)
- [ ] Navigation keyboard-accessible (Tab through links)

### Images & Media
- [ ] All images have descriptive alt text
- [ ] Complex images have expanded descriptions
- [ ] Video has captions (at least auto if not manual)
- [ ] No animated GIFs (use video for animation control)
- [ ] Icons paired with text labels (not icon-only)

### Color & Contrast
- [ ] Text color contrast ≥ 4.5:1 (AA) or 7:1 (AAA)
- [ ] UI component contrast ≥ 3:1
- [ ] No reliance on color alone to convey meaning
- [ ] Test with color-blindness simulator

---

## Key Templates

### Landing Page Blade Structure
```php
<!-- Hero Section -->
<section class="hero bg-gradient">
  <div class="container">
    <h1>{{ $agency }} - {{ $mission }}</h1>
    <p class="lead">{{ $value_proposition }}</p>
    <a href="{{ $cta_link }}" class="btn btn-primary btn-lg">{{ $cta_text }}</a>
  </div>
</section>

<!-- Key Services -->
<section class="services">
  <div class="container">
    <h2>Services We Provide</h2>
    <div class="cards-grid">
      @foreach ($services as $service)
        <article class="card">
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->description }}</p>
          <a href="{{ $service->url }}">Learn More →</a>
        </article>
      @endforeach
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-primary">
  <div class="container">
    <h2>Ready to {{ $action }}?</h2>
    <a href="{{ $cta_link }}" class="btn btn-secondary btn-lg">{{ $cta_text }}</a>
  </div>
</section>
```

### Accessibility Practices (Blade)
```php
<!-- Skip Links -->
<a href="#main-content" class="sr-only">Skip to main content</a>

<!-- Semantic Structure -->
<header role="banner">
  <nav aria-label="Main">...</nav>
</header>
<main id="main-content">
  <article>...</article>
</main>
<footer role="contentinfo">...</footer>

<!-- Form Labels -->
<div class="form-group">
  <label for="permit-type">Permit Type <span aria-label="required">*</span></label>
  <select id="permit-type" name="permit_type" required>...</select>
</div>

<!-- Alt Text for Images -->
<img src="building.jpg" alt="City Hall building entrance, main service desk visible">
```

---

## References

- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/) — Full accessibility standards
- [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/) — Test color contrast
- [Lighthouse CI](https://github.com/GoogleChrome/lighthouse-ci) — Automated audits
- [USA.gov Web Standards](https://www.gov.uk/guidance/design-standards-for-uk-government-digital-services) — Government design patterns
- [Section 508 Compliance](https://www.section508.gov/) — Federal accessibility requirements
- [Mobile-First Responsive Design](https://www.w3.org/Mobile/mobile-web-apps/) — Progressive enhancement

---

## Example Prompts

- `/government-ui-ux hero section for recycling permit landing page`
- `Create accessible form for citizen complaints using /government-ui-ux`
- `Audit landing page navigation for WCAG 2.1 AA compliance`
- `Build cards component for government services landing page`
