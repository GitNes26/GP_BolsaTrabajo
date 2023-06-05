//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(function() {
	$('.summernote').summernote({
		placeholder: "Escribir requisitos, expreiencias necesarias, beneficios,  prestaciones, observaciones, etc.",
		lang: 'es-ES',
		toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear', 'highlight']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['para', ['ul', 'ol']],
			['insert', ['link']],
			// ['insert', ['link', 'picture', 'video']],
			// ['view', ['codeview']],
		 ],
		 height: 350,
	});
});

// btn_modal_form = $("#btn_modal_form"),
const 
	tbody = $("#table tbody"),
	modal_body = $("#modal-body"),
	form = $("#form"),
	modal_vacancy = $(".modal-vacancy"),
	id_modal = $("#id"),
	op_modal = $("#op"),
   input_vacancy = $("#input_vacancy"),
   counter_vacancy = $("#counter_vacancy"),
   input_company_id = $("#input_company_id"),
   input_area_id = $("#input_area_id"),
   input_description = $("#input_description"),
   counter_description = $("#counter_description"),
   input_min_salary = $("#input_min_salary"),
   input_max_salary = $("#input_max_salary"),
   input_job_type = $("#input_job_type"),
	input_name_job_type = $("[name='input_job_type']"),
	input_job_type_tc = $("#input_job_type_tc"),
	input_job_type_mt = $("#input_job_type_mt"),
	input_job_type_p = $("#input_job_type_p"),
   input_schedules = $("#input_schedules"),
	input_tags_ids = $("#input_tags_ids"),
	input_publication_date = $("#input_publication_date"), 
	input_expiration_date = $("#input_expiration_date"), 

	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset"),
	btn_cancel = $("#btn_cancel");
	
//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
	counter_vacancy.text(`0/${input_vacancy.data("limit")}`);
	counter_description.text(`0/${input_description.data("limit")}`);
	$('.note-editing-area .note-editable').html("")

	fillTable();

	fillSelect2(URL_COMPANY_APP, -1, input_company_id);
	fillSelect2(URL_AREA_APP, -1, input_area_id);
   fillSelect2(URL_TAG_APP, -1, input_tags_ids, false);
	setTimeout(() => {
      input_vacancy.focus();
   }, 1000);
}



//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
btn_cancel.click((e) => {
	e.preventDefault();
	modal_vacancy.html(
		"<i class='fa-regular fa-circle-plus'></i>&nbsp; AGREGAR VACANTE"
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
	$('.note-editing-area .note-editable').html("");
	resetSelect2(input_company_id);
	resetSelect2( input_area_id);
   resetSelect2(input_tags_ids);

	$('.note-editing-area .note-placeholder').css("display","d-block");

	// PREVIEW
	$(`#${input_vacancy.attr("data-output")}`).text("Vacante");
	$(`#${input_company_id.attr("data-output")}`).html(`
		<span>Empresa</span><br>
		<span>Ciudad, Estado</span><br><br>
		<span class="">Descripción de la empresa...</span>
	`);
	$(`#${input_area_id.attr("data-output")}`).text("Área");
	$(`#${input_description.attr("data-output")}`).text("Descripción de la vacante...");
	$(`#${input_min_salary.attr("data-output")}`).text("$0");
	$(`#${input_max_salary.attr("data-output")}`).text("$0");
	$(`#${input_name_job_type.attr("data-output")}`).text("Tiempo completo");
	$(`#${input_schedules.attr("data-output")}`).html("8 horas &nbsp;-&nbsp; Lunes a viernes");
	$(`#output_more_info`).html(`
		<i>LA INFORMACION A CONTINUACIÓIN ES SOLO DE EJEMPLO, 
		NO SE GUARDARA A MENOS QUE ESCRIBA ALGO EN EL APARTADO DE <b>Más información</b></i>
		<p class="">
			<span class="fw-bolder">Requisitos</span>
			<ul class="" id="output_requirements">
				<li>Requerimiento 1</li>
				<li>Requerimiento 1</li>
				<li>Requerimiento 1</li>
			</ul>
		</p>
		<p class="">
			<span class="fw-bolder">Expriencia necesaria</span>
			<ul class="" id="output_necessary_experience">
				<li>Experiencias 1</li>
				<li>Experiencias 1</li>
				<li>Experiencias 1</li>
			</ul>
		</p>
		<!-- ./ DETALLES DEL EMPELO -->
		<hr>
		<p class="">
			<span class="fw-bolder">Beneficios</span>
			<ul class="" id="output_benefits">
				<li>Beneficio 1</li>
				<li>Beneficio 1</li>
				<li>Beneficio 1</li>
			</ul>
		</p>
	`);

	// setTimeout(() => {
	// 	input_area.focus();
	// }, 500);
});


// AGREGAR O EDITAR OBJETO
form.on("submit", async (e) => {
	e.preventDefault();
	const input_more_info = $('.note-editing-area .note-editable').html();
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
	addToArray("input_more_info", input_more_info, data);
	addToArray("input_tags_ids", input_tags_ids.val().join(","), data);
	data[10].value = `${data[10].value}:00:00:00`;
	data[11].value = `${data[11].value}:23:59:59`;

	// return console.log(data);
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);
	if (ajaxResponse.message == "duplicado") return
	btn_cancel.click();
	await fillTable();
});

