//#region VARIABLES
const vacancies_enabled = $("#vacancies_enabled"),
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
   form_modal = $("#form_modal");

let card_vacancy = $(".card_vacancy");
let dataVacancies = [];
let vacanciesApplied = [];
//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   fillVacanciesWithRibbon();
   fillBanners();

   fillSelect2(URL_BUSINESS_LINE_APP, -1, input_filter_business_line_id);
   fillSelect2(URL_AREA_APP, -1, input_filter_area_id);
   fillSelect2(URL_TAG_APP, -1, input_filter_interest_tags_ids, false);
   showStates();
   if (role_cookie != 4) {
      btns_submit.attr("disabled", true);
      btns_submit.text("SOLO CANDIDATOS");
   }
}

// EVENTO DE REDIMENCIONADO DE VENTANA
$(window).resize(function () {
   // var heightBrowser =$(window).height();
   adaptDetail();
});
function adaptDetail() {
   var widthBrowser = $(window).width();

   if (widthBrowser <= 767) {
      // console.log("pantalla movil");
      $(".card_vacancy").attr("data-bs-toggle", "modal");
      $(".card_vacancy").attr("data-bs-target", "#modal");
      if (form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click();
   } else {
      // console.log("pantalla pc");
      $(".btn-close").click();
      $(".card_vacancy").removeAttr("data-bs-toggle", "modal");
      $(".card_vacancy").removeAttr("data-bs-target", "#modal");

      if (!form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click();
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

   // PREVIEW
   $(`.output_vacancy`).text("Vacante");
   $(`.output_info_company`).html(`
      <span>Empresa</span><br>
      <span>Ciudad, Estado</span><br>
      <b>CONTACTO:</b>&nbsp;&nbsp;
            <i class="fa-solid fa-user"></i>&nbsp; Contacto &nbsp; | &nbsp;
            <i class="fa-solid fa-phone"></i>&nbsp; (871)-000-00-00 &nbsp; | &nbsp;
            <i class="fa-solid fa-at"></i>&nbsp; correo@contacto.com
      <br><br>
      <span class="">Descripción de la empresa...</span>
   `);
   $(`.div_img`).addClass("d-none");
   $(`.output_area`).text("Área");
   $(`.output_description`).text("Descripción de la vacante...");
   $(`.output_min_salary`).text(formatCurrency("$0"));
   $(`.output_max_salary`).text(formatCurrency("$0"));
   $(`.output_job_type`).text("...");
   $(`.output_schedules`).text("...");
   $(`.output_more_info`).html("");

   setTimeout(() => {
      input_filter_search.focus();
   }, 500);
});

// ACCION PARA LLENAR EL DETALLE
vacancy_container.click(async (e) => {
   $(".card_vacancy_selected").addClass("card_vacancy_selected card-success card-outline");
   $(".card_vacancy_selected").removeClass("card_vacancy_selected");

   if (e.target.matches(".card_vacancy *")) {
      // btn_close_detail.click();
      const card_vacancy = e.target.closest(".card_vacancy");
      if (card_vacancy) {
         card_vacancy.classList.remove("card-success");
         card_vacancy.classList.add("card_vacancy_selected");
         let id_obj = card_vacancy.getAttribute("data-id");
         let data = { id: id_obj, op: "show" };
         const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data);
         const obj = ajaxResponse.data;
         if (obj.length < 1) return;

         // PREVIEW
         $(`.output_vacancy`).text(obj.vacancy);
         data = { op: "show", id: obj.company_id };
         const ajaxResponseCompany = await ajaxRequestAsync(URL_COMPANY_APP, data);
         const objCompany = ajaxResponseCompany.data;
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
         $(`.div_img`).addClass("d-none");
         if (obj.publication_mode != "info") {
            $(`.div_img`).removeClass("d-none");
            $(`.preview_img`).attr("src", `../assets/img/${obj.img_path}`);
         }
         $(`.div_info`).addClass("d-none");
         if (obj.publication_mode.includes("info")) $(`.div_info`).removeClass("d-none");
         $(`.output_area`).text(obj.area);
         $(`.output_description`).text(obj.description);
         $(`.output_min_salary`).text(formatCurrency(obj.min_salary));
         $(`.output_max_salary`).text(formatCurrency(obj.max_salary));
         $(`.output_job_type`).text(obj.job_type);
         $(`.output_schedules`).text(obj.schedules);
         $(`.output_more_info`).html(obj.more_info);
         inputs_id.val(obj.id);
         btns_submit.attr("disabled", false);
         if (role_cookie != 4) {
            btns_submit.attr("disabled", true);
            btns_submit.text("SOLO CANDIDATOS");
         }
         setTimeout(() => {
            input_filter_search.focus();
         }, 500);
      }
   }
});

async function fillVacanciesWithRibbon(show_toas = true) {
   await applicationsByCanidate();
   fillVacancies(show_toas);
}
async function fillVacancies(show_toas = true) {
   let data = { op: "indexJobBag" };
   const ajaxResponse = await ajaxRequestAsync(URL_VACANCY_APP, data, null, true, show_toas);

   //Limpiar table
   // vacancy_container.slideUp();

   // const list = [];
   let objResponse = ajaxResponse.data;
   // console.log(objResponse);

   if (objResponse.length < 1)
      return vacancy_container.html(`
		<h3 class="text-center fst-italic">NO HAY VACANTES DISPONIBLES POR EL MOMENTO</h3>
	`);

   dataVacancies = objResponse; // aqui estamos pasando la data a una variable global para usarla en el buscador
   displayResults(dataVacancies);

   adaptDetail();
   vacancies_enabled.text(dataVacancies.length);
}

// TRAERSE SOLICITUDES APLICADAS POR EL CANDIDATO
async function applicationsByCanidate() {
   if (role_cookie != 4) return;
   vacanciesApplied = [];
   const data = { op: "getVacanciesAppliedByCandidate", user_id: id_cookie };
   const ajaxResponse = await ajaxRequestAsync(URL_APPLICATION_APP, data, null, null, false);
   ajaxResponse.data.ids.map((d) => vacanciesApplied.push(d.id));
}

// #region FUNCIONES DEL BUSCADOR
// form_filter.on("change", () => searchVacancies())
// form_filter.on("input", () => searchVacancies())
form_filter.on("submit", function (e) {
   e.preventDefault();
   searchVacancies(input_filter_search);
});

input_filter_search.on("input change", function (e) {
   searchVacancies(this);
});
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
      displayResults(filtered_vacancies, true);
      leyend_job_found.text("¡Busca tú empleo ideal!");
      return;
   }
   const filtered_results = dataVacancies.filter(function (item) {
      // Lógica de búsqueda, por ejemplo:
      if (accentFold(item.vacancy).toLowerCase().includes(search.toLowerCase())) return item;
      else if (accentFold(item.company).toLowerCase().includes(search.toLowerCase())) return item;
   });
   displayResults(filtered_results, true);
}

