//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {
   // $(`span[aria-labelledby='select2-input_profession_id-container']`).addClass("d-none");

   SUMMERNOTE_CONFIG.placeholder = "Escribir Habilidades, competencias, experiencias, observaciones, etc.";
   SUMMERNOTE_CONFIG.toolbar.push(["templates", ["template_candidate"]]);
   SUMMERNOTE_CONFIG.height = 400;
   $(".summernote").summernote(SUMMERNOTE_CONFIG);
});

// btn_modal_form = $("#btn_modal_form"),
const div_header = $("#div_header"),
   output_enable = $("#output_enable"),
   tbody = $("#table tbody"),
   modal_body = $("#modal-body"),
   form = $("#form"),
   modal_title = $(".modal-title"),
   id_modal = $("#id"),
   op_modal = $("#op");

const input_user_id = $("#input_user_id"),
   input_photo_path = $("#input_photo_path"), //este es un input_file
   output_photo = $("#output_photo"),
   preview_photo = $("#preview_photo"),
   input_name = $("#input_name"),
   output_name = $("#output_name"),
   input_last_name = $("#input_last_name"),
   input_email = $("#input_email"),
   output_email = $("#output_email"),
   input_cellphone = $("#input_cellphone"),
   output_cellphone = $("#output_cellphone"),
   // input_age = $("#input_age"),
   // output_age = $("#output_age"),
   input_birthdate = $("#input_birthdate"),
   output_birthdate = $("#output_birthdate"),
   input_profession_id = $("#input_profession_id"),
   output_profession = $("#output_profession"),
   input_interest_tags_ids = $("#input_interest_tags_ids"),
   output_interest_tags_ids = $("#output_interest_tags_ids"),
   output_professional_info = $("#output_professional_info"),
   input_languages_b = $("#input_languages_b"),
   input_languages_i = $("#input_languages_i"),
   input_languages_a = $("#input_languages_a"),
   output_languages = $("#output_languages"),
   input_cv_path = $("#input_cv_path"), //este es un input_file
   output_cv = $("#output_cv"),
   preview_cv = $("#preview_cv"),
   btn_submit = $("#btn_submit"),
   btn_reset = $("#btn_reset"),
   btn_cancel = $("#btn_cancel"),
   btn_edit = $("#btn_edit"),
   btn_change_enable = $("#btn_change_enable");
const btn_change_password = $("#btn_change_password"),
   form_password = $("#form_password"),
   input_password = $("#input_password"),
   input_confirm_password = $("#input_confirm_password"),
   feedback_confirm_password = $("#feedback_confirm_password");
// /* INPUTS DE REGISTRO EMPRESA */
const input_company = $("#input_company"),
   output_company = $("#output_company"),
   input_description = $("#input_description"),
   output_description = $("#output_description"),
   counter_description = $("#counter_description"),
   input_logo_path = $("#input_logo_path"), //este es un input_file
   output_logo = $("#output_logo"), //este es un input_file
   preview_logo = $("#preview_logo"),
   input_business_line_id = $("#input_business_line_id"),
   output_business_line = $("#output_business_line"),
   input_company_ranking_id = $("#input_company_ranking_id"),
   output_company_ranking = $("#output_company_ranking"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
   output_location = $("#output_location"),
   input_contact_name = $("#input_contact_name"),
   output_contact_name = $("#output_contact_name"),
   input_contact_phone = $("#input_contact_phone"),
   output_contact_phone = $("#output_contact_phone"),
   input_contact_email = $("#input_contact_email"),
   output_contact_email = $("#output_contact_email");
let vProfession_id = null;

//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   counter_description.text(`0/${input_description.data("limit")}`);

   fillInfo(false);
   showStates();

   fillSelect2(URL_BUSINESS_LINE_APP, -1, input_business_line_id, false);
   fillSelect2(URL_COMPANY_RANKING_APP, -1, input_company_ranking_id, false);
}

