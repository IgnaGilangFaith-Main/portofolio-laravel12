// Sidebar Toggle
const sidebar = document.getElementById("sidebar");
const mainWrapper = document.getElementById("mainWrapper");
const sidebarToggle = document.getElementById("sidebarToggle");
const sidebarOpen = document.getElementById("sidebarOpen");
const sidebarClose = document.getElementById("sidebarClose");
const sidebarOverlay = document.getElementById("sidebarOverlay");

// Desktop Toggle
if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        mainWrapper.classList.toggle("expanded");

        // Save state to localStorage
        localStorage.setItem(
            "sidebarCollapsed",
            sidebar.classList.contains("collapsed")
        );
    });
}

// Mobile Open
if (sidebarOpen) {
    sidebarOpen.addEventListener("click", function () {
        sidebar.classList.add("show");
        sidebarOverlay.classList.add("show");
    });
}

// Mobile Close
if (sidebarClose) {
    sidebarClose.addEventListener("click", function () {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    });
}

// Overlay Click
if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", function () {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    });
}

// Restore sidebar state from localStorage
if (localStorage.getItem("sidebarCollapsed") === "true") {
    sidebar.classList.add("collapsed");
    mainWrapper.classList.add("expanded");
}

// Initialize tooltips
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Initialize popovers
var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
});
