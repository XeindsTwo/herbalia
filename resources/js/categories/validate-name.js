export async function validateNameAddCategory() {
    return await validateName('name', 'nameUniqueError', 'nameMaxError', 'subtitle', 'subtitleMaxError');
}

export async function validateNameEditCategory(categoryId) {
    return await validateName('nameEdit', 'nameUniqueErrorEdit', 'nameMaxErrorEdit', 'subtitleEdit', 'subtitleMaxErrorEdit', categoryId);
}

async function validateName(nameInputId, nameUniqueErrorId, nameMaxErrorId, subtitleInputId, subtitleInputMaxErrorId, categoryId = null) {
    const nameInput = document.getElementById(nameInputId);
    const nameUniqueError = document.getElementById(nameUniqueErrorId);
    const nameMaxError = document.getElementById(nameMaxErrorId);
    const subtitleInput = document.getElementById(subtitleInputId);
    const subtitleMaxError = document.getElementById(subtitleInputMaxErrorId);

    const name = nameInput.value.trim();
    const subtitle = subtitleInput.value.trim();

    if (name.length > 250) {
        nameMaxError.classList.add('error--active');
        return false;
    } else {
        nameMaxError.classList.remove('error--active');
    }

    if (subtitle.length > 250) {
        subtitleMaxError.classList.add('error--active');
        return false;
    } else {
        subtitleMaxError.classList.remove('error--active');
    }

    const isUnique = await checkUniqueName(name, categoryId);
    if (!isUnique) {
        nameUniqueError.classList.add('error--active');
        return false;
    } else {
        nameUniqueError.classList.remove('error--active');
    }

    return true;
}

export async function checkUniqueName(name, categoryId = null) {
    try {
        const response = await fetch('/admin/categories/checkUniqueName', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({name: name, id: categoryId})
        });

        if (response.ok) {
            const data = await response.json();
            return data.unique;
        }
    } catch (error) {
        console.error('Error checking unique name:', error);
    }
    return false;
}