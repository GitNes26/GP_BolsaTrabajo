// #region FUNCIONES DE CAJON

//#region VARIABLES
const URL_BASE = $("#url_base").val(), //+ /empleos",
   BACKEND_PATH = `${URL_BASE}/backend`,
   PAGES_PATH = `${URL_BASE}/pages`,
   EMAILS_PATH = `/empleos/emails/NewMemberEmail_copy.php`,
   // URL_API_COUNTRIES = `https://www.universal-tutorial.com/api`,
   URL_API_COUNTRIES = `https://cp.atc.gomezpalacio.gob.mx/api/cp`, //`https://cp.gomezpalacio.gob.mx/api/cp`,
   URL_USER_APP = `${BACKEND_PATH}/User/App.php`,
   URL_COMPANY_APP = `${BACKEND_PATH}/Company/App.php`,
   URL_ROLE_APP = `${BACKEND_PATH}/Role/App.php`,
   URL_MENU_APP = `${BACKEND_PATH}/Menu/App.php`,
   URL_BUSINESS_LINE_APP = `${BACKEND_PATH}/BusinessLine/App.php`,
   URL_TAG_APP = `${BACKEND_PATH}/Tag/App.php`,
   URL_PROFESSION_APP = `${BACKEND_PATH}/Profession/App.php`,
   URL_AREA_APP = `${BACKEND_PATH}/Area/App.php`,
   URL_DISABILITY_APP = `${BACKEND_PATH}/Disability/App.php`,
   URL_LEVEL_APP = `${BACKEND_PATH}/Level/App.php`,
   URL_COMPANY_RANKING_APP = `${BACKEND_PATH}/CompanyRanking/App.php`,
   URL_BANNER_APP = `${BACKEND_PATH}/Banner/App.php`,
   URL_VACANCY_APP = `${BACKEND_PATH}/Vacancy/App.php`,
   URL_CANDIDATE_APP = `${BACKEND_PATH}/Candidate/App.php`,
   URL_APPLICATION_APP = `${BACKEND_PATH}/Application/App.php`;
const btn_close = $(".btn-close");

const id_cookie = Number(Cookies.get("user_id")),
   role_cookie = Number(Cookies.get("role_id")),
   permission_read = Boolean(Cookies.get("permission_read")),
   permission_write = Boolean(Cookies.get("permission_write")),
   permission_delete = Boolean(Cookies.get("permission_delete")),
   permission_update = Boolean(Cookies.get("permission_update")),
   current_page = $("#current_page").val(),
   singular_object = $("#singular_object").val(),
   plural_object = $("#plural_object").val();

let auth_token;
// console.log("🚀 ~ URL_BASE:", URL_BASE);

