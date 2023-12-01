export async function validateName() {
    const nameInput = document.getElementById('name');
    const nameUniqueError = document.getElementById('nameUniqueError');
    const nameMaxError = document.getElementById('nameMaxError');

    const name = nameInput.value.trim();
    if (name.length > 250) {
        nameMaxError.classList.add('error--active');
        return false;
    } else {
        nameMaxError.classList.remove('error--active');
    }

    const isUnique = await checkUniqueName(name);
    if (!isUnique) {
        nameUniqueError.classList.add('error--active');
        return false;
    } else {
        nameUniqueError.classList.remove('error--active');
    }

    return true;
}

export async function checkUniqueName(name) {
    try {
        const response = await fetch('/admin/categories/checkUniqueName', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({name: name})
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