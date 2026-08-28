function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Scroll state management
window.addEventListener(
    "scroll",
    debounce(function () {
        const navbar = document.getElementById("main-navbar");
        if (navbar) {
            if (window.scrollY > 10) {
                navbar.classList.add("navbar-scrolled-state");
            } else {
                navbar.classList.remove("navbar-scrolled-state");
            }
        }
    }, 10),
);

// Mobile & Desktop Interactions
document.addEventListener("DOMContentLoaded", function () {
    // Mobile menu toggle (Slide-out from right)
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const navbarSearch = document.getElementById("navbar-search");
    const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const closeIcon = document.getElementById("close-icon");
    const dropdownMenu = document.getElementById("dropdownNavbar");
    const dropdownIcon = document.getElementById("dropdownIcon");

    function openMobileMenu() {
        if (!navbarSearch) return;
        navbarSearch.classList.remove("translate-x-full");
        navbarSearch.classList.add("translate-x-0");
        if (mobileMenuOverlay) {
            mobileMenuOverlay.classList.remove("opacity-0", "pointer-events-none");
            mobileMenuOverlay.classList.add("opacity-100", "pointer-events-auto");
        }
        
        // Morph button icon
        if (hamburgerIcon) {
            hamburgerIcon.classList.remove("scale-100", "rotate-0");
            hamburgerIcon.classList.add("scale-0", "opacity-0", "-rotate-90");
        }
        if (closeIcon) {
            closeIcon.classList.remove("scale-0", "opacity-0", "rotate-90");
            closeIcon.classList.add("scale-100", "opacity-100", "rotate-0");
        }
    }

    function closeMobileMenu() {
        if (!navbarSearch) return;
        navbarSearch.classList.add("translate-x-full");
        navbarSearch.classList.remove("translate-x-0");
        if (mobileMenuOverlay) {
            mobileMenuOverlay.classList.add("opacity-0", "pointer-events-none");
            mobileMenuOverlay.classList.remove("opacity-100", "pointer-events-auto");
        }
        
        // Morph button icon
        if (hamburgerIcon) {
            hamburgerIcon.classList.add("scale-100", "rotate-0");
            hamburgerIcon.classList.remove("scale-0", "opacity-0", "-rotate-90");
        }
        if (closeIcon) {
            closeIcon.classList.add("scale-0", "opacity-0", "rotate-90");
            closeIcon.classList.remove("scale-100", "opacity-100", "rotate-0");
        }
        
        // Close inner dropdown if open on mobile
        if (dropdownMenu && window.innerWidth < 768) {
            dropdownMenu.style.maxHeight = "0px";
            if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
        }
    }

    if (mobileMenuToggle && navbarSearch) {
        mobileMenuToggle.addEventListener("click", function(event) {
            event.stopPropagation();
            const isOpen = navbarSearch.classList.contains("translate-x-0");
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener("click", closeMobileMenu);
        }

        // Close sidebar on menu links click (useful for anchor scroll or SPA-like transitions)
        navbarSearch.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", function() {
                if (window.innerWidth < 768) {
                    closeMobileMenu();
                }
            });
        });
    }

    // Mobile search toggle
    const mobileSearchButton = document.getElementById("mobile-search-button");
    const mobileSearchForm = document.getElementById("mobile-search-form");

    if (mobileSearchButton && mobileSearchForm) {
        mobileSearchButton.addEventListener("click", function (event) {
            event.stopPropagation();
            mobileSearchForm.classList.toggle("hidden");
            mobileSearchForm.classList.toggle("block");
        });
    }

    // Dropdown toggle
    const dropdownContainer = document.querySelector(".dropdown-hover");
    const dropdownButton = document.getElementById("dropdownNavbarLink");

    if (dropdownButton && dropdownMenu) {
        // Toggle dropdown on click (works for both mobile and desktop clicks)
        dropdownButton.addEventListener("click", function (event) {
            event.stopPropagation();
            
            // Check screen width
            const isMobile = window.innerWidth < 768;
            
            if (isMobile) {
                const isOpen = dropdownMenu.style.maxHeight && dropdownMenu.style.maxHeight !== "0px";
                if (isOpen) {
                    dropdownMenu.style.maxHeight = "0px";
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
                } else {
                    dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + "px";
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(180deg)";
                }
            } else {
                const isExpanded = dropdownMenu.classList.contains("md:opacity-100");
                if (isExpanded) {
                    dropdownMenu.classList.remove("md:opacity-100", "md:visible", "md:translate-y-0");
                    dropdownMenu.classList.add("md:opacity-0", "md:invisible", "md:translate-y-[-10px]");
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
                } else {
                    dropdownMenu.classList.add("md:opacity-100", "md:visible", "md:translate-y-0");
                    dropdownMenu.classList.remove("md:opacity-0", "md:invisible", "md:translate-y-[-10px]");
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(180deg)";
                }
            }
        });

        // Desktop Hover triggers
        if (dropdownContainer) {
            dropdownContainer.addEventListener("mouseenter", function () {
                if (window.innerWidth >= 768) {
                    dropdownMenu.classList.remove("md:opacity-0", "md:invisible", "md:translate-y-[-10px]");
                    dropdownMenu.classList.add("md:opacity-100", "md:visible", "md:translate-y-0");
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(180deg)";
                }
            });

            dropdownContainer.addEventListener("mouseleave", function () {
                if (window.innerWidth >= 768) {
                    dropdownMenu.classList.add("md:opacity-0", "md:invisible", "md:translate-y-[-10px]");
                    dropdownMenu.classList.remove("md:opacity-100", "md:visible", "md:translate-y-0");
                    if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            const isClickInside = dropdownContainer.contains(event.target);
            if (!isClickInside) {
                dropdownMenu.classList.remove("md:opacity-100", "md:visible", "md:translate-y-0");
                dropdownMenu.classList.add("md:opacity-0", "md:invisible", "md:translate-y-[-10px]");
                if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: "smooth",
                });
            }
        });
    });
});
