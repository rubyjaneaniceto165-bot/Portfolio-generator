
const modernFields = {
    name: document.getElementById('modernName'),
    role: document.getElementById('modernRole'),
    photo: document.getElementById('modernPhoto'),
    intro: document.getElementById('modernIntro'),
    about: document.getElementById('modernAbout'),
    skills: document.getElementById('modernSkills'),
    project: document.getElementById('modernProject'),
    projectDescription: document.getElementById('modernProjectDescription'),
    email: document.getElementById('modernEmail')
};

const modernDefaultValues = {
    name: modernFields.name.value,
    role: modernFields.role.value,
    intro: modernFields.intro.value,
    about: modernFields.about.value,
    skills: modernFields.skills.value,
    project: modernFields.project.value,
    projectDescription: modernFields.projectDescription.value,
    email: modernFields.email.value
};

const modernMessage = document.getElementById('modernMessage');

let modernPhotoUrl = null;

function modernSetText(id, value, fallback) {
    const element = document.getElementById(id);

    if (element) {
        element.textContent = value.trim() || fallback;
    }
}

function modernUpdatePreview() {
    modernSetText('modernPreviewName', modernFields.name.value, 'Your Name');
    modernSetText('modernPreviewRole', modernFields.role.value, 'Your Professional Title');
    modernSetText('modernPreviewIntro', modernFields.intro.value, 'Welcome to my portfolio.');
    modernSetText('modernPreviewAbout', modernFields.about.value, 'Add a short introduction about yourself.');
    modernSetText('modernPreviewProject', modernFields.project.value, 'My Featured Project');
    modernSetText(
        'modernPreviewProjectDescription',
        modernFields.projectDescription.value,
        'Describe your featured project here.'
    );

    const email = modernFields.email.value.trim();
    const emailElement = document.getElementById('modernPreviewEmail');
    const emailLink = document.getElementById('modernContactLink');

    emailElement.textContent = email || 'Add your email address';
    emailLink.textContent = email || 'Add your email address';

    if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        emailLink.href = 'mailto:' + email;
    } else {
        emailLink.removeAttribute('href');
    }

    const skillsContainer = document.getElementById('modernPreviewSkills');
    skillsContainer.replaceChildren();

    const skills = modernFields.skills.value
        .split(',')
        .map(skill => skill.trim())
        .filter(Boolean);

    if (skills.length === 0) {
        const emptySkill = document.createElement('span');
        emptySkill.className = 'skill-chip';
        emptySkill.textContent = 'Add your skills';
        skillsContainer.appendChild(emptySkill);
    } else {
        skills.forEach(skill => {
            const chip = document.createElement('span');
            chip.className = 'skill-chip';
            chip.textContent = skill;
            skillsContainer.appendChild(chip);
        });
    }

    document.getElementById('modernPreviewYear').textContent =
        new Date().getFullYear();
}

Object.values(modernFields).forEach(field => {
    if (field.type !== 'file') {
        field.addEventListener('input', modernUpdatePreview);
    }
});

modernFields.photo.addEventListener('change', () => {
    const file = modernFields.photo.files[0];

    if (!file) return;

    if (!file.type.startsWith('image/')) {
        modernFields.photo.value = '';
        modernMessage.textContent = 'Please choose a valid image file.';
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        modernFields.photo.value = '';
        modernMessage.textContent = 'Your image must be 5 MB or smaller.';
        return;
    }

    if (modernPhotoUrl) {
        URL.revokeObjectURL(modernPhotoUrl);
    }

    modernPhotoUrl = URL.createObjectURL(file);

    const previewPhoto = document.getElementById('modernPreviewPhoto');
    const placeholder = document.getElementById('modernPhotoPlaceholder');

    previewPhoto.src = modernPhotoUrl;
    previewPhoto.hidden = false;
    placeholder.hidden = true;

    modernMessage.textContent = 'Profile photo updated.';
});

