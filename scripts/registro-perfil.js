$(document).ready(function() {
   SUMMERNOTE_CONFIG.placeholder = "Escribir Habilidades, competencias, experiencias, observaciones, etc."
   SUMMERNOTE_CONFIG.toolbar.push(['templates', ['template_candidate']]),

	$('.summernote').summernote(SUMMERNOTE_CONFIG)
});

$(".select2").select2();

$("#div_candidate").hide();


const form_role = $("#form_role");
const card_role = $("#card_role");
const user_id = $("#user_id");
const op_modal = $("#op");
const input_name_role = $("[name='input_role']");
const input_role = $("#input_role");

// /* INPUTS DE REGISTRO EMPRESA */
const div_company = $("#div_company"),
   input_company = $("#input_company"),
   input_description = $("#input_description"),
   counter_description = $("#counter_description"),
   input_logo_path = $('#input_logo_path'), //este es un input_file
   preview_logo = $('#preview_logo'),
   input_business_line_id = $("#input_business_line_id"),
   input_company_ranking_id = $("#input_company_ranking_id"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
   input_contact_name = $("#input_contact_name"),
   input_contact_phone = $("#input_contact_phone"),
   input_contact_email = $("#input_contact_email")
   ;

// /* INPUTS DE REGISTRO CANDIDATO */
const div_candidate = $("#div_candidate"),
   input_name = $("#input_name"),
   input_last_name = $("#input_last_name"),
   input_email = $("#input_email"),
   input_age = $("#input_age"),
   input_interest_tags_ids = $("#input_interest_tags_ids")
   ;

// email.focus();
const
   btn_done = $("#btn_done"), 
   btn_reset = $("#btn_reset"),
   btn_return = $("#btn_return");

$.fn.select2.defaults.set("language", "es");
focusSelect2($(".select2"));


// // const check_theme = $("#check_theme");
// // check_theme.on("change", function() {
//    // $("body").toggleClass("dark-mode")
//    // const dark_mode = $("body").hasClass("dark-mode") ? true : false;
//    // Cookies.set("dark_mode", dark_mode);
//    // check_theme.is("Cheked",dark_mode)
//       Cookies.get("dark_mode") ? $("body").addClass("dark-mode") : $("body").removeClass("dark-mode")


//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {

	//EXCLUIR INPUTS PARA VALIDAR
	await resetSelect2(input_business_line_id);
	await resetSelect2(input_company_ranking_id);
	await resetSelect2(input_interest_tags_ids);
	await resetSelect2(input_state);
	await resetSelect2(input_municipality);
   input_municipality.attr("disabled",true);

	$('.note-editing-area .note-editable').html(null);
	$('.note-editing-area .note-placeholder').css("display","block");

	
	setTimeout(() => {
		input_company.focus();
	}, 500);
});

// Agrega un evento change al elemento de entrada de archivo
input_logo_path.on('change', function(event) {
   // Obtén el archivo seleccionado
   const file = event.target.files[0];

   // Crea un objeto FileReader
   const fileReader = new FileReader();

   // Define la función de carga completada del lector
   fileReader.onload = function(e) {
      // Crea un elemento de imagen
      const imagen = document.createElement('img');
      imagen.src = e.target.result; // Asigna la imagen cargada como fuente
      imagen.classList.add("img-fluid"); // Asignar clases
      imagen.classList.add("pointer"); // Asignar clases
      //  imagen.classList.add("p-5"); // Asignar clases
      imagen.classList.add("rounded-lg"); // Asignar clases
      // imagen.classList.add("text-center"); // Asignar clases
      imagen.style = "max-height: 200px !important";

      // Agrega la imagen a la vista previa
      preview_logo.html(""); // Limpia la vista previa antes de agregar la nueva imagen
      preview_logo.append(imagen);
   };

  // Lee el contenido del archivo como una URL de datos
  fileReader.readAsDataURL(file);
});



init();
async function init() {
   counter_description.text(`0/${input_description.data("limit")}`);
   showStates();

   fillSelect2(URL_BUSINESS_LINE_APP, -1, input_business_line_id, false);
   fillSelect2(URL_COMPANY_RANKING_APP, -1, input_company_ranking_id, false);
   fillSelect2(URL_TAG_APP, -1, input_interest_tags_ids, false);
   user_id.val(id_cookie);
   input_company.focus();
};


input_name_role.on("change",async function()  {
   if (this.value == "Empresa") {
      await div_candidate.slideUp(450);
      // await div_company.slideDown(450);
      setTimeout(() => {
         div_company.slideDown(450);
         setTimeout(() => {input_company.focus();},500)
      }, 450);
      // no valido candidato
      $("#div_candidate input").addClass("not_validate");
      $("#div_candidate select").addClass("not_validate");
      $("#div_candidate textarea").addClass("not_validate");
      // valido empresa
      $("#div_company input").removeClass("not_validate");
      $("#div_company select").removeClass("not_validate");
      $("#div_company textarea").removeClass("not_validate");
      
   }
   else if (this.value == "Candidato") {
      await div_company.slideUp(450);
      // await div_candidate.slideDown(450);
      setTimeout(() => {
         div_candidate.slideDown(450);
         setTimeout(() => {input_company.focus();},500)
      }, 450);
      // valido candidato
      $("#div_candidate input").removeClass("not_validate");
      $("#div_candidate select").removeClass("not_validate");
      $("#div_candidate textarea").removeClass("not_validate");
      input_interest_tags_ids.addClass("not_validate");
      // input_skills.addClass("not_validate");
      // input_abilities.addClass("not_validate");
      // no valido empresa
      $("#div_company input").addClass("not_validate");
      $("#div_company select").addClass("not_validate");
      $("#div_company textarea").addClass("not_validate");
   }
})

// REGISTRAR
form_role.on("submit", async (e) => {
	e.preventDefault();

   console.log();
	if (!validateInputs(form_role)) return;
	// return console.log(form_role.serializeArray());
   let data = form_role.serializeArray();
   let url_app = URL_COMPANY_APP;

   // si esta seleccionada la "Empresa"
   if (input_name_role[0].checked) {
      console.log("soy empresa");
      // if (user_id.val() <= 0) {
      // 	//NUEVO
      // 	if (!permission_write) return;
      // 	user_id.val("");
      // 	op_modal.val("create");
      // } else {
      // 	//EDICION
      // 	if (!permission_update) return;
      // 	op_modal.val("edit");
      // }

      // return console.log(data);
      // let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
      // if (user_id.val() <= 0) {
         //NUEVO
         // addToArray("created_at", current_date, data);
      // } else {
      // 	//EDICION
      // 	addToArray("updated_at", current_date, data);
      // }

      const form_imagen = $("#form_role")[0];
      data = new FormData(form_imagen);
      console.log("input_name_role", input_name_role.val());
      // return console.log([...data]);
      // return console.log(data);
   } else {
      console.log("soy candidato");
      url_app = URL_CANDIDATE_APP;

      const input_current_date = $('.note-editing-area .note-editable').html();
      addToArray("input_professional_info", input_current_date, data);
      addToArray("input_user_id", id_cookie, data);
      
   }	

   // return console.log(url_app, data);
	const ajaxResponse = await ajaxRequestAsync(url_app, data);
	// const ajaxResponse = await ajaxRequestFileAsync(url_app, data);
	if (ajaxResponse.message == "duplicado") return
   console.log("ahi quedo");
   
	// btn_cancel.click();
	// await fillTable();
});