// Agrega un evento change a la foto de perfil
input_photo_path.on("change", async function (event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function (e) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      imagen.src = e.target.result; // Asigna la imagen cargada como fuente
      // canvas.getContext("2d") // Asigna la imagen cargada como fuente
      imagen.classList.add("img-circle"); // Asignar clases
      imagen.classList.add("elevation-2"); // Asignar clases
      imagen.classList.add("bg-white"); // Asignar clases
      imagen.classList.add("pointer-sm"); // Asignar clases
      imagen.classList.add("opacity-100"); // Asignar clases
      imagen.title = "Haz clic aquí, si deseas cambiar tu foto de perfil";
      imagen.setAttribute("style", "width: 100px !important; height: 100px !important; object-fit: contain");
      // Agrega la imagen a la vista previa
      preview_photo.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview_photo.append(imagen);
   };

   //PETICION
   const form_photo = $("#form_photo")[0];
   const data = new FormData(form_photo);
   addToArray("op", "editPhoto", data, true);
   addToArray("input_name", input_name.val(), data, true); //para darle nombre al archivo
   addToArray("user_id", id_cookie, data, true);
   addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data, true);
   await ajaxRequestFileAsync(URL_CANDIDATE_APP, data);

   // Lee el contenido del archivo como una URL de datos
   fileReader.readAsDataURL(file);
});

// Agrega un evento change al elemento de entrada de archivo
input_cv_path.on("change", async function (event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function (e) {
      // Crea un elemento de imagen
      const iframe = document.createElement("iframe");
      iframe.src = e.target.result; // Asigna la iframe cargada como fuente
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      // iframe.classList.add("pointer"); // Asignar clases
      //  iframe.classList.add("p-5"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      iframe.classList.add("opacity-100"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview_cv.html(""); // Limpia la vista previa antes de agregar la nueva iframe
      preview_cv.append(iframe);
      // label_input_cv_path.css("height","100%");
      preview_cv.css("height", "100%");
   };

   //PETICION
   const form_cv = $("#form_cv")[0];
   const data = new FormData(form_cv);
   addToArray("op", "editCv", data, true);
   addToArray("input_name", input_name.val(), data, true); //para darle nombre al archivo
   addToArray("user_id", id_cookie, data, true);
   addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data, true);
   await ajaxRequestFileAsync(URL_CANDIDATE_APP, data);

   // Lee el contenido del archivo como una URL de datos
   fileReader.readAsDataURL(file);
});

// Agrega un evento change a la foto de perfil
input_logo_path.on("change", async function (event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function (e) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      imagen.src = e.target.result; // Asigna la imagen cargada como fuente
      // canvas.getContext("2d") // Asigna la imagen cargada como fuente
      imagen.classList.add("img-circle"); // Asignar clases
      imagen.classList.add("elevation-2"); // Asignar clases
      imagen.classList.add("bg-white"); // Asignar clases
      imagen.classList.add("pointer-sm"); // Asignar clases
      imagen.classList.add("opacity-100"); // Asignar clases
      imagen.title = "Haz clic aquí, si deseas cambiar tu foto de perfil";
      imagen.setAttribute("style", "width: 100px !important; height: 100px !important; object-fit: contain");
      // Agrega la imagen a la vista previa
      preview_logo.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview_logo.append(imagen);
   };

   //PETICION
   const form_logo = $("#form_logo")[0];
   const data = new FormData(form_logo);
   addToArray("op", "editLogo", data, true);
   addToArray("input_company", input_company.val(), data, true); //para darle nombre al archivo
   addToArray("user_id", id_cookie, data, true);
   addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data, true);
   await ajaxRequestFileAsync(URL_COMPANY_APP, data);

   // Lee el contenido del archivo como una URL de datos
   fileReader.readAsDataURL(file);
});

