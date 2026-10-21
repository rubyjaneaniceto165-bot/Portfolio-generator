
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portech - Account Settings</title>

    <link rel="stylesheet" href="/css/dark-mode.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="/dashboard" class="brand">
            <img src="/images/logo.png" alt="Portech Logo">
            <span>Portech</span>
        </a>

        <p class="sidebar-label">WORKSPACE</p>

        <nav class="sidebar-nav">
            <a href="/dashboard" class="nav-link">
                <span class="nav-icon">⌂</span> Dashboard
            </a>

            <a href="/dashboard#my-portfolios" class="nav-link">
                <span class="nav-icon">▤</span> My Portfolios
            </a>

            <a href="/profile" class="nav-link">
                <span class="nav-icon">♙</span> Profile Settings
            </a>

            <a href="/account-settings" class="nav-link active">
                <span class="nav-icon">⚙</span> Account Settings
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-tip">
                <span class="tip-icon">✦</span>
                <h3>Keep your account secure.</h3>
                <p>Manage your email and password here.</p>
            </div>

            <button
                type="button"
                id="accountSidebarLogout"
                class="sidebar-logout">
                ↗ Log Out
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dashboard-main">

        <!-- TOPBAR -->
        <header class="dashboard-topbar">
            <div>
                <p class="topbar-label">PORTECH WORKSPACE</p>
                <p class="topbar-subtitle">Manage your account security</p>
            </div>

            <!-- DARK MODE AND PROFILE BUTTONS -->
            <div class="topbar-actions">

                <button
                    type="button"
                    class="theme-toggle"
                    data-theme-toggle
                    aria-label="Switch to dark mode"
                    title="Dark mode">
                    🌙
                </button>

                <a href="/profile" class="secondary-button">
                    My Profile →
                </a>

            </div>
        </header>

        <div class="profile-container">

            <!-- PAGE HEADING -->
            <div class="profile-heading">
                <p class="profile-label">SECURITY & ACCESS</p>
                <h1>Account Settings</h1>
                <p>Update your sign-in details and manage your account.</p>
            </div>

            <!-- CHANGE EMAIL -->
            <section class="profile-card">
                <h2>Change Email</h2>

                <p class="profile-description">
                    Update the email address connected to your Portech account.
                    You may need to confirm the new address.
                </p>

                <form id="changeEmailForm">
                    <label for="currentEmail">Current Email</label>
                    <input
                        type="email"
                        id="currentEmail"
                        readonly>

                    <label for="newEmail">New Email Address</label>
                    <input
                        type="email"
                        id="newEmail"
                        placeholder="Enter your new email address"
                        required>

                    <p
                        id="emailMessage"
                        role="status"
                        aria-live="polite">
                    </p>

                    <button
                        type="submit"
                        id="changeEmailButton"
                        class="save-profile-btn">
                        Update Email
                    </button>
                </form>
            </section>

            <!-- CHANGE PASSWORD -->
            <section class="profile-card">
                <h2>Change Password</h2>

                <p class="profile-description">
                    Choose a new password to help keep your account secure.
                </p>

                <form id="passwordForm">
                    <label for="currentPassword">Current Password</label>
                    <input
                        type="password"
                        id="currentPassword"
                        autocomplete="current-password"
                        placeholder="Enter current password"
                        required>

                    <label for="newPassword">New Password</label>
                    <input
                        type="password"
                        id="newPassword"
                        autocomplete="new-password"
                        minlength="6"
                        placeholder="Enter new password"
                        required>

                    <label for="confirmNewPassword">Confirm New Password</label>
                    <input
                        type="password"
                        id="confirmNewPassword"
                        autocomplete="new-password"
                        minlength="6"
                        placeholder="Confirm new password"
                        required>

                    <label class="show-password-option">
                        <input type="checkbox" id="showPasswords">
                        Show passwords
                    </label>

                    <p
                        id="passwordMessage"
                        role="status"
                        aria-live="polite">
                    </p>

                    <button
                        type="submit"
                        id="changePasswordButton"
                        class="save-profile-btn">
                        Change Password
                    </button>
                </form>
            </section>

            <!-- LOG OUT -->
            <section class="profile-card logout-section">
                <h2>Log Out</h2>

                <p class="profile-description">
                    Log out of your Portech account on this device.
                </p>

                <button
                    type="button"
                    id="logoutButton"
                    class="logout-btn">
                    Log Out
                </button>
            </section>

            <!-- DELETE ACCOUNT -->
            <section class="profile-card delete-account-section">
                <h2>Delete Account</h2>

                <p class="profile-description">
                    Permanently delete your Portech account.
                    This action cannot be undone. Your saved portfolios
                    and other account data may also be removed.
                </p>

                <p class="profile-description">
                    Only continue if you are sure you no longer want
                    to use this account.
                </p>

                <button
                    type="button"
                    id="deleteAccountButton"
                    class="delete-account-btn">
                    Delete My Account
                </button>

                <p
                    id="deleteAccountMessage"
                    role="status"
                    aria-live="polite">
                </p>
            </section>

        </div>

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

<!-- ACCOUNT SETTINGS FUNCTIONALITY -->
<script src="/js/account-settings.js?v=4"></script>

<!-- DARK MODE FUNCTIONALITY -->
<script src="/js/theme.js"></script>

</body>
</html>
