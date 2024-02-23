//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(function () {
   SUMMERNOTE_CONFIG.placeholder = "Escribir Habilidades, competencias, experiencias, observaciones, etc.";
   SUMMERNOTE_CONFIG.toolbar.push(["templates", ["template_candidate"]]), $(".summernote").summernote(SUMMERNOTE_CONFIG);
});

const btn_modal_form = $("#btn_modal_form"),
   tbody = $("#table tbody"),
   modal_body = $("#modal-body"),
   form = $("#form"),
   modal_title = $(".modal-title"),
   id_modal = $("#id"),
   op_modal = $("#op"),
   input_user_id = $("#input_user_id"),
   input_photo_path = $("#input_photo_path"), //este es un input_file
   output_photo = $("#output_photo"),
   preview_photo = $("#preview_photo"),
   input_name = $("#input_name"),
   input_last_name = $("#input_last_name"),
   input_cellphone = $("#input_cellphone"),
   // input_age = $("#input_age"),
   input_birthdate = $("#input_birthdate"),
   input_profession_id = $("#input_profession_id"),
   input_interest_tags_ids = $("#input_interest_tags_ids"),
   input_languages_b = $("#input_languages_b"),
   input_languages_i = $("#input_languages_i"),
   input_languages_a = $("#input_languages_a"),
   input_cv_path = $("#input_cv_path"), //este es un input_file
   output_cv = $("#output_cv"),
   preview_cv = $("#preview_cv"),
   btn_submit = $("#btn_submit"),
   btn_reset = $("#btn_reset"),
   d_output_photo = $("#d_output_photo"),
   d_div_header = $("#d_div_header"),
   d_output_enable = $("#d_output_enable"),
   d_preview_photo = $("#d_preview_photo"),
   d_output_name = $("#d_output_name"),
   d_output_email = $("#d_output_email"),
   d_output_cellphone = $("#d_output_cellphone"),
   // d_output_age = $("#d_output_age"),
   d_output_birthdate = $("#d_output_birthdate"),
   d_output_profession = $("#d_output_profession"),
   d_output_interest_tags_ids = $("#d_output_interest_tags_ids"),
   d_output_professional_info = $("#d_output_professional_info"),
   d_output_languages = $("#d_output_languages"),
   d_preview_cv = $("#d_preview_cv");
let haveImg = false,
   haveCv = false;
let vLogoPath = null,
   vCvPath = null;
//#endregion VARIABLES
$(".select2").select2({ dropdownParent: $("#modal") });
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   fillTable();
   // showStates();
   fillSelect2(URL_USER_APP, -1, input_user_id, false, "candidate");

   fillSelect2(URL_PROFESSION_APP, -1, input_profession_id, false);
   fillSelect2(URL_TAG_APP, -1, input_interest_tags_ids, false);
   resetImgPreview(preview_photo);
   input_name.focus();
}

//CLICK EN BTN ABRIR MODAL
btn_modal_form.click((e) => {
   e.preventDefault();

   modal_title.html("<i class='fa-solid fa-circle-plus'></i></i>&nbsp; REGISTRAR CANDIDATO");
   btn_submit.removeClass("btn-primary");
   btn_submit.addClass("btn-success");
   btn_submit.text("AGREGAR");

   //Resetear form
   btn_reset.click();

   //EXCLUIR INPUTS PARA VALIDAR
   // input_new_password.addClass("not_validate");
   // input_password.removeClass("not_validate");

   // input_email.val("nuevo@gmial.com");
   // input_password.val("1");
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
   btn_submit.prop("disabled", false);

   //EXCLUIR INPUTS PARA VALIDAR

   await resetSelect2(input_user_id);
   await resetSelect2(input_profession_id);
   await resetSelect2(input_interest_tags_ids);
   // await resetSelect2(input_state);
   // await resetSelect2(input_municipality);
   // input_municipality.attr("disabled",true);

   $(".note-editing-area .note-editable").html(null);
   $(".note-editing-area .note-placeholder").css("display", "block");
   resetImgPreview($(`#${input_photo_path.attr("data-preview")}`));
   resetImgPreview($(`#${input_cv_path.attr("data-preview")}`), null, true);

   id_modal.val("");
   setTimeout(() => {
      input_user_id.focus();
   }, 500);
});

