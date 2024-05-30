document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.filter-form');
    const resultsContainer = document.querySelector('.archive_voitures');

    form.addEventListener('input', function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch(ajax_url, {
            method: 'POST',
            body: new URLSearchParams(formData)
        })
            .then(response => response.text())
            .then(data => {
                resultsContainer.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });
});
