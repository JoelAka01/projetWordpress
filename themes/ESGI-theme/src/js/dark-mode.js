// Dark Mode Toggle Functionality
document.addEventListener("DOMContentLoaded", function () {
  const darkModeToggle = document.getElementById("dark-mode-toggle");
  const html = document.documentElement;

  // Check for saved user preference, if any, on page load
  const darkMode = getCookie("darkMode");

  // If the user previously enabled dark mode, apply it
  if (darkMode === "enabled") {
    enableDarkMode();
  }

  // When toggle button is clicked
  darkModeToggle.addEventListener("click", function () {
    // If darkMode is not currently enabled, enable it
    if (getCookie("darkMode") !== "enabled") {
      enableDarkMode();
    } else {
      // If darkMode is currently enabled, disable it
      disableDarkMode();
    }
  });

  // Function to enable dark mode
  function enableDarkMode() {
    // Add the class to the html element
    html.classList.add("dark");
    // Update darkMode in cookie (valid for 30 days)
    setCookie("darkMode", "enabled", 30);
    // Update toggle button aria-pressed state
    darkModeToggle.setAttribute("aria-pressed", "true");
    // Add a class to toggle button for styling
    darkModeToggle.classList.add("dark-mode-on");
  }

  // Function to disable dark mode
  function disableDarkMode() {
    // Remove the class from the html element
    html.classList.remove("dark");
    // Delete the cookie
    setCookie("darkMode", "", -1);
    // Update toggle button aria-pressed state
    darkModeToggle.setAttribute("aria-pressed", "false");
    // Remove class from toggle button
    darkModeToggle.classList.remove("dark-mode-on");
  }

  // Helper function to set cookie
  function setCookie(name, value, days) {
    let expires = "";
    if (days) {
      const date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/; SameSite=Lax";
  }

  // Helper function to get cookie value
  function getCookie(name) {
    const nameEQ = name + "=";
    const cookies = document.cookie.split(";");
    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i];
      while (cookie.charAt(0) === " ") {
        cookie = cookie.substring(1, cookie.length);
      }
      if (cookie.indexOf(nameEQ) === 0) {
        return cookie.substring(nameEQ.length, cookie.length);
      }
    }
    return null;
  }
});
