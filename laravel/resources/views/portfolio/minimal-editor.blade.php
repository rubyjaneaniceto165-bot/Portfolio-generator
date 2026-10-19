
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Portfolio Editor | Portech</title>
    <link rel="stylesheet" href="/css/templates/minimal-editor.css">

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2" defer></script>
    <script src="/js/supabase-config.js" defer></script>
    <script src="/js/portfolio-access.js" defer></script>
    <script src="/js/portfolio-storage.js" defer></script>
    <script src="/js/templates/minimal-editor.js" defer></script>   

</head>
<body>
    <header class="topbar">
        <a href="/templates" class="brand">
            <img src="/images/logo.png" alt="">
            <span>Portech</span>
        </a>
        <a href="/templates" class="back-link">← Back to Templates</a>
    </header>

    <main class="editor-layout">
        <section class="editor-panel">
            <p class="eyebrow">MINIMAL TEMPLATE</p>
            <h1>Edit your portfolio.</h1>
            <p class="intro">Your story, your skills, your work. Keep it simple.</p>

            <form id="minimalForm">
                <label for="minimalName">Full name</label>
                <input id="minimalName" placeholder="e.g. Alex Morgan" maxlength="80" required>

                <label for="minimalTitle">Professional title</label>
                <input id="minimalTitle" placeholder="e.g. IT Student" maxlength="100">

                <label for="minimalPhoto">Profile photo</label>
                <input id="minimalPhoto" type="file" accept="image/*">
                <p class="hint">Optional. Maximum size: 5 MB.</p>

                <label for="minimalAbout">About me</label>
                <textarea id="minimalAbout" rows="4" maxlength="1000" placeholder="Share a short introduction about yourself."></textarea>

                <label for="minimalSkills">Skills</label>
                <input id="minimalSkills" placeholder="e.g. HTML, CSS, JavaScript, PHP">
                <p class="hint">Separate each skill with a comma.</p>

                <label for="minimalProjectTitle">Featured project</label>
                <input id="minimalProjectTitle" placeholder="e.g. My First Project" maxlength="100">

                <label for="minimalProjectDescription">Project description</label>
                <textarea id="minimalProjectDescription" rows="4" maxlength="1000" placeholder="Describe your featured project."></textarea>

                <label for="minimalEmail">Email address</label>
                <input id="minimalEmail" type="email" placeholder="you@example.com" maxlength="150">

                <div class="form-actions">
                    <button type="button" id="minimalReset" class="reset-btn">Reset</button>
                    <button type="button" id="minimalSave" class="button button-primary">Save Portfolio</button>
                    <button type="button" id="minimalDownload" class="download-btn">↓ Download Portfolio</button>
                </div>
                <p id="minimalMessage" class="message" aria-live="polite"></p>
            </form>
        </section>

        <section class="preview-panel">
            <div class="preview-heading">
                <div>
                    <p class="eyebrow">LIVE PREVIEW</p>
                    <h2>Your portfolio</h2>
                </div>
                <span class="live-status">● Live</span>
            </div>

                <article id="portfolioPage" class="portfolio-page">
                <nav class="portfolio-nav">
                    <span class="portfolio-logo">PORTFOLIO.</span>
                    <div>
                        <a href="#previewHome">Home</a>
                        <a href="#previewAboutSection">About</a>
                        <a href="#previewProjects">Projects</a>
                        <a href="#previewContact">Contact</a>
                    </div>
                </nav>

                <section class="hero" id="previewHome">
                    <div class="hero-copy">
                        <p class="eyebrow">HELLO, I'M</p>
                        <h2 id="previewName">Your Name.</h2>
                        <h3 id="previewTitle">IT Student</h3>
                        <p id="previewAbout">I am an IT student who enjoys learning about technology, building projects, and improving my skills.</p>
                        <a class="outline-button" href="#previewProjects">VIEW MY WORK ↘</a>
                    </div>

                    <div class="photo-frame">
                        <img id="previewPhoto" alt="Profile photo" hidden>
                        <div id="photoPlaceholder" class="photo-placeholder">
                            <span>YOUR<br>PHOTO</span>
                        </div>
                    </div>
                </section>

                <section class="details-grid">
                    <div id="previewAboutSection">
                        <p class="section-number">01 / ABOUT</p>
                        <h3>A little about me</h3>
                        <p id="previewAboutFull"></p>
                    </div>

                    <div>
                        <p class="section-number">02 / SKILLS</p>
                        <h3>What I work with</h3>
                        <ul id="previewSkills" class="skill-list"></ul>
                    </div>

                    <div id="previewProjects">
                        <p class="section-number">03 / SELECTED WORK</p>
                        <h3 id="previewProjectTitle">My First Project</h3>
                        <p id="previewProjectDescription"></p>
                    </div>
                </section>

                <section class="contact-section" id="previewContact">
                    <div>
                        <p class="section-number">HAVE A QUESTION?</p>
                        <h3>Let's connect.</h3>
                        <a id="previewEmailLink" href="mailto:you@example.com">you@example.com</a>
                    </div>
                    <span class="contact-arrow">↗</span>
                </section>

                <footer class="portfolio-footer">
                    <span id="previewFooterName">YOUR NAME</span>
                    <span>PERSONAL PORTFOLIO</span>
                </footer>
            </article>
        </section>
    </main>
</body>
</html>
