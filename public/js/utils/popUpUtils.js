import { disableBackgroundScroll, enableBackgroundScroll } from "./utils.js";

/** @param {string} popUpId - The ID of the popUp element */
export function showPopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.add("--visible");
    popUpOverlay.setAttribute("aria-hidden", "false");
    disableBackgroundScroll();
  }
}

/** @param {string} popUpId - The ID of the popUp element */
export function hidePopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.remove("--visible");
    popUpOverlay.setAttribute("aria-hidden", "true");
    enableBackgroundScroll();
  }
}
