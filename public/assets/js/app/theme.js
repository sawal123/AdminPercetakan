function initThemeToggle() {
    console.log("theme");
    const htmlRoot = document.documentElement;
    const darkIcon = document.querySelector(".dark-mode-icon");
    const lightIcon = document.querySelector(".light-mode-icon");
    const toggleButton = document.getElementById("light-dark-mode");

    function updateIcons(theme) {
        if (theme === "dark") {
            darkIcon?.classList.add("d-none");
            lightIcon?.classList.remove("d-none");
        } else {
            darkIcon?.classList.remove("d-none");
            lightIcon?.classList.add("d-none");
        }
    }

    function setTheme(theme, save = true) {
        htmlRoot.setAttribute("data-bs-theme", theme);
        document.body?.setAttribute("data-bs-theme", theme);
        if (save) localStorage.setItem("theme", theme);
        updateIcons(theme);
    }

    const savedTheme = localStorage.getItem("theme");
    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const initialTheme = savedTheme || (prefersDark ? "dark" : "light");

    setTheme(initialTheme, false); // Terapkan saat pertama

    // Re-attach tombol toggle
    toggleButton?.addEventListener("click", function () {
        const current = htmlRoot.getAttribute("data-bs-theme");
        const newTheme = current === "dark" ? "light" : "dark";
        setTheme(newTheme);
    });
}

// Jalankan ulang saat Livewire pindah halaman
if (!window.__LIVEWIRE_NAVIGATED_INIT__) {
    window.__LIVEWIRE_NAVIGATED_INIT__ = true;
    document.addEventListener("livewire:navigated", function () {
        console.log("theme Tes");
        initThemeToggle(); // Re-init tombol setelah SPA selesai render
    });
}
