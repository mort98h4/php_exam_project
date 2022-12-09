"use strict";

function formValidation(callback, url) {
    if (!url) {
        url = '/';
    }
    event.preventDefault();
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form, url);
    }
}

function toggleModal() {
    const modalId = event.target.dataset.target;
    document.querySelector(modalId).classList.toggle('show');
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
    if (response.status !== 204) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href='/';
}