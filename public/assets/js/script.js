document.addEventListener('DOMContentLoaded', function () {

    function animateCount(element, start, end, duration) {
        let startTimestamp = null;

        function step(timestamp) {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.textContent = Math.floor(progress * (end - start) + start);

            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        }

        window.requestAnimationFrame(step);
    }

    animateCount(document.getElementById('year-value'), 0, 2017, 1500);
    animateCount(document.getElementById('count-value'), 0, 50, 2000);
});

document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const messageBox = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Submitting...';

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageBox.innerHTML = `
                    <div class="form-message success">
                        <i class="fa fa-check-circle"></i>
                        <span>${data.message}</span>
                    </div>
                `;

                setTimeout(() => {
                    const msg = document.querySelector('.form-message');
                    if (msg) {
                        msg.style.animation = 'fadeOut 0.5s ease forwards';
                        setTimeout(() => msg.remove(), 500);
                    }
                }, 4000);

                form.reset();
            } else {
                messageBox.innerHTML = `
                <div class="alert alert-danger">
                    ${data.message}
                </div>
            `;
            }
        })
        .catch(() => {
            messageBox.innerHTML = `
            <div class="alert alert-danger">
                Server error. Please try again.
            </div>
        `;
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit';
        });
});