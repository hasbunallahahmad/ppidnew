/* ============================================================
   PPID KOTA SEMARANG — app.js
   ============================================================ */

document.addEventListener("DOMContentLoaded", () => {
    // ─── Navbar Scroll Effect ───
    const mainNav = document.getElementById("mainNav");
    window.addEventListener("scroll", () => {
        if (window.scrollY > 60) {
            mainNav.classList.add("scrolled");
        } else {
            mainNav.classList.remove("scrolled");
        }
    });

    // ─── Hamburger Menu ───
    const hamburger = document.getElementById("navHamburger");
    const navMenu = document.getElementById("navMenu");

    hamburger?.addEventListener("click", () => {
        hamburger.classList.toggle("open");
        navMenu.classList.toggle("open");
        document.body.style.overflow = navMenu.classList.contains("open")
            ? "hidden"
            : "";
    });

    // Mobile dropdown toggle
    document
        .querySelectorAll(".nav-item.has-dropdown .nav-link")
        .forEach((link) => {
            link.addEventListener("click", (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    link.closest(".nav-item").classList.toggle("open");
                }
            });
        });

    // Close menu on link click (non-dropdown on mobile)
    navMenu?.querySelectorAll(".dropdown-menu a").forEach((a) => {
        a.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                navMenu.classList.remove("open");
                hamburger.classList.remove("open");
                document.body.style.overflow = "";
            }
        });
    });

    // ─── Stat Bar Animation ───
    const statBars = document.querySelectorAll(".stat-bar-fill");
    const observerBars = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.style.width;
                    const index = Array.from(statBars).indexOf(bar);
                    bar.style.width = "0";
                    // Delay awal 300ms + stagger 200ms per bar agar tidak semua bergerak serentak
                    setTimeout(
                        () => {
                            bar.style.width = width;
                        },
                        300 + index * 200,
                    );
                    observerBars.unobserve(bar);
                }
            });
        },
        { threshold: 0.3 },
    );

    statBars.forEach((bar) => observerBars.observe(bar));

    // ─── Hero Stats Rolling Animation ───
    // Baca dari data-attribute (dynamic dari database), bukan hardcoded
    const buildHeroStats = () => {
        const stats = [];
        const heroStats = document.querySelectorAll(
            ".hero-stats .hero-stat[data-stat-value]",
        );

        let childIndex = 1;
        heroStats.forEach((statEl) => {
            const value = statEl.getAttribute("data-stat-value");
            const prefix = statEl.getAttribute("data-stat-prefix") || "";
            const isDecimal =
                statEl.getAttribute("data-stat-decimals") === "true";

            // Parse value - handle both regular numbers and comma-separated (Indonesian format)
            let target = parseFloat(
                value.toString().replace(/\./g, "").replace(",", "."),
            );

            // If no parsed value, skip
            if (isNaN(target)) return;

            stats.push({
                selector: `.hero-stat:nth-child(${childIndex}) strong`,
                element: statEl.querySelector("strong"),
                target: target,
                suffix: prefix,
                decimal: isDecimal,
            });

            childIndex += 2; // +2 because of dividers
        });

        return stats;
    };

    const formatStatNumber = (num, decimal) => {
        if (decimal) return num.toFixed(1).replace(".", ",");
        return Math.floor(num).toLocaleString("id-ID");
    };

    const animateStatNumber = (el, target, suffix, decimal) => {
        const duration = 2000; // total ms
        const rollPhase = 1400; // ms fase random rolling
        const start = performance.now();

        const tick = (now) => {
            const elapsed = now - start;

            if (elapsed < rollPhase) {
                // Fase rolling: angka random acak
                const randomVal = decimal
                    ? Math.random() * target * 1.3
                    : Math.floor(Math.random() * target * 1.3);
                el.textContent = formatStatNumber(randomVal, decimal) + suffix;
                requestAnimationFrame(tick);
            } else if (elapsed < duration) {
                // Fase easing: perlahan mendekati angka final
                const progress = (elapsed - rollPhase) / (duration - rollPhase);
                const ease = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                const current = decimal
                    ? target * ease
                    : Math.floor(target * ease);
                el.textContent = formatStatNumber(current, decimal) + suffix;
                requestAnimationFrame(tick);
            } else {
                // Final: kunci ke angka yang benar
                el.textContent = formatStatNumber(target, decimal) + suffix;
            }
        };

        requestAnimationFrame(tick);
    };

    const statsContainer = document.querySelector(".hero-stats");
    if (statsContainer) {
        const observerStats = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    observerStats.unobserve(entry.target);

                    // Dynamic stats dari data-attribute
                    const heroStats = buildHeroStats();
                    heroStats.forEach(
                        ({ element, target, suffix, decimal }) => {
                            if (element) {
                                animateStatNumber(
                                    element,
                                    target,
                                    suffix,
                                    decimal,
                                );
                            }
                        },
                    );
                });
            },
            { threshold: 0.4 },
        );

        observerStats.observe(statsContainer);
    }

    // ─── Scroll Reveal ───
    const revealEls = document.querySelectorAll(
        ".stat-card, .layanan-card, .berita-item, .berita-featured-card, " +
            ".infografis-card, .daftar-card, .opd-card, .statistik-card",
    );

    const observerReveal = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = `${(i % 6) * 0.06}s`;
                    entry.target.classList.add("revealed");
                    observerReveal.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1 },
    );

    // Add initial CSS for reveal
    const style = document.createElement("style");
    style.textContent = `
        .stat-card, .layanan-card, .berita-item, .berita-featured-card,
        .infografis-card, .daftar-card, .opd-card, .statistik-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .5s ease, transform .5s ease, box-shadow .25s, border-color .25s;
        }
        .stat-card.revealed, .layanan-card.revealed, .berita-item.revealed,
        .berita-featured-card.revealed, .infografis-card.revealed,
        .daftar-card.revealed, .opd-card.revealed, .statistik-card.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,.12);
        }
        .nav-hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }
        .nav-hamburger.open span:nth-child(2) {
            opacity: 0;
        }
        .nav-hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }
    `;
    document.head.appendChild(style);

    revealEls.forEach((el) => observerReveal.observe(el));

    // ─── Smooth Anchor Scroll ───
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener("click", (e) => {
            const href = a.getAttribute("href");
            if (href === "#") return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offset = 120;
                const top =
                    target.getBoundingClientRect().top +
                    window.scrollY -
                    offset;
                window.scrollTo({ top, behavior: "smooth" });
            }
        });
    });

    // ─── Document Year Filter ───
    const tahunFilter = document.getElementById("tahunFilter");
    if (tahunFilter) {
        tahunFilter.addEventListener("change", (e) => {
            const form = e.target.closest("form");
            if (form) {
                form.submit();
            }
        });
    }

    console.log(
        "%c PPID Kota Semarang ",
        "background:#0f4c8a;color:#fff;font-size:14px;padding:4px 10px;border-radius:4px;",
    );
    console.log(
        "%c Frontend loaded successfully ",
        "color:#1a9e6a;font-weight:bold;",
    );
});
