//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);
let tbody = $("#table").find('tbody');

$(document).ready(() => {
   // Arrastrar renglón
   tbody.sortable({
      items: 'tr',
      axis: 'y',
      handle: '.handle',
      placeholder: 'ui-sortable-placeholder',
      start: function (event, ui) {
         ui.item.addClass('ui-sortable-item');

         ui.placeholder.height($(ui.item).height());
         ui.placeholder.width($(ui.item).width());

         // show all rows
         // tabla_banverticales.page.len(-1).draw(false);

         // refresh so that newly shown rows are counted as sortable items
         $(this).sortable('refresh');

         // sort table by sequence
         // tabla_banverticales.order([4, 'asc']).draw(false);
      },
      sort: function (event, ui) {
      },
      stop: function (event, ui) {
         enlistarOrden();
      }
   });
   // Arrastrar renglón

   // $("#div_file_upload").hide();

   // function formatearFechaHora(la_fecha) {
   //    // fecha = new Date(parseInt(la_fecha.substr(6)));
   //    fecha = new Date(la_fecha);

   //    if (la_fecha.length <= 10) {
   //       fecha = new Date(fecha.setDate(fecha.getDate()+1));
   //       return fecha_hora = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric'}).format(fecha);
   //    }

   //    fecha = new Date(la_fecha);
   //    return fecha_hora = new Intl.DateTimeFormat("es-MX", { day: '2-digit', month: '2-digit', year: 'numeric', hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: true }).format(fecha);
      
   // }

   // // tds_fecha_inicial = document.querySelectorAll('.td_fecha_inicial');
   // // tds_fecha_inicial.forEach(td_fecha_inicial => {
   // //    let fecha_formateada = formatearFechaHora(td_fecha_inicial.innerHTML);
   // //    td_fecha_inicial.innerHTML = fecha_formateada;
   // // });
   // // tds_fecha_final = document.querySelectorAll('.td_fecha_final');
   // // tds_fecha_final.forEach(td_fecha_final => {
   // //    let fecha_formateada = formatearFechaHora(td_fecha_final.innerHTML);
   // //    td_fecha_final.innerHTML = fecha_formateada;
   // // });

   //RECARGAR Y ACTUALIZAR STATUS DE LOS REGISTROS SI VENCIO SU FECHA FINAL

   tds_active = document.querySelectorAll(".td_active");
   function actualizarStatusRegistros() {
      let ids = "";
      por_actualizar = false;
      query = "UPDATE imagen_vertical SET img_active='0', img_order=1000000 WHERE {obj.id} IN (";
      tds_active.forEach(td_active => {
         let hoy = moment().format("YYYY-MM-DD HH:mm:ss");
         let momento_actual = moment(hoy)
         id_registro = Number(td_active.getAttribute("data-id"));
         active_td = Number(td_active.getAttribute("data-active"));
         fecha_final = moment(td_active.getAttribute("data-date-end"));
         if (td_active.getAttribute("data-date-end").length <= 11) {
            fecha_final = moment(fecha_final).format("YYYY-MM-DD 23:59:59");
            fecha_final = moment(fecha_final)
            let hoy = moment().format("YYYY-MM-DD 23:59:59");
            momento_actual = moment(hoy)
         }
         fecha_vencida = momento_actual.isAfter(fecha_final);
         // if (fecha_vencida) {
         if (fecha_vencida && active_td==1) {
            por_actualizar = true;
            query += `${id_registro},`;
            ids += id_registro+'.,'
         }
      });
      query = query.slice(0,-1);
      query += ");";
      ids = ids.slice(0,-1);
      let datos = {
         accion: "actualizar_active",
         ids,
         query
      }
      if (por_actualizar) { peticionAjax(url_modelo_app,datos,cambioDeEstado,null); }
      
   }
   function cambioDeEstado(ajaxResponse) {
      objResponse =  ajaxResponse.Datos;
      tds_active.forEach(td_active => {
         id_registro = td_active.getAttribute("data-id");
         comparacion = `${id_registro}.`;

         if (objResponse.includes(id_registro)) {
            td_active.setAttribute("data-active", 0);
            td_active.classList.remove("fa-circle-check");
            td_active.classList.add("fa-circle-xmark");

            // obtener su td_order_view, quitarle su numero y poner su letra color muted
            var td_order_view = $(`td[data-id='${id_registro}'].td_order_view`);
            td_order_view.attr("data-order_view",1000000)
            td_order_view.removeClass("handle");
            if (!td_order_view.hasClass("text-muted")) {td_order_view.addClass("text-muted");}
            td_order_view.html("&nbsp;<i class='fa-solid fa-grip-vertical'></i>");
         }
      });
   }
   actualizarStatusRegistros();   
   //RECARGAR Y ACTUALIZAR STATUS DE LOS REGISTROS SI VENCIO SU FECHA FINAL

	$(".td_img").hover(function () {
		// over
		console.log("dentro");
		let id = $(this).attr("data-id");
		let tooltip_imagen = $(`img[data-id='${id}'].tooltip_imagen`)
		tooltip_imagen.fadeIn("fast");
	}, function () {
		// out
		console.log("fuera");
		let id = $(this).attr("data-id");
		let tooltip_imagen = $(`img[data-id='${id}'].tooltip_imagen`)
		tooltip_imagen.fadeOut("fast");
	});
	
	$(".td_video").hover(function () {
		// over
		// console.log("dentro video");
		let id = $(this).attr("data-id");
		let tooltip_video = $(`video[data-id='${id}'].tooltip_video`)
		tooltip_video.fadeIn("fast");
	}, function () {
		// out
		// console.log("fuera video");
		let id = $(this).attr("data-id");
		let tooltip_video = $(`video[data-id='${id}'].tooltip_video`)
		tooltip_video.fadeOut("fast");
	})
});

