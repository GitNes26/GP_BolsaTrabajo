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
	modalLabel = $("#modalLabel"),
	id_modal = $("#id"),
	op_modal = $("#op"),
	input_area = $("#input_area")
	;

	// btn_submit = $("#btn_submit"),
	// btn_reset = $("#btn_reset"),
	btns_cancel = $(".btn_cancel");

const
	d_output_photo = $("#d_output_photo"),
	d_div_header = $("#d_div_header"),
	d_output_enable = $("#d_output_enable"),
	d_preview_photo = $("#d_preview_photo"),
	d_output_name = $("#d_output_name"),
	d_output_email = $("#d_output_email"),
	d_output_cellphone = $("#d_output_cellphone"),
	d_output_age = $("#d_output_age"),
	d_output_profession = $("#d_output_profession"),
	d_output_interest_tags_ids = $("#d_output_interest_tags_ids"),
	d_output_professional_info = $("#d_output_professional_info"),
	d_output_languages = $("#d_output_languages"),
	d_preview_cv = $("#d_preview_cv")
	;
	
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
	let data = { op: "myApplicationsByCompany", user_id: id_cookie };
	if (role_cookie < 3) data.op = "index";
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
				icon = `<i class="fa-brands fa-readme fa-fade"></i>`;
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
		let status = `<h5><span class="badge ${bg_badge}">${icon} &nbsp; ${obj.status}</span></h5>`;
		//Campos
		let
			column_candidate = `
				<button class='btn btn-outline-dark' type='button' data-id='${obj.ca_id}' onclick="showCandidate(${obj.ca_id})" title='Ver Candidato' data-bs-toggle="modal" data-bs-target="#candidate_modal"><i class='fa-solid fa-eye'></i></button><br><br>
				<b>${obj.name} ${obj.last_name}</b><br>
				<i class="fa-solid fa-at"></i>&nbsp; ${obj.email}<br>
				<i class="fa-solid fa-phone"></i>&nbsp; ${formatPhone(obj.cellphone)}<br>
			`; 
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
                  <span class="">${formatCurrency(obj.min_salary)}</span> &nbsp;a&nbsp; 
                  <span class="">${formatCurrency(obj.max_salary)}</span>
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
				<!-- <i>Aqui ira una linea de flujo</i><br><br> -->
				${status}
			`;

		let column_buttons = `<td class='align-middle'>
            <div class='' role='group'>`;
		if (permission_update) {
			column_buttons +=
				//html
				`<button class='btn btn-outline-primary m-1' type='button' data-id='${obj.id}' onclick="showDetail(${obj.v_id})" title='Mostrar Vacante' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-eye'></i></button>
				<button class='btn btn-sm btn-outline-secondary m-1' type='button' onclick="changeStatus('Pendiente', ${obj.a_id})" title='Pasar a status PENDIENTE'>PENDIENTE</button>
				<button class='btn btn-sm btn-outline-info m-1' type='button' onclick="changeStatus('Recibida', ${obj.a_id})" title='Pasar a status RECIBIDA'>RECIBIDA</button>
				<br>
				<button class='btn btn-sm btn-outline-primary m-1' type='button' onclick="changeStatus('En evaluación', ${obj.a_id})" title='Pasar a status EN'>EN EVALUACIÓN</button>
				<button class='btn btn-sm btn-outline-success m-1' type='button' onclick="changeStatus('Aceptada', ${obj.a_id})" title='Pasar a status ACEPTAR'>ACEPTAR</button>
				<button class='btn btn-sm btn-outline-danger m-1' type='button' onclick="changeStatus('Rechazada',${obj.a_id})" title='Pasar a status RECHAZAR'>RECHAZAR</button>`;
		}
		if (permission_delete) {
			if (obj.status == "Aceptada" || obj.status == "Rechazada" || obj.status == "Cancelada") column_buttons += "";
			else
			column_buttons +=
				//html
				`<button class='btn btn-outline-danger m-1 btn_cancel' type='button' onclick="changeStatus('Cancelada',${obj.a_id})" title='Cancelar Solicitud' data-name='${obj.vacancy}'><i class='fa-solid fa-ban'></i></button>`;
		}
		column_buttons += `</div>
					</td>`;

		list.push([
			column_candidate,
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



async function showDetail(id) {
	modalLabel.html("<i class='fa-solid fa-memo-circle-info'></i>&nbsp; DETALLE DE LA VACANTE");

	let data = { id, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);

	const obj = ajaxResponse.data;
	console.log(obj);

	// PREVIEW
	$(`.output_vacancy`).text(obj.vacancy);
	data = { op: "show", id: obj.company_id }
	const ajaxResponseCompany = await ajaxRequestAsync(URL_COMPANY_APP, data);
	const objCompany = ajaxResponseCompany.data
	$(`.output_info_company`).html(`
		<span>${objCompany.company}</span><br>
		<span>${objCompany.municipality}, ${objCompany.state}</span><br>
		<b>CONTACTO:</b>&nbsp;&nbsp;
				<i class="fa-solid fa-user"></i>&nbsp; ${objCompany.contact_name} &nbsp; | &nbsp;
				<i class="fa-solid fa-phone"></i>&nbsp; ${formatPhone(objCompany.contact_phone)} &nbsp; | &nbsp;
				<i class="fa-solid fa-at"></i>&nbsp; ${objCompany.contact_email}
		<br><br>
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

