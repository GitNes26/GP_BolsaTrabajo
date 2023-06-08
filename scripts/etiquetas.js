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
	input_tag = $("#input_tag"),

	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset"),
	btn_cancel = $("#btn_cancel");
	
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
      input_tag.focus();
   }, 500);
}



//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
 btn_cancel.click((e) => {
	e.preventDefault();
	modal_title.html(
		"<i class='fa-regular fa-circle-plus'></i>&nbsp; REGISTRAR ETIQUETA"
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
	// 	input_tag.focus();
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
	const ajaxResponse = await ajaxRequestAsync(URL_TAG_APP, data);
	if (ajaxResponse.message == "duplicado") return
	btn_cancel.click();
	await fillTable();
});

async function fillTable(show_toas=true) {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_TAG_APP, data, null, true, show_toas);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	// console.log(objResponse);

	objResponse.map((obj) => {
		//Campos
		let 
			column_tag = `${obj.tag}`;

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Etiqueta' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-regular fa-pen-to-square fa-lg i_edit'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.id}' title='Eliminar Etiqueta' data-name='${obj.tag}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
		}
		column_buttons += `</div>
					</td>`;

		list.push([
			column_tag,
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
	modal_title.html("<i class='fa-light fa-pen-to-square'></i>&nbsp; EDITAR ETIQUETA");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");

	btn_cancel.removeClass("btn-danger d-none");
	btn_cancel.addClass("btn-danger");
	btn_cancel.text("CANCELAR");

	btn_reset.click();

	let id_obj = btn_edit.attr("data-id");
	let data = { id: id_obj, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_TAG_APP, data);

	const obj = ajaxResponse.data;
	//form
	id_modal.val(Number(obj.id));
	input_tag.val(obj.tag);

	setTimeout(() => {
		input_tag.focus();
	}, 500);
}

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function deleteObj(btn_delete) {
	let title = `¿Estas seguro de eliminar la etiqueta <br> ${btn_delete.attr("data-name")}?`;
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
		URL_TAG_APP,
		data,
		"fillTable()"
	);
}