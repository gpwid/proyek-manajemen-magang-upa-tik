// ===== DASHBOARD FUNCTIONALITY =====

document.addEventListener("DOMContentLoaded", function () {
    // Check authentication and get current user
    const currentUser = window.loginUtils.checkAuthentication();
    if (!currentUser) {
        return; // Redirected to login page
    }

    // Update user info in navbar
    updateUserInfo(currentUser);

    // Initialize sidebar
    initSidebar();

    // Load initial page content (default to dashboard)
    loadPage("dashboard");

    console.log("Dashboard script loaded successfully!");
});

function updateUserInfo(user) {
    const userNameElement = document.getElementById("userName");
    const userAvatarElement = document.getElementById("userAvatar");

    if (userNameElement) {
        userNameElement.textContent = user.name;
    }
    if (userAvatarElement) {
        userAvatarElement.src = user.avatar;
    }
}

function initSidebar() {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    // Toggle sidebar on mobile
    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", function (event) {
        if (window.innerWidth <= 991.98) {
            if (
                !sidebar.contains(event.target) &&
                !sidebarToggle.contains(event.target)
            ) {
                sidebar.classList.remove("show");
            }
        }
    });

    // Handle sidebar navigation
    const navLinks = document.querySelectorAll(".sidebar-nav .nav-link");
    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default navigation

            // Remove active class from all nav items
            document
                .querySelectorAll(".sidebar-nav .nav-item")
                .forEach((item) => {
                    item.classList.remove("active");
                });

            // Add active class to current nav item
            this.parentElement.classList.add("active");

            // Close sidebar on mobile after navigation
            if (window.innerWidth <= 991.98) {
                sidebar.classList.remove("show");
            }

            const page = this.getAttribute("onclick").match(/loadPage\(\'(.*)\'\)/)[1];
            loadPage(page);
        });
    });
}

function loadPage(page) {
    const mainContent = document.getElementById("mainContent");
    if (!mainContent) {
        console.error("Main content area not found!");
        return;
    }

    // Show loading state
    mainContent.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    // Simulate content loading delay
    setTimeout(() => {
        let contentData;
        // Determine which content source to use based on current dashboard
        const currentPath = window.location.pathname;
        if (currentPath.includes("dashboard-admin.html")) {
            contentData = getAdminContent(page);
        } else if (currentPath.includes("dashboard-atasan.html")) {
            contentData = getAtasanContent(page);
        } else if (currentPath.includes("dashboard-pemagang.html")) {
            contentData = getPemagangContent(page);
        } else if (currentPath.includes("dashboard-pembimbing.html")) {
            contentData = getPembimbingContent(page);
        } else {
            contentData = { title: "Error", subtitle: "Page Not Found", content: "<p>The requested page could not be loaded.</p>" };
        }

        mainContent.innerHTML = contentData.content;
        document.querySelector(".page-title").textContent = contentData.title;
        document.querySelector(".page-subtitle").textContent = contentData.subtitle;

        // Re-initialize any scripts or charts specific to the loaded content
        if (page === "dashboard") {
            initDashboardCharts();
        } else if (page === "kelola-penugasan") {
            initKanbanBoard();
        } else if (page === "kelola-penilaian") {
            initPenilaianCharts();
        }
        // Add more conditions for other page-specific initializations

        console.log(`Page ${page} loaded.`);
    }, 300);
}

// Chart Initializations (placeholders for now)
function initDashboardCharts() {
    const pemagangCtx = document.getElementById("pemagangChart");
    if (pemagangCtx) {
        new Chart(pemagangCtx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt"],
                datasets: [
                    {
                        label: "Jumlah Pemagang",
                        data: [10, 15, 22, 25, 20, 28, 32, 29],
                        borderColor: "#003366",
                        backgroundColor: "rgba(0, 51, 102, 0.1)",
                        fill: true,
                        tension: 0.3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    const penugasanCtx = document.getElementById("penugasanChart");
    if (penugasanCtx) {
        new Chart(penugasanCtx, {
            type: "doughnut",
            data: {
                labels: ["Dalam Progress", "Selesai", "Terlambat"],
                datasets: [
                    {
                        data: [13, 15, 2],
                        backgroundColor: ["#ffc107", "#28a745", "#dc3545"],
                        hoverOffset: 4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    }
}

function initKanbanBoard() {
    // Basic Kanban drag and drop functionality
    const kanbanColumns = document.querySelectorAll(".kanban-column");

    kanbanColumns.forEach((column) => {
        column.addEventListener("dragover", (e) => {
            e.preventDefault();
            const afterElement = getDragAfterElement(column, e.clientY);
            const draggable = document.querySelector(".dragging");
            if (afterElement == null) {
                column.appendChild(draggable);
            } else {
                column.insertBefore(draggable, afterElement);
            }
        });
    });

    const kanbanCards = document.querySelectorAll(".kanban-card");
    kanbanCards.forEach((card) => {
        card.addEventListener("dragstart", () => {
            card.classList.add("dragging");
        });

        card.addEventListener("dragend", () => {
            card.classList.remove("dragging");
        });
    });

    function getDragAfterElement(column, y) {
        const draggableCards = [
            ...column.querySelectorAll(".kanban-card:not(.dragging)"),
        ];

        return draggableCards.reduce(
            (closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            },
            { offset: Number.NEGATIVE_INFINITY }
        ).element;
    }
}

function initPenilaianCharts() {
    const nilaiCtx = document.getElementById("nilaiChart");
    if (nilaiCtx) {
        new Chart(nilaiCtx, {
            type: "bar",
            data: {
                labels: ["A", "B+", "B", "C+", "C", "D", "E"],
                datasets: [
                    {
                        label: "Jumlah Pemagang",
                        data: [5, 8, 10, 3, 2, 0, 0],
                        backgroundColor: [
                            "#28a745",
                            "#003366",
                            "#17a2b8",
                            "#ffc107",
                            "#dc3545",
                            "#6c757d",
                            "#343a40",
                        ],
                        borderColor: [
                            "#28a745",
                            "#003366",
                            "#17a2b8",
                            "#ffc107",
                            "#dc3545",
                            "#6c757d",
                            "#343a40",
                        ],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }
}

// Global logout function
function logout() {
    window.loginUtils.logout();
}

// Global showToast function
function showToast(message, type = "info") {
    const toast = document.getElementById("mainToast");
    const toastMessage = document.getElementById("toastMessage");
    const toastHeader = toast.querySelector(".toast-header");
    const icon = toastHeader.querySelector("i");

    // Set message
    toastMessage.textContent = message;

    // Set icon and color based on type
    const typeConfig = {
        success: { icon: "fa-check-circle", class: "text-success" },
        error: { icon: "fa-exclamation-circle", class: "text-danger" },
        warning: { icon: "fa-exclamation-triangle", class: "text-warning" },
        info: { icon: "fa-info-circle", class: "text-primary" },
    };

    const config = typeConfig[type] || typeConfig["info"];
    icon.className = `fas ${config.icon} ${config.class} me-2`;

    // Show toast
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}

// Expose loadPage to global scope for onclick attributes
window.loadPage = loadPage;


