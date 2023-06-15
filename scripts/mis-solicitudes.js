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
	input_area = $("#input_area")
	;

	// btn_submit = $("#btn_submit"),
	// btn_reset = $("#btn_reset"),
	btns_cancel = $(".btn_cancel");
	
//#endregion VARIABLES
// $(".select2").select2();
// focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
	fillTable();
	setTimeout(() => {
      input_area.focus();
   }, 500);
}


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
	const ajaxResponse = await ajaxRequestAsync(URL_APPLICATION_APP, data);
	if (ajaxResponse.message == "duplicado") return
	await fillTable();
});

async function fillTable(show_toas=true) {
	let data = { op: "myApplications", user_id: id_cookie };
	const ajaxResponse = await ajaxRequestAsync(URL_APPLICATION_APP, data, null, true, show_toas);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	// console.log(objResponse);

	objResponse.map((obj) => {
		switch (obj.status) {
			case 'Pendiente':
				bg_badge = "bg-secondary";
				icon = `<i class="fa-thin fa-paper-plane"></i>`;
				break;
			case 'Recibida':
				bg_badge = "bg-info";
				icon = `<i class="fa-thin fa-check-to-slot"></i>`;
				break;
			case 'En evaluación':
				bg_badge = "bg-primary";
				icon = ``;
				break;
			case 'Aceptada':
				bg_badge = "bg-success";
				icon = `<i class="fa-thin fa-file-check"></i>`;
				icon = `<i class="fa-thin fa-thumbs-up"></i>`;
				break;
			case 'Rechazada':
				bg_badge = "bg-danger";
				icon = `<i class="fa-thin fa-thumbs-down"></i>`;
				break;
			case 'Cancelada':
				bg_badge = "bg-danger";
				icon = `<i class="fa-sharp fa-light fa-ban"></i>`;
				break;
			default:
				bg_badge ="";
				icon = ``;
				break;
		}
		let status = `<span class="badge ${bg_badge}">${icon} &nbsp; ${obj.status}</span>`;
		//Campos
		let 
			column_vacancy = `
				<b>${obj.vacancy}</b><br><br>
				<b>${obj.company}</b><br>
				${obj.municipality}, ${obj.state}<br>
			`;
			column_info = `
				${obj.description}<b>
				<div class="mb-2">
                  <i class="fa-regular fa-money-bill-1-wave"></i>&nbsp; 
                  <span class="fw-bolder">&nbsp;</span> 
                  <span class="">$${obj.min_salary}</span> &nbsp;a&nbsp; 
                  <span class="">$${obj.max_salary}</span>
               </div>
               <div class="mb-2">
                  <i class="fa-solid fa-briefcase"></i>&nbsp; 
                  <span class="fw-bolder">&nbsp;</span> 
                  <span class="">${obj.job_type}</span>
               </div>
               <div class="mb-2">
                  <i class="fa-sharp fa-regular fa-timer"></i>&nbsp; 
                  <span class="fw-bolder">&nbsp;</span> 
                  <span class="">${obj.schedules}</span>
               </div>
			`;
			column_flow = `
				<i>Aqui ira una linea de flujo</i><br><br>
				${status}
			`;
			console.log("permission_update",permission_update);

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary' type='button' data-id='${obj.id}' onclick="showDetail(${obj.v_id})" title='Mostrar Vacante' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-eye'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_cancel' type='button' data-id='${obj.a_id}' onclick="cancel(this)" title='Cancelar Solicitud' data-name='${obj.vacancy}'><i class='fa-solid fa-ban'></i></button>`;
		}
		column_buttons += `</div>
					</td>`;

		list.push([
			column_vacancy,
			column_info,
			column_flow,
			column_buttons,
		]);		
	});
	//Dibujar Tabla
	await table.rows
	.add(list)
	.draw();
	await table.columns.adjust().draw();
	tbody.slideDown("slow");
}

//ACCIONES EN BOTONES DE LA TABLA
// tbody.click((e) => {
// 	// console.log(e.target);
// 	e.preventDefault();

// 	//EDITAR OBJETO
// 	if ($(e.target).hasClass("btn_edit") || $(e.target).hasClass("i_edit")) {
// 		let btn_edit;

// 		if ($(e.target).hasClass("i_edit")) {
// 			btn_edit = $(e.target).parent();
// 		} else {
// 			btn_edit = $(e.target);
// 		}

// 		editObj(btn_edit);
// 	}

// 	//ELIMINAR OBJETO
// 	if (
// 		$(e.target).hasClass("btn_delete") ||
// 		$(e.target).hasClass("i_delete")
// 	) {
// 		let btn_delete;

// 		if ($(e.target).hasClass("i_delete")) {
// 			btn_delete = $(e.target).parent();
// 		} else {
// 			btn_delete = $(e.target);
// 		}

// 		deleteObj(btn_delete);
// 	}
// });

//EDITAR OBJETO
async function showDetail(id) {
	modal_title.html("<i class='fa-solid fa-memo-circle-info'></i>&nbsp; DETALLE DE LA VACANTE");

	let data = { id, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);

	const obj = ajaxResponse.data;
	// console.log(obj);

	// PREVIEW
	$(`.output_vacancy`).text(obj.vacancy);
	data = { op: "show", id: obj.company_id }
	const ajaxResponseCompany = await ajaxRequestAsync(URL_COMPANY_APP, data);
	const objCompany = ajaxResponseCompany.data
	$(`.output_info_company`).html(`
		<span>${objCompany.company}</span><br>
		<span>${objCompany.municipality}, ${objCompany.state}</span><br><br>
		<span class="">${objCompany.description}</span>
	`);
	$(`.output_area`).text(obj.area);
	$(`.output_description`).text(obj.description);
	$(`.output_min_salary`).text(formatCurrency(obj.min_salary));
	$(`.output_max_salary`).text(formatCurrency(obj.max_salary));
	$(`.output_job_type`).text(obj.job_type);
	$(`.output_schedules`).text(obj.schedules);
	$(`.output_more_info`).html(obj.more_info);
	btns_cancel.attr("data-id", obj.id);
	btns_cancel.attr("data-name", obj.vacancy);
}

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function cancel(btn_cancel_js) {
	const btn_cancel = $(btn_cancel_js)
	let title = `¿Estas seguro de cancelar tu solicitud de <br> ${btn_cancel.attr("data-name")}?`;
	let text = ``;

	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	let data = {
		op: "cancel",
		id: Number(btn_cancel.attr("data-id")),
		deleted_at: current_date,
	};

	ajaxRequestQuestionAsync(title, text, URL_APPLICATION_APP, data, "fillTable()");
}