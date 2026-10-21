<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portech - Dashboard</title>

    <link rel="stylesheet" href="/css/dark-mode.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
</head>
<body>

    <div class="dashboard-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <a href="/" class="brand">
                <img src="/images/logo.png" alt="Portech Logo">
                <span>Portech</span>
            </a>

            <p class="sidebar-label">WORKSPACE</p>

            <nav class="sidebar-nav">
                <a href="/" class="nav-link">
                    <span class="nav-icon">⌂</span>
                    Home
                </a>

                <a href="/dashboard" class="nav-link active">
                    <span class="nav-icon">▦</span>
                    Dashboard
                </a>

                <a href="#my-portfolios" class="nav-link">
                    <span class="nav-icon">▤</span>
                    My Portfolios
                </a>

                <a href="/profile" class="nav-link">
                    <span class="nav-icon">♙</span>
                    Profile Settings
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-tip">
                    <span class="tip-icon">✦</span>
                    <h3>Your next opportunity starts here.</h3>
                    <p>Create a portfolio that shows what you can do.</p>
                </div>

                <button
                    type="button"
                    id="sidebarLogout"
                    class="sidebar-logout">
                    ↗ Log Out
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="dashboard-main">

            <!-- TOP BAR -->
            <header class="dashboard-topbar">

                <div>
                    <p class="topbar-label">PORTECH WORKSPACE</p>
                    <p class="topbar-subtitle">Your creative space</p>
                </div>

                <!-- THEME BUTTON AND PROFILE -->
                <div class="topbar-actions">

                    <button
                        type="button"
                        class="theme-toggle"
                        data-theme-toggle
                        aria-label="Switch to dark mode"
                        title="Dark mode">
                        🌙
                    </button>

                    <a
                        href="/profile"
                        class="user-profile"
                        title="Profile Settings">

                        <div class="user-avatar" id="userAvatar">U</div>

                        <div class="user-info">
                            <strong id="topbarName">Loading...</strong>
                            <span>My Account</span>
                        </div>
                    </a>

                </div>
            </header>

            <!-- WELCOME SECTION -->
            <section class="welcome-section">

                <div class="welcome-content">
                    <span class="welcome-badge">
                        ✦ YOUR PORTFOLIO JOURNEY
                    </span>

                    <h1>
                        Welcome back,
                        <span id="welcomeName">Creator</span>!
                    </h1>

                    <p>
                        Your skills deserve to be seen. Create a portfolio
                        that tells your story and showcases your work.
                    </p>

                    <a href="/templates" class="primary-button">
                        <span>＋</span> Create Portfolio
                    </a>
                </div>

                <div class="welcome-art" aria-hidden="true">
                    <div class="art-circle circle-one"></div>
                    <div class="art-circle circle-two"></div>

                    <div class="art-paper">
                        <div class="paper-top">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="paper-avatar">P</div>
                        <div class="paper-line line-large"></div>
                        <div class="paper-line line-medium"></div>

                        <div class="paper-blocks">
                            <span></span>
                            <span></span>
                        </div>

                        <div class="paper-line line-small"></div>
                    </div>

                    <div class="art-star star-one">✦</div>
                    <div class="art-star star-two">✧</div>
                </div>

            </section>

            <!-- SUMMARY CARDS -->
            <section class="summary-grid">

                <article class="summary-card">
                    <div class="summary-icon green-icon">▤</div>

                    <div>
                        <p>Total Portfolios</p>
                        <h2 id="totalPortfolios">0</h2>
                        <span>Your created portfolios</span>
                    </div>
                </article>

                <article class="summary-card">
                    <div class="summary-icon cream-icon">✎</div>

                    <div>
                        <p>In Progress</p>
                        <h2 id="draftPortfolios">—</h2>
                        <span>Status tracking coming soon</span>
                    </div>
                </article>

            </section>

            <!-- MY PORTFOLIOS -->
            <section class="portfolio-section" id="my-portfolios">

                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">YOUR CREATIONS</p>
                        <h2>My Portfolios</h2>

                        <p class="section-description">
                            Keep track of your portfolio projects in one place.
                        </p>
                    </div>

                    <a href="/templates" class="secondary-button">
                        ＋ New Portfolio
                    </a>
                </div>

                <!-- EMPTY STATE -->
                <div class="empty-state" id="emptyState">

                    <div class="empty-illustration">
                        <span>▤</span>
                        <span class="empty-sparkle">✦</span>
                    </div>

                    <h3>Your portfolio journey starts here</h3>

                    <p>
                        You haven't created a portfolio yet.
                        Start with your first one and show the world your skills.
                    </p>

                    <a href="/templates" class="primary-button">
                        Create Your First Portfolio
                    </a>

                </div>

                <!-- SAVED PORTFOLIOS -->
                <div class="portfolio-grid" id="portfolioGrid"></div>

                <p
                    class="dashboard-message"
                    id="dashboardMessage"
                    role="status"
                    aria-live="polite">
                </p>

            </section>

            <!-- FOOTER -->
            <footer class="dashboard-footer">
                <p>Made for creators, students, and future professionals.</p>
                <span>© 2026 Portech</span>
            </footer>

        </main>
    </div>

    <!-- SUPABASE LIBRARY -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <!-- SHARED SUPABASE CONFIGURATION -->
    <script src="/js/supabase-config.js"></script>

    <!-- SHARED PORTFOLIO STORAGE -->
    <script src="/js/portfolio-storage.js"></script>

    <!-- DASHBOARD FUNCTIONALITY -->
    <script src="/js/dashboard.js?v=4"></script>

    <!-- DARK MODE FUNCTIONALITY -->
    <script src="/js/theme.js"></script>

</body>
</html>
