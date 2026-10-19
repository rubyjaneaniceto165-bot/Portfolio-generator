/* ==============================
   PORTECH DASHBOARD JAVASCRIPT
============================== */

const supabaseClient = window.supabaseClient;
const portfolioStorage = window.portfolioStorage;

/* ==============================
   DASHBOARD ELEMENTS
============================== */

const welcomeName = document.getElementById("welcomeName");
const topbarName = document.getElementById("topbarName");
const userAvatar = document.getElementById("userAvatar");
const dashboardMessage = document.getElementById("dashboardMessage");

const totalPortfolios = document.getElementById("totalPortfolios");
const draftPortfolios = document.getElementById("draftPortfolios");

const emptyState = document.getElementById("emptyState");
const portfolioGrid = document.getElementById("portfolioGrid");
const logoutButton = document.getElementById("sidebarLogout");

/* ==============================
   DASHBOARD MESSAGE
============================== */

function showDashboardMessage(message) {
    if (dashboardMessage) {
        dashboardMessage.textContent = message;
    }
}

/* ==============================
   UPDATE USER INFORMATION
============================== */

function updateUserInformation(user, profile = null) {
    const metadata = user.user_metadata || {};

    const fullName =
        profile?.full_name ||
        profile?.username ||
        metadata.full_name ||
        metadata.username ||
        user.email?.split("@")[0] ||
        "Creator";

    if (welcomeName) {
        welcomeName.textContent = fullName;
    }

    if (topbarName) {
        topbarName.textContent = fullName;
    }

    if (userAvatar) {
        userAvatar.textContent =
            fullName.trim().charAt(0).toUpperCase() || "U";
    }
}

/* ==============================
   LOAD USER PROFILE
============================== */

async function loadUserProfile(user) {
    updateUserInformation(user);

    try {
        const { data: profile, error } = await supabaseClient
            .from("profiles")
            .select("full_name, username")
            .eq("id", user.id)
            .maybeSingle();

        if (error) {
            console.error("Could not load profile:", error.message);
            return;
        }

        if (profile) {
            updateUserInformation(user, profile);
        }
    } catch (error) {
        console.error("Profile loading failed:", error);
    }
}

/* ==============================
   FORMAT DATE
============================== */

function formatPortfolioDate(dateValue) {
    if (!dateValue) {
        return "Date unavailable";
    }

    const date = new Date(dateValue);

    if (Number.isNaN(date.getTime())) {
        return "Date unavailable";
    }

    return date.toLocaleDateString(undefined, {
        year: "numeric",
        month: "short",
        day: "numeric"
    });
}

/* ==============================
   CREATE PORTFOLIO CARD
============================== */

function createPortfolioCard(portfolio) {
    const card = document.createElement("article");
    card.className = "portfolio-card";

    const title = document.createElement("h3");
    title.className = "portfolio-card-title";
    title.textContent =
        portfolio.title ||
        portfolio.content?.name ||
        "Untitled Portfolio";

    const template = document.createElement("p");
    template.className = "portfolio-card-template";

    const templateNames = {
        modern: "Modern Template",
        creative: "Creative Template",
        minimal: "Minimal Template"
    };

    template.textContent =
        templateNames[portfolio.template] ||
        "Portfolio Template";

    const updated = document.createElement("p");
    updated.className = "portfolio-card-date";
    updated.textContent =
        "Last updated: " +
        formatPortfolioDate(portfolio.updated_at);

    const actions = document.createElement("div");
    actions.className = "portfolio-card-actions";

    /* EDIT BUTTON */

    const editButton = document.createElement("a");
    editButton.className = "portfolio-edit-button";
    editButton.textContent = "Edit Portfolio";

    const allowedTemplates = [
        "modern",
        "creative",
        "minimal"
    ];

    if (allowedTemplates.includes(portfolio.template)) {
        const editUrl = new URL(
            "/portfolio/create",
            window.location.origin
        );

        editUrl.searchParams.set("template", portfolio.template);
        editUrl.searchParams.set("id", portfolio.id);

        editButton.href = editUrl.pathname + editUrl.search;
    } else {
        editButton.href = "/templates";
    }

    /* DELETE BUTTON */

    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.className = "portfolio-delete-button";
    deleteButton.textContent = "Delete";

    deleteButton.addEventListener("click", () => {
        deletePortfolioFromDashboard(portfolio, deleteButton);
    });

    actions.append(editButton, deleteButton);

    card.append(title, template, updated, actions);

    return card;
}

