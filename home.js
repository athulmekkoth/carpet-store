
document.addEventListener('DOMContentLoaded', () => {
  const navicon = document.getElementsByClassName('navicon')[0];
  const navbarList = document.getElementsByClassName('navbar-list')[0];

  navicon.addEventListener('click', () => {
    if (navbarList.style.visibility === "hidden") {
      navbarList.style.visibility = "visible";
    } else {
      navbarList.style.visibility = "hidden";
    }
  });
});

const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach((dropdown) => {
  dropdown.addEventListener('click', () => {
    dropdown.classList.toggle('active');
  });
});

