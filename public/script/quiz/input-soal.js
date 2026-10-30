$(document).ready(function () {
    initializeSummernote("#pertanyaan", "Pertanyaan...", 100);
    initializeSummernote("#kunci_jawaban", "Ketik Sesuatu...", 100);
});

let counter = 1;
let maxCounter = 6;

function tambahOpsi() {
    let container = document.getElementById("tambah_opsi");
    let inputElements = document.querySelectorAll('div[id^="head_opsi_"]');
    let angka_besar = 0;

    // cek element terakhir
    if (inputElements.length > 0) {
        inputElements.forEach(function (inputElement) {
            // Menggunakan ekspresi reguler untuk mencocokkan nomor pada nama input
            var match = inputElement.id.match(/\d+/);

            // Jika ada kecocokan dan nomornya lebih besar dari yang sudah ada
            if (match && parseInt(match[0]) > angka_besar) {
                counter = parseInt(match[0]);
            }
        });
    } else {
        counter = 0;
    }

    // tambah counter
    counter++;
    // console.log(counter);

    if (counter <= maxCounter) {
        let newDiv = document.createElement("div");
        newDiv.className = "col-md-4 mb-3";
        newDiv.id = `head_opsi_${counter}`;
        newDiv.innerHTML = `
                        <div class="form-group">
                            <label for="opsi_jawaban_${counter}">Opsi Jawaban ${counter}</label>
                            <input type="text" class="form-control form-control-sm input is-invalid" required
                                id="opsi_jawaban_${counter}" name="opsi_jawaban_${counter}">
                        </div>
                `;

        container.appendChild(newDiv);

        // Inisialisasi tooltip untuk elemen baru
        const tooltipTrigger = newDiv.querySelector(
            '[data-bs-toggle="tooltip"]',
        );
        if (tooltipTrigger) {
            new bootstrap.Tooltip(tooltipTrigger);
        }
    } else {
        console.error("Maximum number reached.");
        alert("Maksimal yang dapat ditambahkan adalah 6.");
    }
}

function kurangiOpsi() {
    let container = document.getElementById("tambah_opsi");
    let inputElements = document.querySelectorAll('div[id^="head_opsi_"]');

    if (inputElements.length > 0) {
        // ambil elemen terakhir berdasarkan counter
        let lastElement = inputElements[inputElements.length - 1];
        container.removeChild(lastElement);

        // kurangi counter
        counter--;

        // minimal 0 agar tidak minus
        if (counter < 0) {
            counter = 0;
        }
    } else {
        alert("Tidak ada opsi yang bisa dikurangi!");
    }
}
