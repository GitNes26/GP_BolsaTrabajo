var table;
console.log("el scripts de usurios.js");
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {
	$("#div_new_password").hide();
	$("#input_new_password").prop("readonly", true);
});

const btn_modal_form = $("#btn_modal_form"),
	tbody = $("#table tbody"),
	modal_body = $("#modal-body"),
	form = $("#form"),
	modal_title = $(".modal-title"),
	id_modal = $("#id"),
	op_modal = $("#op"),
	input_name = $("#input_name"),
	input_last_name = $("#input_last_name"),
	input_cellphone = $("#input_cellphone"),
	input_correo = $("#input_correo"),
	div_password = $("#div_password"),
	input_password = $("#input_password"),
	input_confirm_password = $("#input_confirm_password"),
	feedback_password = $("#feedback_password"),
	div_new_password = $("#div_new_password"),
	input_new_password = $("#input_new_password"),
	switch_new_password = $("#switch_new_password"),
	input_role_id = $("#input_role_id"),
	
	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset");
	
$(".select2").select2({ dropdownParent: $("#modal") });
focusSelect2($(".select2"));
/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
function init() {
	fillTable();

	let data = { op: "showSelect" };
	// fillSelect2(URL_ROLE_APP, data, -1, "input_role_id");
}

// CONFIRMAR CONTRASEÑA
input_confirm_password.on("input", function () {
	var pwd1 = input_password.val();
	var pwd2 = input_confirm_password.val();

	if (pwd1 === pwd2) {
		feedback_password
			.addClass("text-success")
			.text("Password match")
			.removeClass("text-danger");
		input_password.addClass("is-valid").removeClass("is-invalid");
		input_confirm_password
			.addClass("is-valid")
			.removeClass("is-invalid");
		btn_submit.prop("disabled", false);
	} else {
		feedback_password
			.addClass("text-danger")
			.text("Passwords don't match")
			.removeClass("text-success");
		input_password.addClass("is-invalid").removeClass("is-valid");
		input_confirm_password
			.addClass("is-invalid")
			.removeClass("is-valid");
		btn_submit.prop("disabled", true);
	}
});

//CAMBIAR CONTRASEÑA - SWITCH
switch_new_password.click(() => {
	if (switch_new_password.is(":checked")) {
		input_new_password.prop("readonly", false);
	} else {
		input_new_password.val("");
		input_new_password.prop("readonly", true);
	}
});

//CLICK EN BTN ABRIR MODAL
btn_modal_form.click((e) => {
	e.preventDefault();
	console.log("hola");
	$("#div_new_password").hide();
	$("#input_new_password").prop("readonly", true);

	modal_title.html(
		"<i class='fa-solid fa-user-pen'></i></i>&nbsp; REGISTRAR USUARIO"
	);
	btn_submit.removeClass("btn-primary");
	btn_submit.addClass("btn-success");
	btn_submit.text("AGREGAR");
	div_new_password.hide();
	div_password.show();

	//Resetear form
	btn_reset.click();

	//EXCLUIR INPUTS PARA VALIDAR
	input_new_password.addClass("not_validate");
	input_password.removeClass("not_validate");
	input_confirm_password.removeClass("not_validate");

	// input_name.val("nuevo");
	// input_correo.val("nuevo@gmial.com");
	// input_password.val("1");
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
	input_password.removeClass("is-invalid is-valid");
	input_confirm_password.removeClass("is-invalid is-valid");
	feedback_password.text("").removeClass("text-danger text-success");
	btn_submit.prop("disabled", false);

	//EXCLUIR INPUTS PARA VALIDAR
	input_new_password.addClass("not_validate");
	input_password.removeClass("not_validate");
	input_confirm_password.removeClass("not_validate");

	// resetSelect2(input_role_id, URL_ROLE_APP, data);
	await resetSelect2(input_role_id);
	let data = { op: "showSelect" };
	const ajaxResponse = await ajaxRequestAsync(URL_ROLE_APP, data);
	await fillSelect2(ajaxResponse, -1, input_role_id);
	id_modal.val("");
	setTimeout(() => {
		input_name.focus();
	}, 500);
});

// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
	e.preventDefault();
	id_modal.addClass("not_validate");
	op_modal.addClass("not_validate");
	input_new_password.addClass("not_validate");

	if (switch_new_password.is(":checked"))
		input_new_password.removeClass("not_validate");
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

	// addToArray("consultor_paquete_id", 2, data);
	// addToArray("consultor_fecha_pago", current_date, data);
	// addToArray("consultor_pagado", true, data);
	// addToArray("tipo_objeto","consultor",data);

	// addToArray("suscriptor_nombre_negocio",vacasCrew,data);
	// addToArray("suscriptor_consultor_id",2,data);
	// addToArray("suscriptor_paquete_id",2,data);
	// addToArray("suscriptor_consultor_viewer",true,data);
	// addToArray("suscriptor_fecha_pago",current_date,data);
	// addToArray("suscriptor_pagado",true,data);
	// addToArray("tipo_objeto", "suscriptor", data);

	console.log(data);
	// return console.log(data);
	// peticionRegistrarEditar(URL_USER_APP,data,fillTable);
	await ajaxRequestAsync(URL_USER_APP,data);
	fillTable();
	if (id_modal.val() == id_cookie) rellenarSideBar();
});

async function fillTable() {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	let objResponse = ajaxResponse.data;
	console.log(objResponse);
	// return console.log(objResponse);

	objResponse.map((obj) => {
		//Campos
		let column_name = `${obj.name} ${obj.last_name}`,
			column_email = `${obj.email}`,
			column_cellphone = `${obj.cellphone}`,
			campo_creado = formatDatetime(obj.created_at, true);

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_editar' type='button' data-id='${obj.id}' title='Edit User' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-user-pen fa-lg i_editar'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_eliminar' type='button' data-id='${obj.id}' title='Delete User' data-nombre='${obj.usuario}'><i class='fa-solid fa-trash-alt i_eliminar'></i></button>`;
		}
		column_buttons += `</div>
         </td>`;

		//Dibujar Tabla
		table.row
			.add([
				column_name,
				column_email,
				column_cellphone,
				campo_creado,
				column_buttons,
			])
			.draw()
			.node();
		table.columns.adjust().draw();
	});
	tbody.slideDown("slow");
}

//ACCIONES EN BOTONES DE LA TABLA
tbody.click((e) => {
	// console.log(e.target);
	e.preventDefault();

	//EDITAR OBJETO
	if ($(e.target).hasClass("btn_editar") || $(e.target).hasClass("i_editar")) {
		let btn_editar;

		if ($(e.target).hasClass("i_editar")) {
			btn_editar = $(e.target).parent();
		} else {
			btn_editar = $(e.target);
		}

		$("#div_new_password").show();
		$("#input_new_password").prop("readonly", true);
		editarObjeto(btn_editar);
	}

	//ELIMINAR OBJETO
	if (
		$(e.target).hasClass("btn_eliminar") ||
		$(e.target).hasClass("i_eliminar")
	) {
		let btn_eliminar;

		if ($(e.target).hasClass("i_eliminar")) {
			btn_eliminar = $(e.target).parent();
		} else {
			btn_eliminar = $(e.target);
		}

		eliminarObjeto(btn_eliminar);
	}
});

//EDITAR OBJETO
async function editarObjeto(btn_editar) {
	modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR USUARIO");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");
	div_password.hide();
	div_new_password.show();

	//EXCLUIR INPUTS PARA VALIDAR
	input_password.addClass("not_validate");
	input_confirm_password.addClass("not_validate");

	let id_objeto = btn_editar.attr("data-id");
	let data = { id: id_objeto, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);
	// peticionEditarObjeto(URL_USER_APP,data);

	const obj = ajaxResponse.data;
	//form
	id_modal.val(Number(obj.id));
	input_name.val(obj.usuario);
	input_correo.val(obj.correo);
	input_new_password.val("");

	data = { op: "index" };
	// fillSelect2(URL_ROLE_APP, data, obj.perfil_id,"input_role_id");
	setTimeout(() => {
		input_name.focus();
	}, 1000);
}

//ELIMINAR OBJETO
async function eliminarObjeto(btn_eliminar) {
	let titulo = "¿Are you sure you want to delete this user?";
	let texto = `${btn_eliminar.attr("data-nombre")}`;

	let fecha_actual = moment().format("YYYY-MM-DD hh:mm:ss");
	let data = {
		op: "eliminar_objeto",
		id: Number(btn_eliminar.attr("data-id")),
		eliminado: fecha_actual,
	};

	await peticionEliminarObjetoAsync(
		titulo,
		texto,
		URL_USER_APP,
		data,
		"fillTable()"
	);
}