const SUMMERNOTE_CONFIG = {
   placeholder: "Escribir Habilidades, competencias, experiencias, observaciones, etc.",
   lang: "es-ES",
   toolbar: [
      ["style", ["bold", "italic", "underline", "clear", "highlight"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["para", ["ul", "ol"]],
      ["insert", ["link", "unlink", "separator"]],
      // ['templates', ['template_candidate', 'template_vancancy']],
      // ['insert', ['link', 'picture', 'video']],
      ["view", ["codeview", "clean"]]
   ],
   buttons: {
      separator: function () {
         var ui = $.summernote.ui;
         var button = ui.button({
            contents: '<i class="note-icon-minus"/>',
            tooltip: "Separador",
            click: function () {
               // Insertar código aquí para agregar el separador en el editor
               $(".note-editing-area .note-placeholder").css("display", "none");
               var hr = '<hr class="custom-separator">';
               $(".note-editing-area .note-editable").append(hr);
               // $('#summernote').summernote('pasteHTML', hr);
            }
         });
         return button.render();
      },
      clean: function () {
         var ui = $.summernote.ui;
         var button = ui.button({
            contents: '<i class="fa-solid fa-ban"/>',
            tooltip: "Limpiar todo",
            click: function () {
               // Insertar código aquí para agregar en el editor
               $(".note-editing-area .note-placeholder").css("display", "block");
               $(".note-editing-area .note-editable").html(null);
               // $('#summernote').summernote('pasteHTML', hr);
            }
         });
         return button.render();
      },
      template_candidate: function () {
         // console.log("template", template);
         var ui = $.summernote.ui;
         var button = ui.button({
            contents: '<i class="fa-solid fa-file-lines"/>',
            tooltip: "Agregar plantilla",
            click: function () {
               // Insertar código aquí para agregar en el editor
               $(".note-editing-area .note-placeholder").css("display", "none");

               $(".note-editing-area .note-editable").html(null);
               $(".note-editing-area .note-editable").html(
                  `<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class="custom-separator"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class="custom-separator"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style="font-weight: bolder;">Empresa - Puesto |&nbsp;</span>01/01/2020<span style="font-weight: bolder;">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>`
               );
               // $('#summernote').summernote('pasteHTML', hr);
            }
         });
         return button.render();
      },
      template_vacancy: function () {
         // console.log("template", template);
         var ui = $.summernote.ui;
         var button = ui.button({
            contents: '<i class="fa-solid fa-file-lines"/>',
            tooltip: "Agregar plantilla",
            click: function () {
               // Insertar código aquí para agregar en el editor
               $(".note-editing-area .note-placeholder").css("display", "none");

               $(".note-editing-area .note-editable").html(null);
               $(".note-editing-area .note-editable").html(
                  `<p class=""><span class="fw-bolder">Requisitos</span><ul class="" id="output_requirements"><li>Requerimiento 1</li><li>Requerimiento 1</li><li>Requerimiento 1</li></ul></p><p class=""><span class="fw-bolder">Expriencia necesaria</span><ul class="" id="output_necessary_experience"><li>Experiencias 1</li><li>Experiencias 1</li><li>Experiencias 1</li></ul></p><hr><p class=""><span class="fw-bolder">Beneficios</span><ul class="" id="output_benefits"><li>Beneficio 1</li><li>Beneficio 1</li><li>Beneficio 1</li></ul></p>`
               );
               // $('#summernote').summernote('pasteHTML', hr);
            }
         });
         return button.render();
      }
   },
   height: 350
};
//#endregion VARIABLES

// console.log("Cookies",Cookies.get());
let needCookies = true;
if (location.pathname == "/") needCookies = false;
else if (location.pathname == "/index.php") needCookies = false;
else if (location.pathname == "/registro-perfil.php") needCookies = false;

if (![`${URL_BASE}/`, `${URL_BASE}/index.php`].includes(location.pathname)) if (!Cookies.get(`session`) && needCookies) location.reload();

let inIndex = false;
if ([`${URL_BASE}/pages/index.php`, `${URL_BASE}/pages/`, `${URL_BASE}/pages`].includes(location.pathname)) inIndex = true;
// console.log("pathname", location.pathname, "inIndex", inIndex);
// if (location.pathname == "${URL_BASE}/pages") inIndex = true;
// else if (location.pathname == "${URL_BASE}/pages/") inIndex = true;
// else if (location.pathname == "${URL_BASE}/pages/index.php") inIndex = true;

const ajaxRequestAsync = async (url, data, close_modal = null, show_blockUI = true, show_toast = true) => {
   try {
      if (show_blockUI) {
         await showBlockUI();
      }
      let response = await $.ajax({
         type: "POST",
         url: url,
         data: data,
         async: true,
         dataType: "json"
      });
      // console.log(response);

      if (response.message == "duplicado") {
         $.unblockUI();
         showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
         $(`#${response.input}`).focus();
         return response;
      }

      if (response.result) {
         if (response.toast) {
            if (show_toast) {
               // setTimeout(() => {
               showToast(response.alert_icon, response.alert_text);
               // }, 2000);
            }
         } else showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
      } else {
         showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
      }

      if (close_modal == null && btn_close != null) btn_close.click();
      if (show_blockUI) $.unblockUI();
      return response;
   } catch (error) {
      if (close_modal == null && btn_close != null) btn_close.click();
      console.error(error);
      showAlert("error", "Oopss...!!", `Ocurrio un error inesperado. <br> ${error.responseText}`, true);
      $.unblockUI();
   }
};
const ajaxRequestQuestionAsync = async (
   title,
   text,
   url,
   data,
   function_complete_string,
   text_btn_confirm = "Eliminar",
   color_btn_confirm = "#B04759",
   icon = "warning"
) => {
   Swal.fire({
      title: title,
      html: text,
      icon: icon,
      showCancelButton: true,
      confirmButtonColor: color_btn_confirm,
      confirmButtonText: text_btn_confirm,
      cancelButtonColor: "#9BA4B5",
      cancelButtonText: "Cancelar"
   }).then(async (result) => {
      if (result.isConfirmed) {
         await showBlockUI();

         try {
            let response = await $.ajax({
               type: "POST",
               url: url,
               data: data,
               dataType: "json"
            });

            if (response.result) {
               if (response.alert_text != undefined) showToast(response.alert_icon, response.alert_text);
               deleted = true;
            } else {
               showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
            }
            if (function_complete_string != null) eval(function_complete_string.toString());
            $.unblockUI();
            return response;
         } catch (error) {
            $.unblockUI();
            console.error(error);
            showAlert("error", "Oopss...!!", `Ocurrio un error inesperado. <br> ${error.responseText}`, true);
         }
      }
   });
};
const ajaxRequestFileAsync = async (url, data, close_modal = null, show_blockUI = true, show_toast = true) => {
   try {
      if (show_blockUI) {
         await showBlockUI();
      }
      let response = await $.ajax({
         type: "POST",
         url: url,
         data: data,
         async: true,
         dataType: "json",
         enctype: "multipart/form-data",
         contentType: false,
         cache: false,
         processData: false
      });
      // console.log(response);

      if (response.message == "duplicado") {
         $.unblockUI();
         showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
         $(`#${response.input}`).focus();
         return response;
      }

      if (response.result) {
         if (response.toast) {
            if (show_toast) {
               // setTimeout(() => {
               showToast(response.alert_icon, response.alert_text);
               // }, 2000);
            }
         } else showAlert(response.alert_icon, response.alert_title, response.alert_text, false);
      } else {
         showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
      }

      if (close_modal == null && btn_close != null) btn_close.click();
      if (show_blockUI) $.unblockUI();
      return response;
   } catch (error) {
      if (close_modal == null && btn_close != null) btn_close.click();
      console.error(error);
      showAlert("error", "Oopss...!!", `Ocurrio un error inesperado. <br> ${error.responseText}`, true);
      $.unblockUI();
   }
};

function showBlockUI() {
   const dialogoBlockUI = `
	<div class="card text-center" style="opacity:1 !important; width:40vw !important;">
		<div class="card-body">
			<div class="fw-bold h6">CARGANDO...</div><br>
			<div class='spinner-border text-dark' role='status'> <span class='sr-only'></span></div>
		</div>
	</div>
	`;
   $.blockUI({
      message: dialogoBlockUI,
      css: { backgroundColor: null, color: "#313131", border: null }
   });
}

function showAlert(icon, title, text, show_confirm_btn) {
   Swal.fire({
      icon,
      title,
      html: text,
      showConfirmButton: show_confirm_btn,
      confirmButtonColor: "#494E53"
   });
}

function showToast(icon, message, position = "top-end") {
   const Toast = Swal.mixin({
      toast: true,
      position: position,
      showConfirmButton: false,
      timer: 2000,
      // color: #007BFF,
      timerProgressBar: true,
      didOpen: (toast) => {
         toast.addEventListener("mouseenter", Swal.stopTimer);
         toast.addEventListener("mouseleave", Swal.resumeTimer);
      }
   });

   Toast.fire({ icon: icon, title: message });
}

function showConfirmationOnce(
   storageKey = "alertConfirmed",
   title = "¿Deseas continuar?",
   text = "Esta acción no se volverá a preguntar.",
   textConfirm = "Aceptar",
   fnSuccess = null
) {
   const confirmed = localStorage.getItem(storageKey);

   // Si ya existe la variable, no mostramos la alerta
   if (confirmed === "true") {
      console.log("La alerta ya fue confirmada antes, no se mostrará.");
      return;
   }

   // Mostramos la alerta
   Swal.fire({
      title: title,
      text: text,
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: textConfirm,
      cancelButtonText: "Cancelar",
      // 🔒 Evita que se cierre accidentalmente
      allowOutsideClick: false, // No permite cerrar haciendo clic fuera
      allowEscapeKey: false, // No permite cerrar con la tecla ESC
      allowEnterKey: false, // No se confirma con Enter automáticamente
      backdrop: true // Mantiene el fondo bloqueado
   }).then((result) => {
      if (result.isConfirmed) {
         // Guardamos en localStorage
         localStorage.setItem(storageKey, "true");

         fnSuccess != null ? fnSuccess() : null;

         // Swal.fire({
         //    icon: "success",
         //    title: "Confirmado",
         //    text: "Ya no volverás a ver este mensaje."
         // });
      }
   });
}

const obligatory = $(".obligatory").html(`<span class="text-danger fst-italic">&nbsp; * requerido</span>`);

function mayus(e) {
   e.value = e.value.toUpperCase();
}

function Enter(e) {
   const code = e.keyCode ? e.keyCode : e.which;
   return code == 13 ? true : false;
}

// SWITCH HABILITADO/DESAHBILITADO
function switchEnabled(status, input, label = null, text_label_active = "Activo", text_label_inactive = "No Activo") {
   // console.log("status", status);
   // console.log("input", input);
   if (status) input.is(":checked") ? null : input.click();
   else input.is(":checked") ? input.click() : null;

   if (label != null) input.change(() => (input.is(":checked") ? label.text(text_label_active) : label.text(text_label_inactive)));
}

const accent_map = {
   á: "a",
   é: "e",
   è: "e",
   í: "i",
   ó: "o",
   ú: "u",
   Á: "a",
   É: "e",
   è: "e",
   Í: "i",
   Ó: "o",
   Ú: "u"
};
function accentFold(s) {
   if (!s) {
      return "";
   }
   var ret = "";
   for (var i = 0; i < s.length; i++) {
      ret += accent_map[s.charAt(i)] || s.charAt(i);
   }
   return ret;
}

$(".eye_icon").click((e) => {
   // console.log("ojito en loigin");
   const target = $(e.target);
   target.toggleClass("fa-solid fa-eye fa-duotone fa-eye-slash");
   const input = $(`input#${target.attr("data-input")}`);
   if (target.hasClass("fa-eye")) input.prop("type", "text");
   else input.prop("type", "password");
});

// #region CONTADOR DE LETRAS
$(".counter").on("input change", function () {
   countLetter(this, this.getAttribute("data-counter"), this.value.length, Number(this.dataset.limit));
});
function countLetter(input, counter_name, letters, limit) {
   const counter = $(`#${counter_name}`);
   counter.text(`${letters}/${limit}`);

   if (letters > limit) {
      input.value = input.value.slice(0, limit);
      counter.removeClass("text-muted");
      counter.addClass("text-danger");
      counter.text(`Máximo de caracteres alcanzado ${limit}/${limit}`);
      // $(input).addClass("is-invalid");
      return;
   }
   counter.removeClass("text-danger");
   counter.addClass("text-muted");
   // $(input).removeClass("is-invalid");
}
// #endregion CONTADOR DE LETRAS

//AGREGAR DATO AL ARRAY
function addToArray(name, value, array, formData = false) {
   //array obtenido de formulario_modal.serializeArray()
   // console.log(nombre,valor,array);
   const new_data = { name, value };
   if (formData) array.append(name, value);
   else array.push(new_data);
}

function resetImgPreview(preview, img_path = null, iframe = false) {
   if (!iframe || img_path == null) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      iframe
         ? (imagen.src = img_path == null ? "../assets/img/cargar_archivo.png" : img_path) // Asigna la imagen cargada como fuente
         : (imagen.src = img_path == null ? "../assets/img/cargar_imagen.png" : img_path); // Asigna la imagen cargada como fuente
      imagen.classList.add("img-fluid"); // Asignar clases
      imagen.classList.add("pointer-sm"); // Asignar clases
      //  imagen.classList.add("p-5"); // Asignar clases
      imagen.classList.add("rounded-lg"); // Asignar clases
      // imagen.classList.add("text-center"); // Asignar clases
      imagen.style = "max-height: 200px !important";

      // Agrega la imagen a la vista previa
      preview.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview.append(imagen);
   } else {
      // Crea un elemento de imagen
      const iframe = document.createElement("iframe");
      iframe.src = img_path == null ? "../assets/img/cargar_archivo.png" : img_path; // Asigna la iframe cargada como fuente
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      iframe.classList.add("pointer-sm"); // Asignar clases
      //  iframe.classList.add("p-5"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      // iframe.classList.add("text-center"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview.html(""); // Limpia la vista previa antes de agregar la nueva iframe
      preview.append(iframe);
      preview.parent().css("height", "50vh");
      // label_input_file.css("height","100%");
      preview.css("height", "100%");
   }
}

//#region MENUS
const sidebar_menus = $("#sidebar_menus");
const navbar_menus = $("#navbar_menus");
const fillSidebar = async (show_toast = false, navbar = false) => {
   // sidebar_menus.slideUp(1000);
   // console.log("a cargar menus");
   let role_id = Number(Cookies.get("role_id"));
   // role_id=1;
   let data = { op: "showMyMenus", role_id: role_id };
   const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data, false, true, show_toast);
   sidebar_menus.html(null);
   navbar_menus.html(null);
   const objResponse = ajaxResponse.data;
   // console.log(objResponse);
   let menus = "";
   let parent_menus = objResponse.filter((menu) => menu.belongs_to == 0);
   parent_menus = parent_menus.sort().map((parent_menu) => {
      if (navbar) {
         menus += ` <li class="nav-item dropdown text-light">
			<a id="submenus${parent_menu.id}" href="#" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
				class="nav-link dropdown-toggle"><i class="nav-icon ${parent_menu.icon} mr-2"></i> ${parent_menu.menu}
			</a>
			<ul aria-labelledby="submenus${parent_menu.id}" class="dropdown-menu border-0 shadow">
			`;
      } else {
         menus += `
			<li class="nav-item mb-3">
				<a href="#" class="nav-link">
					<i class="nav-icon ${parent_menu.icon}"></i>
					<p>
						${parent_menu.menu}
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>`;
      }
      let children_menus = objResponse.filter((menu) => menu.belongs_to == parent_menu.id);
      children_menus.sort((a, b) => b.order - a.order);
      children_menus.map(async (child_menu) => {
         if (navbar) {
            menus += `
				<li>
					<a href="${PAGES_PATH}/${child_menu.file_path}" class="dropdown-item text-xs"><i class="nav-icon ${child_menu.icon} mr-2"></i> ${child_menu.menu}</a>
				</li>
				`;
         } else {
            menus += `
				<ul class="nav nav-treeview text-sm">
					<li class="nav-item">
						<a href="${PAGES_PATH}/${child_menu.file_path}" class="nav-link">
							<i class="nav-icon ${child_menu.icon} text-sm"></i>
							<p>
								${child_menu.menu}`;
            if (child_menu.show_counter == 1) {
               // const data = {op: "counter"}
               // const ajaxCount = await ajaxRequestAsync(URL_MENU_APP, data, null, null, false);
               // const count = ajaxCount.data;
               menus += `<span class="badge badge-info right notification">0</span>`;
            }
            menus += `</p>
						</a>
					</li>
				</ul>`;
         }
      });
      if (navbar) menus += `</ul>`;
      menus += `</li>`;
   });
   if (navbar) await navbar_menus.append(menus);
   else await sidebar_menus.append(menus);
   // sidebar_menus.slideDown(1000);
   // console.log("menus cargados", menus);
};
if (sidebar_menus.length > 0) fillSidebar();
else if (inIndex) fillSidebar(false, true);

