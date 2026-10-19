
/* ==============================
   PORTECH PORTFOLIO STORAGE
   Supabase Save, Load, Edit, Delete
============================== */

(() => {
    const client = window.supabaseClient;

    if (!client) {
        console.error("Supabase client is not ready.");
        return;
    }

    const TABLE = "portfolios";
    const ALLOWED_TEMPLATES = ["modern", "creative", "minimal"];

    async function getCurrentUser() {
        const { data, error } = await client.auth.getUser();

        if (error) throw error;

        if (!data.user) {
            throw new Error("Please log in before saving a portfolio.");
        }

        return data.user;
    }

    function validateTemplate(template) {
        if (!ALLOWED_TEMPLATES.includes(template)) {
            throw new Error("Invalid portfolio template.");
        }
    }

    // Save a new portfolio or update an existing one.
    async function savePortfolio({ id = null, title, template, content }) {
        const user = await getCurrentUser();
        validateTemplate(template);

        const record = {
            user_id: user.id,
            title: String(title || "My Portfolio").trim().slice(0, 150),
            template,
            content,
            updated_at: new Date().toISOString()
        };

        if (id) {
            const { data, error } = await client
                .from(TABLE)
                .update(record)
                .eq("id", id)
                .select()
                .single();

            if (error) throw error;
            return data;
        }

        const { data, error } = await client
            .from(TABLE)
            .insert(record)
            .select()
            .single();

        if (error) throw error;
        return data;
    }

    // Load one portfolio. Supabase RLS should restrict access to its owner.
    async function getPortfolio(id) {
        await getCurrentUser();

        const { data, error } = await client
            .from(TABLE)
            .select("*")
            .eq("id", id)
            .single();

        if (error) throw error;
        return data;
    }

    // Load the current user's portfolios.
    async function getMyPortfolios() {
        const user = await getCurrentUser();

        const { data, error } = await client
            .from(TABLE)
            .select("*")
            .eq("user_id", user.id)
            .order("updated_at", { ascending: false });

        if (error) throw error;
        return data || [];
    }

    // Delete a portfolio belonging to the current user.
    async function deletePortfolio(id) {
        await getCurrentUser();

        const { error } = await client
            .from(TABLE)
            .delete()
            .eq("id", id);

        if (error) throw error;
    }

    window.portfolioStorage = {
        savePortfolio,
        getPortfolio,
        getMyPortfolios,
        deletePortfolio
    };
})();