/* ==============================
   LOAD PORTFOLIOS FROM SUPABASE
============================== */

async function loadPortfolios() {
    if (!portfolioStorage) {
        throw new Error(
            "Portfolio storage is not loaded. Check your script order."
        );
    }

    if (totalPortfolios) {
        totalPortfolios.textContent = "…";
    }

    if (draftPortfolios) {
        draftPortfolios.textContent = "—";
        draftPortfolios.title =
            "Status tracking is not configured yet.";
    }

    const portfolios = await portfolioStorage.getMyPortfolios();

    /* UPDATE TOTAL COUNT */

    if (totalPortfolios) {
        totalPortfolios.textContent = String(portfolios.length);
    }

    /*
       The current portfolios table has no status column.
       Therefore, the In Progress count stays as a dash
       until status tracking is implemented.
    */

    /* DISPLAY PORTFOLIO CARDS */

    if (portfolioGrid) {
        portfolioGrid.replaceChildren();

        portfolios.forEach((portfolio) => {
            portfolioGrid.appendChild(
                createPortfolioCard(portfolio)
            );
        });
    }

    /* SHOW EMPTY STATE WHEN THERE ARE NO PORTFOLIOS */

    if (emptyState) {
        emptyState.hidden = portfolios.length > 0;
    }

    return portfolios;
}

/* ==============================
   DELETE PORTFOLIO
============================== */

async function deletePortfolioFromDashboard(portfolio, button) {
    const portfolioTitle =
        portfolio.title ||
        portfolio.content?.name ||
        "this portfolio";

    const confirmed = window.confirm(
        `Are you sure you want to delete "${portfolioTitle}"? This cannot be undone.`
    );

    if (!confirmed) {
        return;
    }

    button.disabled = true;
    button.textContent = "Deleting...";

    try {
        await portfolioStorage.deletePortfolio(portfolio.id);

        showDashboardMessage("Portfolio deleted successfully.");

        await loadPortfolios();
    } catch (error) {
        console.error("Portfolio deletion failed:", error);

        showDashboardMessage(
            error.message ||
            "Could not delete the portfolio. Please try again."
        );

        button.disabled = false;
        button.textContent = "Delete";
    }
}

/* ==============================
   LOAD DASHBOARD
============================== */

async function loadDashboard() {
    if (!supabaseClient) {
        showDashboardMessage(
            "Supabase is not ready. Check supabase-config.js."
        );
        return;
    }

    try {
        const {
            data: { session },
            error
        } = await supabaseClient.auth.getSession();

        if (error) {
            throw error;
        }

        /* REDIRECT IF NOT LOGGED IN */

        if (!session) {
            window.location.replace("/");
            return;
        }

        showDashboardMessage("");

        await loadUserProfile(session.user);
        await loadPortfolios();
    } catch (error) {
        console.error("Dashboard loading failed:", error);

        showDashboardMessage(
            error.message ||
            "Something went wrong while loading your dashboard."
        );

        if (totalPortfolios) {
            totalPortfolios.textContent = "—";
        }

        if (draftPortfolios) {
            draftPortfolios.textContent = "—";
        }

        if (portfolioGrid) {
            portfolioGrid.replaceChildren();
        }

        if (emptyState) {
            emptyState.hidden = true;
        }
    }
}

/* ==============================
   LOG OUT
============================== */

async function logoutUser() {
    if (!supabaseClient) {
        showDashboardMessage(
            "Supabase is not ready. Please refresh."
        );
        return;
    }

    if (logoutButton) {
        logoutButton.disabled = true;
        logoutButton.textContent = "Logging out...";
    }

    try {
        const { error } = await supabaseClient.auth.signOut();

        if (error) {
            throw error;
        }

        window.location.replace("/");
    } catch (error) {
        console.error("Logout failed:", error);

        showDashboardMessage(
            "Could not log out. Please try again."
        );

        if (logoutButton) {
            logoutButton.disabled = false;
            logoutButton.textContent = "↗ Log Out";
        }
    }
}

/* ==============================
   CONNECT LOGOUT BUTTON
============================== */

if (logoutButton) {
    logoutButton.addEventListener("click", logoutUser);
}

/* ==============================
   LISTEN FOR AUTH CHANGES
============================== */

if (supabaseClient) {
    supabaseClient.auth.onAuthStateChange((event, session) => {
        if (event === "SIGNED_OUT" || !session) {
            window.location.replace("/");
        }
    });
}

/* ==============================
   START DASHBOARD
============================== */

loadDashboard();
