$("#card_register").hide();

// const BACKEND_PATH = `${URL_BASE}/Backend`;
// const PAGES_PATH = `${URL_BASE}/pages`;
// const EMAIL_REGISTER_PATH = `/php/NewUserEmail.php`;
const EMAIL = `/emails/email.php`;

const join_now = $("#join_now").val();

/* INPUTS DE CARD LOGIN */
const form_login = $("#form_login");
const card_login = $("#card_login");
const card_register = $("#card_register");
const email = $("#email");
const password = $("#password");

/* INPUTS DE CARD REGISTER */
const form_register = $("#form_register"),
   input_email = $("#input_email"),
   input_password = $("#input_password"),
   input_confirm_password = $("#input_confirm_password"),
   feedback_confirm_password = $("#feedback_confirm_password"),
   btn_register = $("#btn_register");
email.focus();

// const check_theme = $("#check_theme");
// check_theme.on("change", function() {
// $("body").toggleClass("dark-mode")
// const dark_mode = $("body").hasClass("dark-mode") ? true : false;
// Cookies.set("dark_mode", dark_mode);
// check_theme.is("Cheked",dark_mode)
Cookies.get("dark_mode") ? $("body").addClass("dark-mode") : $("body").removeClass("dark-mode");

// });

init();
function init() {
   if (join_now == "1") {
      changeLoginSignup();
   }
}

$("#btn_signup").click((e) => {
   e.preventDefault();
   changeLoginSignup();
});
$("#btn_signin").click((e) => {
   e.preventDefault();
   changeLoginSignup();
});

$("#btn_login").click((e) => {
   e.preventDefault();
   let op = $("#op");
   let password = $("#password");
   if (!validateInputs(form_login)) return;

   const data = {
      op: op.val(),
      email: email.val(),
      password: password.val()
   };
   ajaxRequest(`${BACKEND_PATH}/User/App.php`, data);
});

$("#btn_register").click(async (e) => {
   e.preventDefault();
   if (!validateInputs(form_register)) return;

   data = {
      op: "register",
      input_email: input_email.val(),
      input_password: input_password.val(),
      created_at: moment().format("YYYY-MM-DD hh:mm:ss")
   };
   // console.log(data);
   // return;
   ajaxRequestRegister(`${BACKEND_PATH}/User/App.php`, data);
});

async function changeLoginSignup() {
   const slide_down = Boolean(card_login.data("slide-down"));
   card_login.data("slide-down", !slide_down);
   if (slide_down) {
      await card_login.slideUp(450);
      setTimeout(() => {
         card_register.slideDown(450);
         setTimeout(() => {
            input_email.focus();
         }, 500);
      }, 450);
   } else {
      await card_register.slideUp(450);
      await card_login.slideDown(450);
      setTimeout(() => {
         email.focus();
      }, 500);
   }
}

// CONFIRMAR CONTRASEÑA
input_confirm_password.on("input", function () {
   var pwd1 = input_password.val();
   var pwd2 = input_confirm_password.val();

   if (pwd1 === pwd2) {
      feedback_confirm_password.addClass("text-success").text("Las contraseñas coinciden").removeClass("text-danger");
      input_password.addClass("is-valid").removeClass("is-invalid");
      input_confirm_password.addClass("is-valid").removeClass("is-invalid");
      btn_register.prop("disabled", false);
   } else {
      feedback_confirm_password.addClass("text-danger").text("Las contraseñas no coinciden").removeClass("text-success");
      input_password.addClass("is-invalid").removeClass("is-valid");
      input_confirm_password.addClass("is-invalid").removeClass("is-valid");
      btn_register.prop("disabled", true);
   }
});