//#endregion

//#region CERRAR SESION
const btn_logout = document.getElementById("btn_logout");
if (btn_logout != null) {
   const i = btn_logout.querySelector("i");

   $("#btn_logout").mouseover(function () {
      i.classList.remove("fa-door-closed");
      i.classList.add("fa-door-open");
   });
   $("#btn_logout").mouseleave(function () {
      i.classList.remove("fa-door-open");
      i.classList.add("fa-door-closed");
   });

   $("#btn_logout").click(async (e) => {
      e.preventDefault();
      let data = { op: "logout" };
      const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);
      if (ajaxResponse.result) window.location.href = `${URL_BASE}/`;
   });
}
//#endregion CERRAR SESION

//#region /** FECHAS - FORMATEADO */
function validateRangeDates(action, input_initial_date, input_final_date) {
   let current_date = new Date();
   yesterday = new Date(current_date.setDate(current_date.getDate() - 1));
   yesterday = new Date(yesterday.setHours(23, 59, 59));
   yesterday = yesterday.getTime();

   date1 = new Date(input_initial_date.val());
   date1 = new Date(date1.setDate(date1.getDate() + 1));
   date1 = new Date(date1.setHours(0, 0, 0));
   data_date1 = new Date(date1).getTime();

   date2 = new Date(input_final_date.val());
   date2 = new Date(date2.setDate(date2.getDate() + 1));
   date2 = new Date(date2.setHours(11, 59, 59));
   data_date2 = new Date(date2).getTime();

   if (action == "create") {
      if (data_date1 <= yesterday) {
         showToast("warning", "No puedes publicar con fecha anterior a hoy.");
         input_initial_date.focus();
         return false;
      }
   }
   if (data_date1 > data_date2) {
      showToast("warning", "Rango de fechas inválido.");
      input_final_date.focus();
      return false;
   }
   return true;
}