function resetImgPreviewProfile(preview, img_path = null, iframe = false) {
   if (!iframe || img_path == null) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      iframe
         ? (imagen.src = img_path == null ? "/assets/img/cargar_archivo.png" : img_path) // Asigna la imagen cargada como fuente
         : (imagen.src = img_path == null ? "/assets/img/sin_perfil.webp" : img_path); // Asigna la imagen cargada como fuente
      if (iframe) {
         imagen.classList.add("img-fluid"); // Asignar clases
         imagen.classList.add("pointer-sm"); // Asignar clases
         //  imagen.classList.add("p-5"); // Asignar clases
         imagen.classList.add("rounded-lg"); // Asignar clases
         // imagen.classList.add("text-center"); // Asignar clases
         imagen.style = "max-height: 200px !important";
      } else {
         imagen.classList.add("img-circle"); // Asignar clases
         imagen.classList.add("elevation-2"); // Asignar clases
         imagen.classList.add("bg-white"); // Asignar clases
         imagen.classList.add("pointer-sm"); // Asignar clases
         imagen.classList.add("opacity-100"); // Asignar clases
         imagen.title = "Haz clic aquí, si deseas cambiar tu foto de perfil";

         imagen.setAttribute("style", "width: 100px !important; height: 100px !important; object-fit: contain");
      }

      // Agrega la imagen a la vista previa
      preview.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview.append(imagen);
   } else {
      // Crea un elemento de imagen
      const iframe = document.createElement("iframe");
      iframe.src = img_path == null ? "/assets/img/cargar_archivo.png" : img_path; // Asigna la iframe cargada como fuente
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      iframe.classList.add("pointer-sm"); // Asignar clases
      //  iframe.classList.add("p-5"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      iframe.classList.add("opacity-100"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview.html(""); // Limpia la vista previa antes de agregar la nueva iframe
      preview.append(iframe);
      preview.parent().css("height", "50vh");
      // label_input_file.css("height","100%");
      preview.css("height", "100%");
   }
}

//CLICK EN BTN EDITAR PARA MODIFICAR INFORMACION
btn_edit.click(function () {
   $(this).addClass("d-none");
   btn_change_enable.addClass("d-none");
   btn_submit.removeClass("d-none");
   btn_cancel.removeClass("d-none");
   $(".im_input").removeClass("d-none");
   $(`span[aria-labelledby='select2-input_profession_id-container']`).removeClass("d-none");

   $(".im_output").addClass("d-none");
});

//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
btn_cancel.click((e) => {
   e.preventDefault();
   btn_edit.removeClass("d-none");
   btn_change_enable.removeClass("d-none");
   btn_submit.addClass("d-none");
   btn_cancel.addClass("d-none");
   $(".im_output").removeClass("d-none");
   $(".im_input").addClass("d-none");
});

// CAMBIAR ENTRRE ESTATUS DISPONIBLE Y CONTRATADO
btn_change_enable.click(async (e) => {
   try {
      const enable = btn_change_enable.attr("data-enable");
      const new_enable = enable == "1" ? "0" : "1";
      const data = { op: "changeEnable", input_enable: new_enable, user_id: id_cookie, updated_at: moment().format("YYYY-MM-DD hh:mm:ss") };
      ajaxRequestAsync(URL_CANDIDATE_APP, data);

      changeEnable(new_enable);
   } catch (error) {
      showAlert("error", "Oppss!!", `Ocurrio un error inesperado <br> ${error}`);
      console.error(error);
   }
});

// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
   e.preventDefault();
   // console.log(form.serializeArray());
   showBlockUI();

   if (!validateInputs(form)) return $.unblockUI();
   showBlockUI();
   let ajaxResponse;
   let data = form.serializeArray();

   if (role_cookie == 4) {
      // CANDIDATO
      const input_professional_info = $(".note-editing-area .note-editable").html();

      // return console.log(data);
      addToArray("op", "editInfo", data);
      addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data);
      addToArray("input_professional_info", input_professional_info, data);
      addToArray("user_id", id_cookie, data);

      // return console.log(data);
      ajaxResponse = await ajaxRequestAsync(URL_CANDIDATE_APP, data);
   } else if (role_cookie == 3) {
      addToArray("op", "editInfo", data);
      addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data);
      addToArray("user_id", id_cookie, data);

      ajaxResponse = await ajaxRequestAsync(URL_COMPANY_APP, data);
   }

   if (ajaxResponse.message == "duplicado") return;
   btn_cancel.click();
   showBlockUI();
   await fillInfo(false);
   $.unblockUI();
});

