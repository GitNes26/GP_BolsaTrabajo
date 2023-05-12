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
	input_menu = $("#input_menu"),
	input_description = $("#input_description"),
	input_tag = $("#input_tag"),
	input_belongs_to = $("#input_belongs_to"),
	input_file_path = $("#input_file_path"),
	input_icon = $("#input_icon"),
	input_active = $("#input_active"),
	label_module_enable = $("#label_module_enable"),

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
	fillTable();
	fillSelect2(URL_MENU_APP, -1, input_belongs_to);
	setTimeout(() => {
      input_menu.focus();
   }, 500);
}



//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
 btn_cancel.click((e) => {
	e.preventDefault();
	// modal_title.html(
	// 	"<i class='fa-solid fa-user-pen'></i></i>&nbsp; REGISTRAR USUARIO"
	// );
	btn_submit.removeClass("btn-primary");
	btn_submit.addClass("btn-success");
	btn_submit.text("AGREGAR");

	//Resetear form
	btn_reset.click();
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
	label_module_enable.text("Activo")
	await resetSelect2(input_belongs_to);
	id_modal.val("");
	setTimeout(() => {
		input_menu.focus();
	}, 500);
});

// SWITCH HABILITADO/DESAHBILITADO
function switchEnabled(status) {
   if (status) input_active.is(":checked") ? null : input_active.click()
   else input_active.is(":checked") ? input_active.click() : null 
}
input_active.change(() => input_active.is(":checked") ? label_module_enable.text("Enabled") : label_module_enable.text("Disabled"))


// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
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
	const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP,data);
	console.log(ajaxResponse.message);
	// if (ajaxResponse.message != "duplicado") fillTable();
	fillTable();
	fillSidebar();
});

async function fillTable() {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	console.log(objResponse);

	objResponse.map((obj) => {
		let active_icon = "fa-light fa-circle-check";
      let icon_color = "green";
      let switch_enabled = {
         color: "secondary",
         title: "No Activo",
         icon: "fa-light fa-toggle-off"
      }

		if(!Boolean(Number(obj.active))) {
         active_icon="fa-light fa-circle-xmark"; icon_color="red"
         switch_enabled.color="success"
         switch_enabled.title="Activo"
         switch_enabled.icon="fa-solid fa-toggle-on"
      }

		//Campos
		let 
			column_icon = `
			<td class='align-middle align-middle'>
				<i class="${obj.icon} fa-2x icono"></i><br>
				<i>${obj.icon}</i>
			</td>
			`,
			column_module = `
			<b>${obj.menu}</b><br>
			<i>tag: ${obj.tag}</i>
			`,
			column_info = `
			<td class="text-center">
				<p class="">
					belongs to: <b>${!obj.belongs_to ? "-" : obj.parent_menu}</b><br>
					Order: <b>${obj.order}</b><br>
					File Path: <b>${!obj.file_path ? "-" : obj.file_path}</b>
				</p>
			</td>
			`,
			column_active = `
			<div class="text-center align-middle">
				<i class="${active_icon} fa-2x icono" style="color:${icon_color}"></i>
			</div>
			`;

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Módulo' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-regular fa-pen-to-square fa-lg i_edit'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-${switch_enabled.color} btn_delete' type='button' data-id='${obj.id}' title='${switch_enabled.title}' data-active='${obj.active}'><i class='${switch_enabled.icon} fa-2x i_delete'></i></button>`;
     
		}
		column_buttons += `</div>
         </td>`;

		list.push([
			column_icon,
			column_module,
			column_info,
			column_active,
			column_buttons,
		]);		
	});
	//Dibujar Tabla
	table.rows
	.add(list)
	.draw();
	table.columns.adjust().draw();
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
	// modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR USUARIO");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");

	btn_reset.click();

	let id_obj = btn_edit.attr("data-id");
	let data = { id: id_obj, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data);

	const obj = ajaxResponse.data;
	//form
	id_modal.val(Number(obj.id));
	input_menu.val(obj.menu);
	input_description.val(obj.description);
	input_tag.val(obj.tag);
	input_file_path.val(obj.file_path);
	input_icon.val(obj.icon);
	// await (URL_MENU_APP, obj.belongs_to, input_belongs_to);
	switchEnabled(Boolean(Number(obj.active)))
	label_module_enable.text("Activo");

	setTimeout(() => {
		input_menu.focus();
	}, 500);
}

//ELIMINAR OBJETO
async function deleteObj(btn_delete) {
	let title = `¿Estas seguro de eliminar a <br> ${btn_delete.attr("data-name")}?`;
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
		URL_USER_APP,
		data,
		"fillTable()"
	);
}