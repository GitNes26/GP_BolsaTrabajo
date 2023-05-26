
//#region VARIABLES
const
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
   btn_submit = $("#btn_submit"),
   btn_reset = $("#btn_reset"),
   
   card_vacancy = $(".card_vacancy")

   ;
//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
	// fillTable();
   
	fillSelect2(URL_BUSINESS_LINE_APP, -1, input_filter_business_line_id);
	fillSelect2(URL_AREA_APP, -1, input_filter_area_id);
   fillSelect2(URL_TAG_APP, -1, input_filter_interest_tags_ids, false);
   showStates();
}


// EVENTO DE REDIMENCIONADO DE VENTANA
$(window).resize(function() {
   // var heightBrowser =$(window).height();
   var widthBrowser = $(window).width();

   if (widthBrowser <= 767) {
      card_vacancy.attr("data-bs-toggle","modal")
      card_vacancy.attr("data-bs-target","#modal")
      if (form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click()
   } else {
      card_vacancy.removeAttr("data-bs-toggle","modal")
      card_vacancy.removeAttr("data-bs-target","#modal")
      
      if (!form_filter.hasClass("collapsed-card")) return;
      btn_show_filters.click()
   }
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
	resetSelect2(input_filter_business_line_id);
	resetSelect2(input_filter_area_id);
	resetSelect2(input_filter_interest_tags_ids);
	resetSelect2(input_state);
	resetSelect2(input_municipality);
	
	setTimeout(() => {
		input_filter_search.focus();
	}, 500);
});


// form_filter.on("change", () => searchVacancies())
// form_filter.on("input", () => searchVacancies())
form_filter.on("submit", (e) => {e.preventDefault(); searchVacancies()})

async function searchVacancies() {
   let searching = false;

   if (searching) return;
   console.log("buscando...");
   searching = true;
   setTimeout(() => {
      console.log("busqueda finalizada");
      searching = false;
   }, 3500);
}
