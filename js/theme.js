const r = document.querySelector(':root');

const toggleTheme = function(toggle) {
  if (toggle) {
    r.style.setProperty('--themeWhite', '#201c25');
    r.style.setProperty('--textColor', '#ececec');
    r.style.setProperty('--mainColor', '#2e2c4b');
  } else {
    r.style.removeProperty('--themeWhite');
    r.style.removeProperty('--textColor');
    r.style.removeProperty('--mainColor');
  }
  fetch("/php/theme.php/?toggleTheme="+toggle);
}
// document.addEventListener("DOMContentLoaded", function(event) {
//   toggleTheme(theme.checked);
// });
