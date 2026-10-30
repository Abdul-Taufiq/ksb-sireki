$("input").attr("autocomplete", "off");
$(document).ready(function () {
    // Default semua form diberi border merah
    $(".input").addClass("is-invalid");

    // Event listener untuk semua elemen dengan class .input
    $(document).on("input change", ".input", function () {
        var value = $(this).val();

        if (value && value.toString().trim() !== "") {
            // Ada value → hijau
            $(this).addClass("is-valid").removeClass("is-invalid");
        } else {
            // Kosong → merah
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });

    // Cek kondisi awal (misalnya form edit sudah ada value)
    $(".input").each(function () {
        var value = $(this).val();
        if (value && value.toString().trim() !== "") {
            $(this).addClass("is-valid").removeClass("is-invalid");
        }
    });

    for (let i = 1; i <= 20; i++) {
        if (document.getElementById(`nama_${i}`)) {
            autoFill(i);
            updateAdminSurvey(i);
        }
    }
});
