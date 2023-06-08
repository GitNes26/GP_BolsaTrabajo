
//#region VARIABLES
const
	vacancies_enabled = $("#vacancies_enabled"),
   form_filter = $("#form_filter"),
   btn_show_filters = $("#btn_show_filters"),
   input_filter_search = $("#input_filter_search"),
   input_filter_min_salary = $("#input_filter_min_salary"),
   input_filter_max_salary = $("#input_filter_max_salary"),
   input_filter_business_line_id = $("#input_filter_business_line_id"),
   input_filter_area_id = $("#input_filter_area_id"),
   input_filter_interest_tags_ids = $("#input_filter_interest_tags_ids"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
	leyend_job_found = $("#leyend_job_found"),
   btn_reset = $("#btn_reset"),

   inputs_id = $(".id"),
   btns_submit = $(".btn_submit"),
   
	vacancy_container = $("#vacancy_container"), //donde voy a agregar los templates
	template_card_vacancy = document.getElementById("template_card_vacancy").content, //obtener el contenido (la estructura) de mi templeate
	fragment_card_vacancy = document.createDocumentFragment(), //es donde guardamos temporalmente el contenido

	btn_close_detail = $("#btn_close_detail"),
   form_vacancy = $("#form_vacancy"),
   form_modal = $("#form_modal")

	
   ;
let card_vacancy = $(".card_vacancy");
let dataVacancies = [];
//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   fillVacancies();
   
	fillSelect2(URL_BUSINESS_LINE_APP, -1, input_filter_business_line_id);
	fillSelect2(URL_AREA_APP, -1, input_filter_area_id);
   fillSelect2(URL_TAG_APP, -1, input_filter_interest_tags_ids, false);
   showStates();
	if (role_cookie != 4) {
		btns_submit.attr("disabled",true);
		btns_submit.text("SOLO CANDIDATOS");
	}
}


// EVENTO DE REDIMENCIONADO DE VENTANA
$(window).resize(function() {
   // var heightBrowser =$(window).height();
   adaptDetail();
});
function adaptDetail() {
	var widthBrowser = $(window).width();

   if (widthBrowser <= 767) {
		// console.log("pantalla movil");
      $(".card_vacancy").attr("data-bs-toggle","modal")
      $(".card_vacancy").attr("data-bs-target","#modal")
      if (form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click()
   } else {
		// console.log("pantalla pc");
		$(".btn-close").click();
      $(".card_vacancy").removeAttr("data-bs-toggle","modal")
      $(".card_vacancy").removeAttr("data-bs-target","#modal")
      
      if (!form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click()
   }
}

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
	resetSelect2(input_filter_business_line_id);
	resetSelect2(input_filter_area_id);
	resetSelect2(input_filter_interest_tags_ids);
	resetSelect2(input_state);
	resetSelect2(input_municipality);
	
	input_filter_search.val("");
	searchVacancies(input_filter_search);
	
	setTimeout(() => {
		input_filter_search.focus();
	}, 500);
});

vacancy_container.click(async (e) => {
	$(".card_vacancy_selected").addClass("card_vacancy_selected card-success card-outline");
	$(".card_vacancy_selected").removeClass("card_vacancy_selected");
	
	if (e.target.matches(".card_vacancy *")) {

		// btn_close_detail.click();
		const card_vacancy = e.target.closest('.card_vacancy');
		if (card_vacancy) {
			card_vacancy.classList.remove("card-success");
			card_vacancy.classList.add("card_vacancy_selected");
			let id_obj = card_vacancy.getAttribute('data-id');
			let data = { id: id_obj, op: "show" };
			const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);
			const obj = ajaxResponse.data;
			if (obj.length < 1) return;

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
			inputs_id.val(obj.id);
			btns_submit.attr("disabled",false);
			if (role_cookie != 4) {
				btns_submit.attr("disabled",true);
				btns_submit.text("SOLO CANDIDATOS");
			}
			setTimeout(() => {
				input_filter_search.focus();
			}, 500);

		}
	}
})

