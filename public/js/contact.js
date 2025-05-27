import { showSpinner } from "./utils/spinnerUtils.js";

document.getElementById("contactForm").addEventListener("submit", function () {
  showSpinner("spinner");
});
