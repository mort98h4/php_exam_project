"use strict";

function formValidation(callback) {
    event.preventDefault();
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form);
    }
}

async function postUser(form) {
    console.log(form);
    const response = await fetch('/user', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href="/";    
}