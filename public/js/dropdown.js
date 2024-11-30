document.addEventListener("DOMContentLoaded", function () {
  const dropdownButton = document.querySelector(".dropdown-button");
  const dropdownMenu = document.querySelector(".dropdown-menu");

  dropdownButton.addEventListener("click", function () {
      // メニューの表示/非表示を切り替える
      dropdownMenu.classList.toggle("active");

      // 矢印の向きを切り替える
      dropdownButton.classList.toggle("active");
  });
});
