
/* ==============================
   PORTECH PROFILE JAVASCRIPT
============================== */

const supabaseClient = window.supabaseClient;

// HTML ELEMENTS
const profileForm = document.getElementById("profileForm");
const fullNameInput = document.getElementById("fullName");
const usernameInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const bioInput = document.getElementById("bio");
const profileMessage = document.getElementById("profileMessage");
const profileAvatar = document.querySelector(".profile-avatar");

const passwordForm = document.getElementById("passwordForm");
const currentPasswordInput = document.getElementById("currentPassword");
const newPasswordInput = document.getElementById("newPassword");
const confirmNewPasswordInput = document.getElementById("confirmNewPassword");
const showPasswordsCheckbox = document.getElementById("showPasswords");
const passwordMessage = document.getElementById("passwordMessage");
const changePasswordButton = document.getElementById("changePasswordButton");

const logoutButton =
    document.getElementById("logoutButton") ||
    document.getElementById("profileSidebarLogout");

let currentUser = null;


// DISPLAY MESSAGES
function showProfileMessage(message, isError = false) {
    if (!profileMessage) return;

    profileMessage.textContent = message;
    profileMessage.style.color = isError ? "#b42318" : "#123b2a";
}

function showPasswordMessage(message, isError = false) {
    if (!passwordMessage) return;

    passwordMessage.textContent = message;
    passwordMessage.style.color = isError ? "#b42318" : "#123b2a";
}


// DISABLE FORMS
function disableProfileForms() {
    [profileForm, passwordForm].forEach(form => {
        if (!form) return;

        form.querySelectorAll("input, textarea, button")
            .forEach(element => {
                element.disabled = true;
            });
    });

    if (logoutButton) logoutButton.disabled = true;
}


// LOAD PROFILE
async function loadProfile() {
    if (!supabaseClient) {
        showProfileMessage(
            "Supabase could not be initialized. Check your configuration.",
            true
        );
        return;
    }

    showProfileMessage("Loading your profile...");

    try {
        const { data, error } = await supabaseClient.auth.getSession();

        if (error) throw error;

        const session = data.session;

        if (!session) {
            window.location.replace("/");
            return;
        }

        currentUser = session.user;

        if (emailInput) {
            emailInput.value = currentUser.email || "";
        }

        // Get the user's saved profile
        const { data: profile, error: profileError } =
            await supabaseClient
                .from("profiles")
                .select("full_name, username, bio")
                .eq("id", currentUser.id)
                .maybeSingle();

        if (profileError) throw profileError;

        const fullName =
            profile?.full_name ||
            currentUser.user_metadata?.full_name ||
            "";

        const username =
            profile?.username ||
            currentUser.user_metadata?.username ||
            "";

        if (fullNameInput) fullNameInput.value = fullName;
        if (usernameInput) usernameInput.value = username;
        if (bioInput) bioInput.value = profile?.bio || "";

        updateProfileAvatar(fullName || username);

        showProfileMessage("Your profile is ready.");

    } catch (error) {
        console.error("Profile loading error:", error);

        showProfileMessage(
            "Could not load your profile. Check your connection and Supabase settings.",
            true
        );
    }
}


// UPDATE AVATAR
function updateProfileAvatar(name) {
    if (!profileAvatar) return;

    profileAvatar.textContent =
        (name || "U").trim().charAt(0).toUpperCase();
}


