// {{-- loading screen --}}
document.addEventListener("DOMContentLoaded", function () {
    let loadingScreen = document.getElementById("loading-screen");

    // ✅ Munculkan loading saat halaman berpindah atau direfresh
    window.addEventListener("beforeunload", function () {
        loadingScreen.style.display = "block";
    });

    // ✅ Cegah loading muncul jika klik tombol modal atau event lain di halaman
    document.addEventListener("click", function (event) {
        let target = event.target.closest(
            "[data-toggle='modal'], [data-bs-toggle='modal']",
        );
        if (target) {
            event.stopPropagation();
        }
    });

    // ✅ Munculkan loading saat submit form (POST request)
    document.addEventListener("submit", function () {
        loadingScreen.style.display = "block";
    });

    // ✅ Livewire Hook untuk proses request
    document.addEventListener("livewire:load", function () {
        Livewire.hook("message.sent", () => {
            loadingScreen.style.display = "block";
        });
        Livewire.hook("message.received", () => {
            loadingScreen.style.display = "none";
        });
    });

    // ✅ Hilangkan loading jika halaman selesai dimuat
    window.onload = function () {
        loadingScreen.style.display = "none";
    };

    // ✅ Cegah loading screen pada navigasi back/forward cache
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            // Halaman dimuat dari cache
            loadingScreen.style.display = "none";
        }
    });
});
// {{ end loading screen }}

// {{-- tambahkan title di tag a --}}
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("a").forEach((link) => {
        const href = link.getAttribute("href");

        // Skip kalau href kosong atau hanya "#"
        if (!href || href === "#") return;

        if (!link.getAttribute("title")) {
            // Hindari mengganti title jika sudah ada
            link.setAttribute("title", link.innerText.trim());
            link.setAttribute("data-bs-toggle", "tooltip");
            link.setAttribute("data-bs-custom-class", "custom-tooltip");
            link.setAttribute("data-bs-placement", "right");
        }
    });
});

$(function () {
    $('[data-bs-toggle="tooltip"]').tooltip({
        trigger: "hover",
        delay: {
            show: 400,
            hide: 100,
        },
        html: true,
        container: "body",
    });
});
