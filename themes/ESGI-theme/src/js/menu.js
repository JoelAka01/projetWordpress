document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
  const mobileMenuClose = document.querySelector(".mobile-menu-close");
  const mobileNavigation = document.querySelector(".mobile-navigation");
  const body = document.body;

  // open mobile menu
  function openMobileMenu() {
    mobileMenuToggle.classList.add("active");
    mobileNavigation.classList.add("active");
    body.classList.add("menu-open");
  }

  // close mobile menu
  function closeMobileMenu() {
    mobileMenuToggle.classList.remove("active");
    mobileNavigation.classList.remove("active");
    body.classList.remove("menu-open");
  }

  // event listeners
  if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener("click", function (e) {
      e.preventDefault();
      if (mobileNavigation.classList.contains("active")) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });
  }

  if (mobileMenuClose) {
    mobileMenuClose.addEventListener("click", function (e) {
      e.preventDefault();
      closeMobileMenu();
    });
  }

  // close menu when clicking on a menu link
  const mobileMenuLinks = document.querySelectorAll(".mobile-navigation a");
  mobileMenuLinks.forEach(function (link) {
    link.addEventListener("click", function () {
      closeMobileMenu();
    });
  });

  // close menu when pressing escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && mobileNavigation.classList.contains("active")) {
      closeMobileMenu();
    }
  });

  // close menu when clicking outside of it
  document.addEventListener("click", function (e) {
    if (
      mobileNavigation.classList.contains("active") &&
      !mobileNavigation.contains(e.target) &&
      !mobileMenuToggle.contains(e.target)
    ) {
      closeMobileMenu();
    }
  });
});
