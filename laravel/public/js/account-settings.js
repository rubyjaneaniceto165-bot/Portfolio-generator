
/* ==============================
   PORTECH ACCOUNT SETTINGS
============================== */

const supabaseClient = window.supabaseClient;

// HTML ELEMENTS
const emailForm = document.getElementById("changeEmailForm");
const currentEmailInput = document.getElementById("currentEmail");
const newEmailInput = document.getElementById("newEmail");
const emailMessage = document.getElementById("emailMessage");
const changeEmailButton = document.getElementById("changeEmailButton");

const passwordForm = document.getElementById("passwordForm");
const currentPasswordInput = document.getElementById("currentPassword");
const newPasswordInput = document.getElementById("newPassword");
const confirmNewPasswordInput = document.getElementById("confirmNewPassword");
const showPasswordsCheckbox = document.getElementById("showPasswords");
const passwordMessage = document.getElementById("passwordMessage");
const changePasswordButton = document.getElementById("changePasswordButton");

const deleteAccountButton = document.getElementById("deleteAccountButton");
const deleteAccountMessage = document.getElementById("deleteAccountMessage");

const logoutButtons = [
    document.getElementById("logoutButton"),
    document.getElementById("accountSidebarLogout")
].filter(Boolean);


// DISPLAY MESSAGES
function showMessage(element, message, success = false) {
    if (!element) return;

    element.textContent = message;
    element.style.color = success ? "#246b43" : "#b42318";
}


// GET CURRENT USER
async function getCurrentUser() {
    if (!supabaseClient) {
        showMessage(
            emailMessage,
            "Supabase configuration could not be loaded."
        );
        return null;
    }

    try {
        const { data, error } = await supabaseClient.auth.getUser();

        if (error || !data.user) {
            window.location.replace("/");
            return null;
        }

        if (currentEmailInput) {
            currentEmailInput.value = data.user.email || "";
        }

        return data.user;
    } catch (error) {
        console.error("Account loading error:", error);

        showMessage(
            emailMessage,
            "Could not load your account. Please try again."
        );

        return null;
    }
}


// LOAD ACCOUNT
async function loadAccount() {
    await getCurrentUser();
}


// CHANGE EMAIL
if (emailForm) {
    emailForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const user = await getCurrentUser();
        if (!user) return;

        const newEmail = newEmailInput?.value.trim() || "";

        if (!newEmail) {
            showMessage(emailMessage, "Please enter your new email address.");
            return;
        }

        if (newEmail.toLowerCase() === user.email?.toLowerCase()) {
            showMessage(
                emailMessage,
                "Please enter a different email address."
            );
            return;
        }

        changeEmailButton.disabled = true;
        changeEmailButton.textContent = "Updating...";

        try {
            const { error } = await supabaseClient.auth.updateUser({
                email: newEmail
            });

            if (error) throw error;

            showMessage(
                emailMessage,
                "Email update requested. Check your email for confirmation instructions.",
                true
            );

            newEmailInput.value = "";
        } catch (error) {
            console.error("Email update error:", error);

            showMessage(
                emailMessage,
                error.message || "Could not update your email."
            );
        } finally {
            changeEmailButton.disabled = false;
            changeEmailButton.textContent = "Update Email";
        }
    });
}


// SHOW OR HIDE PASSWORDS
if (showPasswordsCheckbox) {
    showPasswordsCheckbox.addEventListener("change", function () {
        const type = this.checked ? "text" : "password";

        [
            currentPasswordInput,
            newPasswordInput,
            confirmNewPasswordInput
        ].forEach(input => {
            if (input) input.type = type;
        });
    });
}