async function fillInfo(show_toas = true) {
   let data = { op: "showInfo", id: id_cookie, input_role_id: role_cookie };
   const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data, null, true, show_toas);

   let obj = ajaxResponse.data;
   // console.log(obj);

   if (role_cookie == 4) {
      if (obj.enable == 0) {
         div_header.removeClass("bg-success");
         div_header.addClass("bg-primary");
         output_enable.text("CONTRATADO");
      }

      haveImg = false;
      if (obj.photo_path == "" || obj.photo_path == null) resetImgPreviewProfile($(`#${input_photo_path.attr("data-preview")}`), `/assets/img/sin_perfil.webp`);
      else {
         haveImg = true;
         // console.log("tengo imagen guardada");
         resetImgPreviewProfile($(`#${input_photo_path.attr("data-preview")}`), `/assets/img/${obj.photo_path}`);
         vLogoPath = obj.photo_path;
         // input_photo_path.val(obj.photo_path);
         output_photo.attr("src", `/assets/img/${obj.photo_path}`);
      }
      input_name.val(obj.name);
      input_last_name.val(obj.last_name);
      output_name.text(`${obj.name} ${obj.last_name}`);
      input_email.val(obj.email);
      output_email.text(obj.email);
      input_cellphone.val(obj.cellphone);
      output_cellphone.text(formatPhone(obj.cellphone));
      // input_age.val(obj.age);
      let age = moment(obj.birthdate, "YYYYMMDD").fromNow();
      age = age.split("hace ").reverse()[0];
      output_birthdate.text(age);

      await fillSelect2(URL_PROFESSION_APP, obj.profession_id, input_profession_id);
      output_profession.text(obj.profession);
      // await fillSelect2(URL_TAG_APP, obj.interest_tags_ids, input_interest_tags_ids);
      // output_interest_tags_ids.text(obj.)
      // if (obj.professional_info == "<p><br></p>" || obj.professional_info.length < 1)
      // 	$('.note-editing-area .note-placeholder').css("display","block");
      // else {
      // 	$('.note-editing-area .note-placeholder').css("display","none");
      // 	$('.note-editing-area .note-editable').html(obj.professional_info);
      // }
      $(".note-editing-area .note-placeholder").css("display", "none");
      $(".note-editing-area .note-editable").html(obj.professional_info);
      output_professional_info.html(obj.professional_info);

      switch (obj.languages) {
         case "Inglés - Básico":
            input_languages_b.click();
            break;
         case "Inglés - Intermedio":
            input_languages_i.click();
            break;
         case "Inglés - Avanzado":
            input_languages_a.click();
         default:
            break;
      }
      output_languages.text(obj.languages);
      // await showStates(obj.state, obj.municipality);
      haveCv = false;
      if (obj.cv_path == "" || obj.cv_path == null) resetImgPreviewProfile($(`#${input_cv_path.attr("data-preview")}`), null, true);
      else {
         haveCv = true;
         // console.log("tengo imagen guardada");
         resetImgPreviewProfile($(`#${input_cv_path.attr("data-preview")}`), `/assets/img/${obj.cv_path}`, true);
         vCvPath = obj.cv_path;
         // input_cv_path.val(obj.cv_path);
      }
      changeEnable(obj.enable);
   } else if (role_cookie == 3) {
      haveImg = false;
      if (obj.logo_path == "" || obj.logo_path == null) resetImgPreviewProfile($(`#${input_logo_path.attr("data-preview")}`), `/assets/img/sin_perfil.webp`);
      else {
         haveImg = true;
         // console.log("tengo imagen guardada");
         resetImgPreviewProfile($(`#${input_logo_path.attr("data-preview")}`), `/assets/img/${obj.logo_path}`);
         vLogoPath = obj.logo_path;
         // input_logo_path.val(obj.logo_path);
         output_logo.attr("src", `/assets/img/${obj.logo_path}`);
      }
      input_company.val(obj.company);
      output_company.text(`${obj.company}`);

      output_location.text(`${obj.municipality}, ${obj.state}`);
      await showStates(obj.state, obj.municipality);

      input_contact_name.val(obj.contact_name);
      output_contact_name.text(obj.contact_name);
      input_contact_phone.val(obj.contact_phone);
      output_contact_phone.text(formatPhone(obj.contact_phone));
      input_contact_email.val(obj.contact_email);
      output_contact_email.text(obj.contact_email);
      input_email.val(obj.email);

      await fillSelect2(URL_BUSINESS_LINE_APP, obj.business_line_id, input_business_line_id);
      output_business_line.text(obj.business_line);
      await fillSelect2(URL_COMPANY_RANKING_APP, obj.company_ranking_id, input_company_ranking_id);
      output_company_ranking.text(obj.company_ranking);

      input_description.val(obj.description);
      output_description.text(obj.description);

      input_email.val(obj.email);
      output_email.text(obj.email);
   }
}

