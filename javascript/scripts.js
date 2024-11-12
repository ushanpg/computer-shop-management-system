function CheckView() {
  document.addEventListener("DOMContentLoaded", function () {
    var squares = document.querySelectorAll(".container");

    // Create the observer:
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("animated");
          entry.target.classList.add("fadeInUp");
        } else {
          entry.target.classList.remove("animated");
          entry.target.classList.remove("fadeInUp");
        }
      });
    });

    squares.forEach(function (eachSquare) {
      observer.observe(eachSquare);
    });
  });
}

CheckView();

function Scroller() {
  document.addEventListener("scroll", function () {
    var buttonScroll = document.querySelector(".scrollBtn");

    var position = window.scrollY;

    if (position > 50) {
      buttonScroll.classList.remove("invisible");
      buttonScroll.classList.add("visible");
    } else {
      buttonScroll.classList.remove("visible");
      buttonScroll.classList.add("invisible");
    }
  });
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

Scroller();

function ConfirmPrompt() {
  document.addEventListener("DOMContentLoaded", function () {

    var buttons = document.querySelectorAll(".btn-danger");
    
    buttons.forEach(function (button) {
      button.addEventListener("click", function (btnClick) {
        var action = confirm("Are you sure want to perform this action?");
        if (action == false) {
          btnClick.preventDefault();
        }
      });
    });
  });
}

ConfirmPrompt();

function ConfirmLogout() {
  document.addEventListener("DOMContentLoaded", function () {

  document.querySelector(".btnLogout").addEventListener("click", function (btnClick) {
        var action = confirm("Are you sure want to logout?");
        if (action == false) {
          btnClick.preventDefault();
        }
      });
  });
}

ConfirmLogout();

function dataTablePlugin() {
  document.addEventListener("DOMContentLoaded", function () {

        var table = document.querySelector(".table-responsive .table");
        // Checks whether data tables are available
      if (table) {
        table.id = 'dataTable';
        $(document).ready(function () {
          $('#dataTable').dataTable();
          });
        }
    });
}

dataTablePlugin();