document.addEventListener('DOMContentLoaded', () => {
  const dropdownButton = document.querySelector('.dropdown-button');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  dropdownButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('active');
    dropdownButton.classList.toggle('active');
  });
});
