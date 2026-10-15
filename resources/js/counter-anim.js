document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.stat-number-anim');
    const speed = 200; // Semakin kecil angka, semakin cepat animasinya

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target;
            }
        };

        // Menambahkan class show untuk efek fade-in dari CSS
        counter.classList.add('show');
        updateCount();
    });
});