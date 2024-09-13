const animateCSS = (element, animation, prefix = "animate__") =>
  // We create a Promise and return it
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.querySelector(element);

    node.classList.add(`${prefix}animated`, animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove(`${prefix}animated`, animationName);
      resolve("Animation ended");
    }

    node.addEventListener("animationend", handleAnimationEnd, {
      once: true,
    });
  });

$("#change_one").click(function () {
  animateCSS("#col_initial", "bounceOutLeft").then((message) => {
    $("#col_initial").hide();
    $("#col_change_one").show("slow");
  });
});

$("#change_two").click(function () {
  animateCSS("#col_initial", "bounceOutRight").then((message) => {
    $("#col_initial").hide();
    $("#col_change_two").show("slow");
  });
});

$("#return_change_one").click(function () {
  $("#col_initial").show("slow");
  $("#col_change_one").hide("slow");

  animateCSS("#col_initial", "backInUp").then((message) => {
    $("#col_initial").removeClass("bounceOutLeft");
  });
});

$("#return_change_two").click(function () {
  $("#col_initial").show("slow");
  $("#col_change_two").hide("slow");

  animateCSS("#col_initial", "backInUp").then((message) => {
    $("#col_initial").removeClass("bounceOutRight");
  });
});

// PAISES

$("#flag_colombia").click(function () {
  window.location = "./bayerColombia/";
});

$("#flag_peru").click(function () {
  window.location = "./bayerPeru/";
});

$("#flag_ecuador").click(function () {
  window.location = "./bayerEcuador/";
});

$("#flag_centroamerica").click(function () {
  window.location = "./bayerCentroamerica/";
});

// SERVICIOS

$("#flag_crs").click(function () {
  window.location = "./bayerCrs/";
});

$("#flag_diagnostic").click(function () {
  window.location = "./bayerDiagnostico/";
});

$("#flag_corporative").click(function () {
  window.location = "./bayerCorporativo/";
});

$("#flag_lac").click(function () {
  window.location = "./bayerLac/";
});
