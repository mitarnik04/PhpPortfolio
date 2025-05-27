import { showPopUp, hidePopUp } from "./utils/popUpUtils.js";

const popUpCloseAtrName = "data-popup-close";
const popUpIdAtrName = "data-popup-id";

document.addEventListener("DOMContentLoaded", () => {
  // Attach close handlers for links/buttons with data-popup-close attribute
  document.querySelectorAll(`[${popUpCloseAtrName}]`).forEach((el) => {
    let shouldClose = el.getAttribute(popUpCloseAtrName) === "true";
    if (shouldClose) {
      const popupId = el.getAttribute(popUpIdAtrName);
      if (!popupId) {
        console.error(
          `when using ${popUpCloseAtrName} you have to define the attribute: ${popUpIdAtrName} as well.`
        );
        return;
      }
      el.addEventListener("click", (event) => {
        event.preventDefault();
        hidePopUp(popupId);
      });
    }
  });

  // Show popups marked with data-popup-show="true"
  document.querySelectorAll("[data-popup-show='true']").forEach((popup) => {
    showPopUp(popup.id);
  });
});
