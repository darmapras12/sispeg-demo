document.addEventListener("DOMContentLoaded", () => {
    const elemenAngka = document.querySelectorAll('.angka-bergulir');
    
    elemenAngka.forEach(el => {
        const target = parseInt(el.getAttribute('data-target'));
        const durasi = 1000; // 1 detik animasi
        let waktuMulai = null;

        const animasi = (waktuSekarang) => {
            if (!waktuMulai) waktuMulai = waktuSekarang;
            const progress = waktuSekarang - waktuMulai;
            const persentase = Math.min(progress / durasi, 1);
            
            // Menghitung angka berjalan
            const angkaSekarang = Math.floor(persentase * target);
            el.innerText = angkaSekarang;

            if (persentase < 1) {
                window.requestAnimationFrame(animasi);
            } else {
                el.innerText = target; // Pastikan berakhir di angka tepat
            }
        };

        // Tambahkan class CSS untuk efek fade-in
        el.classList.add('muncul');
        window.requestAnimationFrame(animasi);
    });
});