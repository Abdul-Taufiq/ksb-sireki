//summernote
function initializeSummernote(selector, placeholder, height) {
    $(selector).summernote({
        placeholder: placeholder,
        tabsize: 2,
        height: height,
        spellCheck: false,
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["font", ["strikethrough", "superscript", "subscript"]],
            // ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            // ["height", ["height"]],
            ["table", ["table"]],
        ],
        callbacks: {
            onInit: function () {
                $(selector).next(".note-editor").addClass("border-danger");
            },
            onChange: function (contents) {
                var $editor = $(selector).next(".note-editor");

                // Jika konten kosong, tambahkan kelas "border-danger" dan hapus "is-valid"
                if (contents.trim() === "") {
                    $editor
                        .addClass("border-danger")
                        .removeClass("border-success");
                } else {
                    // Jika konten terisi, tambahkan kelas "border-success" dan hapus "border-danger"
                    $editor
                        .addClass("border-success")
                        .removeClass("border-danger");
                }
            },
            onPaste: function (e) {
                // aktifkan cleanPaste
                var bufferText = (
                    (e.originalEvent || e).clipboardData || window.clipboardData
                ).getData("Text");
                e.preventDefault();
                document.execCommand("insertText", false, bufferText);
            },
            onImageUpload: function (files) {
                alert("Penyisipan gambar dan vidio dinonaktifkan!");
            },
            onMediaDelete: function (files) {
                alert("Penyisipan gambar dan vidio dinonaktifkan!");
            },
        },
        styleTags: ["p", "h1", "h2", "h3", "h4", "h5", "h6"], // Pastikan format tetap ada
    });

    // untuk ngecek nilai awal saat load
    var $editor = $(selector).next(".note-editor");
    if ($(selector).val() !== "") {
        $editor.addClass("border-success").removeClass("border-danger");
    } else {
        $editor.removeClass("border-success").addClass("border-danger");
    }
}

// Inisialisasi Summernote dengan selector, placeholder, dan tinggi yang berbeda
// initializeSummernote("#deskripsi", "Keterangan...", 200);