async function fillTable(show_toas=true) {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data, null, true, show_toas);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	// console.log(objResponse);

	objResponse.map((obj) => {
		//Campos
		let 
			column_vacancy = `${obj.vacancy}`;
			column_company = `${obj.company}`;
			column_salary = `${formatCurrency(obj.min_salary)} &nbsp;-&nbsp; ${formatCurrency(obj.max_salary)}`;
			column_job_type = `${obj.job_type}`;

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Vacante' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-regular fa-pen-to-square fa-lg i_edit'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.id}' title='Eliminar Vacante' data-name='${obj.vacancy}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
		}
		column_buttons += `</div>
					</td>`;

		list.push([
			column_vacancy,
			column_company,
			column_salary,
			column_job_type,
			column_buttons,
		]);		
	});
	//Dibujar Tabla
	await table.rows
	.add(list)
	.draw();
	await table.columns.adjust().draw();
	tbody.slideDown("slow");
	btn_reset.click();
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
	modal_vacancy.html("<i class='fa-light fa-pen-to-square'></i>&nbsp; EDITAR VACANTE");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");

	btn_cancel.removeClass("btn-danger d-none");
	btn_cancel.addClass("btn-danger");
	btn_cancel.text("CANCELAR");

	btn_reset.click();

	let id_obj = btn_edit.attr("data-id");
	let data = { id: id_obj, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);

	const obj = ajaxResponse.data;
	// console.log(obj);

	//form
	id_modal.val(Number(obj.id));
	input_vacancy.val(obj.vacancy);
	countLetter(input_vacancy, input_vacancy.attr("data-counter"), input_vacancy.val().length, Number(input_vacancy.data("limit")));
	fillSelect2(URL_COMPANY_APP, obj.company_id, input_company_id);
	fillSelect2(URL_AREA_APP, obj.area_id, input_area_id);
	input_description.val(obj.description);
	countLetter(input_description, input_description.attr("data-counter"), input_description.val().length, Number(input_description.data("limit")));
	input_min_salary.val(obj.min_salary);
	input_max_salary.val(obj.max_salary);
	switch (obj.job_type) {
		case "Tiempo completo":
			input_job_type_tc.click();
			break;
		case "Medio tiempo":
			input_job_type_mt.click();
		case "Prácticas":
			input_job_type_p.click();
		default:
			break;
	}
	input_schedules.val(obj.schedules);
	$('.note-editing-area .note-placeholder').css("display","none");
	$('.note-editing-area .note-editable').html(obj.more_info);
	input_publication_date.val(moment(obj.publication_date).format("Y-MM-DD"));
	input_expiration_date.val(moment(obj.expiration_date).format("Y-MM-DD"));
	input_tags_ids.val(4);

	// PREVIEW
	$(`#${input_vacancy.attr("data-output")}`).text(obj.vacancy);
	data = { op: "show", id: obj.company_id }
	const ajaxResponseCompany = await ajaxRequestAsync(URL_COMPANY_APP, data);
	const objCompany = ajaxResponseCompany.data
	$(`#${input_company_id.attr("data-output")}`).html(`
		<span>${objCompany.company}</span><br>
		<span>${objCompany.municipality}, ${objCompany.state}</span><br><br>
		<span class="">${objCompany.description}</span>
	`);
	$(`#${input_area_id.attr("data-output")}`).text($(`#input_area_id option:selected`).text());
	$(`#${input_description.attr("data-output")}`).text(obj.description);
	$(`#${input_min_salary.attr("data-output")}`).text(formatCurrency(obj.min_salary));
	$(`#${input_max_salary.attr("data-output")}`).text(formatCurrency(obj.max_salary));
	$(`#${input_name_job_type.attr("data-output")}`).text(obj.job_type);
	$(`#${input_schedules.attr("data-output")}`).text(obj.schedules);
	$(`#output_more_info`).html(obj.more_info);

	setTimeout(() => {
		input_vacancy.focus();
	}, 500);

	
}

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function deleteObj(btn_delete) {
	let title = `¿Estas seguro de eliminar la vacante de <br> ${btn_delete.attr("data-name")}?`;
	let text = ``;

	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	let data = {
		op: "delete",
		id: Number(btn_delete.attr("data-id")),
		deleted_at: current_date,
	};

	ajaxRequestDeleteAsync(
		title,
		text,
		URL_VACANCY_APP,
		data,
		"fillTable()"
	);
}


