document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
  const mobileMenuClose = document.querySelector(".mobile-menu-close");
  const mobileNavigation = document.querySelector(".mobile-navigation");
  const searchButton = document.querySelector(".search-button");
  const body = document.body;
  let menuJustOpened = false;

  // open mobile menu
  function openMobileMenu() {
    mobileMenuToggle.classList.add("active");
    mobileNavigation.classList.add("active");
    body.classList.add("menu-open");

    // prevent immediate close when clicking outside
    menuJustOpened = true;
    setTimeout(() => {
      menuJustOpened = false;
    }, 100);
  }

  // close mobile menu
  function closeMobileMenu() {
    mobileMenuToggle.classList.remove("active");
    mobileNavigation.classList.remove("active");
    body.classList.remove("menu-open");
  }

  // search functionality
  function handleSearch() {
    const searchTerm = prompt("Enter your search term:");
    if (searchTerm && searchTerm.trim()) {
      const searchUrl =
        window.location.origin + "/?s=" + encodeURIComponent(searchTerm.trim());
      window.location.href = searchUrl;
    }
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

  if (searchButton) {
    searchButton.addEventListener("click", function (e) {
      e.preventDefault();
      handleSearch();
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
  }); // close menu when clicking outside of it
  document.addEventListener(
    "click",
    function (e) {
      // dont close immediately after opening
      if (menuJustOpened) {
        return;
      }

      // check if menu is active and the click was outside the menu area
      if (mobileNavigation && mobileNavigation.classList.contains("active")) {
        // dont close if clicking inside the mobile navigation
        if (mobileNavigation.contains(e.target)) {
          return;
        }

        // dont close if clicking on the toggle button
        if (mobileMenuToggle && mobileMenuToggle.contains(e.target)) {
          return;
        }

        // close menu for any other click
        closeMobileMenu();
      }
    },
    true
  );
});

document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.contact-form');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('message envoyé');
      form.reset();
    });
  }
});
