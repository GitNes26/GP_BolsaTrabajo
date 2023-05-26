// #region FUNCIONES DE CAJON

//#region VARIABLES
const
	URL_BASE = $("#url_base").val(),
	BACKEND_PATH = `${URL_BASE}/backend`,
	PAGES_PATH = `${URL_BASE}/pages`,
	EMAIL_REGISTER_PATH = `/php/NewUserEmail.php`,
	URL_API_COUNTRIES = `https://www.universal-tutorial.com/api`,
	
	URL_USER_APP = `${BACKEND_PATH}/User/App.php`,
	URL_COMPANY_APP = `${BACKEND_PATH}/Company/App.php`,
	URL_CANDIDATE_APP = `${BACKEND_PATH}/Candidate/App.php`,
	URL_ROLE_APP = `${BACKEND_PATH}/Role/App.php`,
	URL_MENU_APP = `${BACKEND_PATH}/Menu/App.php`,
	URL_BUSINESS_LINE_APP = `${BACKEND_PATH}/BusinessLine/App.php`,
	URL_TAG_APP = `${BACKEND_PATH}/Tag/App.php`,
	URL_AREA_APP = `${BACKEND_PATH}/Area/App.php`,
	URL_COMPANY_RANKING_APP = `${BACKEND_PATH}/CompanyRanking/App.php`
	;

const btn_close = $(".btn-close");

const
	id_cookie = Number(Cookies.get("user_id")),
	permission_read = Boolean(Cookies.get("permission_read")),
	permission_write = Boolean(Cookies.get("permission_write")),
	permission_delete = Boolean(Cookies.get("permission_delete")),
	permission_update = Boolean(Cookies.get("permission_update")),
	current_page = $("#current_page").val(),
	singular_object = $("#singular_object").val(),
	plural_object = $("#plural_object").val()

let auth_token;
//#endregion VARIABLES

// console.log("Cookies",Cookies.get());
let needCookies = true;
if (location.pathname == '/') needCookies = false;
else if (location.pathname == '/index.php') needCookies = false;
else if (location.pathname == '/registro-perfil.php') needCookies = false;

if (!Cookies.get("session") && needCookies) location.reload();



const ajaxRequestAsync = async (
	url,
	data,
	close_modal = null,
	show_blockUI = true,
	show_toast = true
) => {
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
		};

		if (response.result) {
			if (response.toast)
				if (show_toast) 
					showToast(response.alert_icon, response.alert_text);
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
}
const ajaxRequestDeleteAsync = async (
	title,
	text,
	url,
	data,
	function_complete_string
) => {
	Swal.fire({
		title: title,
		text: text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#B04759",
		confirmButtonText: "Eliminar",
		cancelButtonColor: "#9BA4B5",
		cancelButtonText: "Cancelar",
	}).then(async (result) => {
		if (result.isConfirmed) {
			await showBlockUI();

			try {
				let response = await $.ajax({
					type: "POST",
					url: url,
					data: data,
					dataType: "json",
				});

				if (response.result) {
					if (response.alert_text != undefined)
						showToast(response.alert_icon, response.alert_text);
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
}
const ajaxRequestFileAsync = async (
	url,
	data,
	close_modal = null,
	show_blockUI = true,
	show_toast = true
) => {
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
			contentType:false,
			enctype: "multipart/form-data",
			processData:false,
		});
		// console.log(response);

		if (response.message == "duplicado") {
			$.unblockUI();
			showAlert(response.alert_icon, response.alert_title, response.alert_text, true);
			$(`#${response.input}`).focus();
			return response;
		};

		if (response.result) {
			if (response.toast)
				if (show_toast) 
					showToast(response.alert_icon, response.alert_text);
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
}

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
		css: { backgroundColor: null, color: "#313131", border: null },
	});
}

function showAlert(icon, title, text, show_confirm_btn) {
	Swal.fire({
		icon,
		title,
		html: text,
		showConfirmButton: show_confirm_btn,
		confirmButtonColor: "#494E53",
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
		},
	});

	Toast.fire({ icon: icon, title: message });
}
const obligatory = $(".obligatory").html(
	`<span class="text-danger fst-italic">&nbsp; * requerido</span>`
);

function mayus(e) {
	e.value = e.value.toUpperCase();
}

$(".eye_icon").click((e) => {
   // console.log("ojito en loigin");
   const target = $(e.target);
   target.toggleClass("fa-solid fa-eye fa-duotone fa-eye-slash");
   const input = $(`input#${target.attr('data-input')}`)
   if (target.hasClass("fa-eye")) input.prop("type","text")
   else input.prop("type","password")
});