const 
	btn_modal_form = $("#btn_modal_form"),
	modal_body = $("#modal-body"),
	form = $("#form"),
	modal_title = $(".modal-title"),
	id_modal = $("#id"),
	op_modal = $("#op"),
	input_date_init = $("#input_date_init"),
	input_date_end = $("#input_date_end"),
	div_file = $("#div_file"),
	input_file_path = $("#input_file_path"),
	div_file_upload = $("#div_file_upload"),
	preview_file = $("#preview_file"),
	btn_quit_file = $("#btn_quit_file"),
	input_active = $("#input_active"),
	label_input_active = $("#label_input_active"),

	btn_submit = $("#btn_submit"),
	btn_reset = $("#btn_reset"),
	btn_cancel = $("#btn_cancel");
	
let haveImg = false, vImgPath = null;
//#endregion VARIABLES
// $(".select2").select2();
// focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
	fillTable();
}

//Mostrar imagen en grande en hover
$(`.tooltip_imagen`).fadeOut(1);
$(`.tooltip_video`).fadeOut(1);


$(".td_img").hover(function () {
	// over
	console.log("dentro");
	let id = $(this).attr("data-id");
	let tooltip_imagen = $(`img[data-id='${id}'].tooltip_imagen`)
	tooltip_imagen.fadeIn("fast");
}, function () {
	// out
	console.log("fuera");
	let id = $(this).attr("data-id");
	let tooltip_imagen = $(`img[data-id='${id}'].tooltip_imagen`)
	tooltip_imagen.fadeOut("fast");
});

$(".td_video").hover(function () {
   // over
   // console.log("dentro video");
   let id = $(this).attr("data-id");
   let tooltip_video = $(`video[data-id='${id}'].tooltip_video`)
   tooltip_video.fadeIn("fast");
}, function () {
   // out
   // console.log("fuera video");
   let id = $(this).attr("data-id");
   let tooltip_video = $(`video[data-id='${id}'].tooltip_video`)
   tooltip_video.fadeOut("fast");
})






//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
 btn_cancel.click((e) => {
	e.preventDefault();
	modal_title.html(
		"<i class='fa-regular fa-circle-plus'></i>&nbsp; REGISTRAR BANNER"
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

	preview_file.attr("src","/assets/img/cargar_archivo.png");
	preview_file.addClass("rounded-lg");

	setTimeout(() => {
		input_date_init.focus();
		input_date_init.val(moment().format("YYYY-MM-DD"));
	}, 500);
});

btn_modal_form.click(async (e) => {
	btn_reset.click();
});

//ESTADO ACTIVO E INACTIVO
input_active.click(() => {
   estado = input_active.prop("checked")
   if (estado) { label_input_active.text("Activo"); input_active.attr("data-activo",1); }
   else { label_input_active.text("Inactivo"); input_active.attr("data-activo",0); }
});

// Agrega un evento change a la foto de perfil
input_file_path.on('change', async function(event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];
	 resetImgPreviewBanner(file);
});
function resetImgPreviewBanner(file) {
	// Crea un objeto FileReader
	const fileReader = new FileReader();

	// Define la función de carga completada del lector
	fileReader.onload = function(e) {
		// Agrega la imagen a la vista previa
		preview_file.html(""); // Limpia la vista previa antes de agregar la nueva imagen
		preview_file.attr("src",e.target.result);
		preview_file.addClass("rounded-lg");
	};

  // Lee el contenido del archivo como una URL de datos
  fileReader.readAsDataURL(file);
}