// Agrega un evento change al elemento de entrada de archivo
input_photo_path.on("change", function (event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];
   // Crea un objeto FileReader
   const fileReader = new FileReader();
   const preview = $(`#${input_photo_path.attr("data-preview")}`);

   // Define la función de carga completada del lector
   fileReader.onload = function (e) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      imagen.src = e.target.result; // Asigna la imagen cargada como fuente
      imagen.classList.add("img-fluid"); // Asignar clases
      imagen.classList.add("pointer-sm"); // Asignar clases
      //  imagen.classList.add("p-5"); // Asignar clases
      imagen.classList.add("rounded-lg"); // Asignar clases
      imagen.style = "max-height: 200px !important";

      // Agrega la imagen a la vista previa
      preview.html(null); // Limpia la vista previa antes de agregar la nueva imagen
      preview.append(imagen);
   };

   if (file == undefined) resetImgPreview(preview);

   // Lee el contenido del archivo como una URL de datos
   fileReader.readAsDataURL(file);
});
input_cv_path.on("change", function (event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];
   // Crea un objeto FileReader
   const fileReader = new FileReader();
   const preview = $(`#${input_cv_path.attr("data-preview")}`);

   // Define la función de carga completada del lector
   fileReader.onload = function (e) {
      // Crea un elemento de imagen
      const iframe = document.createElement("iframe");
      iframe.src = e.target.result; // Asigna la iframe cargada como fuente
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      iframe.classList.add("pointer-sm"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      // iframe.classList.add("text-center"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview.html(null); // Limpia la vista previa antes de agregar la nueva iframe
      preview.append(iframe);
      preview.parent().css("height", "50vh");
      // label_input_file.css("height","100%");
      preview.css("height", "100%");
   };

   // if (file == undefined) resetImgPreview(preview);

   // Lee el contenido del archivo como una URL de datos
   fileReader.readAsDataURL(file);
});

// REGISTRAR O EDITAR OBJETO
form.on("submit", async function (e) {
   e.preventDefault();
   id_modal.addClass("not_validate");
   op_modal.addClass("not_validate");

   if (!validateInputs(form)) return;

   if (id_modal.val() <= 0) {
      //NUEVO
      id_modal.val("");
      op_modal.val("create");
   } else {
      //EDICION
      op_modal.val("edit");
   }

   // let data = form.serializeArray();
   let data = new FormData(this);
   // console.log(typeof(data));

   // return console.log(data);
   let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
   const input_professional_info = $(".note-editing-area .note-editable").html();
   addToArray("input_professional_info", input_professional_info, data, true);

   if (id_modal.val() <= 0) {
      // 	//NUEVO
      addToArray("created_at", current_date, data, true);
   } else {
      //EDICION
      addToArray("updated_at", current_date, data, true);
      // debugger
      if (haveImg) addToArray("haveImg", vLogoPath, data, true);
      if (haveCv) addToArray("haveCv", vCvPath, data, true);
   }

   const ajaxResponse = await ajaxRequestFileAsync(URL_CANDIDATE_APP, data);
   if (ajaxResponse.message == "duplicado") return;
   if (id_modal.val() == id_cookie) fillSidebar();
   fillTable();
});