document.getElementById('modernReset').addEventListener('click', () => {
    Object.keys(modernDefaultValues).forEach(key => {
        modernFields[key].value = modernDefaultValues[key];
    });

    modernFields.photo.value = '';

    if (modernPhotoUrl) {
        URL.revokeObjectURL(modernPhotoUrl);
        modernPhotoUrl = null;
    }

    const previewPhoto = document.getElementById('modernPreviewPhoto');
    previewPhoto.removeAttribute('src');
    previewPhoto.hidden = true;

    document.getElementById('modernPhotoPlaceholder').hidden = false;

    modernMessage.textContent = 'Form cleared.';
    modernUpdatePreview();
});

function modernReadPhoto(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = () => resolve(reader.result);
        reader.onerror = () => reject(new Error('Could not read the photo.'));

        reader.readAsDataURL(file);
    });
}

function modernEscapeHtml(value) {
    return String(value).replace(/[&<>"']/g, character => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
    })[character]);
}

document.getElementById('modernDownload').addEventListener('click', async () => {
    const button = document.getElementById('modernDownload');

    button.disabled = true;
    button.textContent = 'Preparing...';
    modernMessage.textContent = '';

    let downloadUrl = null;

    try {
        const response = await fetch('/css/templates/modern-editor.css');

        if (!response.ok) {
            throw new Error('Could not load the Modern CSS file.');
        }

        const css = await response.text();
        const portfolio = document.getElementById('modernPortfolioPage').cloneNode(true);

        // Remove any editor-only behavior from the exported portfolio.
        portfolio.querySelectorAll('[contenteditable]').forEach(element => {
            element.removeAttribute('contenteditable');
        });

        // Keep the navigation working inside the downloaded file.
        portfolio.querySelectorAll('.portfolio-links a').forEach(link => {
            const label = link.textContent.trim().toLowerCase();

            if (label === 'about') link.href = '#modernAboutSection';
            if (label === 'work') link.href = '#modernWorkSection';
            if (label === 'contact') link.href = '#modernContactSection';
        });

        // Embed the uploaded photo so it still appears offline.
        const photoFile = modernFields.photo.files[0];
        const downloadedPhoto = portfolio.querySelector('#modernPreviewPhoto');
        const placeholder = portfolio.querySelector('#modernPhotoPlaceholder');

        if (photoFile) {
            const photoData = await modernReadPhoto(photoFile);

            downloadedPhoto.src = photoData;
            downloadedPhoto.hidden = false;
            downloadedPhoto.removeAttribute('hidden');
            downloadedPhoto.style.display = 'block';

            if (placeholder) {
                placeholder.hidden = true;
                placeholder.style.display = 'none';
            }
        } else {
            downloadedPhoto.removeAttribute('src');
            downloadedPhoto.hidden = true;
            downloadedPhoto.style.display = 'none';

            if (placeholder) {
                placeholder.hidden = false;
                placeholder.style.display = 'grid';
            }
        }

        const portfolioName =
            modernFields.name.value.trim() || 'My Portfolio';

        const safeTitle = modernEscapeHtml(portfolioName) + ' | Portfolio';

        const exportStyles = `
            ${css}

            body {
                margin: 0;
                padding: 24px;
                background: #f3f5f9;
            }

            .portfolio-page {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
            }

            .profile-photo {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .profile-photo[hidden],
            .photo-placeholder[hidden],
            [hidden] {
                display: none !important;
            }

            .portfolio-links a {
                cursor: pointer;
            }

            @media (max-width: 600px) {
                body {
                    padding: 8px;
                }
            }
        `;

        const html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${safeTitle}</title>
    <style>${exportStyles}</style>
</head>
<body>
    ${portfolio.outerHTML}
</body>
</html>`;

        const blob = new Blob([html], {
            type: 'text/html;charset=utf-8'
        });

        downloadUrl = URL.createObjectURL(blob);

        const link = document.createElement('a');
        const filename = portfolioName
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-|-$/g, '') || 'my-portfolio';

        link.href = downloadUrl;
        link.download = filename + '-portfolio.html';

        document.body.appendChild(link);
        link.click();
        link.remove();

        modernMessage.textContent =
            'Your portfolio is ready to download!';

    } catch (error) {
        console.error(error);

        modernMessage.textContent =
            'Download failed. Check that the CSS file exists and try again.';
    } finally {
        if (downloadUrl) {
            setTimeout(() => URL.revokeObjectURL(downloadUrl), 60000);
        }

        button.disabled = false;
        button.textContent = 'Download HTML ↓';
    }
});

modernUpdatePreview();


/* ==============================
   SUPABASE SAVE AND EDIT
============================== */

(async function connectModernStorage() {
    const saveButton = document.getElementById("modernSave");
    const message = document.getElementById("modernMessage");
    const storage = window.portfolioStorage;

    if (!saveButton || !storage) {
        console.error("Modern save button or portfolio storage is missing.");
        return;
    }

    const params = new URLSearchParams(window.location.search);
    let portfolioId = params.get("id");
    let savedPhotoData = "";

    function showMessage(text) {
        message.textContent = text;
    }

    function getModernContent() {
        return {
            name: modernFields.name.value.trim(),
            role: modernFields.role.value.trim(),
            intro: modernFields.intro.value.trim(),
            about: modernFields.about.value.trim(),
            skills: modernFields.skills.value.trim(),
            project: modernFields.project.value.trim(),
            projectDescription: modernFields.projectDescription.value.trim(),
            email: modernFields.email.value.trim(),
            photo: savedPhotoData
        };
    }

    function restoreModernContent(content) {
        modernFields.name.value = content.name || "";
        modernFields.role.value = content.role || "";
        modernFields.intro.value = content.intro || "";
        modernFields.about.value = content.about || "";
        modernFields.skills.value = content.skills || "";
        modernFields.project.value = content.project || "";
        modernFields.projectDescription.value =
            content.projectDescription || "";
        modernFields.email.value = content.email || "";

        savedPhotoData = content.photo || "";

        const previewPhoto = document.getElementById("modernPreviewPhoto");
        const placeholder = document.getElementById("modernPhotoPlaceholder");

        if (savedPhotoData) {
            previewPhoto.src = savedPhotoData;
            previewPhoto.hidden = false;
            placeholder.hidden = true;
        } else {
            previewPhoto.removeAttribute("src");
            previewPhoto.hidden = true;
            placeholder.hidden = false;
        }

        modernUpdatePreview();
    }

    // Restore a previously saved portfolio when opened with ?id=...
    if (portfolioId) {
        try {
            showMessage("Loading your saved portfolio...");

            const portfolio = await storage.getPortfolio(portfolioId);

            if (portfolio.template !== "modern") {
                throw new Error("This is not a Modern portfolio.");
            }

            restoreModernContent(portfolio.content || {});
            showMessage("Saved portfolio loaded.");
        } catch (error) {
            console.error("Could not load Modern portfolio:", error);
            showMessage("Could not load this portfolio. Please check access.");
        }
    }

    // Keep the stored photo data updated when a new image is selected.
    modernFields.photo.addEventListener("change", async function () {
        const file = modernFields.photo.files[0];

        if (!file) return;

        try {
            savedPhotoData = await modernReadPhoto(file);
        } catch (error) {
            console.error(error);
            showMessage("Could not read your photo.");
        }
    });

    // Save a new portfolio or update the current one.
    saveButton.addEventListener("click", async function () {
        const originalText = saveButton.textContent;

        saveButton.disabled = true;
        saveButton.textContent = "Saving...";
        showMessage("");

        try {
            const file = modernFields.photo.files[0];

            if (file) {
                if (!file.type.startsWith("image/")) {
                    throw new Error("Please choose a valid image file.");
                }

                if (file.size > 5 * 1024 * 1024) {
                    throw new Error("Your image must be 5 MB or smaller.");
                }

                savedPhotoData = await modernReadPhoto(file);
            }

            const content = getModernContent();

            if (!content.name) {
                throw new Error("Please enter your full name.");
            }

            const saved = await storage.savePortfolio({
                id: portfolioId,
                title: content.name + " - Portfolio",
                template: "modern",
                content
            });

            portfolioId = saved.id;

            const url = new URL(window.location.href);
            url.searchParams.set("id", portfolioId);
            window.history.replaceState({}, "", url);

            showMessage("Portfolio saved successfully!");
        } catch (error) {
            console.error("Modern portfolio save failed:", error);
            showMessage(error.message || "Could not save your portfolio.");
        } finally {
            saveButton.disabled = false;
            saveButton.textContent = originalText;
        }
    });
})();
