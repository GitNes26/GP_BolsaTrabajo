$("#card_register").hide();

const URL_BASE = $("#url_base").val();
const BACKEND_PATH = `${URL_BASE}/Backend`;
const ADMIN_PATH = `${URL_BASE}/Admin`;
const EMAIL_REGISTER_PATH = `/php/NewUserEmail.php`;

const join_now = $("#join_now").val();

/* INPUTS DE CARD LOGIN */
const form_login = $("#form_login");
const card_login = $("#card_login");
const card_register = $("#card_register");
const email = $("#email");

/* INPUTS DE CARD REGISTER */
const
 form_register = $("#form_register"),
 input_name = $("#input_name"),
 input_last_name = $("#input_last_name"),
 input_email = $("#input_email"),
 input_password = $("#input_password"),
 input_confirm_password = $("#input_confirm_password"),
 feedback_confirm_password = $("#feedback_confirm_password"),
 btn_register = $("#btn_register")
;
email.focus();


// const check_theme = $("#check_theme");
// check_theme.on("change", function() {
   // $("body").toggleClass("dark-mode")
   // const dark_mode = $("body").hasClass("dark-mode") ? true : false;
   // Cookies.set("dpnstash_tema_oscuro", dark_mode);
   // check_theme.is("Cheked",dark_mode)
      Cookies.get("dpnstash_tema_oscuro") ? $("body").addClass("dark-mode") : $("body").removeClass("dark-mode")

// });



init();
function init() {
  if (join_now == '1') {
    changeLoginSignup();
   //  changeLoginSignup("I'm new here");
  }
};

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
   if (!validatingInputs(form_login)) return

   const data = {
      op: op.val(),
      email: email.val(),
      password: password.val()
   }
   return console.log(data);
   peticionAjax(`${BACKEND_PATH}/User/App.php`,data);
});

$("#btn_register").click(async (e) =>{
   e.preventDefault();
   if (!validatingInputs(form_register)) return

   let validado = true;

   if (!validado) return;
   datos = {
      accion: "crear_objeto",
      input_name: input_name.val(),
      input_email: input_email.val(),
      input_password: input_password.val(),
      input_id_perfil: 4, //SUSCRIPTOR
      creado: moment().format("YYYY-MM-DD hh:mm:ss"),
   }
   // console.log(datos);
   // return;
   ajaxResponseRegister(`${BACKEND_PATH}/Usuario/App.php`,datos);
});


$(".eye_icon").click((e) => {
   console.log("ojito en loigin");
   const target = $(e.target);
   target.toggleClass("fa-solid fa-eye fa-duotone fa-eye-slash");
   const input = $(`input#${target.attr('data-input')}`)
   if (target.hasClass("fa-eye")) input.prop("type","text")
   else input.prop("type","password")
})

async function changeLoginSignup() {
   const slide_down = Boolean(card_login.data("slide-down"));
   card_login.data("slide-down",!slide_down)
   if (slide_down) {
      await card_login.slideUp(450);
      setTimeout(() => {
         card_register.slideDown(450);
         setTimeout(() => {input_name.focus();},500)
      }, 450);
   } else {
      await card_register.slideUp(450);
      await card_login.slideDown(450);
      setTimeout(() => {email.focus();},500)
      // email.focus();
      // setTimeout(() => {
      //    card_login.slideDown(450);
      //    setTimeout(() => {email.focus();},500)
      // }, 450);
   }
}

// CONFIRMAR CONTRASEÑA
input_confirm_password.on('input',function() {
    var contrasena1 = input_password.val();
    var contrasena2 = input_confirm_password.val();

    if (contrasena1 === contrasena2) {
        feedback_confirm_password.addClass('text-success').text('Las contraseñas coinciden').removeClass('text-danger');
        input_password.addClass('is-valid').removeClass('is-invalid');
        input_confirm_password.addClass('is-valid').removeClass('is-invalid');
        btn_register.prop('disabled',false);
    } else {
        feedback_confirm_password.addClass('text-danger').text("Las contraseñas no coinciden").removeClass('text-success');
        input_password.addClass('is-invalid').removeClass('is-valid');
        input_confirm_password.addClass('is-invalid').removeClass('is-valid');
        btn_register.prop('disabled',true);
    }
});

