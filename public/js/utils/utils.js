export function disableBackgroundScroll() {
  let oldWidth = document.documentElement.clientWidth;

  document.documentElement.classList.add("no-scroll");
  document.body.classList.add("no-scroll");

  let newWidth = document.documentElement.clientWidth;

  let scrollbarWidth = Math.max(0, newWidth - oldWidth);
  document.body.style.marginRight = `${scrollbarWidth}px`;
}

export function enableBackgroundScroll() {
  document.documentElement.classList.remove("no-scroll");
  document.body.classList.remove("no-scroll");
  document.body.style.removeProperty("marginRight");
}