async function fillTable() {
   let data = { op: "index" };
   const ajaxResponse = await ajaxRequestAsync(URL_CANDIDATE_APP, data);

   //Limpiar table
   tbody.slideUp();
   table.clear().draw();

   const list = [];
   let objResponse = ajaxResponse.data;
   // console.log(objResponse);

   objResponse.map((obj) => {
      let enable = {
         badgeColor: "badge-success",
         text: "DISPONIBLE"
      };
      if (obj.enable == 0) {
         enable = {
            badgeColor: "badge-primary",
            text: "CONTRATADO"
         };
      }

      let age = moment(obj.birthdate, "YYYYMMDD").fromNow();
      age = age.split("hace ").reverse()[0];

      //Campos
      let column_photo =
            obj.photo_path == "" || obj.photo_path == null
               ? `<img class="img-fluid rounded-lg" src="../assets/img/sin_perfil.webp" style="max-height: 150px !important;" />`
               : `<img class="img-fluid rounded-lg" src="../assets/img/${obj.photo_path}" style="max-height: 150px !important;" />`,
         column_candidate = `
				<b>${obj.name} ${obj.last_name}</b><br>
				<i>(${age})</i>
			`,
         column_contact = `
				<p><i class="fa-solid fa-phone"></i>&nbsp; ${formatPhone(obj.cellphone)}</p>
				<p><i class="fa-solid fa-at"></i>&nbsp; ${obj.email}</p>
			`,
         column_profession = `
				${obj.profession}
			`,
         column_enable = `<h5><span class="fw-bolder badge ${enable.badgeColor}">${enable.text}</span></h5>`,
         column_created_at = formatDatetime(obj.created_at, true);

      let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
      if (role_cookie <= 3) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-primary' type='button' onclick='showObj(${obj.id})' title='Mostrar Información del Candidato' data-bs-toggle="modal" data-bs-target="#candidate_modal"><i class='fa-solid fa-eye '></i></button>`;
      }
      if (permission_update) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Candidato' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-pen-to-square fa-lg i_edit'></i></button>`;
      }
      if (permission_delete) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.user_id}' title='Eliminar Candidato' data-name='${obj.name}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
      }
      column_buttons += `</div>
         </td>`;

      if (role_cookie <= 2) {
         list.push([column_photo, column_candidate, column_contact, column_profession, column_enable, column_created_at, column_buttons]);
      } else {
         list.push([column_photo, column_candidate, column_contact, column_profession, column_enable, column_buttons]);
      }
   });
   //Dibujar Tabla
   table.rows.add(list).draw();
   table.columns.adjust().draw();
   tbody.slideDown("slow");
   $("tr td").css("vertical-align", "middle");
}

//ACCIONES EN BOTONES DE LA TABLA
tbody.click((e) => {
   // console.log(e.target);
   e.preventDefault();

   //EDITAR OBJETO
   if ($(e.target).hasClass("btn_edit") || $(e.target).hasClass("i_edit")) {
      let btn_edit;

      if ($(e.target).hasClass("i_edit")) {
         btn_edit = $(e.target).parent();
      } else {
         btn_edit = $(e.target);
      }

      editObj(btn_edit);
   }

   //ELIMINAR OBJETO
   if ($(e.target).hasClass("btn_delete") || $(e.target).hasClass("i_delete")) {
      let btn_delete;

      if ($(e.target).hasClass("i_delete")) {
         btn_delete = $(e.target).parent();
      } else {
         btn_delete = $(e.target);
      }

      deleteObj(btn_delete);
   }
});

//EDITAR OBJETO
async function editObj(btn_edit) {
   modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR CANDIDATO");
   btn_submit.removeClass("btn-success");
   btn_submit.addClass("btn-primary");
   btn_submit.text("GUARDAR");

   //EXCLUIR INPUTS PARA VALIDAR

   // btn_submit.attr("disabled",true);
   // btn_reset.attr("disabled",true);

   let id_obj = btn_edit.attr("data-id");
   let data = { id: id_obj, op: "show" };
   const ajaxResponse = await ajaxRequestAsync(URL_CANDIDATE_APP, data);

   const obj = ajaxResponse.data;
   // console.log(obj);

   //form
   id_modal.val(Number(obj.id));
   await fillSelect2(URL_USER_APP, obj.user_id, input_user_id, false, "candidate");
   // input_user_id.attr("disabled", true);
   haveImg = false;
   if (obj.photo_path == "" || obj.photo_path == null) resetImgPreview($(`#${input_photo_path.attr("data-preview")}`));
   else {
      haveImg = true;
      // console.log("tengo imagen guardada");
      resetImgPreview($(`#${input_photo_path.attr("data-preview")}`), `/assets/img/${obj.photo_path}`);
      vLogoPath = obj.photo_path;
      // input_photo_path.val(obj.photo_path);
   }
   input_name.val(obj.name);
   input_last_name.val(obj.last_name);
   input_cellphone.val(obj.cellphone);
   // input_age.val(obj.age);
   input_birthdate.val(obj.birthdate);
   await fillSelect2(URL_PROFESSION_APP, obj.profession_id, input_profession_id);
   // await fillSelect2(URL_TAG_APP, obj.interest_tags_ids, input_interest_tags_ids);
   if (obj.professional_info == "<p><br></p>" || obj.professional_info.length < 1) $(".note-editing-area .note-placeholder").css("display", "block");
   else {
      $(".note-editing-area .note-placeholder").css("display", "none");
      $(".note-editing-area .note-editable").html(obj.professional_info);
   }
   switch (obj.languages) {
      case "Inglés - Básico":
         input_languages_b.click();
         break;
      case "Inglés - Intermedio":
         input_languages_i.click();
      case "Inglés - Avanzado":
         input_languages_a.click();
      default:
         break;
   }
   // await showStates(obj.state, obj.municipality);
   haveCv = false;
   if (obj.cv_path == "" || obj.cv_path == null) resetImgPreview($(`#${input_cv_path.attr("data-preview")}`), null, true);
   else {
      haveCv = true;
      // console.log("tengo imagen guardada");
      resetImgPreview($(`#${input_cv_path.attr("data-preview")}`), `/assets/img/${obj.cv_path}`, true);
      vCvPath = obj.cv_path;
      // input_cv_path.val(obj.cv_path);
   }

   setTimeout(() => {
      // btn_submit.attr("disabled",false);
      // btn_reset.attr("disabled",false);
      input_name.focus();
   }, 500);
}

//ELIMINAR OBJETO
async function deleteObj(btn_delete) {
   let title = `¿Estas seguro de eliminar a <br> ${btn_delete.attr("data-name")}?`;
   let text = ``;

   let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
   let data = {
      op: "delete",
      user_id: Number(btn_delete.attr("data-id")),
      deleted_at: current_date
   };

   ajaxRequestQuestionAsync(title, text, URL_CANDIDATE_APP, data, "fillTable()");
}

//MOSTRAR INFORMAICON
function resetImgPreviewProfile(preview, img_path = null, iframe = false, pointer = true) {
   if (!iframe || img_path == null) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      iframe
         ? (imagen.src = img_path == null ? "/assets/img/cargar_archivo.png" : img_path) // Asigna la imagen cargada como fuente
         : (imagen.src = img_path == null ? "/assets/img/sin_perfil.webp" : img_path); // Asigna la imagen cargada como fuente
      if (iframe) {
         imagen.classList.add("img-fluid"); // Asignar clases
         pointer ? imagen.classList.add("pointer-sm") : imagen.classList.remove("pointer-sm"); // sAsignar clases
         //  imagen.classList.add("p-5"); // Asignar clases
         imagen.classList.add("rounded-lg"); // Asignar clases
         // imagen.classList.add("text-center"); // Asignar clases
         imagen.style = "max-height: 200px !important";
      } else {
         imagen.classList.add("img-circle"); // Asignar clases
         imagen.classList.add("elevation-2"); // Asignar clases
         imagen.classList.add("bg-white"); // Asignar clases
         pointer ? imagen.classList.add("pointer-sm") : imagen.classList.remove("pointer-sm"); // sAsignar clases
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
      pointer ? iframe.classList.add("pointer-sm") : iframe.classList.remove("pointer-sm"); // sAsignar clases
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

async function showObj(id) {
   let data = { id, op: "show" };
   const ajaxResponse = await ajaxRequestAsync(URL_CANDIDATE_APP, data);
   const obj = ajaxResponse.data;
   // console.log(obj);

   d_div_header.removeClass("bg-primary");
   d_div_header.addClass("bg-success");
   d_output_enable.text("DISPONIBLE");
   if (obj.enable == 0) {
      d_div_header.removeClass("bg-success");
      d_div_header.addClass("bg-primary");
      d_output_enable.text("CONTRATADO");
   }

   haveImg = false;
   if (obj.photo_path == "" || obj.photo_path == null) resetImgPreviewProfile(d_preview_photo, `/assets/img/sin_perfil.webp`, false, false);
   else {
      haveImg = true;
      // console.log("tengo imagen guardada");
      resetImgPreviewProfile(d_preview_photo, `/assets/img/${obj.photo_path}`, false, false);
      vLogoPath = obj.photo_path;
      // input_photo_path.val(obj.photo_path);
      d_output_photo.attr("src", `/assets/img/${obj.photo_path}`);
   }
   d_output_name.text(`${obj.name} ${obj.last_name}`);
   d_output_email.text(obj.email);
   d_output_cellphone.text(formatPhone(obj.cellphone));
   // input_age.val(obj.age);
   let age = moment(obj.birthdate, "YYYYMMDD").fromNow();
   age = age.split("hace ").reverse()[0];
   d_output_birthdate.text(age);

   d_output_profession.text(obj.profession);
   d_output_professional_info.html(obj.professional_info);

   d_output_languages.text(obj.languages);
   // await showStates(obj.state, obj.municipality);
   haveCv = false;
   if (obj.cv_path == "" || obj.cv_path == null) resetImgPreviewProfile(d_preview_cv, null, true, false);
   else {
      haveCv = true;
      // console.log("tengo imagen guardada");
      resetImgPreviewProfile(d_preview_cv, `/assets/img/${obj.cv_path}`, true, false);
      vCvPath = obj.cv_path;
      // input_cv_path.val(obj.cv_path);
   }
   // changeEnable(obj.enable);
}
