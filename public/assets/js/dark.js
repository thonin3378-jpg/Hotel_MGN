document.addEventListener("DOMContentLoaded", function () {
    const html = document.documentElement;

    const darkOn = document.getElementById("dark-on");
    const darkOff = document.getElementById("dark-off");

    if (!darkOn || !darkOff) return;

    // Apply saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        html.classList.add("dark");
    }

    // Dark ON
    darkOn.addEventListener("click", function (e) {
        e.preventDefault();
        html.classList.add("dark");
        localStorage.setItem("theme", "dark");
    });

    // Dark OFF
    darkOff.addEventListener("click", function (e) {
        e.preventDefault();
        html.classList.remove("dark");
        localStorage.setItem("theme", "light");
    });
});