function countLetter(input, counter, letters, limit) {
	counter.text(`${letters}/${limit}`);

	if (letters > limit) {
		input.value = input.value.slice(0,limit); 
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

//AGREGAR DATO AL ARRAY
function addToArray(name, value, array) {
	//array obtenido de formulario_modal.serializeArray()
	// console.log(nombre,valor,array);
	const new_data = { name, value };
	array.push(new_data);
}




//#region MENUS
const sidebar_menus = $("#sidebar_menus");
const fillSidebar = async (show_toast=false) => {
	sidebar_menus.slideUp(1000);
	let role_id = Number(Cookies.get("role_id"));
	// role_id=1;
	let data = { op: "showMyMenus", role_id: role_id };
	const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data, false, true, show_toast);
	sidebar_menus.html("");
	const objResponse = ajaxResponse.data;
	// console.log(objResponse);
	let menus = "";
	let parent_menus = objResponse.filter((menu) => menu.belongs_to == 0);
	parent_menus = parent_menus.sort().map((parent_menu) => {
		menus += `
        <li class="nav-item  mb-3">
          <a href="#" class="nav-link">
              <i class="nav-icon ${parent_menu.icon}"></i>
              <p>
                ${parent_menu.menu}
                <i class="right fas fa-angle-left"></i>
              </p>
          </a>`;
		let children_menus = objResponse.filter(
			(menu) => menu.belongs_to == parent_menu.id
		);
		children_menus.sort((a, b) => b.order - a.order);
		children_menus.map((child_menu) => {
			menus += `
              <ul class="nav nav-treeview text-sm">
                <li class="nav-item">
                    <a href="${PAGES_PATH}/${child_menu.file_path}" class="nav-link">
                        <i class="nav-icon ${child_menu.icon} text-sm"></i>
                        <p>${child_menu.menu}</p>
                    </a>
                </li>
              </ul>`;
		});
		menus += `</li>`;
	});
	await sidebar_menus.append(menus);
	sidebar_menus.slideDown(1000);
};
if (sidebar_menus.length > 0) fillSidebar();
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
function validateRangeDates(action) {
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

	if (action == "crear") {
		if (data_date1 <= yesterday) {
			showToast(
				"warning",
				"No puedes publicar con fecha anterior a hoy."
			);
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
		return (datetime = moment(date).format("MM-DD-YYYY"));
		// return datetime = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric'}).format(date);
	}

	date = new Date(the_date);
	const formato = long_format ? "MM-DD-YYYY h:mm:ss a" : "MMMM-DD-YYYY";
	return (datetime = moment(date).format(formato));
	// return datetime = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric', hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: true }).format(date);
}

function formatDatetimeToSQL(the_date) {
	let datetime = moment(the_date).format("YYYY-MM-DDTh:mm:ss");
	return datetime
}
//#endregion /** FECHAS - FORMATEADO */


//#region /** VALIDACIONES - INPUTS - FORMULARIOS */
function validateInputs(form) {
	let inputs = form.serializeArray();
	let validated = true;
	$.each(inputs, function (i, input_iterable) {
		if (!validated) return;
		let input = $(`#${input_iterable.name}`);
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
		input.addClass("is-invalid")
		input.focus();
		return false;
	}
	input.removeClass("is-invalid")
	return true;
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
		} catch (e) { }
	});
	select2.keydown(function (e) {
		try {
			var searcher = $(".select2-search__field");
			searcher[0].focus();
			searcher[1].focus();
		} catch (e) { }
	});
}
focusSelect2($(".select2"));

function resetSelect2(selector) {
	// function resetearSelect2(selector, url, data) {
	selector.attr("disabled",true);

	if (selector.data().select2.options.options.multiple) {
		selector.prop("selectedIndex", 0);
		selector.val("-1");
		$(`#select2-${selector[0].name}-container`).attr("title", "Selecciona etiquetas con tús intereses");
		$(`#select2-${selector[0].name}-container`).text("");
		// console.log(selector[0].placeholder);
		selector.attr("disabled",false);
	} else {
		selector.prop("selectedIndex", 0);
		selector.val("-1");
		$(`#select2-${selector[0].name}-container`).text("Selecciona una opción...");
		$(`#select2-${selector[0].name}-container`).attr("title", "Selecciona una opción...");
		selector.attr("disabled",false);
	}

	// iconos(url, data, -1, select2[0].name);
}

