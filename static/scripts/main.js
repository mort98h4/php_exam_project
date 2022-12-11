"use strict";

function formValidation(callback, url) {
    event.preventDefault();
    if (!url) {
        url = '/';
    }
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form, url);
    }
}

function toggleModal() {
    const modalId = event.target.dataset.target;
    document.querySelector(modalId).classList.toggle('show');
}

function toggleUpdateModal() {
    const modalId = event.target.dataset.target;
    const table = event.target.dataset.table;
    const id = event.target.dataset.id;

    const modal = document.querySelector(modalId);

    if (modal.classList.contains('show')) {
        modal.classList.remove('show');
        return;
    } 
    modal.classList.add('show');
    if (table === 'users') {
        getUser(id, modalId);
    } else if (table === 'breweries') {
        getBrewery(id, modalId);
    }
}

function toggleDeleteModal() {
    const modalId = event.target.dataset.target;
    const id = event.target.dataset.id;

    const modal = document.querySelector(modalId);
    if (modal.classList.contains('show')) {
        modal.classList.remove('show');
        return;
    } else {
        const form = modal.querySelector('form');
        form.id.value = id;
        modal.classList.add('show');
    }
}

function toggleBurger() {
    document.querySelector(".burger").classList.toggle('show');
    document.querySelector(".menu").classList.toggle('show');
}

function toggleLabel() {
    const select = event.target;
    if (select.value !== '') {
        select.classList.remove('invalid');
        select.classList.add('valid');
    } else {
        select.classList.remove('valid');
        select.classList.add('invalid');
    };
}

function addPreviewImage() {
    const input = event.target;
    console.log(input.id);
    const preview = document.querySelector(`.preview[data-input-id='#${input.id}']`);
    console.log(preview);
    const image = input.files[0];
    preview.querySelector('img').src = URL.createObjectURL(image);
    preview.classList.remove('hidden');
}

function removePreviewImage() {
    const inputId = event.target.dataset.inputId;
    document.querySelector(inputId).value = "";
    const preview = document.querySelector(`.preview[data-input-id='${inputId}']`);
    preview.querySelector('img').src = "";
    preview.classList.add('hidden');

    // Might need to create some logic regarding updating images...
    // const inputHidden = document.querySelector(`[type='hidden'][data-input-id='${inputId}']`)
    // if (inputHidden) {
    //     inputHidden.value = "";
    // }
}

async function getUser(id, modalId) {
    const response = await fetch(`/user/${id}`, {
        method: 'GET',
    });
    if (!response.status === 200) {
        const error = await response.json();
        console.log('Error: ', error);
        return;
    }

    const user = await response.json();
    const form = document.querySelector(`${modalId} form`);
    form.user_id.value = user.user_id;
    form.first_name.value = user.user_first_name;
    form.last_name.value = user.user_last_name;
    form.email.value = user.user_email;
    form.user_role_id.value = user.role_id;
}

async function postUser(form, url) {
    const response = await fetch('/user', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;    
}

async function updateUser(form, url) {
    const response = await fetch(`/user/${form.user_id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'No user data to update.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    const user = await response.json();
    const userElem = document.querySelector(`#user_${user.user_id}`);
    userElem.querySelector('h3').textContent = `${user.user_first_name} ${user.user_last_name}`;
    userElem.querySelector('.email').textContent = user.user_email;
    userElem.querySelector('.role').textContent = user.role_name;

    form.querySelector('.error-container').classList.add('hidden');
    form.querySelector('.error-container span').textContent = '';
    document.querySelector('#update_user_modal').classList.toggle('show');
}

async function deleteUser(form, url) {
    const userId = form.id.value;
    const response = await fetch(`/user/${userId}`, {
        method: 'DELETE'
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'User does not exist.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    document.querySelector(`#user_${userId}`).remove();
    form.querySelector('.error-container').classList.add('hidden');
    form.querySelector('.error-container span').textContent = '';
    form.confirm.value = '';
    document.querySelector('#delete_user_modal').classList.toggle('show');
}

async function getBrewery(id, modalId) {
    const response = await fetch(`/brewery/${id}`, {
        method: 'GET',
    });
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error.info);
        return;
    }

    const brewery = await response.json();
    const form = document.querySelector(`${modalId} form`);
    form.brewery_id.value = brewery.brewery_id;
    form.name.value = brewery.brewery_name;
}

async function postBrewery(form, url) {
    const response = await fetch('/brewery', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href = url;
}

async function updateBrewery(form, url) {
    const response = await fetch(`/brewery/${form.brewery_id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'No brewery data to update.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    const brewery = await response.json();
    const breweryElem = document.querySelector(`#brewery_${brewery.brewery_id}`);
    breweryElem.querySelector('h3').textContent = brewery.brewery_name;

    form.querySelector('.error-container').classList.add('hidden');
    form.querySelector('.error-container span').textContent = '';
    document.querySelector('#update_brewery_modal').classList.toggle('show');
}

async function deleteBrewery(form, url) {
    const breweryId = form.id.value;
    const response = await fetch(`/brewery/${breweryId}`, {
        method: 'DELETE'
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'User does not exist.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    document.querySelector(`#brewery_${breweryId}`).remove();
    form.querySelector('.error-container').classList.add('hidden');
    form.querySelector('.error-container span').textContent = '';
    form.confirm.value = '';
    document.querySelector('#delete_brewery_modal').classList.toggle('show');
}

async function postSession(form, url) {
    const response = await fetch('/login', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;
}

async function postBeer(form, url) {
    const isActive = form.is_active;
    if (isActive.value === "0") {
        form.tapwall_no.value = "0";
    }

    const response = await fetch('/beer', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        console.log(error);
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;
}

async function deleteSession() {
    const userId = event.target.dataset.id;
    console.log(userId);
    const response = await fetch(`/logout/${userId}`, {
        method: 'DELETE',
    });
    if (response.status !== 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href='/';
}