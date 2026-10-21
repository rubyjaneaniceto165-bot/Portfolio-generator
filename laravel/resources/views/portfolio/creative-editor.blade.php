
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portech - Creative Portfolio</title>

    <link rel="stylesheet" href="/css/dark-mode.css">
    <link rel="stylesheet" href="/css/templates/creative-editor.css">
</head>

<body>

    <!-- HEADER -->
    <header class="topbar">
        <a class="brand" href="/templates">
            <img src="/images/logo.png" alt="Portech logo">
            <span>Portech</span>
        </a>

        <div class="topbar-actions">
            <button
                type="button"
                class="theme-toggle"
                data-theme-toggle
                aria-label="Switch to dark mode"
                title="Dark mode"
            >🌙</button>

            <a class="back-link" href="/templates">
                ← Back to Templates
            </a>
        </div>
    </header>

    <!-- MAIN EDITOR -->
    <main class="editor-layout">

        <!-- EDITOR FORM -->
        <section class="editor-panel">

            <div class="editor-heading">
                <span class="heading-sticker">✦</span>
                <p class="eyebrow">YOUR LITTLE CREATIVE SPACE</p>
                <h1>Make it yours<span>!</span></h1>
                <p class="subheading">
                    Fill in your details and watch your portfolio bloom.
                </p>
            </div>

            <form id="creativeForm">

                <label for="creativeName">Your name</label>
                <input
                    id="creativeName"
                    type="text"
                    maxlength="80"
                    placeholder="e.g. Alex Morgan"
                >

                <label for="creativeTitle">What do you do?</label>
                <input
                    id="creativeTitle"
                    type="text"
                    maxlength="100"
                    placeholder="e.g. Web Developer &amp; Designer"
                >

                <label for="creativePhoto">Your profile photo</label>
                <input
                    id="creativePhoto"
                    type="file"
                    accept="image/*"
                >

                <p class="hint">
                    Optional · JPG, PNG or WEBP · up to 5 MB
                </p>

                <label for="creativeAbout">A little about you</label>
                <textarea
                    id="creativeAbout"
                    rows="4"
                    maxlength="1000"
                    placeholder="Tell visitors a little about yourself."
                ></textarea>

                <p class="counter">
                    <span id="creativeAboutCount">0</span>/1000
                </p>

                <label for="creativeSkills">Your skills</label>
                <input
                    id="creativeSkills"
                    type="text"
                    placeholder="e.g. HTML, CSS, JavaScript, UI/UX"
                >

                <p class="hint">
                    Use commas to separate your skills.
                </p>

                <label for="creativeProjectTitle">Featured project</label>
                <input
                    id="creativeProjectTitle"
                    type="text"
                    placeholder="e.g. My Portfolio Website"
                    maxlength="100"
                >

                <label for="creativeProjectDescription">
                    Tell us about it
                </label>

                <textarea
                    id="creativeProjectDescription"
                    rows="3"
                    maxlength="1000"
                    placeholder="Describe what your project does."
                ></textarea>

                <p class="counter">
                    <span id="creativeProjectCount">0</span>/1000
                </p>

                <label for="creativeEmail">Contact email</label>
                <input
                    id="creativeEmail"
                    type="email"
                    placeholder="you@example.com"
                    maxlength="150"
                >

                <!-- FORM BUTTONS -->
                <div class="button-row">
                    <button
                        type="button"
                        id="creativeReset"
                        class="button secondary"
                    >
                        ↺ Reset
                    </button>

                    <button
                        type="button"
                        id="creativeSave"
                        class="button primary"
                    >
                        Save Portfolio
                    </button>

                    <button
                        type="button"
                        id="creativeDownload"
                        class="button primary"
                    >
                        Download portfolio ↓
                    </button>
                </div>

                <p
                    id="creativeMessage"
                    class="status-message"
                    aria-live="polite"
                >✿ Your preview is ready!</p>

            </form>
        </section>

        <!-- LIVE PREVIEW -->
        <section class="preview-panel">

            <div class="preview-heading">
                <div>
                    <p class="eyebrow">A LITTLE PREVIEW</p>
                    <h2>Your portfolio</h2>
                </div>

                <span class="live-pill">
                    <i></i> Live preview
                </span>
            </div>

            <!-- CREATIVE PORTFOLIO DESIGN -->
            <article
                id="creativePortfolioPage"
                class="portfolio-page modern-style"
            >

                <!-- PROFILE SIDEBAR -->
                <aside class="profile-sidebar">

                    <div class="sidebar-top">
                        <a href="#creativeHome" class="sidebar-logo">P.</a>
                        <p class="sidebar-caption">PERSONAL PORTFOLIO</p>
                    </div>

                    <div class="profile-block">

                        <div class="profile-photo-wrap">
                            <div
                                id="creativePhotoPlaceholder"
                                class="profile-photo-placeholder"
                            >
                                <span>YOUR PHOTO</span>
                            </div>

                            <img
                                id="creativePreviewPhoto"
                                class="profile-photo"
                                alt="Profile photo"
                                hidden
                            >
                        </div>

                        <h1 id="creativePreviewName">Your Name</h1>

                        <p
                            id="creativePreviewTitle"
                            class="profile-role"
                        >Web Developer &amp; Designer</p>

                        <span class="availability">
                            <i></i> Available for opportunities
                        </span>

                    </div>

                    <div class="sidebar-contact">
                        <p class="sidebar-label">GET IN TOUCH</p>
                        <p>Have a project in mind?</p>

                        <a
                            href="#creativeContact"
                            class="sidebar-button"
                        >Contact Me ↗</a>
                    </div>

                    <div class="sidebar-bottom">
                        <span id="creativePreviewFooter">
                            MADE BY YOUR NAME
                        </span>
                    </div>

                </aside>

                <!-- PORTFOLIO MAIN CONTENT -->
                <div class="portfolio-main">

                    <!-- PORTFOLIO NAVIGATION -->
                    <nav class="portfolio-nav">
                        <a href="#creativeHome" class="portfolio-brand">
                            PORTFOLIO<span>.</span>
                        </a>

                        <div class="portfolio-links">
                            <a href="#creativeHome">Home</a>
                            <a href="#creativeAboutSection">About</a>
                            <a href="#creativeProjects">Projects</a>
                            <a href="#creativeContact">Contact</a>
                        </div>
                    </nav>

                    <!-- HERO SECTION -->
                    <section id="creativeHome" class="modern-hero">

                        <p class="hero-label">
                            <span></span> WELCOME TO MY PORTFOLIO
                        </p>

                        <h2>
                            Hello, I'm
                            <span id="creativeHeroName">Your Name</span>
                        </h2>

                        <h3 id="creativeHeroRole">
                            Web Developer &amp; Designer
                        </h3>

                        <p id="creativeHeroAbout">
                            Hi! I'm a creative and curious person who enjoys
                            building websites, learning new things, and
                            turning simple ideas into something useful.
                        </p>

                        <div class="hero-actions">
                            <a
                                href="#creativeProjects"
                                class="preview-cta"
                            >View My Work ↗</a>

                            <a
                                href="#creativeAboutSection"
                                class="text-link"
                            >Learn More</a>
                        </div>

                    </section>

                    <!-- ABOUT SECTION -->
                    <section
                        id="creativeAboutSection"
                        class="content-section about-section"
                    >
                        <p class="section-label">01 — ABOUT ME</p>
                        <h2>A little about me</h2>

                        <p id="creativePreviewAbout">
                            I'm a creative and curious person who enjoys
                            building websites, learning new things, and
                            turning simple ideas into something useful.
                        </p>
                    </section>

                    <!-- SKILLS SECTION -->
                    <section class="content-section skills-section">
                        <p class="section-label">02 — MY SKILLS</p>
                        <h2>What I can do</h2>

                        <div
                            id="creativePreviewSkills"
                            class="skill-list"
                        ></div>
                    </section>

                    <!-- PROJECTS SECTION -->
                    <section
                        id="creativeProjects"
                        class="content-section projects-section"
                    >
                        <p class="section-label">03 — MY WORK</p>
                        <h2>Featured Project</h2>

                        <div class="project-card">
                            <div class="project-number">01</div>

                            <div class="project-copy">
                                <h3 id="creativePreviewProjectTitle">
                                    My Little Project
                                </h3>

                                <p id="creativePreviewProjectDescription">
                                    A simple and friendly web project made
                                    to help people stay organized and make
                                    everyday tasks easier.
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- CONTACT SECTION -->
                    <section
                        id="creativeContact"
                        class="content-section contact-section"
                    >
                        <p class="section-label">04 — CONTACT</p>
                        <h2>Let's work together.</h2>

                        <p>
                            Have an idea or project? Feel free to get in touch.
                        </p>

                        <a
                            id="creativePreviewEmail"
                            href="mailto:you@example.com"
                        >you@example.com ↗</a>
                    </section>

                    <!-- PORTFOLIO FOOTER -->
                    <footer class="portfolio-footer">
                        <span>MY PORTFOLIO</span>
                        <span>THANK YOU FOR VISITING.</span>
                    </footer>

                </div>
            </article>
        </section>
    </main>

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/js/supabase-config.js"></script>
    <script src="/js/portfolio-access.js"></script>
    <script src="/js/portfolio-storage.js"></script>
    <script src="/js/templates/creative-editor.js"></script>
    <script src="/js/theme.js"></script>

</body>
</html>
