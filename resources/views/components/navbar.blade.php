{{-- resources/views/components/navbar.blade.php --}}
<header class="site-header">

    {{-- Top Bar --}}
    <div class="topbar">
        <div class="container">
            <div class="topbar-left">
                <span><i class="fas fa-map-marker-alt"></i> Jl. Prof. Sudarto No. 116, Kel.Sumurboto, Kec. Banyumanik,
                    Kota Semarang, Jawa Tengah 50269</span>
            </div>
            <div class="topbar-right">
                <a href="https://www.facebook.com/groups/dinasarpus.semarangkota" target="_blank" title="Facebook"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/dinasarpus_semarang" target="_blank" title="Instagram"><i
                        class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@dinasarpuskotasemarang2232" target="_blank" title="YouTube"><i
                        class="fab fa-youtube"></i></a>
                <a href="https://x.com/dinarpus_smg" target="_blank" title="Twitter/X"><i
                        class="fab fa-x-twitter"></i></a>
                <div class="topbar-divider"></div>
                <a href="/ppid-new-pusda-smg/login" target="_blank" class="btn-login"><i class="fas fa-user-circle"></i>
                    Masuk</a>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="navbar" id="mainNav">
        <div class="container">
            <a href="/" class="navbar-brand">
                <div class="brand-logo">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo PPID Dinarpus"
                            style="height: 48px; width: auto;">
                    </div>
                    <div class="brand-text">
                        <span class="brand-name">PPID Dinarpus</span>
                        <span class="brand-sub">Dinas Arsip & Perpustakaan Kota Semarang</span>
                    </div>
                </div>
            </a>

            <ul class="nav-menu" id="navMenu">
                <x-menu-items />
            </ul>

            <button class="nav-hamburger" id="navHamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

</header>
