//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {
});

// btn_modal_form = $("#btn_modal_form"),
const 
	tbody = $("#table tbody"),
	modal_body = $("#modal-body"),
	form = $("#form"),
	modal_title = $(".modal-title"),
	id_modal = $("#id"),
	op_modal = $("#op"),

	input_user_id = $("#input_user_id"),
   input_photo_path = $('#input_photo_path'), //este es un input_file
   output_photo = $('#output_photo'),
   preview_photo = $('#preview_photo'),
   input_name = $("#input_name"),
   output_name = $("#output_name"),
   input_last_name = $("#input_last_name"),
   output_last_name = $("#output_last_name"),
	input_email = $("#input_email"),
   output_email = $("#output_email"),
   input_cellphone = $("#input_cellphone"),
   output_cellphone = $("#output_cellphone"),
   input_age = $("#input_age"),
   output_age = $("#output_age"),
   input_profession_id = $("#input_profession_id"),
   output_profession = $("#output_profession"),
   input_interest_tags_ids = $("#input_interest_tags_ids"),
   output_interest_tags_ids = $("#output_interest_tags_ids"),
	output_professional_info = $("#output_professional_info");
	input_languages_b = $("#input_languages_b"),
	input_languages_i = $("#input_languages_i"),
	input_languages_a = $("#input_languages_a"),
	output_languages = $("#output_languages"),
	input_cv_path = $('#input_cv_path'), //este es un input_file
   output_cv = $('#output_cv'),
   preview_cv = $('#preview_cv'),
	
	
	
	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset"),
	btn_cancel = $("#btn_cancel"),
	
	input_logo_path = $('#input_logo_path'), //este es un input_file
	label_input_file = $("#label_input_file"),
   preview_logo = $('#preview_logo'),
	input_business_line = $("#input_business_line"),
	
	input_file = $('#input_file'), //este es un input_file
   preview_file = $('#preview_file'),
	
	
//#endregion VARIABLES
// $(".select2").select2();
// focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
	fillInfo(false);
	setTimeout(() => {
      input_business_line.focus();
   }, 500);
}


// Agrega un evento change a la foto de perfil
input_file.on('change', function(event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function(e) {
      // Crea un elemento de imagen
      const iframe = document.createElement('iframe');
      iframe.src = e.target.result; // Asigna la iframe cargada como fuente
		console.log(iframe);
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      // iframe.classList.add("pointer"); // Asignar clases
      //  iframe.classList.add("p-5"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      // iframe.classList.add("text-center"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview_file.html(""); // Limpia la vista previa antes de agregar la nueva iframe
      preview_file.append(iframe);
		label_input_file.css("height","100%");
		preview_file.css("height","90%");
   };

  // Lee el contenido del archivo como una URL de datos
  fileReader.readAsDataURL(file);
});

// Agrega un evento change al elemento de entrada de archivo
input_logo_path.on('change', function(event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function(e) {
      // Crea un elemento de imagen
      const imagen = document.createElement('img');
      imagen.src = e.target.result; // Asigna la imagen cargada como fuente
      // canvas.getContext("2d") // Asigna la imagen cargada como fuente
      imagen.classList.add("img-fluid"); // Asignar clases
      imagen.classList.add("pointer"); // Asignar clases
      //  imagen.classList.add("p-5"); // Asignar clases
      imagen.classList.add("rounded-lg"); // Asignar clases
      // imagen.classList.add("text-center"); // Asignar clases
      imagen.style = "max-height: 200px !important";

      // Agrega la imagen a la vista previa
      preview_logo.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview_logo.append(imagen);
   };

  // Lee el contenido del archivo como una URL de datos
  fileReader.readAsDataURL(file);
});








//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
 btn_cancel.click((e) => {
	e.preventDefault();
	modal_title.html(
		"<i class='fa-regular fa-circle-plus'></i>&nbsp; REGISTRAR GIRO"
	);
	btn_submit.removeClass("btn-primary");
	btn_submit.addClass("btn-success");
	btn_submit.text("AGREGAR");

	btn_cancel.removeClass("btn-success");
	btn_cancel.addClass("btn-danger d-none");
	btn_cancel.text("CANCELAR");

	//Resetear form
	btn_reset.click();
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
	id_modal.val("");
	// setTimeout(() => {
	// 	input_business_line.focus();
	// }, 500);
});


// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
	e.preventDefault();
	// console.log(form.serializeArray());

	if (!validateInputs(form)) return;

	if (id_modal.val() <= 0) {
		//NUEVO
		if (!permission_write) return;
		id_modal.val("");
		op_modal.val("create");
	} else {
		//EDICION
		if (!permission_update) return;
		op_modal.val("edit");
	}

	let data = form.serializeArray();
	// return console.log(data);
	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	if (id_modal.val() <= 0) {
		//NUEVO
		addToArray("created_at", current_date, data);
	} else {
		//EDICION
		addToArray("updated_at", current_date, data);
	}

	// return console.log(data);
	const ajaxResponse = await ajaxRequestAsync(URL_BUSINESS_LINE_APP, data);
	if (ajaxResponse.message == "duplicado") return
	btn_cancel.click();
	await fillTable();
});

async function fillInfo(show_toas=true) {
	let data = { op: "showInfo", id: id_cookie, input_role_id: role_cookie };
	const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data, null, true, show_toas);

	//Limpiar table
	// tbody.slideUp();
	// table.clear().draw();

	let obj = ajaxResponse.data;
	console.log(obj);

	haveImg=false;
	if (obj.photo_path == "" || obj.photo_path == null) resetImgPreview($(`#${input_photo_path.attr("data-preview")}`));
	else {
		haveImg = true;
		// console.log("tengo imagen guardada");
 		resetImgPreview($(`#${input_photo_path.attr("data-preview")}`),`/assets/img/${obj.photo_path}`);
		vLogoPath = obj.photo_path;
		// input_photo_path.val(obj.photo_path);
		output_photo.attr("src", `/assets/img/${obj.photo_path}`)
	}
	// input_name.val(obj.name);
	output_name.text(obj.name);
	// input_last_name.val(obj.last_name);
	output_last_name.text(obj.last_name);
	// input_email.val(obj.email);
	output_email.text(obj.email);
	// input_cellphone.val(obj.cellphone);
	output_cellphone.text(formatPhone(obj.cellphone));
	// input_age.val(obj.age);
	output_age.text(obj.age);
	
	// await fillSelect2(URL_PROFESSION_APP, obj.profession_id, input_profession_id);
	output_profession.text(obj.profession)
	// await fillSelect2(URL_TAG_APP, obj.interest_tags_ids, input_interest_tags_ids);
	// output_interest_tags_ids.text(obj.)
	// if (obj.professional_info == "<p><br></p>" || obj.professional_info.length < 1)
	// 	$('.note-editing-area .note-placeholder').css("display","block");
	// else {
	// 	$('.note-editing-area .note-placeholder').css("display","none");
	// 	$('.note-editing-area .note-editable').html(obj.professional_info);
	// }
	output_professional_info.html(obj.professional_info);

	// switch (obj.languages) {
	// 	case "Inglés - Básico":
	// 		input_languages_b.click();
	// 		break;
	// 	case "Inglés - Intermedio":
	// 		input_languages_i.click();
	// 	case "Inglés - Avanzado":
	// 		input_languages_a.click();
	// 	default:
	// 		break;
	// }
	output_languages.text(obj.languages)
	// await showStates(obj.state, obj.municipality);
	haveCv=false;
	if (obj.cv_path == "" || obj.cv_path == null) resetImgPreview($(`#${input_cv_path.attr("data-preview")}`), null, true );
	else {
		haveCv = true;
		// console.log("tengo imagen guardada");
 		resetImgPreview($(`#${input_cv_path.attr("data-preview")}`),`/assets/img/${obj.cv_path}`, true);
		vCvPath = obj.cv_path;
		// input_cv_path.val(obj.cv_path);
	}


	
	// tbody.slideDown("slow");
	// btn_reset.click();
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
	if (
		$(e.target).hasClass("btn_delete") ||
		$(e.target).hasClass("i_delete")
	) {
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

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function deleteObj(btn_delete) {
	let title = `¿Estas seguro de eliminar el giro <br> ${btn_delete.attr("data-name")}?`;
	let text = ``;

	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	let data = {
		op: "delete",
		id: Number(btn_delete.attr("data-id")),
		deleted_at: current_date,
	};

	ajaxRequestQuestionAsync(
		title,
		text,
		URL_BUSINESS_LINE_APP,
		data,
		"fillTable()"
	);
}