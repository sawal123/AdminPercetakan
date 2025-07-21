function waitForImagesToLoad(container, callback) {
    const images = container.querySelectorAll("img");
    let loadedCount = 0;

    if (images.length === 0) {
        callback(); // tidak ada gambar, langsung callback
        return;
    }

    images.forEach((img) => {
        if (img.complete && img.naturalHeight !== 0) {
            loadedCount++;
            if (loadedCount === images.length) callback();
        } else {
            img.onload = img.onerror = () => {
                loadedCount++;
                if (loadedCount === images.length) callback();
            };
        }
    });
}

document.getElementById("download-png").addEventListener("click", function () {
    const invoiceElement = document.getElementById("invoice-area");

    // Tambahkan kelas khusus jika ingin ubah tampilan download
    invoiceElement.classList.add("download-mode");

    // Tunggu semua gambar selesai load + tambahkan delay
    waitForImagesToLoad(invoiceElement, () => {
        setTimeout(() => {
            html2canvas(invoiceElement, {
                scale: 2,
                useCORS: true,
                scrollY: -window.scrollY,
            }).then(function (canvas) {
                const link = document.createElement("a");
                link.download = "tagihan-{{ now()->format('YmdHis') }}.png";
                link.href = canvas.toDataURL("image/png");
                link.click();

                invoiceElement.classList.remove("download-mode");
            });
        }, 500); // delay opsional 500ms
    });
});
