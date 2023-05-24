console.log("registros-perfil.php");

$(".select2").select2();

$("#div_candidate").hide();


const form_role = $("#form_role");
const card_role = $("#card_role");
const user_id = $("#user_id");
const op_modal = $("#op");
const input_name_role = $("[name='input_role']");
const input_role = $("#input_role");

// /* INPUTS DE CARD REGISTRO */
const div_company = $("#div_company"),
   input_company = $("#input_company"),
   input_description = $("#input_description"),
   counter_description = $("#counter_description"),
   input_business_line_id = $("#input_business_line_id"),
   input_company_ranking_id = $("#input_company_ranking_id"),
   input_state = $("#input_state"),
   input_municipality = $("#input_municipality"),
   input_contact_name = $("#input_contact_name"),
   input_contact_phone = $("#input_contact_phone"),
   input_contact_email = $("#input_contact_email")
   ;

// /* INPUTS DE CARD REGISTER */
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



// Obtén el elemento de entrada de archivo y la vista previa
const input_file = $('#input_file');
const preview = $('#preview');

// Agrega un evento change al elemento de entrada de archivo
input_file.on('change', function(event) {
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
    imagen.classList.add("pointer");// Asignar clases
    imagen.classList.add("p-3");// Asignar clases

    // Agrega la imagen a la vista previa
    preview.html(""); // Limpia la vista previa antes de agregar la nueva imagen
    preview.append(imagen);
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
};


input_name_role.on("change",function() {
   changeForms(this.value)
}) 

async function changeForms(checkbox) {
   // const 
   if (checkbox == "Empresa") {
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
   else if (checkbox == "Candidato") {
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
}

// REGISTRAR
form_role.on("submit", async (e) => {
	e.preventDefault();

	if (!validateInputs(form_role)) return;
	// return console.log(form_role.serializeArray());

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

	let data = form_role.serializeArray();
	// return console.log(data);
	// let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
	// if (user_id.val() <= 0) {
		//NUEVO
		// addToArray("created_at", current_date, data);
	// } else {
	// 	//EDICION
	// 	addToArray("updated_at", current_date, data);
	// }

	// return console.log(data);
   console.log("input_name_role", input_name_role.val());
   const url_app = input_name_role.val() == "Empresa"
   ? URL_COMPANY_APP
   : URL_CANDIDATE_APP
   console.log(url_app);
	const ajaxResponse = await ajaxRequestAsync(url_app, data);
	if (ajaxResponse.message == "duplicado") return
	btn_cancel.click();
	await fillTable();
});

input_description.on("input", function() {
	countLetter(this, counter_description, this.value.length, Number(this.dataset.limit))
})