async function fillSelect2(url_app, selected_index, selector, select_modules=false) {
	const data = { op: "showSelect" };
	const ajaxResponse = await ajaxRequestAsync(url_app, data, null, null, null);

	const objResponse = ajaxResponse.data;
	// console.log("objResponse",objResponse);
	selector.attr("disabled",true);
	selector.html(`<option value="">Cargando...</option>`);


	let options = /*HTML*/ `
      <option value="-1" disabled>Selecciona una opción...</option>
   `;
	if (selector.data().select2.options.options.multiple) {
		options = /*HTML*/ `
      <option value="-1" disabled>Selecciona etiquetas...</option>
   `;
	}
	if(select_modules) {
		options += /*HTML*/ `
      	<option value="0" selected>***** Soy Módulo Padre *****</option>
		`;
	}

	selector.html("");
	selector.append(options);

	$.each(objResponse, function (i, obj) {
		if (obj.value == selected_index)
			selector.append(
				`<option selected value='${obj.value}'>${obj.text}</option>`
			);
		else
			selector.append(
				`<option value='${obj.value}'>${obj.text}</option>`
			);
	});
	selector.attr("disabled",false);

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
			targets: "_all",
		},
	],
	dom: '<"row mb-2"B><"row"<"col-md-6 "lr> <"col-md-6"f> > rt <"row"<"col-md-6 "i> <"col-md-6"p> >',
	lengthMenu: [
		[5, 10, 50, 100, -1],
		[5, 10, 50, 100, "Todos"],
	],
	pageLength: 10,
	deferRender: true,
	aaSorting: [], //deshabilitar ordenado automatico
};
$("table thead tr")
	.clone(true)
	.addClass("filters")
	.appendTo("table thead");
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
			$(cell).addClass("bb-primary")
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
						.search(
							this.value != ""
								? regexr.replace("{search}", "(((" + this.value + ")))")
								: "",
							this.value != "",
							this.value == ""
						)
						.draw();
				})
				.on("keyup", function (e) {
					e.stopPropagation();

					$(this).trigger("change");
					$(this)
						.focus()[0]
						.setSelectionRange(cursorPosition, cursorPosition);
				});
			});
};

// if ($("table").length > 0) $("table").DataTable(DT_CONFIG)
//#endregion /* DataTables */


//#region /** MonentJS */
moment.locale("es-mx");
// console.log(moment.locale());
//#endregion /** MonentJS */

// // #endregion FUNCIONES DE CAJON


//#region SELECTORES DE PAISES / CIUDADES
async function showStates() {
	$("#input_state").attr("disabled",true)
	$("#input_state").html("<option value=''>Cargando...</option>");

	// console.log("generar token");
	let requestToken = await $.ajax({
		async: true,
		crossDomain: true,
		url: `${URL_API_COUNTRIES}/getaccesstoken`,
		method: "GET",
		headers: {
			Accept: "application/json",
			"api-token": "7-XEHwLCLzq7iaJRWwnkSI5GFfL4A8VCIczHNsc2mXrvlUO3VDUGu7ZIBY7dauhz-qA",
			"user-email": "182310211@itslerdo.edu.mx",
		}
	});

	auth_token = requestToken.auth_token;
	// console.log(auth_token);

	// await estados_ciudades(output_estado.text(), output_ciudad.text());
	await states_cities();
	// console.log("ESTADOS_CIUDADES");
	async function states_cities(estado = null, ciudad = null) {
		let states = await $.ajax({
			url: `${URL_API_COUNTRIES}/states/México`,
			method: "GET",
			headers: {
				Authorization: `Bearer ${auth_token}`,
				Accept: "application/json",
			}
		});
		while (states.length < 1) {
			states = await $.ajax({
				url: `${URL_API_COUNTRIES}/states/México`,
				method: "GET",
				headers: {
					Authorization: `Bearer ${auth_token}`,
					Accept: "application/json",
				}
			});
		}
		let comboStates = "<option value='' disabled>Seleccionar una opción...</option>";
		states.forEach((element) => {
			let seleccionar_estado = "";
			if (estado != null) {
				if (estado == element[`state_name`]) {
					seleccionar_estado = "selected";
				}
			}
			// console.log(estado);
			// $("#input_state").click()
			comboStates +=
				'<option value="' +
				element["state_name"] +
				'" ' +
				seleccionar_estado +
				">" +
				element["state_name"] +
				"</option>";
		});

		$("#input_state").html(comboStates);
		$("#input_state").attr("disabled",false)
	}
	// await estados_ciudades2(output_estado.text(), output_ciudad.text());
}
$("#input_state").on("change", async function () {
	var state = this.value;
	// console.log(output_estado.text());
	// console.log(state);
	$("#input_municipality").attr("disabled",true);
	$("#input_municipality").html("<option value=''>Cargando...</option>");


	let cities = await $.ajax({
		url: `${URL_API_COUNTRIES}/cities/${state}`,
		method: "GET",
		headers: {
			Authorization: `Bearer ${auth_token}`,
			Accept: "application/json",
		}
	});
	// while (cities.length < 1) {
	// 	cities = await $.ajax({
	// 		url: `${URL_API_COUNTRIES}/cities/${state}`,
	// 		method: "GET",
	// 		headers: {
	// 			Authorization: `Bearer ${auth_token}`,
	// 			Accept: "application/json",
	// 		}
	// 	});
	// }
	var comboCities = "<option value='' >Selecciona una opción...</option>";
	cities.forEach((element) => {
		let seleccionar_ciudad = "";
		// if (ciudad != null) {
		// 	if (estado == element[`state_name`]) {
		// 		seleccionar_ciudad = "selected";
		// 	}
		// }
		comboCities +=
			'<option value="' +
			element["city_name"] +
			'" ' +
			seleccionar_ciudad +
			">" +
			element["city_name"] +
			"</option>";
	});
	$("#input_municipality").html(comboCities);
	$("#input_municipality").attr("disabled",false);
});
//#endregion SELECTORES DE PAISES / CIUDADES