//EDITAR OBJETO
async function editObj(btn_edit) {
   modal_title.html("<i class='fa-light fa-pen-to-square'></i>&nbsp; EDITAR GIRO");
   btn_submit.removeClass("btn-success");
   btn_submit.addClass("btn-primary");
   btn_submit.text("GUARDAR");

   btn_cancel.removeClass("btn-danger d-none");
   btn_cancel.addClass("btn-danger");
   btn_cancel.text("CANCELAR");

   btn_reset.click();

   let id_obj = btn_edit.attr("data-id");
   let data = { id: id_obj, op: "show" };
   const ajaxResponse = await ajaxRequestAsync(URL_BUSINESS_LINE_APP, data);

   const obj = ajaxResponse.data;
   //form
   id_modal.val(Number(obj.id));
   input_business_line.val(obj.business_line);

   setTimeout(() => {
      input_business_line.focus();
   }, 500);
}

// CAMBIAR STATUS CON EL SWITCH
async function changeEnable(enable) {
   btn_change_enable.attr("data-enable", enable);
   if (enable == "1") {
      div_header.removeClass("bg-primary");
      div_header.addClass("bg-success");
      output_enable.text("DISPONIBLE");
      btn_change_enable.text("Fui Contratado");
      btn_change_enable.attr("title", "Click para mostrar en tú perfíl que estás CONTRATADO");
      return;
   }
   div_header.removeClass("bg-success");
   div_header.addClass("bg-primary");
   output_enable.text("CONTRATADO");
   btn_change_enable.text("Disponible");
   btn_change_enable.attr("title", "Click para mostrar en tú perfíl que estás DISPONIBLE");
}

// output_name.dblclick(function () {
// 	this.classList.add("d-none")
// 	input_name.removeClass("d-none");
// 	input_last_name.removeClass("d-none");
// 	input_name.focus();
// });
input_name.keypress((e) => {
   if (Enter(e)) input_last_name.focus();
});
input_last_name.keypress((e) => {
   if (Enter(e)) input_profession_id.focus();
});
input_email.keypress((e) => {
   if (Enter(e)) input_cellphone.focus();
});
input_cellphone.keypress((e) => {
   if (Enter(e)) input_languages_b.focus();
});
// input_last_name.keypress(async function(e) {
// 	if (!Enter(e)) return;
// 	const data = { op:"editName", user_id: id_cookie, input_name: input_name.val(), input_last_name: input_last_name.val(), updated_at: moment().format("YYYY-MM-DD hh:mm:ss") }
// 	await ajaxRequestAsync(URL_CANDIDATE_APP, data);

// 	output_name.text(`${input_name.val()} ${input_last_name.val()}`);
// 	input_name.addClass("d-none")
// 	input_last_name.addClass("d-none");
// 	output_name.removeClass("d-none");
// });
// output_profession.dblclick(function () {
// 	this.classList.add("d-none")
// 	$(`span[aria-labelledby='select2-input_profession_id-container']`).removeClass("d-none");
// 	input_profession_id.focus();
// });

btn_change_password.click(() => {
   setTimeout(() => {
      input_password.focus();
   }, 500);
});

// CONFIRMAR CONTRASEÑA
input_confirm_password.on("input", function () {
   var pwd1 = input_password.val();
   var pwd2 = input_confirm_password.val();

   if (pwd1 === pwd2) {
      feedback_confirm_password.addClass("text-success").text("Las contraseñas coinciden").removeClass("text-danger");
      input_password.addClass("is-valid").removeClass("is-invalid");
      input_confirm_password.addClass("is-valid").removeClass("is-invalid");
   } else {
      feedback_confirm_password.addClass("text-danger").text("Las contraseñas no coinciden").removeClass("text-success");
      input_password.addClass("is-invalid").removeClass("is-valid");
      input_confirm_password.addClass("is-invalid").removeClass("is-valid");
   }
});
form_password.on("submit", async function (e) {
   e.preventDefault();

   if (!validateInputs(form_password)) return;

   const data = form_password.serializeArray();
   addToArray("op", "changePassword", data);
   addToArray("id", id_cookie, data);
   addToArray("updated_at", moment().format("YYYY-MM-DD hh:mm:ss"), data);

   await ajaxRequestAsync(URL_USER_APP, data);

   // enviar correo
});
