
/* =========================
   PORTECH HOMEPAGE
   SUPABASE AUTHENTICATION
========================= */

// Use the shared Supabase client.
const supabaseClient = window.supabaseClient;

if (!supabaseClient) {
    console.error(
        "Supabase client not found. Check supabase-config.js."
    );
}


/* =========================
   POPUP ELEMENTS
========================= */

const loginPopup = document.getElementById("loginPopup");
const signupPopup = document.getElementById("signupPopup");

const closeLogin = document.getElementById("closeLogin");
const closeSignup = document.getElementById("closeSignup");

const switchToSignup = document.getElementById("switchToSignup");
const switchToLogin = document.getElementById("switchToLogin");

const loginForm = document.getElementById("loginForm");
const signupForm = document.getElementById("signupForm");


/* =========================
   POPUP FUNCTIONS
========================= */

function openPopup(popup) {
    if (popup) {
        popup.style.display = "flex";
    }
}

function closePopup(popup) {
    if (popup) {
        popup.style.display = "none";
    }
}

function showLoginPopup() {
    openPopup(loginPopup);
}

function showSignupPopup() {
    openPopup(signupPopup);
}

function getPostLoginDestination() {
    const next = new URLSearchParams(window.location.search).get("next");

    if (!next) return "/dashboard";

    let destination;

    try {
        destination = new URL(next, window.location.origin);
    } catch {
        return "/dashboard";
    }

    if (
        destination.origin !== window.location.origin ||
        destination.pathname !== "/portfolio/create"
    ) {
        return "/dashboard";
    }

    return `${destination.pathname}${destination.search}`;
}


/* =========================
   OPEN AND CLOSE POPUPS
========================= */

document.addEventListener("click", (event) => {
    const target = event.target.closest("button, a, span");

    if (!target) return;

    if (target.id === "loginButton") {
        event.preventDefault();
        showLoginPopup();
    }

    if (target.id === "signupButton") {
        event.preventDefault();
        showSignupPopup();
    }

    if (target.id === "closeLogin") {
        closePopup(loginPopup);
    }

    if (target.id === "closeSignup") {
        closePopup(signupPopup);
    }

    if (target.id === "switchToSignup") {
        closePopup(loginPopup);
        showSignupPopup();
    }

    if (target.id === "switchToLogin") {
        closePopup(signupPopup);
        showLoginPopup();
    }
});


/* =========================
   CLOSE POPUP OUTSIDE FORM
========================= */

if (loginPopup) {
    loginPopup.addEventListener("click", (event) => {
        if (event.target === loginPopup) {
            closePopup(loginPopup);
        }
    });
}

if (signupPopup) {
    signupPopup.addEventListener("click", (event) => {
        if (event.target === signupPopup) {
            closePopup(signupPopup);
        }
    });
}


/* =========================
   UPDATE HOMEPAGE HEADER
========================= */

function updateHeader(session) {
    const buttons = document.querySelector(".buttons");

    if (!buttons) return;

    if (session) {
        buttons.innerHTML = `
            <a href="/dashboard" class="login-btn">
                Dashboard
            </a>

            <a href="/profile"
               class="profile-icon-btn"
               title="Profile Settings"
               aria-label="Open profile settings">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2"></path>
                </svg>

            </a>
        `;

        closePopup(loginPopup);
        closePopup(signupPopup);

    } else {
        buttons.innerHTML = `
            <button
                class="login-btn"
                id="loginButton"
                type="button">
                Log In
            </button>

            <button
                class="signup-btn"
                id="signupButton"
                type="button">
                Sign Up
            </button>
        `;
    }
}


/* =========================
   LOGIN
========================= */

if (loginForm && supabaseClient) {
    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const email = document
            .getElementById("loginUsername")
            .value.trim();

        const password = document
            .getElementById("loginPassword")
            .value;

        if (!email || !password) {
            alert("Please enter your email and password.");
            return;
        }

        const submitButton = loginForm.querySelector(
            'button[type="submit"]'
        );

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = "Logging in...";
        }

        try {
            const { data, error } =
                await supabaseClient.auth.signInWithPassword({
                    email: email,
                    password: password
                });

            if (error) {
                alert("Login failed: " + error.message);
                return;
            }

            if (data.session) {
                updateHeader(data.session);
                closePopup(loginPopup);

                window.location.href = getPostLoginDestination();
            } else {
                alert(
                    "No active session was returned. " +
                    "Check your email verification settings."
                );
            }

        } catch (error) {
            console.error("Login error:", error);
            alert("Something went wrong while logging in.");

        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = "Log In";
            }
        }
    });
}


/* =========================
   SIGN UP
========================= */

if (signupForm && supabaseClient) {
    signupForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const fullName = document
            .getElementById("fullname")
            .value.trim();

        const username = document
            .getElementById("signupUsername")
            .value.trim();

        const email = document
            .getElementById("signupEmail")
            .value.trim();

        const password = document
            .getElementById("signupPassword")
            .value;

        const confirmPassword = document
            .getElementById("confirmPassword")
            .value;

        if (!fullName || !username || !email) {
            alert("Please complete all required fields.");
            return;
        }

        if (password.length < 6) {
            alert("Your password must be at least 6 characters long.");
            return;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        const submitButton = signupForm.querySelector(
            'button[type="submit"]'
        );

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = "Creating account...";
        }

        try {
            const { data, error } =
                await supabaseClient.auth.signUp({
                    email: email,
                    password: password,

                    options: {
                        data: {
                            full_name: fullName,
                            username: username
                        }
                    }
                });

            if (error) {
                alert("Signup failed: " + error.message);
                return;
            }

            if (data.session) {
                alert("Account created successfully!");

                updateHeader(data.session);
                closePopup(signupPopup);

                window.location.href = getPostLoginDestination();
                return;
            }

            alert(
                "Your account was created. Please check your email " +
                "to verify your account, then log in."
            );

            closePopup(signupPopup);
            signupForm.reset();

        } catch (error) {
            console.error("Signup error:", error);
            alert("Something went wrong while creating your account.");

        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = "Create Account";
            }
        }
    });
}


/* =========================
   CHECK CURRENT SESSION
========================= */

async function checkLoginSession() {
    if (!supabaseClient) return;

    try {
        const {
            data: { session },
            error
        } = await supabaseClient.auth.getSession();

        if (error) {
            console.error(
                "Could not retrieve session:",
                error.message
            );
            return;
        }

        updateHeader(session);

    } catch (error) {
        console.error("Session check failed:", error);
    }
}


/* =========================
   LISTEN FOR AUTH CHANGES
========================= */

if (supabaseClient) {
    supabaseClient.auth.onAuthStateChange(
        (event, session) => {
            updateHeader(session);
        }
    );
}


/* =========================
   INITIALIZE HOMEPAGE
========================= */

checkLoginSession();

if (new URLSearchParams(window.location.search).get("login") === "1") {
    showLoginPopup();
}
