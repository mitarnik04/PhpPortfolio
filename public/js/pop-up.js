/**
 * pop-up.js
 * Provides showPopUp and hidePopUp functions under the global PopUpUtils namespace.
 */

function showPopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.add("--visible");
    popUpOverlay.setAttribute("aria-hidden", "false");
    // Prevent background scrolling
    document.body.style.overflow = "hidden";
  }
}

function hidePopUp(popUpId) {
  const popUpOverlay = document.getElementById(popUpId);
  if (popUpOverlay) {
    popUpOverlay.classList.remove("--visible");
    popUpOverlay.setAttribute("aria-hidden", "true");
    // Restore background scrolling
    document.body.style.overflow = "";
  }
}

// Expose under a namespace on window
window.PopUpUtils = {
  showPopUp: showPopUp,
  hidePopUp: hidePopUp,
};
