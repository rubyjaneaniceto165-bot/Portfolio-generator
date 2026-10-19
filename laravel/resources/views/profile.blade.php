
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portech - Profile Settings</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
<div class="dashboard-layout">

    <aside class="sidebar">
        <a href="/dashboard" class="brand">
            <img src="/images/logo.png" alt="Portech Logo">
            <span>Portech</span>
        </a>

        <p class="sidebar-label">WORKSPACE</p>

        <nav class="sidebar-nav">
            <a href="/dashboard" class="nav-link">
                <span class="nav-icon">▦</span> Dashboard
            </a>

            <a href="/dashboard#my-portfolios" class="nav-link">
                <span class="nav-icon">▤</span> My Portfolios
            </a>

            <a href="/profile" class="nav-link active">
                <span class="nav-icon">♙</span> Profile Settings
            </a>

            <a href="/account-settings" class="nav-link">
                <span class="nav-icon">⚙</span> Account Settings
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
                id="profileSidebarLogout"
                class="sidebar-logout">
                ↗ Log Out
            </button>
        </div>
    </aside>

    <main class="dashboard-main">

        <header class="dashboard-topbar">
            <div>
                <p class="topbar-label">PORTECH WORKSPACE</p>
                <p class="topbar-subtitle">Your personal information</p>
            </div>

            <a href="/account-settings" class="secondary-button">
                Account Settings →
            </a>
        </header>

        <div class="profile-container">
            <div class="profile-heading">
                <p class="profile-label">YOUR ACCOUNT</p>
                <h1>Profile Settings</h1>
                <p>Manage your personal information and introduction.</p>
            </div>

            <section class="profile-card">
                <div class="profile-avatar">U</div>

                <h2>Personal Information</h2>

                <p class="profile-description">
                    Update the information associated with your Portech account.
                </p>

                <form id="profileForm">
                    <label for="fullName">Full Name</label>
                    <input
                        type="text"
                        id="fullName"
                        placeholder="Enter your full name"
                        required>

                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        placeholder="Enter your username"
                        required>

                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        placeholder="Your account email"
                        disabled>

                    <label for="bio">About Me</label>
                    <textarea
                        id="bio"
                        rows="4"
                        placeholder="Write a short introduction about yourself"></textarea>

                    <p
                        id="profileMessage"
                        role="status"
                        aria-live="polite">
                    </p>

                    <button type="submit" class="save-profile-btn">
                        Save Changes
                    </button>
                </form>
            </section>
        </div>

        <footer class="dashboard-footer">
            <p>Made for creators, students, and future professionals.</p>
            <span>© 2026 Portech</span>
        </footer>

    </main>
</div>

<!-- Load Supabase first -->
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

<!-- Create the shared Supabase client -->
<script src="/js/supabase-config.js"></script>

<!-- Profile loading, saving, and logout -->
<script src="/js/profile.js?v=2"></script>

</body>
</html>
