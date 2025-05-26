import { disableBackgroundScroll, enableBackgroundScroll } from "./utils.js";

export function showSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.add("active");
    disableBackgroundScroll();
  }
}

export function hideSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.remove("active");
    enableBackgroundScroll();
  }
}
