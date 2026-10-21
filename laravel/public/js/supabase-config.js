
const SUPABASE_URL = "https://rprmljjwkquvilbixcuc.supabase.co";

const SUPABASE_KEY = "sb_publishable_L_5zaMN5kXblflj97IwJsA_BdosW0Ko";

window.supabaseClient = window.supabase.createClient(
    SUPABASE_URL,
    SUPABASE_KEY,
    {
        auth: {
            autoRefreshToken: true,
            persistSession: true,
            detectSessionInUrl: true,
            flowType: "implicit"
        }
    }
);