async function fillVacancies(show_toas=true) {
	let data = { op: "indexJobBag" };
	const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data, null, true, show_toas);

	//Limpiar table
	// vacancy_container.slideUp();

	
	// const list = [];
	let objResponse = ajaxResponse.data;
	// console.log(objResponse);
	
	if (objResponse.length < 1) return vacancy_container.html(`
		<h3 class="text-center fst-italic">NO HAY VACANTES DISPONIBLES POR EL MOMENTO</h3>
	`);

	dataVacancies = objResponse; // aqui estamos pasando la data a una variable global para usarla en el buscador
	await objResponse.map( obj => {
		//busco los elementos que existen en mi template y le asigno valores a sus atributos y contenido...
		template_card_vacancy.querySelector(".card_vacancy").setAttribute("data-id", obj.id);
		template_card_vacancy.querySelector(".vacancy").innerText = `${obj.vacancy}`;
		// template_card_vacancy.querySelector(".vacancy_numbers").innerText = `1`;
		template_card_vacancy.querySelector(".publication_date").innerText = `Publicado ${moment(obj.publication_date, "YYYYMMDD").fromNow()}`;
		template_card_vacancy.querySelector(".company").innerText = `${obj.company}`;
		template_card_vacancy.querySelector(".company_location").innerText = `${obj.municipality}, ${obj.state}`;
		template_card_vacancy.querySelector(".area").innerText = `${obj.area}`;
		template_card_vacancy.querySelector(".min_salary").innerText = `${formatCurrency(obj.min_salary, true, false)}`;
		template_card_vacancy.querySelector(".max_salary").innerText = `${formatCurrency(obj.max_salary, true, false)}`;
		template_card_vacancy.querySelector(".job_type").innerText = `${obj.job_type}`;
		template_card_vacancy.querySelector(".schedules").innerText = `${obj.schedules}`;

		// ya que termine de asignarle valores a mis elementos de la plantilla, creo un nodo llamado clone ya que duplicara el contenido de mi template
		let clone = document.importNode(template_card_vacancy, true); //el primer parametro es el elemento a cloonar y el segundo parametro es para indicar que si quiero que se duplique  su contenido
		fragment_card_vacancy.appendChild(clone); //lo agego al fragmento
	});
	vacancy_container.html(null); //si se va a sustituir, se recomienda vaciar el contenido de nuestra seccion antes de agregar nuestro fragment
	vacancy_container.append(fragment_card_vacancy); //ya que termino el recorrido y todo esta el fragment, agregamos todo a la seccion  seleccionada
	//Dibujar Tabla
	vacancy_container.slideDown("slow");
	btn_reset.click();
	card_vacancy = $(".card_vacancy");

   adaptDetail();
	vacancies_enabled.text(dataVacancies.length);
}


// #region FUNCIONES DEL BUSCADOR
// form_filter.on("change", () => searchVacancies())
// form_filter.on("input", () => searchVacancies())
form_filter.on("submit", function(e) {e.preventDefault(); searchVacancies(input_filter_search)});

input_filter_search.on("input change", function(e) {searchVacancies(this)});
async function searchVacancies(input) {
   let searching = false;
	let filtered_vacancies = dataVacancies;

   if (searching) return;
   // console.log("buscando...",input.value);
   searching = true;

	const search = accentFold(input.value);
	// const filtered_cards = vacancy_container.html();
	// console.log(filtered_cards);

	if (search == "" || search == undefined) {
		displayResults(filtered_vacancies);
		leyend_job_found.text("¡Busca tú empleo ideal!")
		return;
	}
	const filtered_results = dataVacancies.filter(function(item) {
		// Lógica de búsqueda, por ejemplo:
		if (accentFold(item.vacancy).toLowerCase().includes(search.toLowerCase())) return item;
		else if (accentFold(item.company).toLowerCase().includes(search.toLowerCase())) return item;
	});
  	displayResults(filtered_results);

}

input_state.on("input change click", function(e) {searchVacanciesByLocation(this)});
async function searchVacancies(input_js) {
	const input = $(input_js);
   let searching = false;
	let filtered_vacancies = dataVacancies;

   if (searching) return;
   // console.log("buscando...",input.val());
   searching = true;

	const search = accentFold(input.val());
	// console.log(search);

	if (search == "") {
		displayResults(filtered_vacancies);
		leyend_job_found.text("¡Busca tú empleo ideal!")
		return;
	}
	const filtered_results = dataVacancies.filter(function(item) {
		// Lógica de búsqueda, por ejemplo:
		if (accentFold(item.vacancy).toLowerCase().includes(search.toLowerCase())) return item;
		else if (accentFold(item.company).toLowerCase().includes(search.toLowerCase())) return item;
	});
  	displayResults(filtered_results);
		setTimeout(() => {
			vacancy_container.click();
		}, 1000);
}