// CHANGE PASSWORD
if (passwordForm) {
    passwordForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const user = await getCurrentUser();
        if (!user) return;

        const currentPassword = currentPasswordInput?.value || "";
        const newPassword = newPasswordInput?.value || "";
        const confirmPassword = confirmNewPasswordInput?.value || "";

        if (!currentPassword || !newPassword || !confirmPassword) {
            showMessage(passwordMessage, "Please fill in all password fields.");
            return;
        }

        if (newPassword.length < 6) {
            showMessage(
                passwordMessage,
                "Your new password must have at least 6 characters."
            );
            return;
        }

        if (newPassword !== confirmPassword) {
            showMessage(passwordMessage, "The new passwords do not match.");
            return;
        }

        if (newPassword === currentPassword) {
            showMessage(
                passwordMessage,
                "Choose a password different from your current one."
            );
            return;
        }

        changePasswordButton.disabled = true;
        changePasswordButton.textContent = "Changing...";

        try {
            const { error: verifyError } =
                await supabaseClient.auth.signInWithPassword({
                    email: user.email,
                    password: currentPassword
                });

            if (verifyError) {
                showMessage(
                    passwordMessage,
                    "Your current password is incorrect."
                );
                return;
            }

            const { error: updateError } =
                await supabaseClient.auth.updateUser({
                    password: newPassword
                });

            if (updateError) throw updateError;

            showMessage(
                passwordMessage,
                "Password changed successfully.",
                true
            );

            passwordForm.reset();

            [
                currentPasswordInput,
                newPasswordInput,
                confirmNewPasswordInput
            ].forEach(input => {
                if (input) input.type = "password";
            });
        } catch (error) {
            console.error("Password update error:", error);

            showMessage(
                passwordMessage,
                error.message || "Could not change your password."
            );
        } finally {
            changePasswordButton.disabled = false;
            changePasswordButton.textContent = "Change Password";
        }
    });
}


// DELETE ACCOUNT
if (deleteAccountButton) {
    deleteAccountButton.addEventListener("click", async function () {
        if (!supabaseClient) {
            showMessage(
                deleteAccountMessage,
                "Supabase configuration could not be loaded."
            );
            return;
        }

        const confirmed = confirm(
            "Are you sure you want to permanently delete your Portech account and saved portfolios? This cannot be undone."
        );

        if (!confirmed) return;

        const confirmationText = prompt(
            "Type DELETE to permanently remove your account."
        );

        if (confirmationText !== "DELETE") {
            showMessage(deleteAccountMessage, "Account deletion cancelled.");
            return;
        }

        deleteAccountButton.disabled = true;
        deleteAccountButton.textContent = "Deleting account...";

        showMessage(
            deleteAccountMessage,
            "Please wait while we process your request."
        );

        try {
            // Get the current Supabase session.
            const { data, error } = await supabaseClient.auth.getSession();

            if (error) throw error;

            const session = data.session;

            if (!session?.access_token) {
                throw new Error(
                    "Your session has expired. Please log in again."
                );
            }

            // Get Laravel's CSRF token.
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            if (!csrfToken) {
                throw new Error(
                    "Laravel CSRF token is missing. Please refresh the page."
                );
            }

            // Send the deletion request to Laravel.
            const response = await fetch("/account/delete", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${session.access_token}`,
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken
                }
            });

            const result = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw new Error(
                    result.message || "Could not delete your account."
                );
            }

            showMessage(
                deleteAccountMessage,
                "Your account was deleted. Redirecting...",
                true
            );

            // Clear the local Supabase session.
            await supabaseClient.auth.signOut({ scope: "local" });

            window.location.replace("/");
        } catch (error) {
            console.error("Account deletion error:", error);

            showMessage(
                deleteAccountMessage,
                error.message ||
                    "Could not delete your account. Please try again."
            );

            deleteAccountButton.disabled = false;
            deleteAccountButton.textContent = "Delete My Account";
        }
    });
}


// LOG OUT
async function logout() {
    if (!supabaseClient) {
        alert("Supabase configuration could not be loaded.");
        return;
    }

    if (!confirm("Are you sure you want to log out?")) return;

    logoutButtons.forEach(button => {
        button.disabled = true;
        button.textContent = "Logging out...";
    });

    try {
        const { error } = await supabaseClient.auth.signOut();

        if (error) throw error;

        window.location.replace("/");
    } catch (error) {
        console.error("Logout error:", error);

        alert("Unable to log out. Please try again.");

        logoutButtons.forEach(button => {
            button.disabled = false;
            button.textContent =
                button.id === "accountSidebarLogout"
                    ? "↗ Log Out"
                    : "Log Out";
        });
    }
}


logoutButtons.forEach(button => {
    button.addEventListener("click", logout);
});


// INITIALIZE
if (supabaseClient) {
    loadAccount();
} else {
    showMessage(
        emailMessage,
        "Supabase configuration could not be loaded."
    );
}
