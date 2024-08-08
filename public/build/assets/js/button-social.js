var social_open = false;
window.addEventListener("load", () => {
  const menu = document.querySelector(".social-button");

  menu.addEventListener("click", () => {
    const icon = document.querySelector("#social-icon");
    if (social_open == true) {
      social_open = false;

      menu.title = menu.title.replace(/hide/, "expand");
      menu.classList.remove("social-button-open");
      icon.classList.remove("fa-times");
      icon.classList.add("fa-share-alt");

      var menu_point = document.querySelectorAll(".social-point");
      for (let i = 0; i < menu_point.length; i++) {
        menu_point[i].classList.remove("social-point-open");
        setTimeout(function () {
          menu_point[i].hidden = true;
        }, 800);
      }
    } else {
      social_open = true;

      menu.title = menu.title.replace(/expand/, "hide");
      menu.classList.add("social-button-open");
      icon.classList.remove("fa-share-alt");
      icon.classList.add("fa-times");

      var menu_point = document.querySelectorAll(".social-point");
      for (let i = 0; i < menu_point.length; i++) {
        menu_point[i].hidden = false;
        setTimeout(function () {
          menu_point[i].classList.add("social-point-open");
        }, 200);
      }
    }
  });
});

/*********************- Scroll Reveal Animation-*/
/*
const sr = ScrollReveal({
  origin: "top",
  distance: "30px",
  duration: 2000,
  reset: true,
});

sr.reveal(
  ".about-image, .about-content, .section-title,  .adela-course-main-wrapper, .course-cart, .mission-content, .courses-categories-area, .single-categories-courses-box, .single-courses-box, .become-instructor-partner-area, .animated",
  { interval: 200 }
);

/**
 * Initiate portfolio lightbox
 */
/*
const portfolioLightbox = GLightbox({
  selector: ".portfolio-lightbox",
});

/**
 * Initiate portfolio details lightbox
 */
/*
const portfolioDetailsLightbox = GLightbox({
  selector: ".portfolio-details-lightbox",
  width: "90%",
  height: "90vh",
});
*/

/**Tabla */
$(document).ready(function () {
  // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
  $(".table-responsive-stack").each(function (i) {
    var id = $(this).attr("id");
    //alert(id);
    $(this)
      .find("th")
      .each(function (i) {
        $("#" + id + " td:nth-child(" + (i + 1) + ")").prepend(
          '<span class="table-responsive-stack-thead">' +
            $(this).text() +
            ":</span> "
        );
        $(".table-responsive-stack-thead").hide();
      });
  });
  $(".table-responsive-stack").each(function () {
    var thCount = $(this).find("th").length;
    var rowGrow = 100 / thCount + "%";
    //console.log(rowGrow);
    $(this).find("th, td").css("flex-basis", rowGrow);
  });

  function flexTable() {
    if ($(window).width() < 768) {
      $(".table-responsive-stack").each(function (i) {
        $(this).find(".table-responsive-stack-thead").show();
        $(this).find("thead").hide();
      });

      // window is less than 768px
    } else {
      $(".table-responsive-stack").each(function (i) {
        $(this).find(".table-responsive-stack-thead").hide();
        $(this).find("thead").show();
      });
    }
    // flextable
  }

  flexTable();

  window.onresize = function (event) {
    flexTable();
  };

  // document ready
});