function binaryDateTimeFormat(the_date) {
   let date = new Date(parseInt(the_date.substr(6)));
   let datetime = moment(date).format("MM-DD-YYYY h:mm:ss a");
   // let datetime = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric', hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: true }).format(date);

   return datetime;
}

function formatDatetime(the_date, long_format = true) {
   let date = new Date(the_date);
   let datetime;

   if (the_date.length <= 10) {
      date = new Date(date.setDate(date.getDate() + 1));
      return (datetime = moment(date).format("DD-MM-YYYY"));
      // return datetime = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric'}).format(date);
   }

   date = new Date(the_date);
   const formato = long_format ? "DD-MM-YYYY h:mm:ss a" : "DD-MM-YYYY";
   return (datetime = moment(date).format(formato));
   // return datetime = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric', hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: true }).format(date);
}

function formatDatetimeToSQL(the_date) {
   let datetime = moment(the_date).format("YYYY-MM-DDTh:mm:ss");
   return datetime;
}
//#endregion /** FECHAS - FORMATEADO */

//#region /** VALIDACIONES - INPUTS - FORMULARIOS */
function validateInputs(form) {
   let inputs = form.serializeArray();
   let validated = true;
   // console.log(inputs);
   $.each(inputs, function (i, input_iterable) {
      if (!validated) return;
      let input = $(`#${input_iterable.name}`);
      // console.log(input);
      if (!input.hasClass("not_validate")) {
         // console.log(input)
         let input_validated = validateInput(input);
         if (!input_validated) return (validated = false);
      }
      validated = true;
   });
   return validated;
}

