console.log("registros-perfil.php");

$(".select2").select2();

$("#div_candidate").hide();


const form_role = $("#form_role");
const card_role = $("#card_role");
const id_modal = $("#id");
const op_modal = $("#op");
const input_name_role = $("[name='input_role']");
const input_role = $("#input_role");

// /* INPUTS DE CARD REGISTRO */
const div_company = $("#div_company"),
   input_company = $("#input_company"),
   input_description = $("#input_description"),
   input_business_line_id = $("#input_business_line_id"),
   input_company_ranking_id = $("#input_company_ranking_id"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
   input_contact_name = $("#input_contact_name"),
   input_contact_phone = $("#input_contact_phone"),
   input_contact_email = $("#input_contact_email")
   ;

// /* INPUTS DE CARD REGISTER */
const div_candidate = $("#div_candidate");
// const
//  form_register = $("#form_register"),
//  input_name = $("#input_name"),
//  input_last_name = $("#input_last_name"),
//  input_email = $("#input_email"),
//  input_password = $("#input_password"),
//  input_confirm_password = $("#input_confirm_password"),
//  feedback_confirm_password = $("#feedback_confirm_password"),
//  btn_register = $("#btn_register")
// ;
// email.focus();


// // const check_theme = $("#check_theme");
// // check_theme.on("change", function() {
//    // $("body").toggleClass("dark-mode")
//    // const dark_mode = $("body").hasClass("dark-mode") ? true : false;
//    // Cookies.set("dark_mode", dark_mode);
//    // check_theme.is("Cheked",dark_mode)
//       Cookies.get("dark_mode") ? $("body").addClass("dark-mode") : $("body").removeClass("dark-mode")

// // });



init();
async function init() {
   fillSelect2(URL_BUSINESS_LINE_APP, -1, input_business_line_id, false);
   fillSelect2(URL_COMPANY_RANKING_APP, -1, input_company_ranking_id, false);
};

// $("#btn_signup").click((e) => {
//    e.preventDefault();
//   changeLoginSignup();

// });
// $("#btn_signin").click((e) => {
//    e.preventDefault();
//   changeLoginSignup();
// });

// $("#btn_login").click((e) => {
//    e.preventDefault();
//    let op = $("#op");
//    let password = $("#password");
//    if (!validateInputs(form_role)) return

//    const data = {
//       op: op.val(),
//       email: email.val(),
//       password: password.val()
//    }
//    ajaxRequest(`${BACKEND_PATH}/User/App.php`,data);
// });

// $("#btn_register").click(async (e) =>{
//    e.preventDefault();
//    if (!validateInputs(form_register)) return

//    let validado = true;

//    if (!validado) return;
//    data = {
//       accion: "crear_objeto",
//       input_name: input_name.val(),
//       input_email: input_email.val(),
//       input_password: input_password.val(),
//       input_id_perfil: 4, //SUSCRIPTOR
//       creado: moment().format("YYYY-MM-DD hh:mm:ss"),
//    }
//    // console.log(data);
//    // return;
//    ajaxRequestRegister(`${BACKEND_PATH}/Usuario/App.php`,data);
// });


input_name_role.on("change",function() {
   changeForms(this.value)
}) 

async function changeForms(checkbox) {
   // const 
   if (checkbox == 3) {
      await div_candidate.slideUp(450);
      // await div_company.slideDown(450);
      setTimeout(() => {
         div_company.slideDown(450);
         setTimeout(() => {input_company.focus();},500)
      }, 450);
   }
   else if (checkbox == 4) {
      await div_company.slideUp(450);
      // await div_candidate.slideDown(450);
      setTimeout(() => {
         div_candidate.slideDown(450);
         setTimeout(() => {input_company.focus();},500)
      }, 450);
   }
}

// // CONFIRMAR CONTRASEÑA
// input_confirm_password.on('input',function() {
//    var pwd1 = input_password.val();
//    var pwd2 = input_confirm_password.val();

//    if (pwd1 === pwd2) {
//       feedback_confirm_password.addClass('text-success').text('Las contraseñas coinciden').removeClass('text-danger');
//       input_password.addClass('is-valid').removeClass('is-invalid');
//       input_confirm_password.addClass('is-valid').removeClass('is-invalid');
//       btn_register.prop('disabled',false);
//    } else {
//       feedback_confirm_password.addClass('text-danger').text("Las contraseñas no coinciden").removeClass('text-success');
//       input_password.addClass('is-invalid').removeClass('is-valid');
//       input_confirm_password.addClass('is-invalid').removeClass('is-valid');
//       btn_register.prop('disabled',true);
//    }
// });

// function ajaxRequest(url,data) {
//    $.ajax({
//       url,
//       type: "POST",
//       data: data,
//       dataType: "json",
//       success: (ajaxResponse) => {
//          if (ajaxResponse.result) {
//            let rol = 1;

//             Swal.fire({
//                icon: ajaxResponse.alert_icon,
//                title: ajaxResponse.alert_title,
//                text: `${ajaxResponse.alert_text}`,
//                showConfirmButton: false,
//                timer: 2000
//             }).then(() => {
//                $("#form_role")[0].reset();
//                rol = Number(ajaxResponse.Rol);
//                console.log(location.pathname);
//                // return console.log("todo bien hasta aqui");

//                if (location.pathname == URL_BASE || location.pathname == `${URL_BASE}/` || location.pathname == `/` || location.pathname == `/index.php` ) {
//                      // if (rol == 2) window.location.href = `${PATH_CLIENTE}`;
//                      // else if (rol > 2) window.location.href = `${PATH_PAYMENT}`;
//                      // else window.location.href = `${PAGES_PATH}`;
//                      console.log("aqui entro", PAGES_PATH);
//                      window.location.href = `${PAGES_PATH}`;
//                }
//                location.reload();
//             });
//          } else {
//             Swal.fire({
//                icon: ajaxResponse.alert_icon,
//                title: ajaxResponse.alert_title,
//                text: `${ajaxResponse.alert_text}`,
//                showConfirmButton: true,
//                confirmButtonColor: '#494E53'
//             }).then(() => {
//                if (ajaxResponse.alert_text == "El usuario no cuenta con los privilegios para acceder.") {
//                   $("#email").focus();
//                }
//             });
//          }
//       },
//       error: () => {
//          Swal.fire({
//             icon: "error",
//             title: "Opss!!",
//             text: "Ah ocurrido un error, verifica tu informaciónEEEEEE.",
//             showConfirmButton: true,
//             confirmButtonColor: '#494E53'
//          })
//       }
//    })
// }

// function ajaxRequestRegister(url,data) {
//    $.ajax({
//       url,
//       type: "POST",
//       data: data,
//       dataType: "json",
//       success: (ajaxResponse) => {
//          if (ajaxResponse.result) {
//          //   console.log(data);
//            // ajaxRequestEmail(data);

//             Swal.fire({
//                icon: ajaxResponse.alert_icon,
//                title: ajaxResponse.alert_title,
//                html: `${ajaxResponse.alert_text}`,
//                showConfirmButton: false,
//                timer: 2500
//             }).then(() => {
//                if (ajaxResponse.alert_title.includes("unavailable!")) return;

//                $("#form_register")[0].reset();
//                input_password.removeClass('is-invalid is-valid');
//                input_confirm_password.removeClass('is-invalid is-valid');
//                feedback_confirm_password.text("").removeClass('text-danger text-success');
//                btn_register.prop('disabled',false);

//                changeLoginSignup();
//                email.val(data.input_email);

//             });
//          } else {
//             Swal.fire({
//                icon: ajaxResponse.alert_icon,
//                title: ajaxResponse.alert_title,
//                text: `${ajaxResponse.alert_text}`,
//                showConfirmButton: true,
//                confirmButtonColor: '#494E53'
//             }).then(() => {
//                if (ajaxResponse.alert_text == "El usuario no cuenta con los privilegios para acceder.") {
//                   $("#email").focus();
//                }
//             });
//          }
//       },
//       error: () => {
//          Swal.fire({
//             icon: "error",
//             title: "Opss!!",
//             text: "Ah ocurrido un error, verifica tu información.",
//             showConfirmButton: true,
//             confirmButtonColor: '#494E53'
//          })
//       }
//    })
// }

// function ajaxRequestEmail(data) {
//    $.ajax({
//       url: EMAIL_REGISTER_PATH,
//       type: "POST",
//       data: data,
//       dataType: "json",
//    });
// }
