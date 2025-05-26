import { disableBackgroundScroll, enableBackgroundScroll } from "./utils.js";

export function showSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.add("--visible");
    disableBackgroundScroll();
  }
}

export function hideSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.remove("--visible");
    enableBackgroundScroll();
  }
}
