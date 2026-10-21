
(() => {
    const $ = (id) => document.getElementById(id);

    const fields = {
        name: $('creativeName'),
        title: $('creativeTitle'),
        photo: $('creativePhoto'),
        about: $('creativeAbout'),
        skills: $('creativeSkills'),
        projectTitle: $('creativeProjectTitle'),
        projectDescription: $('creativeProjectDescription'),
        email: $('creativeEmail')
    };

    const defaults = {};

    Object.entries(fields).forEach(([key, field]) => {
        if (key !== 'photo') {
            defaults[key] = field.value;
        }
    });

    let currentPhotoUrl = null;
    let savedPhotoData = '';
    let portfolioId = new URLSearchParams(window.location.search).get('id');

    const saveButton = $('creativeSave');
    const message = $('creativeMessage');

    // Require a name containing letters and spaces only.
    fields.name.required = true;
    fields.name.setAttribute('autocomplete', 'name');

    function showMessage(text) {
        message.textContent = text;
    }

    function isValidName(name) {
        return /^[\p{L}]+(?:\s+[\p{L}]+)*$/u.test(name.trim());
    }

    // Highlight the name field when it is empty or invalid.
    function validateName(showError = true) {
        const name = fields.name.value.trim();
        const valid = isValidName(name);

        fields.name.setAttribute('aria-invalid', String(!valid));

        if (!valid) {
            fields.name.style.borderColor = '#dc2626';
            fields.name.style.backgroundColor = '#fff1f2';

            if (showError) {
                showMessage(
                    name
                        ? 'Please use letters and spaces only for your name.'
                        : 'Please fill in your name before saving.'
                );
            }
        } else {
            fields.name.style.borderColor = '';
            fields.name.style.backgroundColor = '';
        }

        return valid;
    }

    function updatePreview() {
        const name = fields.name.value.trim() || 'Your Name';
        const title = fields.title.value.trim() || 'Your Professional Title';
        const about = fields.about.value.trim() ||
            'Write a little introduction about yourself.';
        const projectTitle = fields.projectTitle.value.trim() ||
            'Featured Project';
        const projectDescription = fields.projectDescription.value.trim() ||
            'Add a short description of your project.';
        const email = fields.email.value.trim() || 'you@example.com';

        $('creativePreviewName').textContent = name;
        $('creativePreviewTitle').textContent = title;

        const heroName = $('creativeHeroName');
        if (heroName) {
            heroName.textContent = name;
        }

        const heroRole = $('creativeHeroRole');
        if (heroRole) {
            heroRole.textContent = title;
        }

        $('creativeHeroAbout').textContent = about;
        $('creativePreviewAbout').textContent = about;
        $('creativePreviewProjectTitle').textContent = projectTitle;
        $('creativePreviewProjectDescription').textContent = projectDescription;

        $('creativePreviewFooter').textContent =
            'MADE BY ' + name.toUpperCase() + ' ♡';

        const emailLink = $('creativePreviewEmail');
        emailLink.textContent = email + ' ↗';
        emailLink.href = 'mailto:' + email;

        const skillsBox = $('creativePreviewSkills');
        skillsBox.replaceChildren();

        const skills = fields.skills.value
            .split(',')
            .map(skill => skill.trim())
            .filter(Boolean)
            .slice(0, 20);

        (skills.length ? skills : ['Add your skills']).forEach(skill => {
            const chip = document.createElement('span');
            chip.className = 'skill-chip';
            chip.textContent = skill;
            skillsBox.appendChild(chip);
        });

        $('creativeAboutCount').textContent = fields.about.value.length;
        $('creativeProjectCount').textContent =
            fields.projectDescription.value.length;
    }

    function readPhotoAsDataURL(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            reader.onload = () => resolve(reader.result);
            reader.onerror = () => reject(
                new Error('Could not read your photo.')
            );

            reader.readAsDataURL(file);
        });
    }

    function displaySavedPhoto(photoData) {
        const previewPhoto = $('creativePreviewPhoto');
        const placeholder = $('creativePhotoPlaceholder');

        if (currentPhotoUrl) {
            URL.revokeObjectURL(currentPhotoUrl);
            currentPhotoUrl = null;
        }

        if (photoData) {
            previewPhoto.src = photoData;
            previewPhoto.hidden = false;
            placeholder.hidden = true;
        } else {
            previewPhoto.removeAttribute('src');
            previewPhoto.hidden = true;
            placeholder.hidden = false;
        }
    }

    function getPortfolioContent() {
        return {
            name: fields.name.value.trim(),
            title: fields.title.value.trim(),
            about: fields.about.value.trim(),
            skills: fields.skills.value.trim(),
            projectTitle: fields.projectTitle.value.trim(),
            projectDescription: fields.projectDescription.value.trim(),
            email: fields.email.value.trim(),
            photo: savedPhotoData
        };
    }

    function restorePortfolioContent(content) {
        fields.name.value = content.name ?? defaults.name;
        fields.title.value = content.title ?? defaults.title;
        fields.about.value = content.about ?? defaults.about;
        fields.skills.value = content.skills ?? defaults.skills;
        fields.projectTitle.value =
            content.projectTitle ?? defaults.projectTitle;
        fields.projectDescription.value =
            content.projectDescription ?? defaults.projectDescription;
        fields.email.value = content.email ?? defaults.email;

        savedPhotoData = content.photo || '';

        displaySavedPhoto(savedPhotoData);
        validateName(false);
        updatePreview();
    }

    // Keep numbers and special characters out of the name field.
    fields.name.addEventListener('input', () => {
        fields.name.value = fields.name.value.replace(/[^\p{L}\s]/gu, '');

        validateName(false);
        updatePreview();
    });

    // Preview the uploaded photo.
    fields.photo.addEventListener('change', async () => {
        const file = fields.photo.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showMessage('Please select an image file.');
            fields.photo.value = '';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            showMessage('Please choose an image under 5 MB.');
            fields.photo.value = '';
            return;
        }

        try {
            savedPhotoData = await readPhotoAsDataURL(file);

            if (currentPhotoUrl) {
                URL.revokeObjectURL(currentPhotoUrl);
            }

            currentPhotoUrl = URL.createObjectURL(file);

            const previewPhoto = $('creativePreviewPhoto');
            previewPhoto.src = currentPhotoUrl;
            previewPhoto.hidden = false;
            $('creativePhotoPlaceholder').hidden = true;

            showMessage('Your photo looks lovely in the preview! ✿');
        } catch (error) {
            console.error(error);
            showMessage('Could not read your photo.');
        }
    });

    // Update the preview when other fields change.
    Object.entries(fields).forEach(([key, field]) => {
        if (key !== 'photo' && key !== 'name') {
            field.addEventListener('input', updatePreview);
        }
    });

    // Reset the editor.
    $('creativeReset').addEventListener('click', () => {
        Object.entries(fields).forEach(([key, field]) => {
            field.value = key === 'photo' ? '' : defaults[key];
        });

        savedPhotoData = '';
        displaySavedPhoto('');

        validateName(false);
        updatePreview();

        showMessage('All fields have been cleared. ✿');
    });

    // Load an existing portfolio.
    async function loadSavedPortfolio() {
        if (!portfolioId) {
            validateName(false);
            return;
        }

        if (!window.portfolioStorage) {
            showMessage('Portfolio storage is not loaded. Refresh the page.');
            return;
        }

        if (saveButton) saveButton.disabled = true;
        showMessage('Loading your saved portfolio...');

        try {
            const portfolio =
                await window.portfolioStorage.getPortfolio(portfolioId);

            if (portfolio.template !== 'creative') {
                throw new Error('This is not a Creative portfolio.');
            }

            restorePortfolioContent(portfolio.content || {});
            showMessage('Saved portfolio loaded! ✿');
        } catch (error) {
            console.error('Could not load portfolio:', error);
            showMessage(error.message || 'Could not load this portfolio.');
        } finally {
            if (saveButton) saveButton.disabled = false;
        }
    }

    // Save the portfolio, then redirect to the dashboard.
    if (saveButton) {
        saveButton.addEventListener('click', async () => {
            // Validate before attempting to save.
            if (!validateName(true)) {
                fields.name.focus();
                return;
            }

            const originalText = saveButton.textContent;

            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            try {
                const storage = window.portfolioStorage;

                if (!storage) {
                    throw new Error(
                        'Portfolio storage is not loaded. Check your script tags.'
                    );
                }

                const file = fields.photo.files[0];

                if (file) {
                    if (!file.type.startsWith('image/')) {
                        throw new Error('Please select a valid image.');
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        throw new Error('Your photo must be 5 MB or smaller.');
                    }

                    savedPhotoData = await readPhotoAsDataURL(file);
                }

                const content = getPortfolioContent();

                // Validate again immediately before saving.
                if (!isValidName(content.name)) {
                    validateName(true);
                    fields.name.focus();
                    return;
                }

                const saved = await storage.savePortfolio({
                    id: portfolioId,
                    title: content.name + ' - Portfolio',
                    template: 'creative',
                    content
                });

                if (!saved || !saved.id) {
                    throw new Error('The portfolio could not be saved.');
                }

                portfolioId = saved.id;

                // Go to the dashboard only after a successful save.
                showMessage('Portfolio saved successfully! Redirecting...');

                window.location.href = '/dashboard';

            } catch (error) {
                console.error('Could not save portfolio:', error);

                showMessage(
                    error.message || 'Could not save your portfolio.'
                );

                saveButton.disabled = false;
                saveButton.textContent = originalText;
            }
        });
    } else {
        console.error('The creativeSave button was not found in the page.');
    }

    // Download the portfolio as a standalone HTML file.
    $('creativeDownload').addEventListener('click', async () => {
        const button = $('creativeDownload');

        button.disabled = true;
        button.textContent = 'Preparing...';

        try {
            const response = await fetch(
                '/css/templates/creative-editor.css'
            );

            if (!response.ok) {
                throw new Error('Could not load the portfolio CSS.');
            }

            const css = await response.text();
            const portfolio = $('creativePortfolioPage').cloneNode(true);

            portfolio.querySelectorAll('.portfolio-links a').forEach(link => {
                const label = link.textContent.trim().toLowerCase();

                if (label === 'home') {
                    link.href = '#creativeHome';
                } else if (label === 'about') {
                    link.href = '#creativeAboutSection';
                } else if (label === 'work' || label === 'projects') {
                    link.href = '#creativeProjects';
                } else if (label === 'contact') {
                    link.href = '#creativeContact';
                }
            });

            const downloadedPhoto = portfolio.querySelector(
                '#creativePreviewPhoto'
            );

            const placeholder = portfolio.querySelector(
                '#creativePhotoPlaceholder'
            );

            if (savedPhotoData) {
                downloadedPhoto.src = savedPhotoData;
                downloadedPhoto.hidden = false;
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
                    placeholder.style.display = '';
                }
            }

            portfolio.querySelectorAll('[contenteditable]').forEach(element => {
                element.removeAttribute('contenteditable');
            });

            const name = fields.name.value.trim() || 'My Portfolio';
            const safeTitle = name.replace(/[<>]/g, '');

            const html = `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>${safeTitle} - Portfolio</title>
<style>
${css}

body {
    padding: 20px;
    background: #f7f7ef;
}

.portfolio-page {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
}

[hidden] {
    display: none !important;
}

.portrait-frame {
    overflow: hidden;
}

.portrait-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

@media (max-width: 900px) {
    body {
        padding: 10px;
    }
}

@media print {
    body {
        padding: 0;
        background: white;
    }

    .portfolio-page {
        max-width: 100%;
        border: none;
        box-shadow: none;
    }
}
</style>
</head>
<body>
${portfolio.outerHTML}
</body>
</html>`;

            const blob = new Blob([html], {
                type: 'text/html;charset=utf-8'
            });

            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');

            const fileName = name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '') || 'my-portfolio';

            link.href = url;
            link.download = fileName + '-portfolio.html';

            document.body.appendChild(link);
            link.click();
            link.remove();

            setTimeout(() => URL.revokeObjectURL(url), 10000);

            showMessage('Your designed portfolio and photo are ready! ✿');
        } catch (error) {
            console.error(error);

            showMessage(
                'Download failed. Check your CSS file and try again.'
            );
        } finally {
            button.disabled = false;
            button.textContent = 'Download portfolio ↓';
        }
    });

    // Start the preview and load saved content.
    updatePreview();
    validateName(false);
    loadSavedPortfolio();
})();
