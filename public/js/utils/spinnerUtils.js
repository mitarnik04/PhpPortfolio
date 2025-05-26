export function showSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.add("active");
    document.documentElement.classList.add("no-scroll");
    document.body.classList.add("no-scroll");
  }
}

export function hideSpinner(id) {
  const spinner = document.getElementById(id);
  if (spinner) {
    spinner.classList.remove("active");
    document.documentElement.classList.remove("no-scroll");
    document.body.classList.remove("no-scroll");
  }
}
