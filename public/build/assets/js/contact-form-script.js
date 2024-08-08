/*==============================================================*/
// Raque Contact Form  JS
/*==============================================================*/
(function ($) {
  "use strict"; // Start of use strict
  // $("#contactAdela")
  //   .validator()
  //   .on("submit", function (event) {
  //     if (event.isDefaultPrevented()) {
  //       // handle the invalid form...
  //       formError();
  //       submitMSG(false, "Has completado corretamente el formulario?");
  //     } else {
  //       // everything looks good!
  //       event.preventDefault();
  //       submitForm();
  //     }
  //   });

  $("#contactAdela")
  .validator()
  .on("submit", function (event) {
    if (event.isDefaultPrevented()) {
      // handle the invalid form...
      formError();
      submitMSG(false, "Has completado corretamente el formulario?");
    } else {
      // everything looks good!
      submitForm();
    }
  });

  function submitForm() {
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var msg_subject = $("#asunto").val();
    var phone_number = $("#telefono").val();
    var message = $("#message").val();

    $.ajax({
      type: "POST",
      // url: "assets/php/form-process.php",
      data:
        "name=" +
        name +
        "&email=" +
        email +
        "&asunto=" +
        asunto +
        "&telefono=" +
        telefono +
        "&message=" +
        message,
      success: function (text) {
        if (text == "success") {
          formSuccess();
        } else {
          formError();
          submitMSG(false, text);
        }
      },
    });
  }

  function formSuccess() {
    $("#contactAdela")[0].reset();
    submitMSG(true, "Message Submitted!");
  }

  function formError() {
    $("#contactForm")
      .removeClass()
      .addClass("shake animated")
      .one(
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
        function () {
          $(this).removeClass();
        }
      );
  }

  function submitMSG(valid, msg) {
    if (valid) {
      var msgClasses = "h4 tada animated text-success";
    } else {
      var msgClasses = "h4 text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
  }
})(jQuery); // End of use strict


