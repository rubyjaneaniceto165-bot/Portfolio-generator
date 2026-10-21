<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Portfolio Editor | Portech</title>
    <link rel="stylesheet" href="/css/templates/modern-editor.css">
</head>
<body>
<header class="editor-header">
    <a class="brand" href="/templates">
        <img src="/images/logo.png" alt="">
        <span>Portech</span>
    </a>
    <span class="editor-label">MODERN EDITOR</span>
    <a class="back-link" href="/templates">← Templates</a>
</header>

<main class="editor-layout">
    <section class="form-panel">
        <div class="panel-heading">
            <span class="eyebrow">YOUR PERSONAL BRAND</span>
            <h1>Build your portfolio.</h1>
            <p>Fill in your details and watch your portfolio update.</p>
        </div>

        <form id="modernForm">
            <label for="modernName">Full name</label>
            <input id="modernName" type="text" maxlength="70" placeholder="e.g. Alex Morgan">

            <label for="modernRole">Professional title</label>
            <input id="modernRole" type="text" maxlength="100" placeholder="e.g. Web Developer">

            <label for="modernPhoto">Profile photo</label>
            <input id="modernPhoto" type="file" accept="image/*">
            <small class="field-hint">Choose an image up to 5 MB.</small>

            <label for="modernIntro">Short introduction</label>
            <textarea id="modernIntro" rows="3" maxlength="300" placeholder="Write a short introduction about yourself."></textarea>

            <label for="modernAbout">About me</label>
            <textarea id="modernAbout" rows="4" maxlength="600" placeholder="Share your background, experience, and what you enjoy doing."></textarea>

            <label for="modernSkills">Skills</label>
            <input id="modernSkills" type="text" maxlength="250" placeholder="e.g. HTML, CSS, JavaScript">
            <small class="field-hint">Separate each skill with a comma.</small>

            <label for="modernProject">Featured project</label>
            <input id="modernProject" type="text" maxlength="100" placeholder="e.g. Personal Portfolio Website">

            <label for="modernProjectDescription">Project description</label>
            <textarea id="modernProjectDescription" rows="3" maxlength="400" placeholder="Describe your featured project."></textarea>

            <label for="modernEmail">Email address</label>
            <input id="modernEmail" type="email" maxlength="150" placeholder="you@example.com">

            <div class="form-actions">
                <button type="button" id="modernReset" class="button button-light">Reset</button>
                <button type="button" id="modernSave" class="button button-primary">Save Portfolio</button>
                <button type="button" id="modernDownload" class="button button-primary">Download HTML ↓</button>
            </div>

            <p id="modernMessage" class="status-message" aria-live="polite"></p>
        </form>
    </section>

    <section class="preview-panel">
        <div class="preview-heading">
            <div>
                <span class="eyebrow">LIVE PREVIEW</span>
                <h2>Your portfolio</h2>
            </div>
            <span class="live-indicator"><i></i> LIVE</span>
        </div>

        <!-- Creative design adapted for the Modern editor -->
        <article id="modernPortfolioPage" class="portfolio-page creative-style">

            <nav class="portfolio-nav">
                <a href="#modernHome" class="portfolio-brand">hello<span>✿</span></a>
                <div class="portfolio-links">
                    <a href="#modernHome">Home</a>
                    <a href="#modernAboutSection">About</a>
                    <a href="#modernWorkSection">Work</a>
                    <a href="#modernContactSection">Contact</a>
                </div>
            </nav>

            <section id="modernHome" class="hero-section">
                <div class="hero-copy">
                    <p class="mini-label"><span>✦</span> HEY THERE, I'M</p>

                    <h1 id="modernPreviewName">Alex Morgan</h1>

                    <h2 id="modernPreviewRole">Web Developer</h2>

                    <p id="modernPreviewIntro">
                        I enjoy building clean, useful, and user-friendly digital experiences.
                        I am always learning and looking for opportunities to improve my skills.
                    </p>

                    <div class="hero-actions">
                        <a href="#modernWorkSection" class="preview-cta">
                            See my work <span>↗</span>
                        </a>
                        <a href="#modernContactSection" class="text-link">Say hello ♡</a>
                    </div>

                    <span class="tiny-note">made with a little bit of magic ✧</span>
                </div>

                <div class="portrait-area">
                    <div class="portrait-blob"></div>

                    <div class="portrait-frame">
                        <div id="modernPhotoPlaceholder" class="portrait-placeholder">
                            <span>YOUR PHOTO</span>
                            <b>♡</b>
                        </div>

                        <img id="modernPreviewPhoto"
                             class="portrait-image"
                             alt="Profile photo"
                             hidden>
                    </div>

                    <span class="float-star star-one">✦</span>
                    <span class="float-star star-two">✧</span>
                    <span class="float-heart">♡</span>
                </div>
            </section>

            <section id="modernAboutSection" class="about-section content-section">
                <div class="section-icon">♡</div>

                <div>
                    <p class="section-number">01 · A LITTLE ABOUT ME</p>
                    <h2>Nice to meet you!</h2>

                    <p id="modernPreviewAbout">
                        I am a motivated and detail-oriented developer who enjoys solving
                        problems and turning ideas into working projects. I value teamwork,
                        continuous learning, and creating work that is simple to use.
                    </p>
                </div>
            </section>

            <section class="skills-section content-section">
                <p class="section-number">02 · THINGS I LOVE TO DO</p>
                <h2>My little toolkit <span>✿</span></h2>

                <div id="modernPreviewSkills" class="skill-list"></div>
            </section>

            <section id="modernWorkSection" class="projects-section content-section">
                <div class="section-heading-row">
                    <div>
                        <p class="section-number">03 · SOMETHING I MADE</p>
                        <h2>Featured project <span>✧</span></h2>
                    </div>

                    <span class="tiny-note">a work in progress ♡</span>
                </div>

                <div class="project-card">
                    <div class="project-art">
                        <span class="project-sun">☼</span>
                        <span class="project-art-text">little<br>ideas</span>
                        <span class="project-flower">✿</span>
                    </div>

                    <div class="project-copy">
                        <span class="project-tag">MY CREATIVE CORNER</span>

                        <h3 id="modernPreviewProject">
                            Personal Portfolio Website
                        </h3>

                        <p id="modernPreviewProjectDescription">
                            A personal website that presents my skills, projects, and
                            background in one organized place.
                        </p>
                    </div>
                </div>
            </section>

            <section id="modernContactSection" class="contact-section">
                <span class="contact-doodle">✿</span>

                <div>
                    <p class="section-number">04 · LET'S CONNECT</p>
                    <h2>Have a lovely idea?</h2>
                    <p>I'd love to hear from you. Let's make something good!</p>
                </div>

                <a id="modernContactLink"
                   class="contact-email"
                   href="mailto:alex@example.com">
                    alex@example.com ↗
                </a>
            </section>

            <footer class="portfolio-footer">
                <span id="modernPreviewYear">2026</span>
                <span>THANKS FOR STOPPING BY ✿</span>
            </footer>

        </article>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="/js/supabase-config.js"></script>
