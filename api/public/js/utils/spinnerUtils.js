import { disableBackgroundScroll, enableBackgroundScroll } from "./utils.js";

/** @param {string} id - The ID of the spinner element */
export function showSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.add("--visible");
    disableBackgroundScroll();
  }
}

/** @param {string} id - The ID of the spinner element */
export function hideSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.remove("--visible");
    spinner.remove();
    enableBackgroundScroll();
  }
}
