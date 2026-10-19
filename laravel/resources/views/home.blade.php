<!-- PORTECH HOMEPAGE TEST -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portech - Portfolio Generator</title>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <!-- ================= HEADER ================= -->

    <header>
        <div class="logo">
            Portech
        </div>

        <nav>
            <a href="#home">Home</a>
            <a href="#guide">Guide</a>
            <a href="#about">About</a>
        </nav>

        <div class="buttons">
            <button class="login-btn" id="loginButton" type="button">
                Log In
            </button>

            <button class="signup-btn" id="signupButton" type="button">
                Sign Up
            </button>
        </div>
    </header>


    <!-- ================= HOME SECTION ================= -->

    <section class="home" id="home">
        <div class="home-text">
            <h1>
                Welcome to <span>Portech</span>
            </h1>

            <p>
                Portech is a portfolio generator website that helps you
                build a professional and creative portfolio quickly and easily.
                Showcase your skills, projects, experiences, and achievements
                in one organized website.
            </p>

            <p>
                Choose a template, add your information, customize your
                portfolio, and create a website that represents you.
            </p>

            <div class="home-buttons">
                <!-- Opens the Templates selection page -->
                <a href="/templates" class="get-started">
                     Get Started
                </a>

                <a href="#about" class="learn-more">
                    Learn More
                </a>
            </div>
        </div>

        <div class="home-logo">
            <img
                src="/images/logo.png"
                alt="Portech Logo"
                class="logo-center">
        </div>
    </section>


    <!-- ================= GUIDE SECTION ================= -->

    <section class="guide-section" id="guide">

        <div class="section-title">
            <h2>How to Use Portech</h2>

            <p>
                Create your own professional portfolio in just a few simple steps.
            </p>
        </div>

        <div class="steps">

            <div class="step-card">
                <div class="step-number">01</div>
                <h3>Create an Account</h3>
                <p>
                    Sign up for a Portech account using your name,
                    username, email, and password.
                </p>
            </div>

            <div class="step-card">
                <div class="step-number">02</div>
                <h3>Choose a Template</h3>
                <p>
                    Select one of our available portfolio templates
                    that matches your preferred style.
                </p>
            </div>

            <div class="step-card">
                <div class="step-number">03</div>
                <h3>Add Your Information</h3>
                <p>
                    Enter your personal information, skills,
                    projects, education, and experience.
                </p>
            </div>

            <div class="step-card">
                <div class="step-number">04</div>
                <h3>Generate Your Portfolio</h3>
                <p>
                    Review your information and generate your
                    portfolio website when everything is ready.
                </p>
            </div>

        </div>


        <!-- ================= PORTFOLIO TEMPLATES ================= -->

        <div class="template-title">
            <h2>Choose Your Portfolio Template</h2>

            <p>
                Pick a design that best represents your personality and work.
            </p>
        </div>

        <div class="templates">

            <!-- MODERN TEMPLATE -->

            <div class="template-card">
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
                    <h3>Modern</h3>

                    <p>
                        A clean and professional design
                        suitable for students and professionals.
                    </p>

                    
                        <a 
                            href="/portfolio/create?template=modern" class="template-button">
                                Choose Template
                        </a>

                </div>
            </div>


            <!-- CREATIVE TEMPLATE -->

            <div class="template-card">
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
                    <h3>Creative</h3>

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
            </div>


            <!-- MINIMAL TEMPLATE -->

            <div class="template-card">
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
                    <h3>Minimal</h3>

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
            </div>

        </div>

    </section>


    <!-- ================= ABOUT SECTION ================= -->

    <section class="about-section" id="about">
        <div class="about-container">

            <div class="about-text">
                <h2>About Portech</h2>

                <p>
                    Portech is a portfolio generator designed to make
                    portfolio creation easier, faster, and more accessible.
                </p>

                <p>
                    Our goal is to help students, job seekers, developers,
                    designers, and professionals create a portfolio without
                    needing advanced web development skills.
                </p>

                <p>
                    With simple templates and an easy-to-use interface,
                    users can organize their information and showcase their
                    skills, projects, experiences, and achievements online.
                </p>
            </div>

            <div class="contact-box">
                <h3>Contact Us</h3>

                <p>
                    Have questions or suggestions?
                    Feel free to reach out to us.
                </p>

                <a href="#" class="social-link">
                    Facebook
                </a>

                <a href="#" class="social-link">
                    Instagram
                </a>

                <div class="location">
                    <strong>Location</strong>
                    <p>Cebu City, Philippines</p>
                </div>
            </div>

        </div>
    </section>


    <!-- ================= FOOTER ================= -->

    <footer>
        <div class="footer-logo">
            Portech
        </div>

        <p>
            Build your portfolio. Showcase your skills.
        </p>

        <p class="copyright">
            © 2026 Portech. All Rights Reserved.
        </p>
    </footer>


    <!-- ================= LOGIN POPUP ================= -->

    <div class="popup" id="loginPopup">
        <div class="form-box">

            <span class="close" id="closeLogin">
                &times;
            </span>

            <h2>Log In</h2>

            <form id="loginForm">

                <label for="loginUsername">
                    Username or Email
                </label>

                <input
                    type="text"
                    id="loginUsername"
                    placeholder="Enter username or email"
                    required>

                <label for="loginPassword">
                    Password
                </label>

                <input
                    type="password"
                    id="loginPassword"
                    placeholder="Enter password"
                    required>

                <button type="submit" class="submit-button">
                    Log In
                </button>

            </form>

            <p class="switch-text">
                Don't have an account?

                <span id="switchToSignup">
                    Sign Up
                </span>
            </p>

        </div>
    </div>


    <!-- ================= SIGN UP POPUP ================= -->

    <div class="popup" id="signupPopup">
        <div class="form-box">

            <span class="close" id="closeSignup">
                &times;
            </span>

            <h2>Sign Up</h2>

            <form id="signupForm">

                <label for="fullname">
                    Full Name
                </label>

                <input
                    type="text"
                    id="fullname"
                    placeholder="Enter your full name"
                    required>

                <label for="signupUsername">
                    Username
                </label>

                <input
                    type="text"
                    id="signupUsername"
                    placeholder="Create a username"
                    required>

                <label for="signupEmail">
                    Email
                </label>

                <input
                    type="email"
                    id="signupEmail"
                    placeholder="Enter your email"
                    required>

                <label for="signupPassword">
                    Password
                </label>

                <input
                    type="password"
                    id="signupPassword"
                    placeholder="Create a password"
                    required>

                <label for="confirmPassword">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="confirmPassword"
                    placeholder="Confirm your password"
                    required>

                <button type="submit" class="submit-button">
                    Create Account
                </button>

            </form>

            <p class="switch-text">
                Already have an account?

                <span id="switchToLogin">
                    Log In
                </span>
            </p>

        </div>
    </div>


    
    <!-- ================= SCRIPTS ================= -->

    <!-- SUPABASE LIBRARY -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <!-- SHARED SUPABASE CONFIGURATION -->
    <script src="/js/supabase-config.js"></script>

    <!-- PORTFOLIO ACCESS CONTROL -->
    <script src="/js/portfolio-access.js"></script>

    <!-- HOMEPAGE AUTHENTICATION -->
    <script src="/js/main.js?v=4"></script>


</body>
</html>