function displayResults(results) {
	vacancy_container.html(null); // Limpia los resultados anteriores
	if (results.length < 1) {
		vacancy_container.html(`
			<h3 class="text-center fst-italic">NO HAY VACANTES DISPONIBLES CON ESTOS FILTROS</h3>
		`);
		leyend_job_found.text("¡0 coincidencias!")
		return;
	}
	results.forEach(function(obj) {
	//busco los elementos que existen en mi template y le asigno valores a sus atributos y contenido...
		template_card_vacancy.querySelector(".card_vacancy").setAttribute("data-id", obj.id);
		template_card_vacancy.querySelector(".vacancy").innerText = `${obj.vacancy}`;
		// template_card_vacancy.querySelector(".vacancy_numbers").innerText = `1`;
		template_card_vacancy.querySelector(".publication_date").innerText = `Publicado ${moment(obj.publication_date, "YYYYMMDD").fromNow()}`;
		template_card_vacancy.querySelector(".company").innerText = `${obj.company}`;
		template_card_vacancy.querySelector(".company_location").innerText = `${obj.municipality}, ${obj.state}`;
		template_card_vacancy.querySelector(".area").innerText = `${obj.area}`;
		template_card_vacancy.querySelector(".min_salary").innerText = `${formatCurrency(obj.min_salary, true, false)}`;
		template_card_vacancy.querySelector(".max_salary").innerText = `${formatCurrency(obj.max_salary, true, false)}`;
		template_card_vacancy.querySelector(".job_type").innerText = `${obj.job_type}`;
		template_card_vacancy.querySelector(".schedules").innerText = `${obj.schedules}`;

		// ya que termine de asignarle valores a mis elementos de la plantilla, creo un nodo llamado clone ya que duplicara el contenido de mi template
		let clone = document.importNode(template_card_vacancy, true); //el primer parametro es el elemento a cloonar y el segundo parametro es para indicar que si quiero que se duplique  su contenido
		fragment_card_vacancy.appendChild(clone); //lo agego al fragmento
	});
	vacancy_container.html(null); //si se va a sustituir, se recomienda vaciar el contenido de nuestra seccion antes de agregar nuestro fragment
	vacancy_container.append(fragment_card_vacancy); //ya que termino el recorrido y todo esta el fragment, agregamos todo a la seccion  seleccionada
	//Dibujar Tabla
	vacancy_container.slideDown("slow");
	card_vacancy = $(".card_vacancy");

	// adaptDetail();
	leyend_job_found.text(`¡${results.length} empleos para ti!`)
	searching = false;
	setTimeout(() => {
		vacancy_container.click();
	}, 1000);

}
// #endregion FUNCIONES DEL BUSCADOR


form_vacancy.on("submit", function(e) { e.preventDefault(); applyVacancy(this) });
form_modal.on("submit", function(e) { e.preventDefault(); applyVacancy(this) });
async function applyVacancy(form_js) {
	btns_submit.attr("disabled",true);
	const form = $(form_js);
	let data = { 
		op: "checkAlreadyApplied",
		input_vacancy_id: inputs_id.val(), 
		user_id: id_cookie,
	}
	const ajaxApplied = await ajaxRequestAsync(URL_APPLICATION_APP, data, null, true, false);
	//validar cuando no sea candidato! o quitar el boton de postularse
	if (ajaxApplied.data.applied > 0) {
		showToast(ajaxApplied.alert_icon, ajaxApplied.alert_title, "bottom-end")
		btns_submit.attr("disabled",false);
		return;
	}


	data = { 
		op: "apply",
		input_vacancy_id: inputs_id.val(), 
		user_id: id_cookie,
		created_at: moment().format("YYYY-MM-DD hh:mm:ss")
	}
	console.log("data",data);
	await ajaxRequestAsync(URL_APPLICATION_APP, data);
	btns_submit.attr("disabled",false);

}
// let num = 0
// setInterval(() => {
// 	num++;
// 	$(".notification").text(num);
// 	console.log("Refrescando");
// }, 1000);