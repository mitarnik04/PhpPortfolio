import { showSpinner, hideSpinner } from "./utils/spinnerUtils.js";

//show Spinner by default
showSpinner("content-loading-spinner");

//hide spinner once page has been loaded
window.addEventListener("load", () => {
  hideSpinner("content-loading-spinner");
});
