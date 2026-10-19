
document.addEventListener("DOMContentLoaded", function () {
    const $ = (id) => document.getElementById(id);

    const nameInput = $("minimalName");
    const titleInput = $("minimalTitle");
    const photoInput = $("minimalPhoto");
    const aboutInput = $("minimalAbout");
    const skillsInput = $("minimalSkills");
    const projectTitleInput = $("minimalProjectTitle");
    const projectDescriptionInput = $("minimalProjectDescription");
    const emailInput = $("minimalEmail");

    const downloadButton = $("minimalDownload");
    const resetButton = $("minimalReset");
    const saveButton = $("minimalSave");
    const message = $("minimalMessage");
    const portfolioPage = $("portfolioPage");

    if (!portfolioPage) {
        console.error('Portfolio preview not found. Check id="portfolioPage".');

        if (message) {
            message.textContent = "Portfolio preview not found.";
        }

        return;
    }

    if (
        !nameInput ||
        !titleInput ||
        !photoInput ||
        !aboutInput ||
        !skillsInput ||
        !projectTitleInput ||
        !projectDescriptionInput ||
        !emailInput
    ) {
        console.error("One or more Minimal editor inputs were not found.");
        return;
    }

    let photoData = "";
    let portfolioId = new URLSearchParams(window.location.search).get("id");

    const originalValues = {
        name: nameInput.value,
        title: titleInput.value,
        about: aboutInput.value,
        skills: skillsInput.value,
        projectTitle: projectTitleInput.value,
        projectDescription: projectDescriptionInput.value,
        email: emailInput.value
    };

    function showMessage(text) {
        if (message) {
            message.textContent = text;
        }
    }

    // Update the live portfolio preview.
    function updatePreview() {
        const name = nameInput.value.trim() || "Your Name";
        const title = titleInput.value.trim() || "IT Student";
        const about = aboutInput.value.trim();
        const skills = skillsInput.value.trim();

        const projectTitle =
            projectTitleInput.value.trim() || "My First Project";

        const projectDescription =
            projectDescriptionInput.value.trim();

        const email = emailInput.value.trim();

        $("previewName").textContent = name + ".";
        $("previewTitle").textContent = title;

        $("previewAbout").textContent =
            about || "Add a short introduction about yourself.";

        $("previewAboutFull").textContent =
            about || "Add a short introduction about yourself.";

        const skillList = $("previewSkills");

        skillList.replaceChildren();

        if (skills) {
            skills.split(",").forEach(function (skill) {
                const cleanSkill = skill.trim();

                if (cleanSkill) {
                    const item = document.createElement("li");
                    item.textContent = cleanSkill;
                    skillList.appendChild(item);
                }
            });
        }

        $("previewProjectTitle").textContent = projectTitle;

        $("previewProjectDescription").textContent =
            projectDescription || "Add a description of your project.";

        $("previewFooterName").textContent = name.toUpperCase();

        const emailLink = $("previewEmailLink");

        emailLink.textContent = email || "you@example.com";
        emailLink.href = "mailto:" + (email || "you@example.com");

        const previewPhoto = $("previewPhoto");
        const photoPlaceholder = $("photoPlaceholder");

        if (photoData) {
            previewPhoto.src = photoData;
            previewPhoto.hidden = false;

            if (photoPlaceholder) {
                photoPlaceholder.hidden = true;
            }
        } else {
            previewPhoto.removeAttribute("src");
            previewPhoto.hidden = true;

            if (photoPlaceholder) {
                photoPlaceholder.hidden = false;
            }
        }
    }

    // Collect the current portfolio information.
    function getPortfolioContent() {
        return {
            name: nameInput.value.trim(),
            title: titleInput.value.trim(),
            about: aboutInput.value.trim(),
            skills: skillsInput.value.trim(),
            projectTitle: projectTitleInput.value.trim(),
            projectDescription: projectDescriptionInput.value.trim(),
            email: emailInput.value.trim(),
            photo: photoData
        };
    }

    // Restore saved portfolio information to the editor.
    function restorePortfolioContent(content) {
        nameInput.value = content.name ?? originalValues.name;
        titleInput.value = content.title ?? originalValues.title;
        aboutInput.value = content.about ?? originalValues.about;
        skillsInput.value = content.skills ?? originalValues.skills;

        projectTitleInput.value =
            content.projectTitle ?? originalValues.projectTitle;

        projectDescriptionInput.value =
            content.projectDescription ?? originalValues.projectDescription;

        emailInput.value = content.email ?? originalValues.email;

        photoData = content.photo || "";

        updatePreview();
    }

    // Update the live preview whenever text fields change.
    [
        nameInput,
        titleInput,
        aboutInput,
        skillsInput,
        projectTitleInput,
        projectDescriptionInput,
        emailInput
    ].forEach(function (input) {
        input.addEventListener("input", updatePreview);
    });

    // Read and validate the selected profile photo.
    photoInput.addEventListener("change", function () {
        const file = photoInput.files[0];

        if (!file) {
            photoData = "";
            updatePreview();
            return;
        }

        if (!file.type.startsWith("image/")) {
            photoInput.value = "";
            photoData = "";
            updatePreview();

            showMessage("Please select a valid image.");
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            photoInput.value = "";
            photoData = "";
            updatePreview();

            showMessage("Your photo must be 5 MB or smaller.");
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            photoData = event.target.result;

            updatePreview();
            showMessage("Your photo has been updated.");
        };

        reader.onerror = function () {
            photoData = "";
            updatePreview();

            showMessage(
                "Could not read the photo. Please try another image."
            );
        };

        reader.readAsDataURL(file);
    });

    // Reset the editor to empty fields.
    // This does not delete the saved portfolio from Supabase.
    if (resetButton) {
        resetButton.addEventListener("click", function () {
            nameInput.value = originalValues.name;
            titleInput.value = originalValues.title;
            aboutInput.value = originalValues.about;
            skillsInput.value = originalValues.skills;

            projectTitleInput.value = originalValues.projectTitle;

            projectDescriptionInput.value =
                originalValues.projectDescription;

            emailInput.value = originalValues.email;

            photoInput.value = "";
            photoData = "";

            updatePreview();
            showMessage("Your portfolio has been reset.");
        });
    }

    // Load an existing portfolio for editing.
    async function loadSavedPortfolio() {
        if (!portfolioId) {
            return;
        }

        if (!window.portfolioStorage) {
            showMessage(
                "Portfolio storage is not loaded. Refresh the page."
            );
            return;
        }

        if (saveButton) {
            saveButton.disabled = true;
        }

        showMessage("Loading your saved portfolio...");

        try {
            const portfolio =
                await window.portfolioStorage.getPortfolio(portfolioId);

            if (portfolio.template !== "minimal") {
                throw new Error("This is not a Minimal portfolio.");
            }

            restorePortfolioContent(portfolio.content || {});

            showMessage("Saved portfolio loaded successfully.");
        } catch (error) {
            console.error("Could not load Minimal portfolio:", error);

            showMessage(
                error.message || "Could not load this portfolio."
            );
        } finally {
            if (saveButton) {
                saveButton.disabled = false;
            }
        }
    }

    // Save a new portfolio or update the current one.
    if (saveButton) {
        saveButton.addEventListener("click", async function () {
            const originalText = saveButton.textContent;

            saveButton.disabled = true;
            saveButton.textContent = "Saving...";

            try {
                const storage = window.portfolioStorage;

                if (!storage) {
                    throw new Error(
                        "Portfolio storage is not loaded. Check your script tags."
                    );
                }

                const file = photoInput.files[0];

                if (file) {
                    if (!file.type.startsWith("image/")) {
                        throw new Error("Please select a valid image.");
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        throw new Error(
                            "Your photo must be 5 MB or smaller."
                        );
                    }
                }

                const content = getPortfolioContent();

                if (!content.name) {
                    throw new Error(
                        "Please enter your name before saving."
                    );
                }

                const saved = await storage.savePortfolio({
                    id: portfolioId,
                    title: content.name + " - Portfolio",
                    template: "minimal",
                    content: content
                });

                portfolioId = saved.id;

                const url = new URL(window.location.href);

                url.searchParams.set("id", portfolioId);

                window.history.replaceState({}, "", url);

                showMessage("Portfolio saved successfully!");
            } catch (error) {
                console.error("Could not save Minimal portfolio:", error);

                showMessage(
                    error.message || "Could not save your portfolio."
                );
            } finally {
                saveButton.disabled = false;
                saveButton.textContent = originalText;
            }
        });
    } else {
        console.error(
            'Save button not found. Add id="minimalSave" in Blade.'
        );
    }

    // Escape HTML characters used in the downloaded page title.
    function escapeHTML(value) {
        return value.replace(/[&<>"']/g, function (character) {
            return {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;"
            }[character];
        });
    }

    // Create a standalone HTML copy without copying computed styles.
    async function createDownloadHTML() {
        const clone = portfolioPage.cloneNode(true);

        // Keep the current photo in the downloaded portfolio.
        const clonedPhoto = clone.querySelector("#previewPhoto");
        const clonedPlaceholder = clone.querySelector("#photoPlaceholder");

        if (clonedPhoto) {
            if (photoData) {
                clonedPhoto.src = photoData;
                clonedPhoto.hidden = false;

                if (clonedPlaceholder) {
                    clonedPlaceholder.hidden = true;
                }
            } else {
                clonedPhoto.removeAttribute("src");
                clonedPhoto.hidden = true;

                if (clonedPlaceholder) {
                    clonedPlaceholder.hidden = false;
                }
            }
        }

        // Remove the editor's main preview ID from the exported copy.
        clone.removeAttribute("id");

        // Load the actual template stylesheet.
        const response = await fetch("/css/templates/minimal-editor.css");

        if (!response.ok) {
            throw new Error(
                "Could not load the Minimal template CSS. Check the CSS file path."
            );
        }

        const css = await response.text();

        const safeTitle = escapeHTML(
            nameInput.value.trim() || "My Portfolio"
        );

        // Include the stylesheet in the file so it works independently.
        return `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${safeTitle}</title>

    <style>
        ${css}

        /* Downloaded portfolio layout */
        body {
            margin: 0;
            padding: 24px;
            background: #eeeeee;
        }

        .portfolio-page {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        @media screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
        }

        @media print {
            body {
                padding: 0;
                background: #ffffff;
            }

            .portfolio-page {
                max-width: none;
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    ${clone.outerHTML}
</body>
</html>`;
    }

    // Download the portfolio as a standalone HTML file.
    if (downloadButton) {
        downloadButton.addEventListener("click", async function () {
            const originalText = downloadButton.textContent;

            downloadButton.disabled = true;
            downloadButton.textContent = "Preparing download...";

            try {
                // Ensure the latest edits appear in the exported copy.
                updatePreview();

                const html = await createDownloadHTML();

                const blob = new Blob(
                    [html],
                    { type: "text/html;charset=utf-8" }
                );

                const url = URL.createObjectURL(blob);
                const link = document.createElement("a");

                link.href = url;
                link.download = "minimal-portfolio.html";

                document.body.appendChild(link);
                link.click();
                link.remove();

                setTimeout(function () {
                    URL.revokeObjectURL(url);
                }, 10000);

                showMessage("Your portfolio has been downloaded.");
            } catch (error) {
                console.error("Portfolio download failed:", error);

                showMessage(
                    error.message ||
                    "Could not download your portfolio. Please try again."
                );
            } finally {
                downloadButton.disabled = false;
                downloadButton.textContent = originalText;
            }
        });
    } else {
        console.error(
            'Download button not found. Check id="minimalDownload".'
        );
    }

    // Initialize the preview and load saved data if editing.
    updatePreview();
    loadSavedPortfolio();
});