function ajaxRequest(url, data, register = false) {
   $.ajax({
      url,
      type: "POST",
      data: data,
      dataType: "json",
      success: (ajaxResponse) => {
         ajaxRequestEmail(data);

         if (ajaxResponse.result) {
            let role = 0;

            if (!register) {
               Swal.fire({
                  icon: ajaxResponse.alert_icon,
                  title: ajaxResponse.alert_title,
                  text: `${ajaxResponse.alert_text}`,
                  showConfirmButton: false,
                  timer: 2000
               }).then(() => {
                  $("#form_login")[0].reset();
                  role = Number(ajaxResponse.data.role_id);

                  if (location.pathname == URL_BASE || location.pathname == `${URL_BASE}/` || location.pathname == `/` || location.pathname == `/index.php`) {
                     if (role == undefined || role == 0 || role == NaN) window.location.href = `/registro-perfil.php`;
                     // if (role == 2) window.location.href = `${PATH_CLIENTE}`;
                     // else if (role > 2) window.location.href = `${PATH_PAYMENT}`;
                     // else window.location.href = `${PAGES_PATH}`;
                     window.location.href = `${PAGES_PATH}`;
                  }
                  location.reload();
               });
            } else {
               $("#form_login")[0].reset();
               role = Number(ajaxResponse.data.role_id);

               if (location.pathname == URL_BASE || location.pathname == `${URL_BASE}/` || location.pathname == `/` || location.pathname == `/index.php`) {
                  if (role == undefined || role == 0 || role == NaN) window.location.href = `/registro-perfil.php`;
                  // if (role == 2) window.location.href = `${PATH_CLIENTE}`;
                  // else if (role > 2) window.location.href = `${PATH_PAYMENT}`;
                  // else window.location.href = `${PAGES_PATH}`;
                  window.location.href = `${PAGES_PATH}`;
               }
               location.reload();
            }
         } else {
            Swal.fire({
               icon: ajaxResponse.alert_icon,
               title: ajaxResponse.alert_title,
               text: `${ajaxResponse.alert_text}`,
               showConfirmButton: true,
               confirmButtonColor: "#494E53"
            }).then(() => {
               if (ajaxResponse.alert_text == "El usuario no cuenta con los privilegios para acceder.") {
                  $("#email").focus();
               }
            });
         }
      },
      error: (error) => {
         Swal.fire({
            icon: "error",
            title: "Opss!!",
            html: `Ah ocurrido un error, verifica tu información <br> ${error.responseText}`,
            showConfirmButton: true,
            confirmButtonColor: "#494E53"
         });
      }
   });
}

function ajaxRequestRegister(url, data) {
   $.ajax({
      url,
      type: "POST",
      data: data,
      dataType: "json",
      success: (ajaxResponse) => {
         if (ajaxResponse.result) {
            //   console.log(data);
            // ajaxRequestEmail(data);

            Swal.fire({
               icon: ajaxResponse.alert_icon,
               title: ajaxResponse.alert_title,
               html: `${ajaxResponse.alert_text}`,
               showConfirmButton: false,
               timer: 2500
            }).then(() => {
               // if (ajaxResponse.alert_title.includes("unavailable!")) return;
               if (ajaxResponse.message.includes("duplicado")) return;

               input_password.removeClass("is-invalid is-valid");
               input_confirm_password.removeClass("is-invalid is-valid");
               feedback_confirm_password.text("").removeClass("text-danger text-success");
               btn_register.prop("disabled", false);

               const data = {
                  op: "login",
                  email: input_email.val(),
                  password: input_password.val()
               };
               ajaxRequest(`${BACKEND_PATH}/User/App.php`, data, true);
               // changeLoginSignup();
               // setTimeout(() => {
               //    email.val(input_email.val());
               //    password.val(input_password.val());
               // }, 1500);
               $("#form_register")[0].reset();
            });
         } else {
            Swal.fire({
               icon: ajaxResponse.alert_icon,
               title: ajaxResponse.alert_title,
               text: `${ajaxResponse.alert_text}`,
               showConfirmButton: true,
               confirmButtonColor: "#494E53"
            }).then(() => {
               $("#email").focus();
            });
         }
      },
      error: (error) => {
         Swal.fire({
            icon: "error",
            title: "Opss!!",
            html: `Ah ocurrido un error, verifica tu información <br> ${error.responseText}`,
            showConfirmButton: true,
            confirmButtonColor: "#494E53"
         });
      }
   });
}

function ajaxRequestEmail(data) {
   // console.log(data);
   // url: EMAILS_PATH,
   // $.ajax({
   //    url: EMAIL,
   //    type: "POST",
   //    data: data,
   //    dataType: "json",
   // });
}

const openDialogPrivate = () => {
   console.log("click");
   $("#container_privacity").removeClass("slideDownExit");
   $("#container_privacity").addClass("slideUpEnter");
};
const closeDialogPrivate = () => {
   console.log("click");
   $("#container_privacity").removeClass("slideUpEnter");
   $("#container_privacity").addClass("slideDownExit");
};