function validateInput(input) {
   if (input.val() == "" || input.val() == -1 || input.val() == "-1") {
      showToast("error", `El campo ${input.attr("data-input-name")} esta vacío.`);
      input.addClass("is-invalid");
      input.focus();
      return false;
   }
   input.removeClass("is-invalid");
   return true;
}

if ($(".numeric").length > 0) {
   $(".numeric").numeric();
}
function formatCurrency(amount, MX = true, show_currency = true) {
   let divisa = "MXN";
   let total = new Intl.NumberFormat("es-MX").format(amount);
   if (!MX) {
      divisa = "USD";
      total = new Intl.NumberFormat("en-US").format(amount);
   }

   if (!total.includes(".")) total += ".00";
   let decimales = total.split(".").reverse();
   if (decimales[0].length == 1) total += "0";
   if (amount == 0) total == "0.00";
   show_currency ? (total = `$${total} ${divisa}`) : (total = `$${total}`);

   return total;
}
function formatearCantidadDeRenglones(tds) {
   $.each(tds, function (i, elemento) {
      let td = $(elemento);
      let cantidad = td.text();
      let cantidad_formateada = formatCurrency(cantidad);
      td.html(`${cantidad_formateada}`);
   });
}

function formatPhone(phone) {
   return `${phone.slice(0, 3)} ${phone.slice(3, 6)} ${phone.slice(6, 10)}`;
}
//#endregion /** VALIDACIONES - INPUTS - FORMULARIOS */