// REGISTRAR O EDITAR OBJETO
form.on("submit", async function(e) {
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

	let data = new FormData(this);
	// return console.log(data);
	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	if (id_modal.val() <= 0) {
		//NUEVO
		addToArray("created_at", current_date, data, true);
	} else {
		//EDICION
		if (haveImg) addToArray("haveImg", vImgPath, data, true);
		addToArray("updated_at", current_date, data, true);
	}

	// return console.log([...data]);
	const ajaxResponse = await ajaxRequestFileAsync(URL_BANNER_APP, data);
	if (ajaxResponse.message == "duplicado") return
	btn_cancel.click();
	await fillTable();
});

async function fillTable(show_toas=true) {
	let data = { op: "index" };
	const ajaxResponse = await ajaxRequestAsync(URL_BANNER_APP, data, null, true, show_toas);

	//Limpiar table
	tbody.slideUp();
	table.clear().draw();

	const list = [];
	let objResponse = ajaxResponse.data;
	// console.log(objResponse);

	objResponse.map((obj) => {
		// console.log(obj);

		let
			class_handle = "handle"
			;

			if (obj.active == false ) {order_view = 1000000;}
			if (obj.order_view == 1000000) { class_handle = "text-muted"; obj.order_view = ""; }
		
		//Campos
		let 
			column_date_init = `${formatDatetime(obj.date_init)}`,
			column_date_end = `${formatDatetime(obj.date_end)}`,
			column_file_path = `
				<td class='align-middle'>
					<img src='/assets/img/${obj.file_path}' class='img-fluid rounded shadow tooltip_imagen tt_banvertical' data-id='${obj.id}'></img>
					<img src='/assets/img/${obj.file_path}' width='50' preload='true' class='td_img rounded' data-id='${obj.id}'></img>
				</td>`;

			column_order_view = `
				<td class='align-middle td_order fw-bold text-lg ${class_handle}' data-id='${obj.id}' data-order_view='${obj.order_view}'>${obj.order_view} &nbsp;<i class='fa-solid fa-grip-vertical'></i></td>`,

			column_active = Boolean(obj.active) == true 
				? `<i class='fa-regular fa-circle-check fa-2xl td_active' data-id='${obj.id}' data-active='${obj.active}' data-date-end='${obj.date_end}'></i>` 
				: `<i class='fa-regular fa-circle-xmark fa-2xl td_active' data-id='${obj.id}' data-active='${obj.active}' data-date-end='${obj.date_end}'></i>`;

		let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Banner' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-regular fa-pen-to-square fa-lg i_edit'></i></button>`;
		}
		if (permission_delete) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.id}' title='Eliminar Banner' data-name='${obj.area}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
		}
		column_buttons += `</div>
					</td>`;

		list.push([
			column_date_init,
			column_date_end,
			column_file_path,
			column_order_view,
			column_active,
			column_buttons,
		]);		
	});
	//Dibujar Tabla
	await table.rows
	.add(list)
	.draw();
	await table.columns.adjust().draw();
	$(`.tooltip_imagen`).fadeOut(1);
	$(`.tooltip_video`).fadeOut(1);
	tbody.slideDown("slow");
	btn_reset.click();
	$("tr td").css("vertical-align", "middle");
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
	modal_title.html("<i class='fa-light fa-pen-to-square'></i>&nbsp; EDITAR BANNER");
	btn_submit.removeClass("btn-success");
	btn_submit.addClass("btn-primary");
	btn_submit.text("GUARDAR");

	btn_cancel.removeClass("btn-danger d-none");
	btn_cancel.addClass("btn-danger");
	btn_cancel.text("CANCELAR");

	btn_reset.click();

	let id_obj = btn_edit.attr("data-id");
	let data = { id: id_obj, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_BANNER_APP, data);

	const obj = ajaxResponse.data;
	//form
	id_modal.val(Number(obj.id));
	input_date_init.val(obj.date_init);
	input_date_end.val(obj.date_end);
	haveImg=false;
	if (obj.file_path == "" || obj.file_path == null) {
		preview_file.html(""); // Limpia la vista previa antes de agregar la nueva imagen
		preview_file.attr("src","/assets/img/cargar_imagen.webp");
		preview_file.addClass("rounded-lg");
	}
	else {
		haveImg = true;
		// console.log("tengo imagen guardada");
		preview_file.html(""); // Limpia la vista previa antes de agregar la nueva imagen
		preview_file.attr("src",`/assets/img/${obj.file_path}`);
		preview_file.addClass("rounded-lg");

		vImgPath = obj.file_path;
		// input_file_path.val(obj.file_path);
	}
	// const check_active = Boolean(obj.active);
	input_active.attr("checked", Boolean(obj.active))
	

	setTimeout(() => {
		input_date_init.focus();
	}, 500);
}

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function deleteObj(btn_delete) {
	let title = `¿Estas seguro de eliminar el banner <br> ${btn_delete.attr("data-name")}?`;
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
		URL_BANNER_APP,
		data,
		"fillTable()"
	);
}