input_state.on("input change click", function (e) {
   searchVacanciesByLocation(this);
});
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
      displayResults(filtered_vacancies, true);
      leyend_job_found.text("¡Busca tú empleo ideal!");
      return;
   }
   const filtered_results = dataVacancies.filter(function (item) {
      // Lógica de búsqueda, por ejemplo:
      if (accentFold(item.vacancy).toLowerCase().includes(search.toLowerCase())) return item;
      else if (accentFold(item.company).toLowerCase().includes(search.toLowerCase())) return item;
   });
   displayResults(filtered_results, true);
   setTimeout(() => {
      vacancy_container.click();
   }, 1000);
}

function displayResults(results, filter) {
   vacancy_container.html(null); // Limpia los resultados anteriores
   if (results.length < 1) {
      vacancy_container.html(`
			<h3 class="text-center fst-italic">NO HAY VACANTES DISPONIBLES CON ESTOS FILTROS</h3>
		`);
      if (filter) leyend_job_found.text("¡0 coincidencias!");
      return;
   }
   results.map((obj) => {
      //busco los elementos que existen en mi template y le asigno valores a sus atributos y contenido...
      template_card_vacancy.querySelector(".card_vacancy").setAttribute("data-id", obj.id);
      template_card_vacancy.querySelector(".ribbon-wrapper").classList.add("d-none");
      if (vacanciesApplied.includes(obj.id)) template_card_vacancy.querySelector(".ribbon-wrapper").classList.remove("d-none");
      template_card_vacancy.querySelector(".vacancy").innerText = `${obj.vacancy}`;
      // template_card_vacancy.querySelector(".vacancy_numbers").innerText = `1`;
      template_card_vacancy.querySelector(".publication_date").innerText = `Publicado ${moment(obj.publication_date, "YYYYMMDD").fromNow()}`;
      template_card_vacancy.querySelector(".company").innerText = `${obj.company}`;
      template_card_vacancy.querySelector(".company_location").innerText = `${obj.municipality}, ${obj.state}`;
      template_card_vacancy.querySelector(".have_img").classList.add("d-none");
      template_card_vacancy.querySelector(".div_info_vacancy").classList.remove("d-none");
      if (obj.publication_mode == "img") {
         template_card_vacancy.querySelector(".have_img").classList.remove("d-none");
         template_card_vacancy.querySelector(".div_info_vacancy").classList.add("d-none");
      }
      if (obj.publication_mode == "infoImg") {
         template_card_vacancy.querySelector(".have_img").classList.remove("d-none");
         template_card_vacancy.querySelector(".div_info_vacancy").classList.remove("d-none");
      }
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
   // btn_reset.click();
   card_vacancy = $(".card_vacancy");

   // adaptDetail();
   if (filter) leyend_job_found.text(`¡${results.length} empleos para ti!`);
   searching = false;
   setTimeout(() => {
      vacancy_container.click();
   }, 1000);
}
// #endregion FUNCIONES DEL BUSCADOR

form_vacancy.on("submit", function (e) {
   e.preventDefault();
   applyVacancy(this);
});
form_modal.on("submit", function (e) {
   e.preventDefault();
   applyVacancy(this);
});
async function applyVacancy(form_js) {
   btns_submit.attr("disabled", true);
   // const form = $(form_js);
   let data = {
      op: "checkAlreadyApplied",
      input_vacancy_id: inputs_id.val(),
      user_id: id_cookie
   };
   const ajaxApplied = await ajaxRequestAsync(URL_APPLICATION_APP, data, null, true, false);
   //validar cuando no sea candidato! o quitar el boton de postularse
   if (ajaxApplied.data.applied > 0) {
      showToast(ajaxApplied.alert_icon, ajaxApplied.alert_title, "bottom-end");
      btns_submit.attr("disabled", false);
      return;
   }

   data = {
      op: "show",
      id: inputs_id.val()
   };
   const ajaxVacancy = await ajaxRequestAsync(URL_VACANCY_APP, data, null, true, false);
   // return console.log("ajaxVacancy", ajaxVacancy);

   let title = ``;
   let text = `<h5 class="fw-bold">¿Estas seguro de postularte de <br> ${ajaxVacancy.data.vacancy} en ${ajaxVacancy.data.company} ?</h5>`;
   data = {
      op: "apply",
      input_vacancy_id: inputs_id.val(),
      user_id: id_cookie,
      created_at: moment().format("YYYY-MM-DD hh:mm:ss")
   };
   await ajaxRequestQuestionAsync(title, text, URL_APPLICATION_APP, data, "fillVacanciesWithRibbon(false)", "Sí, Postularme", "green", "question");
   // await ajaxRequestAsync(URL_APPLICATION_APP, data);
   btns_submit.attr("disabled", false);
}
// let num = 0
// setInterval(() => {
// 	num++;
// 	$(".notification").text(num);
// 	console.log("Refrescando");
// }, 1000);

//#region BANNERS
const swipper_banners = document.querySelector("#swipper_banners"),
   template_banner = document.querySelector("#template_banner").content,
   fragment_banner = document.createDocumentFragment(),
   fragment_banner1 = document.createDocumentFragment();
async function fillBanners() {
   const swipper_banners1 = document.getElementById("swipper_banners1");
   // const swipers_wrapper = $(".swiper-wrapper");
   const swipers_wrapper = document.querySelectorAll(".swiper-wrapper");
   const data = {
      op: "fillBanners",
      current_date: moment().format("YYYY-MM-DD")
   };
   const ajaxResponse = await ajaxRequestAsync(URL_BANNER_APP, data, null, false, false);
   // console.log(ajaxResponse);
   ajaxResponse.data.map((obj) => {
      //busco los elementos que existen en mi template y le asigno valores a sus atributos y contenido...
      template_banner.querySelector("img").src = `../assets/img/${obj.file_path}`;
      template_banner.querySelector("img").style = `border-radius: 10px;`;
      template_banner.querySelector("img").alt = `${obj.file_path.split("/").reverse()[0]}`;
      template_banner.querySelector("a").href = "";
      template_banner.querySelector("a").target = ""; 
      template_banner.querySelector("a").removeAttribute("href");
      if (obj.link != null) {
         if (obj.link.length > 1) {
            template_banner.querySelector("a").target = "_blank";
            template_banner.querySelector("a").href = obj.link;
         }
      }

      // ya que termine de asignarle valores a mis elementos de la plantilla, creo un nodo llamado clone ya que duplicara el contenido de mi template
      let $clone = document.importNode(template_banner, true); //el primer parametro es el elemento a cloonar y el segundo parametro es para indicar que si quiero que se duplique  su contenid
      let $clone1 = document.importNode(template_banner, true); //el primer parametro es el elemento a cloonar y el segundo parametro es para indicar que si quiero que se duplique  su contenid
      fragment_banner.appendChild($clone); //lo agego al fragmento
      fragment_banner1.appendChild($clone1); //lo agego al fragmento
   });

   swipers_wrapper[0].innerHTML = null;
   swipers_wrapper[0].appendChild(fragment_banner);
   swipers_wrapper[1].innerHTML = null;
   swipers_wrapper[1].appendChild(fragment_banner1);
   // swipers_wrapper.forEach(sw => {
   // 	console.log(sw);
   // 	sw.innerHTML=null;
   // 	sw.appendChild(fragment_banner);
   // })
   // swipers_wrapper.html(null); //si se va a sustituir, se recomienda vaciar el contenido de nuestra seccion antes de agregar nuestro fragment
   // swipers_wrapper.append(fragment_banner); //ya que termino el recorrido y todo esta el fragment, agregamos todo a la seccion  seleccionada
   // swipers_wrapper.html(null);
   // swipers_wrapper.append(fragment_banner);
   // SLICE PARA BANNERS
   const swiper = new Swiper(".swiper", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      autoplay: {
         delay: 5000
      },
      parallax: true,
      // effect: 'slide',
      a11y: {
         prevSlideMessage: "Anterior",
         nextSlideMessage: "Siguiente"
      },

      // If we need pagination
      pagination: {
         el: ".swiper-pagination"
      },

      // Navigation arrows
      navigation: {
         nextEl: ".swiper-button-next",
         prevEl: ".swiper-button-prev"
      },

      // And if we need scrollbar
      scrollbar: {
         el: ".swiper-scrollbar"
      }
   });
}

//#endregion BANNERS