//#region /* Select2 */
if ($(".select2").length > 0) {
   // $(".select2").select2(); //(/* { dropdownParent: $("#modal") } */);
   $.fn.select2.defaults.set("language", "es");
}
function focusSelect2(select2) {
   select2.click(function (e) {
      try {
         var searcher = $(".select2-search__field");
         searcher[0].focus();
         searcher[1].focus();
      } catch (e) {}
   });
   select2.keydown(function (e) {
      try {
         var searcher = $(".select2-search__field");
         searcher[0].focus();
         searcher[1].focus();
      } catch (e) {}
   });
}
focusSelect2($(".select2"));

function resetSelect2(selector) {
   // function resetearSelect2(selector, url, data) {
   selector.attr("disabled", true);

   if (selector.data().select2.options.options.multiple) {
      selector.prop("selectedIndex", 0);
      selector.val("-1");
      $(`#select2-${selector[0].name}-container`).attr("title", "Selecciona etiquetas con tús intereses");
      $(`#select2-${selector[0].name}-container`).text("");
      // console.log(selector[0].placeholder);
      selector.attr("disabled", false);
   } else {
      selector.prop("selectedIndex", 0);
      selector.val("-1");
      $(`#select2-${selector[0].name}-container`).text("Selecciona una opción...");
      $(`#select2-${selector[0].name}-container`).attr("title", "Selecciona una opción...");
      selector.attr("disabled", false);
   }

   // iconos(url, data, -1, select2[0].name);
}

async function fillSelect2(url_app, selected_index, selector, select_modules = false, role = null, dataOptions = []) {
   let data = { op: "showSelect" };
   if (role != null) data = { op: "showSelect", role };
   const ajaxResponse = dataOptions.length > 0 ? { data: dataOptions } : await ajaxRequestAsync(url_app, data, null, null, null);

   const objResponse = dataOptions.length > 0 ? dataOptions : ajaxResponse.data;
   // console.log("objResponse",objResponse);
   selector.attr("disabled", true);
   selector.html(`<option value="">Cargando...</option>`);

   let options = /*HTML*/ `
      <option value="-1">Selecciona una opción...</option>
   `;
   // console.log(selector.data().select2);
   if (selector.data().select2) {
      if (selector.data().select2.options.options.multiple) {
         options = /*HTML*/ `
				<option value="-1">Selecciona etiquetas...</option>
			`;
      }
   }
   if (select_modules) {
      options += /*HTML*/ `
      	<option value="0" selected>***** Soy Módulo Padre *****</option>
		`;
   }

   selector.html("");
   selector.append(options);

   $.each(objResponse, function (i, obj) {
      if (obj.value == selected_index) selector.append(`<option selected value='${obj.value}'>${obj.text}</option>`);
      else selector.append(`<option value='${obj.value}'>${obj.text}</option>`);
   });
   selector.attr("disabled", false);
}

//#endregion /* Select2 */

//#region /* DataTables */
const DT_CONFIG = {
   // responsive: true,
   language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
   },
   columnDefs: [
      {
         className: "dt-center",
         targets: "_all"
      }
   ],
   buttons: [
      {
         extend: "excelHtml5",
         text: '<b><i class="fa-solid fa-file-excel"></i>&nbsp; Exportar a Excel</b>',
         className: "btn btn-success" // color verde estilo Bootstrap
      }
   ],
   dom: '<"row mb-2"B><"row"<"col-md-6 "lr> <"col-md-6"f> > rt <"row"<"col-md-6 "i> <"col-md-6"p> >',
   lengthMenu: [
      [5, 10, 50, 100, -1],
      [5, 10, 50, 100, "Todos"]
   ],
   pageLength: 10,
   deferRender: true,
   aaSorting: [] //deshabilitar ordenado automatico
};
$("table thead tr").clone(true).addClass("filters").appendTo("table thead");
DT_CONFIG.orderCellsTop = true;
DT_CONFIG.fixedHeader = true;
DT_CONFIG.initComplete = function () {
   var api = this.api();

   // For each column
   api.columns()
      .eq(0)
      .each(function (colIdx) {
         // Set the header cell to contain the input element
         var cell = $(".filters th").eq($(api.column(colIdx).header()).index());
         var title = $(cell).text();
         $(cell).addClass("bb-primary");
         $(cell).html('<input type="search" class="form-control" placeholder="' + title + '" />');

         // On every keypress in this input
         var cursorPosition;
         $("input", $(".filters th").eq($(api.column(colIdx).header()).index()))
            .off("keyup change")
            .on("change", function (e) {
               // Get the search value
               $(this).attr("title", $(this).val());
               var regexr = "({search})"; //$(this).parents('th').find('select').val();

               cursorPosition = this.selectionStart;
               // Search the column for that value
               api.column(colIdx)
                  .search(this.value != "" ? regexr.replace("{search}", "(((" + this.value + ")))") : "", this.value != "", this.value == "")
                  .draw();
            })
            .on("keyup", function (e) {
               e.stopPropagation();

               $(this).trigger("change");
               $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
            });
      });
};

