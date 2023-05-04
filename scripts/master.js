// #region FUNCIONES DE CAJON
const
	URL_NOMINA_APP = "./backend/Nomina10001/App.php";




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
			dataType: "json",
		});

		if (response.result) {
			if (response.alert_text != undefined)
				if (show_toast)
					showToast(response.alert_icon, response.alert_text);
		} else {
			Swal.fire({
				icon: response.alert_icon,
				title: response.alert_title,
				text: response.alert_text,
				showConfirmButton: true,
				confirmButtonColor: "#494E53",
			});
		}

		// if (close_modal == null) btn_close.click();
		$.unblockUI();
		return response;

	} catch (error) {
		// if (close_modal == null) btn_close.click();
		$.unblockUI();
		// console.error(error);
		Swal.fire({
			icon: "error",
			title: "Oops...!",
			html: ` Ocurrio un error inesperado <br> ${error.responseText}.`,
			showConfirmButton: true,
			confirmButtonColor: "#494E53",
		});
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
function validatingInputs(form) {
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
	$(".select2").select2(); //(/* { dropdownParent: $("#modal") } */);
	$.fn.select2.defaults.set("language", "es");
}
function focusSelect2(select2) {
	select2.click(function (e) {
		try {
			var searcher = $(".select2-search__field");
			searcher[0].focus();
		} catch (e) { }
	});
	select2.keydown(function (e) {
		try {
			var searcher = $(".select2-search__field");
			searcher[0].focus();
		} catch (e) { }
	});
}
focusSelect2($(".select2"));
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

if ($("table").length > 0) $("table").DataTable(DT_CONFIG)
//#endregion /* DataTables */


//#region /** MonentJS */
moment.locale("es-mx");
console.log(moment.locale());
//#endregion /** MonentJS */

// // #endregion FUNCIONES DE CAJON