function peticionAjax(url,datos) {
   $.ajax({
      url,
      type: "POST",
      data: datos,
      dataType: "json",
      success: (respuesta) => {
         if (respuesta.Resultado) {
           let rol = 1;

            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               text: `${respuesta.Texto_alerta}`,
               showConfirmButton: false,
               timer: 2000
            }).then(() => {
               $("#form_login")[0].reset();
               rol = Number(respuesta.Rol)

               if (location.pathname == URL_BASE || location.pathname == `${URL_BASE}/` || location.pathname == `/` ) {
                     if (rol == 2) window.location.href = `${PATH_CLIENTE}`;
                     else if (rol > 2) window.location.href = `${PATH_PAYMENT}`;
                     else window.location.href = `${ADMIN_PATH}`;
               }
               location.reload();
            });
         } else {
            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               text: `${respuesta.Texto_alerta}`,
               showConfirmButton: true,
               confirmButtonColor: '#494E53'
            }).then(() => {
               if (respuesta.Texto_alerta == "El usuario no cuenta con los privilegios para acceder.") {
                  $("#email").focus();
               }
            });
         }
      },
      error: () => {
         Swal.fire({
            icon: "error",
            title: "Opss!!",
            text: "An ever has occurred, please verify your information.",
            showConfirmButton: true,
            confirmButtonColor: '#494E53'
         })
      }
   })
}

function ajaxResponseRegister(url,datos) {
   $.ajax({
      url,
      type: "POST",
      data: datos,
      dataType: "json",
      success: (respuesta) => {
         if (respuesta.Resultado) {
         //   console.log(datos);
           // peticionAjaxemail(datos);

            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               html: `${respuesta.Texto_alerta}`,
               showConfirmButton: false,
               timer: 2500
            }).then(() => {
               if (respuesta.Titulo_alerta.includes("unavailable!")) return;

               $("#form_register")[0].reset();
               input_password.removeClass('is-invalid is-valid');
               input_confirm_password.removeClass('is-invalid is-valid');
               feedback_confirm_password.text("").removeClass('text-danger text-success');
               btn_register.prop('disabled',false);

               changeLoginSignup();
               email.val(datos.input_email);

            });
         } else {
            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               text: `${respuesta.Texto_alerta}`,
               showConfirmButton: true,
               confirmButtonColor: '#494E53'
            }).then(() => {
               if (respuesta.Texto_alerta == "El usuario no cuenta con los privilegios para acceder.") {
                  $("#email").focus();
               }
            });
         }
      },
      error: () => {
         Swal.fire({
            icon: "error",
            title: "Opss!!",
            text: "An ever has occurred, please verify your information.",
            showConfirmButton: true,
            confirmButtonColor: '#494E53'
         })
      }
   })
}

function peticionAjaxemail(datos) {
   $.ajax({
      url: EMAIL_REGISTER_PATH,
      type: "POST",
      data: datos,
      dataType: "json",
   });
}


async function peticionAjaxAsync(
   url,
   datos,
   funcion_complete_string,
   cerrar_modal
 ) {
   if (cerrar_modal != false) {
     cerrar_modal = null;
   }
   let response = await $.ajax({
     type: "POST",
     url: url,
     data: datos,
     dataType: "json",
     beforeSend: () => {
       //mostrar pantalla cargando
       $.blockUI({
         message: dialogoBlockUI,
         css: { backgroundColor: null, color: "#313131", border: null },
       });
     },
     success: (ajaxResponse) => {
       if (!ajaxResponse.Resultado) {
         Swal.fire({
           icon: ajaxResponse.Icono_alerta,
           title: ajaxResponse.Titulo_alerta,
           text: ajaxResponse.Texto_alerta,
           showConfirmButton: true,
           confirmButtonColor: "#494E53",
         });
       }
     },
     error: (ajaxResponse) => {
       Swal.fire({
         icon: "error",
         title: "Oops...!",
         text: `An ever has occurred, please verify your information.`,
         showConfirmButton: true,
         confirmButtonColor: "#494E53",
       });
     },
     complete: () => {
       //quitar pantalla c!rgfalse
       if (funcion_complete_string != null)
         eval(funcion_complete_string.toString());
       $.unblockUI();
     },
   });
   return response;
}



// function validandoInputs(formulario) {
//    let inputs = formulario.serializeArray();
//    // console.log(inputs)
//    let validado = true;
//    $.each(inputs, function (i, input_iterable) {
//      if (!validado) return;
//      let input = $(`#${input_iterable.name}`);
//      if (!input.hasClass("excluir_validacion")) {
//        // console.log(input)
//        let campo_valido = validarInputs(input);
//        if (!campo_valido) return (validado = false);
//      }
//      validado = true;
//    });
//    return validado;
//  }
//  function validarInputs(input) {
//    if (input.val() == "" || input.val() == -1 || input.val() == "-1") {
//      mostrarToast("error", `Space ${input.attr("data-nombre-campo")} empty.`);
//      input.focus();
//      return false;
//    }
//    return true;
//  }

// function mostrarToast(icono, mensaje) {
//    const Toast = Swal.mixin({
//        toast: true,
//        position: 'top-end',
//        showConfirmButton: false,
//        timer: 2000,
//        timerProgressBar: true,
//        didOpen: (toast) => {
//            toast.addEventListener('mouseenter', Swal.stopTimer)
//            toast.addEventListener('mouseleave', Swal.resumeTimer)
//        }
//    })

//    Toast.fire({
//        icon: icono,
//        title: mensaje
//    })
// }