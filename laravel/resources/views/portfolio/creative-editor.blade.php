
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portech - Creative Portfolio</title>
    <link rel="stylesheet" href="/css/templates/creative-editor.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="/templates">
        <img src="/images/logo.png" alt="">
        <span>Portech</span>
    </a>
    <a class="back-link" href="/templates">← Back to Templates</a>
</header>

<main class="editor-layout">
    <section class="editor-panel">
        <div class="editor-heading">
            <span class="heading-sticker">✦</span>
            <p class="eyebrow">YOUR LITTLE CREATIVE SPACE</p>
            <h1>Make it yours<span>!</span></h1>
            <p class="subheading">Fill in your details and watch your portfolio bloom.</p>
        </div>

        <form id="creativeForm">
            <label for="creativeName">Your name</label>
            <input id="creativeName" type="text" maxlength="80" placeholder="e.g. Alex Morgan">

            <label for="creativeTitle">What do you do?</label>
            <input id="creativeTitle" type="text" maxlength="100" placeholder="e.g. Web Developer &amp; Designer">

            <label for="creativePhoto">Your profile photo</label>
            <input id="creativePhoto" type="file" accept="image/*">
            <p class="hint">Optional · JPG, PNG or WEBP · up to 5 MB</p>

            <label for="creativeAbout">A little about you</label>
            <textarea id="creativeAbout" rows="4" maxlength="1000" placeholder="Tell visitors a little about yourself."></textarea>
            <p class="counter"><span id="creativeAboutCount">0</span>/1000</p>

            <label for="creativeSkills">Your skills</label>
            <input id="creativeSkills" type="text" placeholder="e.g. HTML, CSS, JavaScript, UI/UX">
            <p class="hint">Use commas to separate your skills.</p>

            <label for="creativeProjectTitle">Featured project</label>
            <input id="creativeProjectTitle" type="text" placeholder="e.g. My Portfolio Website" maxlength="100">

            <label for="creativeProjectDescription">Tell us about it</label>
            <textarea id="creativeProjectDescription" rows="3" maxlength="1000" placeholder="Describe what your project does."></textarea>
            <p class="counter"><span id="creativeProjectCount">0</span>/1000</p>

            <label for="creativeEmail">Contact email</label>
            <input id="creativeEmail" type="email" placeholder="you@example.com" maxlength="150">

            <div class="button-row">
                <button type="button" id="creativeReset" class="button secondary">↺ Reset</button>
                <button type="button" id="creativeSave" class="button primary">Save Portfolio</button>
                <button type="button" id="creativeDownload" class="button primary">Download portfolio ↓</button>
            </div>

            <p id="creativeMessage" class="status-message">✿ Your preview is ready!</p>
        </form>
    </section>

    <section class="preview-panel">
        <div class="preview-heading">
            <div>
                <p class="eyebrow">A LITTLE PREVIEW</p>
                <h2>Your portfolio</h2>
            </div>
            <span class="live-pill"><i></i> Live preview</span>
        </div>

        <article id="creativePortfolioPage" class="portfolio-page">
            <nav class="portfolio-nav">
                <a href="#creativeHome" class="portfolio-brand">hello<span>✿</span></a>
                <div class="portfolio-links">
                    <a href="#creativeHome">Home</a>
                    <a href="#creativeAboutSection">About</a>
                    <a href="#creativeProjects">Work</a>
                    <a href="#creativeContact">Contact</a>
                </div>
            </nav>

            <section id="creativeHome" class="hero-section">
                <div class="hero-copy">
                    <p class="mini-label"><span>✦</span> HEY THERE, I'M</p>
                    <h1 id="creativePreviewName">Your Name</h1>
                    <h2 id="creativePreviewTitle">Web Developer & Designer</h2>
                    <p id="creativeHeroAbout">Hi! I'm a creative and curious person who enjoys building websites, learning new things, and turning simple ideas into something lovely.</p>

                    <div class="hero-actions">
                        <a href="#creativeProjects" class="preview-cta">See my work <span>↗</span></a>
                        <a href="#creativeContact" class="text-link">Say hello ♡</a>
                    </div>

                    <span class="tiny-note">made with a little bit of magic ✧</span>
                </div>

                <div class="portrait-area">
                    <div class="portrait-blob"></div>
                    <div class="portrait-frame">
                        <div id="creativePhotoPlaceholder" class="portrait-placeholder">
                            <span>YOUR PHOTO</span>
                            <b>♡</b>
                        </div>
                        <img id="creativePreviewPhoto" class="portrait-image" alt="Profile photo" hidden>
                    </div>
                    <span class="float-star star-one">✦</span>
                    <span class="float-star star-two">✧</span>
                    <span class="float-heart">♡</span>
                </div>
            </section>

            <section id="creativeAboutSection" class="about-section content-section">
                <div class="section-icon">♡</div>
                <div>
                    <p class="section-number">01 · A LITTLE ABOUT ME</p>
                    <h2>Nice to meet you!</h2>
                    <p id="creativePreviewAbout">I'm a creative and curious person who enjoys building websites, learning new things, and turning simple ideas into something lovely.</p>
                </div>
            </section>

            <section class="skills-section content-section">
                <p class="section-number">02 · THINGS I LOVE TO DO</p>
                <h2>My little toolkit <span>✿</span></h2>
                <div id="creativePreviewSkills" class="skill-list"></div>
            </section>

            <section id="creativeProjects" class="projects-section content-section">
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
                        <h3 id="creativePreviewProjectTitle">My Little Project</h3>
                        <p id="creativePreviewProjectDescription">A simple and friendly web project made to help people stay organized and make everyday tasks easier.</p>
                    </div>
                </div>
            </section>

            <section id="creativeContact" class="contact-section">
                <span class="contact-doodle">✿</span>
                <div>
                    <p class="section-number">04 · LET'S CONNECT</p>
                    <h2>Have a lovely idea?</h2>
                    <p>I'd love to hear from you. Let's make something good!</p>
                </div>
                <a id="creativePreviewEmail" href="mailto:you@example.com">you@example.com ↗</a>
            </section>

            <footer class="portfolio-footer">
                <span id="creativePreviewFooter">MADE BY YOUR NAME ♡</span>
                <span>THANKS FOR STOPPING BY ✿</span>
            </footer>
        </article>
    </section>
</main>



<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="/js/supabase-config.js"></script>
<script src="/js/portfolio-access.js"></script>
<script src="/js/portfolio-storage.js"></script>
<script src="/js/templates/creative-editor.js"></script>


</body>
</html>