// if ($("table").length > 0) $("table").DataTable(DT_CONFIG)
//#endregion /* DataTables */

//#region /** MomentJS */
moment.locale("es-mx");
// console.log(moment.locale());
//#endregion /** MonentJS */

// // #endregion FUNCIONES DE CAJON

function resetImgPreviewProfile(preview, img_path = null, iframe = false, pointer = true, logo_empresa = false) {
   if (!iframe || img_path == null) {
      // Crea un elemento de imagen
      const imagen = document.createElement("img");
      iframe
         ? (imagen.src = img_path == null ? "../assets/img/cargar_archivo.png" : img_path) // Asigna la imagen cargada como fuente
         : (imagen.src = img_path == null ? "../assets/img/sin_perfil.webp" : img_path); // Asigna la imagen cargada como fuente
      if (iframe) {
         imagen.classList.add("img-fluid"); // Asignar clases
         pointer ? imagen.classList.add("pointer-sm") : imagen.classList.remove("pointer-sm"); // sAsignar clases
         //  imagen.classList.add("p-5"); // Asignar clases
         !logo_empresa && imagen.classList.add("rounded-lg"); // Asignar clases
         // imagen.classList.add("text-center"); // Asignar clases
         imagen.style = "max-height: 200px !important";
      } else {
         !logo_empresa && imagen.classList.add("img-circle"); // Asignar clases
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
      iframe.src = img_path == null ? "../assets/img/cargar_archivo.png" : img_path; // Asigna la iframe cargada como fuente
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

const removeDuplicates = (array) => {
   return [...new Set(array)];
};

//#region SELECTORES DE PAISES / CIUDADES
async function showStates(zip = 35000, community_id = null) {
   // console.log("🚀 ~ showStates ~ zip:", zip);
   // console.log("🚀 ~ showStates ~ community_id:", community_id);

   $("#input_state").attr("disabled", true);
   $("#input_state").html("<option value=''>Cargando...</option>");
   $("#input_municipality").attr("disabled", true);
   $("#input_municipality").html("<option value=''>Cargando...</option>");
   $("#input_colony").attr("disabled", true);
   $("#input_colony").html("<option value=''>Cargando...</option>");

   // console.log("ESTADOS_CIUDADES");
   let url = `${URL_API_COUNTRIES}/${zip}`;
   if (community_id) url = `${URL_API_COUNTRIES}/colonia/${community_id}`;

   const communitiesRequest = await $.ajax({
      url: url,
      method: "GET",
      headers: {
         Accept: "application/json"
      }
   });
   let communities = Array.isArray(communitiesRequest.data.result) ? communitiesRequest.data.result : [communitiesRequest.data.result];
   const community = {
      zip: "",
      state: "",
      city: "",
      colony: ""
   };
   if (community_id) {
      community.zip = communities[0].CodigoPostal;
      community.state = communities[0].Estado;
      community.city = communities[0].Municipio;
      community.colony = communities[0].Colonia;
   }

   let states = communities.map((item) => item.Estado);
   states = removeDuplicates(states);
   let cities = communities.map((item) => item.Municipio);
   cities = removeDuplicates(cities);
   let colonies = communities.map((item) => {
      return { id: item.id, label: item.Colonia };
   });
   colonies = removeDuplicates(colonies);

   let comboStates = "<option value=''>Seleccionar una opción...</option>";
   states.forEach((element) => {
      let selected_state = "";
      if (states.length > 1) {
         if (community.state != null) {
            if (community.state == element) {
               selected_state = "selected";
            }
         }
      } else selected_state = "selected";
      // console.log(state);
      // $("#input_state").click()
      comboStates += '<option value="' + element + '" ' + selected_state + ">" + element + "</option>";
   });

   let comboCities = "<option value=''>Seleccionar una opción...</option>";
   cities.forEach((element) => {
      let selected_city = "";
      if (cities.length > 1) {
         if (community.city != null) {
            if (community.city == element) {
               selected_city = "selected";
            }
         }
      } else selected_city = "selected";
      // console.log(city);
      // $("#input_city").click()
      comboCities += '<option value="' + element + '" ' + selected_city + ">" + element + "</option>";
   });

   let comboColonies = "<option value=''>Seleccionar una opción...</option>";
   colonies.forEach((element) => {
      let selected_colony = "";
      if (colonies.length > 1) {
         if (community.colony != null) {
            if (community.colony == element.label) {
               selected_colony = "selected";
               $("#input_community_id").val(element.id);
            }
         }
      } else {
         selected_colony = "selected";
         $("#input_community_id").val(element.id);
      }
      // console.log(colony);
      // $("#input_colony").click()
      comboColonies += '<option value="' + element.id + '" ' + selected_colony + ">" + element.label + "</option>";
   });

   if (community_id) $("#input_zip").val(community.zip);
   $("#input_state").html(comboStates);
   $("#input_state").attr("disabled", false);
   $("#input_municipality").html(comboCities);
   $("#input_municipality").attr("disabled", false);
   $("#input_colony").html(comboColonies);
   $("#input_colony").attr("disabled", false);
}

$(".reload_input").click(function () {
   const zip = $(`#input_zip`).val();
   if (zip == "") return showToast("info", "El Código Postal esta vacío");
   showStates(zip);
});

/** OPCION 1 */
// async function showStates(state = null, city = null) {
//    $("#input_state").attr("disabled", true);
//    $("#input_state").html("<option value=''>Cargando...</option>");

//    // console.log("generar token");
//    let requestToken = await $.ajax({
//       async: true,
//       crossDomain: true,
//       url: `${URL_API_COUNTRIES}/getaccesstoken`,
//       method: "GET",
//       headers: {
//          Accept: "application/json",
//          "api-token": "9BlpaH5qgUCOZJjDtIvbDH9BFkZbt40BdC9VQlVEGwkmibb3ubtwPdKWi9ftc6qVENE",
//          "user-email": "deconomico@gomezpalacio.gob.mx"
//       }
//    });
//    // Desarollo Economico - correo y token

//    auth_token = requestToken.auth_token;
//    // console.log(auth_token);

//    // await estados_ciudades(output_estado.text(), output_ciudad.text());
//    await states_cities(state, city);
//    // console.log("ESTADOS_CIUDADES");
//    async function states_cities(state = null, city = null) {
//       let states = await $.ajax({
//          url: `${URL_API_COUNTRIES}/states/México`,
//          method: "GET",
//          headers: {
//             Authorization: `Bearer ${auth_token}`,
//             Accept: "application/json"
//          }
//       });
//       while (states.length < 1) {
//          states = await $.ajax({
//             url: `${URL_API_COUNTRIES}/states/México`,
//             method: "GET",
//             headers: {
//                Authorization: `Bearer ${auth_token}`,
//                Accept: "application/json"
//             }
//          });
//       }
//       let comboStates = "<option value=''>Seleccionar una opción...</option>";
//       states.forEach((element) => {
//          let selected_state = "";
//          if (state != null) {
//             if (state == element[`state_name`]) {
//                selected_state = "selected";
//             }
//          }
//          // console.log(state);
//          // $("#input_state").click()
//          comboStates += '<option value="' + element["state_name"] + '" ' + selected_state + ">" + element["state_name"] + "</option>";
//       });

//       $("#input_state").html(comboStates);
//       $("#input_state").attr("disabled", false);
//       if (city != null) await showCities(state, city);
//    }
// }
// $("#input_state").on("change", async function () {
//    var state = this.value;
//    // console.log(output_estado.text());
//    // console.log(state);
//    showCities(state);
// });
// async function showCities(state, city = null) {
//    $("#input_municipality").attr("disabled", true);
//    $("#input_municipality").html("<option value=''>Cargando...</option>");

//    let cities = await $.ajax({
//       url: `${URL_API_COUNTRIES}/cities/${state}`,
//       method: "GET",
//       headers: {
//          Authorization: `Bearer ${auth_token}`,
//          Accept: "application/json"
//       }
//    });
//    var comboCities = "<option value='' >Selecciona una opción...</option>";
//    cities.forEach((element) => {
//       let selected_city = "";
//       if (city != null) {
//          // console.log("hay ciudad:", city);
//          if (city == element[`city_name`]) {
//             selected_city = "selected";
//          }
//       }
//       comboCities += '<option value="' + element["city_name"] + '" ' + selected_city + ">" + element["city_name"] + "</option>";
//    });
//    $("#input_municipality").html(comboCities);
//    $("#input_municipality").attr("disabled", false);
// }

// $(".reload_input").click(function () {
//    const input = $(`#${$(this).attr("data-input")}`);
//    if (input.attr("id") == "input_state") showStates((state = null), (city = null));
//    else if (input.attr("id") == "input_municipality") showCities($("#input_state").val());
// });
//#endregion SELECTORES DE PAISES / CIUDADES
