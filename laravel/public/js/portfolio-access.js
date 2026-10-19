(() => {
    const client = window.supabaseClient;
    const currentUrl = new URL(window.location.href);

    function loginUrl(destination) {
        const url = new URL("/", window.location.origin);
        url.searchParams.set("login", "1");
        url.searchParams.set("next", destination);
        return url.toString();
    }

    async function hasSession() {
        if (!client) {
            throw new Error("Supabase client is not ready.");
        }

        const { data, error } = await client.auth.getSession();

        if (error) throw error;

        return Boolean(data.session);
    }

    if (currentUrl.pathname === "/portfolio/create") {
        hasSession()
            .then((authenticated) => {
                if (!authenticated) {
                    window.location.replace(
                        loginUrl(`${currentUrl.pathname}${currentUrl.search}`)
                    );
                }
            })
            .catch((error) => {
                console.error("Could not verify login before opening the portfolio editor:", error);
                alert("We couldn't verify your login. Please try again.");
            });
    }
})();
