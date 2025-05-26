import { disableBackgroundScroll, enableBackgroundScroll } from "./utils.js";

//TODO: Make this modular ! (major rework required)

function showPopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.add("--visible");
    popUpOverlay.setAttribute("aria-hidden", "false");
    disableBackgroundScroll();
  }
}

function hidePopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.remove("--visible");
    popUpOverlay.setAttribute("aria-hidden", "true");
    enableBackgroundScroll();
  }
}

// Expose under a namespace on window
window.PopUpUtils = {
  showPopUp: showPopUp,
  hidePopUp: hidePopUp,
};
