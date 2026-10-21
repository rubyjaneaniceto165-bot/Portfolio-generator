<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Choose a Template | Portech</title>

    <link rel="stylesheet" href="/css/dark-mode.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/templates.css">
</head>
<body>

    <!-- HEADER -->
    <header class="templates-header">

        <a href="/" class="templates-logo">
            <img src="/images/logo.png" alt="Portech Logo">
            <span>Portech</span>
        </a>

        <div class="templates-nav-buttons">

            <!-- DARK MODE BUTTON -->
            <button
                type="button"
                id="themeToggle"
                class="theme-toggle"
                data-theme-toggle
                aria-label="Switch to dark mode"
                title="Switch theme">
                🌙
            </button>

            <a href="/dashboard" class="dashboard-link">
                Dashboard
            </a>

            <a href="/" class="back-link">
                ← Back to Home
            </a>

        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="templates-container">

        <section class="templates-heading">
            <p class="section-eyebrow">YOUR PORTFOLIO JOURNEY</p>

            <h1>Choose Your Portfolio Template</h1>

            <p>
                Pick a design that best represents your personality and work.
                You can customize your portfolio next.
            </p>
        </section>

        <!-- TEMPLATE CARDS -->
        <section class="templates-grid">

            <!-- MODERN TEMPLATE -->
            <article class="template-card">

                <div class="template-preview template-one">
                    <div class="preview-header">
                        PORTFOLIO
                    </div>

                    <div class="preview-content">
                        <div class="preview-circle"></div>

                        <div class="preview-lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="template-info">
                    <h2>Modern</h2>

                    <p>
                        A clean and professional design
                        suitable for students and professionals.
                    </p>

                    <a
                        href="/portfolio/create?template=modern"
                        class="template-button">
                        Choose Template
                    </a>
                </div>

            </article>

            <!-- CREATIVE TEMPLATE -->
            <article class="template-card">

                <div class="template-preview template-two">
                    <div class="preview-sidebar">
                        PORTFOLIO
                    </div>

                    <div class="preview-main">
                        <div class="preview-box"></div>

                        <div class="preview-lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="template-info">
                    <h2>Creative</h2>

                    <p>
                        A stylish layout for designers,
                        artists, developers, and creatives.
                    </p>

                    <a
                        href="/portfolio/create?template=creative"
                        class="template-button">
                        Choose Template
                    </a>
                </div>

            </article>

            <!-- MINIMAL TEMPLATE -->
            <article class="template-card">

                <div class="template-preview template-three">
                    <div class="preview-title">
                        MY PORTFOLIO
                    </div>

                    <div class="preview-grid">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="template-info">
                    <h2>Minimal</h2>

                    <p>
                        A simple and elegant layout focused
                        on your content and achievements.
                    </p>

                    <a
                        href="/portfolio/create?template=minimal"
                        class="template-button">
                        Choose Template
                    </a>
                </div>

            </article>

        </section>
    </main>

    <!-- FOOTER -->
    <footer class="templates-footer">
        <div class="footer-logo">Portech</div>

        <p>Build your portfolio. Showcase your skills.</p>

        <p class="copyright">
            © 2026 Portech. All Rights Reserved.
        </p>
    </footer>

    <!-- SUPABASE -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/js/supabase-config.js"></script>
    <script src="/js/portfolio-access.js"></script>

    <!-- DARK MODE -->
    <script src="/js/theme.js"></script>

</body>
</html>