// SAVE PROFILE
if (profileForm) {
    profileForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        if (!currentUser) {
            showProfileMessage("Please log in before saving your profile.", true);
            return;
        }

        const fullName = fullNameInput?.value.trim() || "";
        const username = usernameInput?.value.trim() || "";
        const bio = bioInput?.value.trim() || "";

        if (!fullName || !username) {
            showProfileMessage(
                "Please enter your full name and username.",
                true
            );
            return;
        }

        const saveButton =
            profileForm.querySelector('button[type="submit"]');

        if (saveButton) {
            saveButton.disabled = true;
            saveButton.textContent = "Saving...";
        }

        try {
            // Save the user's profile information
            const { data: existingProfile, error: lookupError } =
                await supabaseClient
                    .from("profiles")
                    .select("id")
                    .eq("id", currentUser.id)
                    .maybeSingle();

            if (lookupError) throw lookupError;

            const profileData = {
                id: currentUser.id,
                full_name: fullName,
                username: username,
                bio: bio
            };

            const { error: saveError } = existingProfile
                ? await supabaseClient
                    .from("profiles")
                    .update({
                        full_name: fullName,
                        username: username,
                        bio: bio
                    })
                    .eq("id", currentUser.id)
                : await supabaseClient
                    .from("profiles")
                    .insert(profileData);

            if (saveError) throw saveError;

            // Update the name stored in the authentication account
            const { error: metadataError } =
                await supabaseClient.auth.updateUser({
                    data: {
                        full_name: fullName,
                        username: username
                    }
                });

            if (metadataError) {
                console.error("Account metadata update error:", metadataError);
            }

            updateProfileAvatar(fullName || username);

            showProfileMessage(
                metadataError
                    ? "Profile saved, but account details may not be fully updated."
                    : "Profile saved successfully!",
                Boolean(metadataError)
            );

        } catch (error) {
            console.error("Profile saving error:", error);

            if (error.code === "23505") {
                showProfileMessage("That username is already taken.", true);
            } else {
                showProfileMessage(
                    "Could not save your profile. Check your Supabase table and security policies.",
                    true
                );
            }
        } finally {
            if (saveButton) {
                saveButton.disabled = false;
                saveButton.textContent = "Save Changes";
            }
        }
    });
}


// SHOW OR HIDE PASSWORDS
if (showPasswordsCheckbox) {
    showPasswordsCheckbox.addEventListener("change", function () {
        const type = this.checked ? "text" : "password";

        if (currentPasswordInput) currentPasswordInput.type = type;
        if (newPasswordInput) newPasswordInput.type = type;
        if (confirmNewPasswordInput) {
            confirmNewPasswordInput.type = type;
        }
    });
}


// CHANGE PASSWORD
if (passwordForm) {
    passwordForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        if (!currentUser?.email) {
            showPasswordMessage("Please log in first.", true);
            return;
        }

        const currentPassword = currentPasswordInput?.value || "";
        const newPassword = newPasswordInput?.value || "";
        const confirmPassword = confirmNewPasswordInput?.value || "";

        if (!currentPassword || !newPassword || !confirmPassword) {
            showPasswordMessage("Please fill in all password fields.", true);
            return;
        }

        if (newPassword.length < 6) {
            showPasswordMessage(
                "Your new password must be at least 6 characters.",
                true
            );
            return;
        }

        if (newPassword !== confirmPassword) {
            showPasswordMessage("The new passwords do not match.", true);
            return;
        }

        if (newPassword === currentPassword) {
            showPasswordMessage(
                "Your new password must be different from your current password.",
                true
            );
            return;
        }

        if (changePasswordButton) {
            changePasswordButton.disabled = true;
            changePasswordButton.textContent = "Updating...";
        }

        try {
            // Verify the current password
            const { error: verifyError } =
                await supabaseClient.auth.signInWithPassword({
                    email: currentUser.email,
                    password: currentPassword
                });

            if (verifyError) {
                throw new Error("Your current password is incorrect.");
            }

            // Set the new password
            const { error: updateError } =
                await supabaseClient.auth.updateUser({
                    password: newPassword
                });

            if (updateError) throw updateError;

            showPasswordMessage("Password changed successfully.");

            passwordForm.reset();

            if (currentPasswordInput) currentPasswordInput.type = "password";
            if (newPasswordInput) newPasswordInput.type = "password";
            if (confirmNewPasswordInput) {
                confirmNewPasswordInput.type = "password";
            }

        } catch (error) {
            console.error("Password update error:", error);

            showPasswordMessage(
                error.message || "Could not change your password. Please try again.",
                true
            );
        } finally {
            if (changePasswordButton) {
                changePasswordButton.disabled = false;
                changePasswordButton.textContent = "Change Password";
            }
        }
    });
}


// LOG OUT
if (logoutButton) {
    logoutButton.addEventListener("click", async function () {
        if (!supabaseClient) return;

        if (!confirm("Are you sure you want to log out?")) return;

        logoutButton.disabled = true;
        logoutButton.textContent = "Logging out...";

        try {
            const { error } = await supabaseClient.auth.signOut();

            if (error) throw error;

            window.location.replace("/");

        } catch (error) {
            console.error("Logout error:", error);

            alert("Logout failed. Please try again.");

            logoutButton.disabled = false;
            logoutButton.textContent = "Log Out";
        }
    });
}


// INITIALIZE
loadProfile();
