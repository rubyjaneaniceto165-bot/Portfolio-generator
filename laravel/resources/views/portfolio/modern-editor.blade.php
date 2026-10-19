
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

        <article id="modernPortfolioPage" class="portfolio-page">
            <aside class="profile-sidebar">
                <div class="sidebar-top">
                    <span class="sidebar-logo">P.</span>
                    <span class="sidebar-caption">PORTFOLIO / 2026</span>
                </div>

                <div class="profile-block">
                    <div class="profile-photo-wrap">
                        <div id="modernPhotoPlaceholder" class="photo-placeholder">AM</div>
                        <img id="modernPreviewPhoto" class="profile-photo" alt="Profile photo" hidden>
                    </div>
                    <h2 id="modernPreviewName">Alex Morgan</h2>
                    <p id="modernPreviewRole" class="profile-role">Web Developer</p>
                    <span class="availability"><i></i> OPEN TO OPPORTUNITIES</span>
                </div>

                <div class="sidebar-divider"></div>

                <div class="sidebar-contact">
                    <span class="sidebar-section-label">GET IN TOUCH</span>
                    <p id="modernPreviewEmail">alex@example.com</p>
                </div>

                <div class="sidebar-bottom">
                    <span>DESIGNED WITH PURPOSE.</span>
                    <span>© <span id="modernPreviewYear">2026</span></span>
                </div>
            </aside>

            <div class="portfolio-main">
                <nav class="portfolio-nav">
                    <span class="nav-current">OVERVIEW</span>
                    <div class="portfolio-links">
                        <a href="#modernAboutSection">ABOUT</a>
                        <a href="#modernWorkSection">WORK</a>
                        <a href="#modernContactSection">CONTACT</a>
                    </div>
                </nav>

                <section id="modernHome" class="portfolio-hero">
                    <span class="hero-label"><span>01</span> INTRODUCTION</span>
                    <h1>Turning ideas<br>into <span>digital reality.</span></h1>
                    <p id="modernPreviewIntro">I enjoy building clean, useful, and user-friendly digital experiences. I am always learning and looking for opportunities to improve my skills.</p>
                    <a class="hero-link" href="#modernWorkSection">EXPLORE MY WORK <span>↘</span></a>
                    <div class="hero-decoration" aria-hidden="true">✳</div>
                </section>

                <section id="modernAboutSection" class="portfolio-section about-section">
                    <div class="section-number">01 / ABOUT</div>
                    <div>
                        <h2>A little about me<span>.</span></h2>
                        <p id="modernPreviewAbout">I am a motivated and detail-oriented developer who enjoys solving problems and turning ideas into working projects. I value teamwork, continuous learning, and creating work that is simple to use.</p>
                    </div>
                </section>

                <section class="portfolio-section skills-section">
                    <div class="section-number">02 / EXPERTISE</div>
                    <div>
                        <h2>Skills & tools<span>.</span></h2>
                        <div id="modernPreviewSkills" class="skill-list"></div>
                    </div>
                </section>

                <section id="modernWorkSection" class="portfolio-section work-section">
                    <div class="section-number">03 / SELECTED WORK</div>
                    <div>
                        <h2>Featured project<span>.</span></h2>
                        <div class="project-card">
                            <div class="project-card-top">
                                <span class="project-icon">↗</span>
                                <span class="project-index">PROJECT / 001</span>
                            </div>
                            <h3 id="modernPreviewProject">Personal Portfolio Website</h3>
                            <p id="modernPreviewProjectDescription">A personal website that presents my skills, projects, and background in one organized place.</p>
                            <span class="project-tag">FEATURED PROJECT</span>
                        </div>
                    </div>
                </section>

                <section id="modernContactSection" class="contact-section">
                    <span class="section-number">04 / CONTACT</span>
                    <h2>Have an idea?<br><span>Let's connect.</span></h2>
                    <a id="modernContactLink" class="contact-email" href="mailto:alex@example.com">alex@example.com ↗</a>
                </section>

                <footer class="portfolio-footer">
                    <span>PERSONAL PORTFOLIO</span>
                    <span>BUILT WITH PORTECH ✳</span>
                </footer>
            </div>
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
