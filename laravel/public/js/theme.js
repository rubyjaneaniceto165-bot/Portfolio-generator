
(() => {
    const STORAGE_KEY = "portech-theme";

    function applyTheme(theme) {
        document.documentElement.dataset.theme = theme;

        document.querySelectorAll("[data-theme-toggle]").forEach(button => {
            const dark = theme === "dark";

            button.textContent = dark ? "☀️" : "🌙";
            button.setAttribute(
                "aria-label",
                dark ? "Switch to light mode" : "Switch to dark mode"
            );
            button.setAttribute("title", dark ? "Light mode" : "Dark mode");
        });
    }

    let savedTheme = "light";

    try {
        savedTheme = localStorage.getItem(STORAGE_KEY) || "light";
    } catch (error) {
        console.warn("Theme preference could not be loaded.");
    }

    applyTheme(savedTheme);

    document.addEventListener("click", event => {
        const button = event.target.closest("[data-theme-toggle]");

        if (!button) return;

        const nextTheme =
            document.documentElement.dataset.theme === "dark"
                ? "light"
                : "dark";

        applyTheme(nextTheme);

        try {
            localStorage.setItem(STORAGE_KEY, nextTheme);
        } catch (error) {
            console.warn("Theme preference could not be saved.");
        }
    });
})();
