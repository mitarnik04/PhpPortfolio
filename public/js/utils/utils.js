export function disableBackgroundScroll() {
  document.documentElement.classList.add("no-scroll");
}

export function enableBackgroundScroll() {
  document.documentElement.classList.remove("no-scroll");
}