//MOSTRAR INFORMAICON
function resetImgPreviewProfile(preview, img_path=null, iframe=false, pointer=true) {
	if (!iframe || img_path==null) {
		// Crea un elemento de imagen
		const imagen = document.createElement('img');
		iframe 
		? imagen.src = img_path == null ? "/assets/img/cargar_archivo.png" : img_path // Asigna la imagen cargada como fuente
		: imagen.src = img_path == null ? "/assets/img/sin_perfil.webp" : img_path; // Asigna la imagen cargada como fuente
		if (iframe) {
			imagen.classList.add("img-fluid"); // Asignar clases
			pointer ? imagen.classList.add("pointer-sm") : imagen.classList.remove("pointer-sm")  // sAsignar clases
			//  imagen.classList.add("p-5"); // Asignar clases
			imagen.classList.add("rounded-lg"); // Asignar clases
			// imagen.classList.add("text-center"); // Asignar clases
			imagen.style = "max-height: 200px !important";
		} else {
			imagen.classList.add("img-circle"); // Asignar clases
			imagen.classList.add("elevation-2"); // Asignar clases
			imagen.classList.add("bg-white"); // Asignar clases
			pointer ? imagen.classList.add("pointer-sm") : imagen.classList.remove("pointer-sm")  // sAsignar clases
			imagen.classList.add("opacity-100"); // Asignar clases
			imagen.title = "Haz clic aquí, si deseas cambiar tu foto de perfil";
			
			imagen.setAttribute("style","width: 100px !important; height: 100px !important; object-fit: contain");
		}

		// Agrega la imagen a la vista previa
		preview.html(""); // Limpia la vista previa antes de agregar la nueva imagen
		preview.append(imagen);
	} else {
		// Crea un elemento de imagen
      const iframe = document.createElement('iframe');
      iframe.src = img_path == null ? "/assets/img/cargar_archivo.png" : img_path; // Asigna la iframe cargada como fuente
      // canvas.getContext("2d") // Asigna la iframe cargada como fuente
      iframe.classList.add("img-fluid"); // Asignar clases
      pointer ? iframe.classList.add("pointer-sm") : iframe.classList.remove("pointer-sm")  // sAsignar clases
      //  iframe.classList.add("p-5"); // Asignar clases
      iframe.classList.add("rounded-lg"); // Asignar clases
      iframe.classList.add("opacity-100"); // Asignar clases
      iframe.style = "height: 100% !important";

      // Agrega la iframe a la vista previa
      preview.html(""); // Limpia la vista previa antes de agregar la nueva iframe
      preview.append(iframe);
		preview.parent().css("height","50vh");
		// label_input_file.css("height","100%");
		preview.css("height","100%");
	}
}

async function showCandidate(id) {
	let data = { id, op: "show" };
	const ajaxResponse = await ajaxRequestAsync(URL_CANDIDATE_APP, data);
	const obj = ajaxResponse.data;
	// console.log(obj);

	if (obj.enable == 0) {
		d_div_header.removeClass("bg-success");
		d_div_header.addClass("bg-primary");
		d_output_enable.text("CONTRATADO");
	}

	haveImg=false;
	if (obj.photo_path == "" || obj.photo_path == null) resetImgPreviewProfile(d_preview_photo, `/assets/img/sin_perfil.webp`, false, false);
	else {
		haveImg = true;
		// console.log("tengo imagen guardada");
 		resetImgPreviewProfile(d_preview_photo,`/assets/img/${obj.photo_path}`, false, false);
		vLogoPath = obj.photo_path;
		// input_photo_path.val(obj.photo_path);
		d_output_photo.attr("src", `/assets/img/${obj.photo_path}`)
	}
	d_output_name.text(`${obj.name} ${obj.last_name}`);
	d_output_email.text(obj.email);
	d_output_cellphone.text(formatPhone(obj.cellphone));
	// input_age.val(obj.age);
	d_output_age.text(obj.age);
	
	d_output_profession.text(obj.profession)
	d_output_professional_info.html(obj.professional_info);

	d_output_languages.text(obj.languages);
	// await showStates(obj.state, obj.municipality);
	haveCv=false; 
	if (obj.cv_path == "" || obj.cv_path == null) resetImgPreviewProfile(d_preview_cv, null, true, false);
	else {
		haveCv = true;
		// console.log("tengo imagen guardada");
 		resetImgPreviewProfile(d_preview_cv,`/assets/img/${obj.cv_path}`, true, false);
		vCvPath = obj.cv_path;
		// input_cv_path.val(obj.cv_path);
	}
	// changeEnable(obj.enable);
}

async function changeStatus(status, vacancy_id) {
	let title = `¿Estas de acuerdo con pasar a ${status} esta solicitud?`;
	// if (status == "Cancelada") title = `¿Estas seguro de cancelar tu solicitud de <br> ${btn_cancel.attr("data-name")}?`;
	let text = ``;

	let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	let data = {
		op: "changeStatus",
		input_status: status,
		id: vacancy_id,
		updated_at: current_date,
	};

	ajaxRequestQuestionAsync(title, text, URL_APPLICATION_APP, data, "fillTable(false)", "De acuerdo", "#0c7827");
}

//ELIMINAR OBJETO 
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

	console.log(data);
	ajaxRequestQuestionAsync(title, text, URL_APPLICATION_APP, data, "fillTable()");
}