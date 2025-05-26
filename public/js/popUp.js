import { showPopUp, hidePopUp } from "./utils/popUpUtils.js";

document.addEventListener("DOMContentLoaded", () => {
  // Attach close handlers for links/buttons with data-popup-close attribute
  document.querySelectorAll("[data-popup-close]").forEach((el) => {
    el.addEventListener("click", (event) => {
      event.preventDefault();
      const popupId = el.getAttribute("data-popup-close");
      hidePopUp(popupId);
    });
  });

  // Show popups marked with data-popup-show="true"
  document.querySelectorAll("[data-popup-show='true']").forEach((popup) => {
    showPopUp(popup.id);
  });
});
