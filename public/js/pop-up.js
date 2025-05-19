/**
 * pop-up.js
 * Provides showPopUp and hidePopUp functions under the global PopUpUtils namespace.
 */

function showPopUp(popupId) {
  const overlay = document.getElementById(popupId);
  if (overlay) {
    overlay.classList.add("popup-overlay--visible");
    overlay.setAttribute("aria-hidden", "false");
    // Prevent background scrolling
    document.body.style.overflow = "hidden";
  }
}

function hidePopUp(popupId) {
  const overlay = document.getElementById(popupId);
  if (overlay) {
    overlay.classList.remove("popup-overlay--visible");
    overlay.setAttribute("aria-hidden", "true");
    // Restore background scrolling
    document.body.style.overflow = "";
  }
}

// Expose under a namespace on window
window.PopUpUtils = {
  showPopUp: showPopUp,
  hidePopUp: hidePopUp,
};
