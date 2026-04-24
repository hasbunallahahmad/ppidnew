# Government Website Design Patterns

## Landing Page Hero Section

**Purpose**: Immediate clarity of agency/service + primary CTA

**Structure**:
```html
<section class="hero">
  <div class="hero-content">
    <h1>Official Name + Service</h1>
    <p>One-line value proposition (citizen-friendly language)</p>
    <a href="/apply" class="btn btn-primary">Primary CTA Text</a>
  </div>
  <div class="hero-visual">
    <!-- Image, icon, or svg -->
  </div>
</section>
```

**Design Notes**:
- H1 contains agency name or primary service name
- Subheading explains benefit (not feature)
- CTA uses action verbs: "Apply Now", "Get Started", "Learn More"
- Image has alt text
- Mobile: Single column, no horizontal scroll
- Background: Solid color or subtle gradient (avoid code patterns)

---

## Service Cards Section

**Purpose**: Organize 3–6 top citizen tasks into scannable, clickable cards

**Structure**:
```html
<section class="services">
  <h2>Our Services</h2>
  <div class="cards-grid">
    <article class="card">
      <h3>Service Name</h3>
      <p>Brief description (2–3 sentences)</p>
      <a href="/services/name">Learn More →</a>
    </article>
    <!-- Repeat for each service -->
  </div>
</section>
```

**Design Notes**:
- Grid: 1 column (mobile), 2–3 columns (tablet), 3+ (desktop)
- Card height consistent
- Icon + heading + description + link
- Link text actionable ("Learn More", "Apply", "Find Eligibility")
- Hover: Subtle shadow or color shift (accessible)
- Touch target ≥ 44×44px for entire card

---

## How It Works / Process Section

**Purpose**: Build confidence by showing process steps required

**Structure**:
```html
<section class="process">
  <h2>How It Works</h2>
  <ol class="steps">
    <li><strong>Step 1:</strong> Gather documents</li>
    <li><strong>Step 2:</strong> Fill out form</li>
    <li><strong>Step 3:</strong> Submit and wait for confirmation</li>
    <li><strong>Step 4:</strong> Get your permit</li>
  </ol>
</section>
```

**Design Notes**:
- Use `<ol>` for ordered steps
- Timeline visual (optional, ensure accessible)
- Estimated duration for each step
- Examples of required documents
- Link to download forms/checklists

---

## FAQ Section

**Purpose**: Address common objections and reduce support burden

**Structure**:
```html
<section class="faq">
  <h2>Frequently Asked Questions</h2>
  <dl>
    <dt><strong>Question?</strong></dt>
    <dd>Answer with specific details, links to resources.</dd>
    <!-- Repeat -->
  </dl>
</section>
```

**Design Notes**:
- Collapsible (accordion) optional if > 8 FAQs
- If collapsible: use `aria-expanded` attribute
- Answer referencing docs with links
- Order by frequency (analytics-driven)
- Link to detailed help pages

---

## Form Patterns

**Best Practice Structure**:
```html
<form method="POST" action="/apply">
  <fieldset>
    <legend>Personal Information</legend>
    
    <div class="form-group">
      <label for="full_name">Full Name <span aria-label="required">*</span></label>
      <input 
        type="text" 
        id="full_name" 
        name="full_name" 
        required 
        aria-required="true"
      >
    </div>

    <div class="form-group">
      <label for="email">Email <span aria-label="required">*</span></label>
      <input 
        type="email" 
        id="email" 
        name="email" 
        required
      >
      <small>We'll send confirmation here</small>
    </div>
  </fieldset>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Submit Application</button>
    <button type="reset" class="btn btn-secondary">Clear Form</button>
  </div>
</form>
```

**Design Notes**:
- Labels above inputs (not inside placeholders)
- One column layout (easier scanning)
- Fieldsets group related fields
- Legends identify fieldset purpose
- Help text below input (not placeholder)
- Show progress: "Step 2 of 4"
- Success/error validation clear and linked

---

## Call-to-Action Patterns

**High-Intent CTA**:
```html
<section class="cta-section">
  <h2>Ready to Apply?</h2>
  <p>Follow these simple steps and get started today.</p>
  <a href="/apply" class="btn btn-primary btn-lg">Apply Now</a>
</section>
```

**Secondary CTA**:
```html
<a href="/learn-more" class="btn btn-secondary">Learn More</a>
```

**Design Notes**:
- Primary: Bold color, contrasting text
- Secondary: Outline or muted color
- CTA text specific to action (not "Click Here")
- Responsive: Button remains clickable on mobile
- Placement: Above fold (hero), within content, before footer

---

## Navigation Pattern

**Desktop + Mobile Header**:
```html
<header role="banner">
  <div class="navbar">
    <div class="navbar-branding">
      <a href="/">Agency Logo + Name</a>
    </div>
    
    <!-- Desktop Nav (always visible) -->
    <nav aria-label="Main navigation" class="nav-desktop">
      <ul>
        <li><a href="/services">Services</a></li>
        <li><a href="/apply">Apply</a></li>
        <li><a href="/faq">FAQ</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
    </nav>

    <!-- Mobile Nav (hamburger menu) -->
    <button 
      aria-label="Toggle menu" 
      aria-expanded="false" 
      class="menu-toggle"
    >
      ☰
    </button>
  </div>
</header>
```

**Design Notes**:
- Sticky header helps navigation
- Mobile hamburger menu with aria-label
- Current page indicated (active state)
- Search bar optional (for large sites > 50 pages)
- Breadcrumbs on detail pages

---

## Footer Pattern

**Government Website Footer**:
```html
<footer role="contentinfo">
  <div class="footer-content">
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="/services">Services</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/careers">Careers</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Legal</h3>
      <ul>
        <li><a href="/privacy">Privacy Policy</a></li>
        <li><a href="/terms">Terms</a></li>
        <li><a href="/accessibility">Accessibility Statement</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Contact</h3>
      <p>Phone: <a href="tel:+1234567890">123-456-7890</a></p>
      <p>Email: <a href="mailto:info@agency.gov">info@agency.gov</a></p>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2024 Agency Name. All rights reserved.</p>
  </div>
</footer>
```

**Design Notes**:
- Three columns on desktop, stacked on mobile
- Accessibility statement prominently linked
- Contact info easily scannable
- Privacy/terms accessible
- Copyright year dynamic if possible

---

## Responsive Breakpoints

**Mobile First**:
- **320px–767px**: Single column, large touch targets
- **768px–1023px**: Two columns, optimized tablet
- **1024px+**: Multi-column, full features

**Example Values**:
- Padding: 1rem (mobile) → 2rem (tablet) → 3rem (desktop)
- Font: 14px (mobile) → 16px (tablet) → 18px (desktop)
- Grid: 1 column → 2 columns → 3+ columns
