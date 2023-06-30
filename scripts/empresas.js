//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {

});

const 
	btn_modal_form = $("#btn_modal_form"),
	tbody = $("#table tbody"),
	modal_body = $("#modal-body"),
	form = $("#form"),
	modal_title = $(".modal-title"),
	id_modal = $("#id"),
	op_modal = $("#op"),
	input_user_id = $("#input_user_id"),
	input_company = $("#input_company"),
   input_description = $("#input_description"),
   counter_description = $("#counter_description"),
   input_logo_path = $('#input_logo_path'), //este es un input_file
   output_logo = $('#output_logo'),
   preview_logo = $('#preview_logo'),
   input_business_line_id = $("#input_business_line_id"),
   input_company_ranking_id = $("#input_company_ranking_id"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
   input_contact_name = $("#input_contact_name"),
   input_contact_phone = $("#input_contact_phone"),
   input_contact_email = $("#input_contact_email"),
	
	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset")
	;
let haveImg = false;
let vLogoPath = null;
//#endregion VARIABLES
$(".select2").select2({ dropdownParent: $("#modal") });
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {

	fillTable();
	counter_description.text(`0/${input_description.data("limit")}`);
   showStates();
   fillSelect2(URL_USER_APP, -1, input_user_id, false);

   fillSelect2(URL_BUSINESS_LINE_APP, -1, input_business_line_id, false);
   fillSelect2(URL_COMPANY_RANKING_APP, -1, input_company_ranking_id, false);
   // fillSelect2(URL_TAG_APP, -1, input_interest_tags_ids, false);
	// resetImgPreview(preview_logo);
   input_company.focus();
}



//CLICK EN BTN ABRIR MODAL
btn_modal_form.click((e) => {
	e.preventDefault();

	modal_title.html(
		"<i class='fa-solid fa-circle-plus'></i></i>&nbsp; REGISTRAR EMPRESA"
	);
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
	await resetSelect2(input_business_line_id);
	await resetSelect2(input_company_ranking_id);
	// await resetSelect2(input_interest_tags_ids);
	await resetSelect2(input_state);
	await resetSelect2(input_municipality);
   input_municipality.attr("disabled",true);

	// $('.note-editing-area .note-editable').html(null);
	// $('.note-editing-area .note-placeholder').css("display","block");
	resetImgPreview($(`#${input_logo_path.attr("data-preview")}`));
	
	id_modal.val("");
	setTimeout(() => {
		input_user_id.focus();
	}, 500);
});


// Agrega un evento change al elemento de entrada de archivo
input_logo_path.on('change', function(event) {
	// Obtén el archivo seleccionado
	const file = event.target.files[0];
	// Crea un objeto FileReader
	const fileReader = new FileReader();
	const preview = $(`#${input_logo_path.attr("data-preview")}`);

	// Define la función de carga completada del lector
	fileReader.onload = function(e) {
		// Crea un elemento de imagen
		const imagen = document.createElement('img');
		imagen.src = e.target.result; // Asigna la imagen cargada como fuente
		imagen.classList.add("img-fluid"); // Asignar clases
		imagen.classList.add("pointer-sm"); // Asignar clases
		//  imagen.classList.add("p-5"); // Asignar clases
		imagen.classList.add("rounded-lg"); // Asignar clases
		// imagen.classList.add("text-center"); // Asignar clases
		imagen.style = "max-height: 200px !important";

		// Agrega la imagen a la vista previa
		preview.html(""); // Limpia la vista previa antes de agregar la nueva imagen
		preview.append(imagen);
	};

	if (file == undefined) resetImgPreview(preview);

 // Lee el contenido del archivo como una URL de datos
 fileReader.readAsDataURL(file);
});



// REGISTRAR O EDITAR OBJETO
form.on("submit", async function(e) {
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
	// console.log(typeof(data));

	// return console.log(data);
	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	// const input_current_date = $('.note-editing-area .note-editable').html();
	// addToArray("input_professional_info", input_current_date, data);

	let data = new FormData(this);
	// console.log(typeof(data));
	// data.append("updated_at", current_date)
	if (id_modal.val() <= 0) {
	// 	//NUEVO
		addToArray("created_at", current_date, data, true);
		
	} else {
		//EDICION
		addToArray("updated_at", current_date, data, true);

		// addToArray("haveImg", haveImg, data);
		if (haveImg) addToArray("haveImg", vLogoPath, data, true);
	}
	// console.log([...data]);
	// console.log("disabled:",input_user_id.attr("disabled"));
	// if (input_user_id.attr("disabled")) await input_user_id.removeAttr("disabled"); 
	// console.log("disabled:",input_user_id.attr("disabled"));
	// return console.log(data);
	// const form_imagen = $("#form")[0];
	
	const ajaxResponse = await ajaxRequestFileAsync(URL_COMPANY_APP, data);
	if (ajaxResponse.message == "duplicado") return;
	if (id_modal.val() == id_cookie) fillSidebar();
	fillTable();
});

async function fillTable() {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_COMPANY_APP, data);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	// return console.log(objResponse);

	objResponse.map((obj) => {
		//Campos
		let 
			column_logo = (obj.logo_path == "" || obj.logo_path == null)  ? `<img class="img-fluid rounded-lg" src="/assets/img/cargar_imagen.png" style="max-height: 150px !important;" />` : `<img class="img-fluid rounded-lg" src="/assets/img/${obj.logo_path}" style="max-height: 150px !important;" />`,
			column_company = `
				<b>${obj.company}</b><br>
				${obj.municipality}, ${obj.state}<br><br>

				<b>${obj.email}</b>
			`,
			column_contact = `
				<i class="fa-solid fa-id-badge"></i>&nbsp; <b>${obj.contact_name}</b><br>
				<i class="fa-solid fa-phone-office"></i>&nbsp; ${obj.contact_phone}<br>
				<i class="fa-solid fa-at"></i>&nbsp; ${obj.contact_email}
			`,
			column_business_line = `
				${obj.business_line}
			`,
			column_company_ranking = `
				<b>${obj.company_ranking}</b><br>
				${obj.cr_description}
			`,
			column_created_at = formatDatetime(obj.created_at, true);

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Empresa' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-pen-to-square fa-lg i_edit'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.user_id}' title='Eliminar Empresa' data-name='${obj.company}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
		}
		column_buttons += `</div>
         </td>`;

		list.push([
			column_logo,
			column_company,
			column_contact,
			column_business_line,
			column_company_ranking,
			column_created_at,
			column_buttons,
		]);		
	});
	//Dibujar Tabla
	table.rows
	.add(list)
	.draw();
	table.columns.adjust().draw();
	tbody.slideDown("slow");
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

		$("#div_new_password").show();
		$("#input_new_password").prop("readonly", true);
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
	modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR EMPRESA");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");

	//EXCLUIR INPUTS PARA VALIDAR


	// btn_submit.attr("disabled",true);
	// btn_reset.attr("disabled",true);
	
	let id_obj = btn_edit.attr("data-id");
	let data = { id: id_obj, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_COMPANY_APP, data);

	const obj = ajaxResponse.data;
	// console.log(obj);
	//form
	id_modal.val(Number(obj.id));
	/* await */ fillSelect2(URL_USER_APP, obj.user_id, input_user_id);
	// input_user_id.attr("disabled", true);
	haveImg=false;
	if (obj.logo_path == "" || obj.logo_path == null) resetImgPreview($(`#${input_logo_path.attr("data-preview")}`) );
	else {
		haveImg = true;
		// console.log("tengo imagen guardada");
 		resetImgPreview($(`#${input_logo_path.attr("data-preview")}`),`/assets/img/${obj.logo_path}`);
		vLogoPath = obj.logo_path;
		// input_logo_path.val(obj.logo_path);
	}
	input_company.val(obj.company);
	input_description.val(obj.description);
	/* await */ fillSelect2(URL_BUSINESS_LINE_APP, obj.business_line_id, input_business_line_id);
	/* await */ fillSelect2(URL_COMPANY_RANKING_APP, obj.company_ranking_id, input_company_ranking_id);
	input_contact_name.val(obj.contact_name);
	input_contact_phone.val(obj.contact_phone);
	input_contact_email.val(obj.contact_email);
	/* await */ showStates(obj.state, obj.municipality);
	
	setTimeout(() => {
		// btn_submit.attr("disabled",false);
		// btn_reset.attr("disabled",false);
		input_company.focus();
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
		deleted_at: current_date,
	};

	ajaxRequestQuestionAsync(
		title,
		text,
		URL_COMPANY_APP,
		data,
		"fillTable()"
	);
}