<script src="/js/portfolio-access.js"></script>
<script src="/js
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Portfolio Editor | Portech</title>
    <link rel="stylesheet" href="/css/templates/modern-editor.css">
</head>
<body>
<header class="editor-header">
    <a class="brand" href="/templates">
        <img src="/images/logo.png" alt="">
        <span>Portech</span>
    </a>
    <span class="editor-label">MODERN EDITOR</span>
    <a class="back-link" href="/templates">← Templates</a>
</header>

<main class="editor-layout">
    <section class="form-panel">
        <div class="panel-heading">
            <span class="eyebrow">YOUR PERSONAL BRAND</span>
            <h1>Build your portfolio.</h1>
            <p>Fill in your details and watch your portfolio update.</p>
        </div>

        <form id="modernForm" novalidate>
            <label for="modernName">
                Full name <span class="required-mark">*</span>
            </label>
            <input
                id="modernName"
                type="text"
                maxlength="70"
                placeholder="e.g. Alex Morgan"
                autocomplete="name"
                required
                aria-describedby="modernNameError"
            >
            <small id="modernNameError" class="field-error" hidden>
                Please enter your full name using letters only.
            </small>

            <label for="modernRole">
                Professional title <span class="required-mark">*</span>
            </label>
            <input
                id="modernRole"
                type="text"
                maxlength="100"
                placeholder="e.g. Web Developer"
                required
            >

            <label for="modernPhoto">Profile photo</label>
            <input id="modernPhoto" type="file" accept="image/*">
            <small class="field-hint">Choose an image up to 5 MB.</small>

            <label for="modernIntro">
                Short introduction <span class="required-mark">*</span>
            </label>
            <textarea
                id="modernIntro"
                rows="3"
                maxlength="300"
                placeholder="Write a short introduction about yourself."
                required
            ></textarea>

            <label for="modernAbout">About me</label>
            <textarea
                id="modernAbout"
                rows="4"
                maxlength="600"
                placeholder="Share your background, experience, and what you enjoy doing."
            ></textarea>

            <label for="modernSkills">Skills</label>
            <input
                id="modernSkills"
                type="text"
                maxlength="250"
                placeholder="e.g. HTML, CSS, JavaScript"
            >
            <small class="field-hint">Separate each skill with a comma.</small>

            <label for="modernProject">
                Featured project <span class="required-mark">*</span>
            </label>
            <input
                id="modernProject"
                type="text"
                maxlength="100"
                placeholder="e.g. Personal Portfolio Website"
                required
            >

            <label for="modernProjectDescription">Project description</label>
            <textarea
                id="modernProjectDescription"
                rows="3"
                maxlength="400"
                placeholder="Describe your featured project."
            ></textarea>

            <label for="modernEmail">Email address</label>
            <input
                id="modernEmail"
                type="email"
                maxlength="150"
                placeholder="you@example.com"
            >

            <small class="field-hint">
                Fields marked with <span class="required-mark">*</span> are required.
            </small>

            <div class="form-actions">
                <button type="button" id="modernReset" class="button button-light">
                    Reset
                </button>
                <button type="button" id="modernSave" class="button button-primary">
                    Save Portfolio
                </button>
                <button type="button" id="modernDownload" class="button button-primary">
                    Download HTML ↓
                </button>
            </div>

            <p id="modernMessage" class="status-message" aria-live="polite"></p>
        </form>
    </section>

    <section class="preview-panel">
        <div class="preview-heading">
            <div>
                <span class="eyebrow">LIVE PREVIEW</span>
                <h2>Your portfolio</h2>
            </div>
            <span class="live-indicator"><i></i> LIVE</span>
        </div>

        <!-- Creative design adapted for the Modern editor -->
        <article id="modernPortfolioPage" class="portfolio-page creative-style">

            <nav class="portfolio-nav">
                <a href="#modernHome" class="portfolio-brand">hello<span>✿</span></a>
                <div class="portfolio-links">
                    <a href="#modernHome">Home</a>
                    <a href="#modernAboutSection">About</a>
                    <a href="#modernWorkSection">Work</a>
                    <a href="#modernContactSection">Contact</a>
                </div>
            </nav>

            <section id="modernHome" class="hero-section">
                <div class="hero-copy">
                    <p class="mini-label"><span>✦</span> HEY THERE, I'M</p>

                    <h1 id="modernPreviewName">Alex Morgan</h1>

                    <h2 id="modernPreviewRole">Web Developer</h2>

                    <p id="modernPreviewIntro">
                        I enjoy building clean, useful, and user-friendly digital experiences.
                        I am always learning and looking for opportunities to improve my skills.
                    </p>

                    <div class="hero-actions">
                        <a href="#modernWorkSection" class="preview-cta">
                            See my work <span>↗</span>
                        </a>
                        <a href="#modernContactSection" class="text-link">Say hello ♡</a>
                    </div>

                    <span class="tiny-note">made with a little bit of magic ✧</span>
                </div>

                <div class="portrait-area">
                    <div class="portrait-blob"></div>

                    <div class="portrait-frame">
                        <div id="modernPhotoPlaceholder" class="portrait-placeholder">
                            <span>YOUR PHOTO</span>
                            <b>♡</b>
                        </div>

                        <img
                            id="modernPreviewPhoto"
                            class="portrait-image"
                            alt="Profile photo"
                            hidden
                        >
                    </div>

                    <span class="float-star star-one">✦</span>
                    <span class="float-star star-two">✧</span>
                    <span class="float-heart">♡</span>
                </div>
            </section>

            <section id="modernAboutSection" class="about-section content-section">
                <div class="section-icon">♡</div>

                <div>
                    <p class="section-number">01 · A LITTLE ABOUT ME</p>
                    <h2>Nice to meet you!</h2>

                    <p id="modernPreviewAbout">
                        I am a motivated and detail-oriented developer who enjoys solving
                        problems and turning ideas into working projects. I value teamwork,
                        continuous learning, and creating work that is simple to use.
                    </p>
                </div>
            </section>

            <section class="skills-section content-section">
                <p class="section-number">02 · THINGS I LOVE TO DO</p>
                <h2>My little toolkit <span>✿</span></h2>

                <div id="modernPreviewSkills" class="skill-list"></div>
            </section>

            <section id="modernWorkSection" class="projects-section content-section">
                <div class="section-heading-row">
                    <div>
                        <p class="section-number">03 · SOMETHING I MADE</p>
                        <h2>Featured project <span>✧</span></h2>
                    </div>

                    <span class="tiny-note">a work in progress ♡</span>
                </div>

                <div class="project-card">
                    <div class="project-art">
                        <span class="project-sun">☼</span>
                        <span class="project-art-text">little<br>ideas</span>
                        <span class="project-flower">✿</span>
                    </div>

                    <div class="project-copy">
                        <span class="project-tag">MY CREATIVE CORNER</span>

                        <h3 id="modernPreviewProject">
                            Personal Portfolio Website
                        </h3>

                        <p id="modernPreviewProjectDescription">
                            A personal website that presents my skills, projects, and
                            background in one organized place.
                        </p>
                    </div>
                </div>
            </section>

            <section id="modernContactSection" class="contact-section">
                <span class="contact-doodle">✿</span>

                <div>
                    <p class="section-number">04 · LET'S CONNECT</p>
                    <h2>Have a lovely idea?</h2>
                    <p>I'd love to hear from you. Let's make something good!</p>
                </div>

                <a
                    id="modernContactLink"
                    class="contact-email"
                    href="mailto:alex@example.com"
                >
                    alex@example.com ↗
                </a>
            </section>

            <footer class="portfolio-footer">
                <span id="modernPreviewYear">2026</span>
                <span>THANKS FOR STOPPING BY ✿</span>
            </footer>

        </article>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="/js/supabase-config.js"></script>
<script src="/js/portfolio-access.js"></script>
<script src="/js/portfolio-storage.js"></script>
<script src="/js/templates/modern-editor.js"></script>

</body>
</html>
/portfolio-storage.js"></script>
<script src="/js/templates/modern-editor.js"></script>

</body>
</html>