// #region EDICION DE LA VISTA PREVIA EN TIEMPO REAL
input_vacancy.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.text(this.value);
	if (this.value == "") output.text("Vacante")
});
input_company_id.on("input change", async function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	const data = { op: "show", id: this.value	}
	const ajaxResponse = await ajaxRequestAsync(URL_COMPANY_APP, data);
	const obj = ajaxResponse.data
	output.html(`
		<span>${obj.company}</span><br>
		<span>${obj.municipality}, ${obj.state}</span><br><br>
		<span class="">${obj.description}</span>
	`);
	if (this.value == "") output.html(`
		<span>Empresa</span><br>
		<span>Ciudad, Estado</span>
		<p class="">Descripción de la empresa...</p>
	`);
});
input_area_id.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.text(this[this.value].innerHTML);
	if (this.value == "") output.text("Área");
});
input_description.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.html(this.value);
	if (this.value == "") output.text("Descripción de la vacante...")
});
input_min_salary.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.html(formatCurrency(this.value));
	if (this.value == "") output.text("$0")
});
input_max_salary.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.html(formatCurrency(this.value));
	if (this.value == "") output.text("$0");
});
input_name_job_type.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.html(this.value);
	if (this.value == "") output.text("Tiempo completo");
});
input_schedules.on("input change", function() {
	const output = $(`#${this.getAttribute("data-output")}`);
	output.html(this.value);
	if (this.value == "") output.html("8 horas &nbsp;-&nbsp; Lunes a viernes");
});
form.on("input change", function() {
	const output = $(`#output_more_info`);
	const more_info = $('.note-editing-area .note-editable').html();
	output.html(more_info);
	if (more_info == "") output.html(`
		<i>LA INFORMACION A CONTINUACIÓIN ES SOLO DE EJEMPLO, 
		NO SE GUARDARA A MENOS QUE ESCRIBA ALGO EN EL APARTADO DE <b>Más información</b></i>
		<p class="">
			<span class="fw-bolder">Requisitos</span>
			<ul class="" id="output_requirements">
				<li>Requerimiento 1</li>
				<li>Requerimiento 1</li>
				<li>Requerimiento 1</li>
			</ul>
		</p>
		<p class="">
			<span class="fw-bolder">Expriencia necesaria</span>
			<ul class="" id="output_necessary_experience">
				<li>Experiencias 1</li>
				<li>Experiencias 1</li>
				<li>Experiencias 1</li>
			</ul>
		</p>
		<!-- ./ DETALLES DEL EMPELO -->
		<hr>
		<p class="">
			<span class="fw-bolder">Beneficios</span>
			<ul class="" id="output_benefits">
				<li>Beneficio 1</li>
				<li>Beneficio 1</li>
				<li>Beneficio 1</li>
			</ul>
		</p>
	`);
});

// #endregion EDICION DE LA VISTA PREVIA EN TIEMPO REAL