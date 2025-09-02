//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {});

// btn_modal_form = $("#btn_modal_form"),
const tbody = $("#table tbody"),
   modal_body = $("#modal-body"),
   form = $("#form"),
   modal_title = $(".modal-title"),
   id_modal = $("#id"),
   op_modal = $("#op"),
   input_menu = $("#input_menu"),
   input_description = $("#input_description"),
   input_tag = $("#input_tag"),
   input_belongs_to = $("#input_belongs_to"),
   input_file_path = $("#input_file_path"),
   input_icon = $("#input_icon"),
   input_active = $("#input_active"),
   label_module_enable = $("#label_module_enable"),
   input_show_counter = $("#input_show_counter"),
   label_module_counter = $("#label_module_counter"),
   btn_submit = $("#btn_submit"),
   btn_reset = $("#btn_reset"),
   btn_cancel = $("#btn_cancel");

//#endregion VARIABLES
$(".select2").select2();
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   fillTable();
   fillSelect2(URL_MENU_APP, -1, input_belongs_to, true);
   setTimeout(() => {
      input_menu.focus();
   }, 500);
}

//CLICK EN BTN CANCELAR PARA CREAR UNO NUEVO
btn_cancel.click((e) => {
   e.preventDefault();
   // modal_title.html(
   // 	"<i class='fa-solid fa-user-pen'></i></i>&nbsp; REGISTRAR USUARIO"
   // );
   btn_submit.removeClass("btn-primary");
   btn_submit.addClass("btn-dark");
   btn_submit.text("AGREGAR");

   btn_cancel.removeClass("btn-dark");
   btn_cancel.addClass("btn-danger");
   btn_cancel.text("CANCELAR");

   //Resetear form
   btn_reset.click();
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
   label_module_enable.text("Activo");
   label_module_counter.text("Mostrar contador");
   await resetSelect2(input_belongs_to);
   id_modal.val("");
   // setTimeout(() => {
   // 	input_menu.focus();
   // }, 500);
});

// SWITCH HABILITADO/DESAHBILITADO
function switchEnabled(status, input) {
   // console.log("status",status);
   if (status) input.is(":checked") ? null : input.click();
   else input.is(":checked") ? input.click() : null;
}
input_active.change(() => (input_active.is(":checked") ? label_module_enable.text("Activo") : label_module_enable.text("No Activo")));
input_show_counter.change(() =>
   input_show_counter.is(":checked") ? label_module_counter.text("Mostrar Contador") : label_module_counter.text("No Mostrar Contador")
);

// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
   e.preventDefault();
   id_modal.addClass("not_validate");
   op_modal.addClass("not_validate");

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
   let class_icon = data[6].value.split('"')[1];
   if (data[6].value.includes('"')) {
      data[6].value = class_icon;
   }
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
   const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data);
   // if (ajaxResponse.message != "duplicado") fillTable();
   await fillTable();
   await fillSidebar();
});

async function fillTable(show_toas = true) {
   let data = { op: "index" };
   const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data, null, true, show_toas);

   //Limpiar table
   tbody.slideUp();
   table.clear().draw();

   const list = [];
   let objResponse = ajaxResponse.data;
   // console.log(objResponse);

   objResponse.map((obj) => {
      let active_icon = "fa-solid fa-circle-check";
      let icon_color = "green";
      let switch_enabled = {
         color: "success",
         title: "Activo",
         icon: "fa-solid fa-toggle-on"
      };

      if (!Boolean(obj.active)) {
         active_icon = "fa-solid fa-circle-xmark";
         icon_color = "red";
         switch_enabled.color = "secondary";
         switch_enabled.title = "No Activo";
         switch_enabled.icon = "fa-solid fa-toggle-off";
      }

      //Campos
      let column_icon = `
			<td class='align-middle align-middle'>
				<i class="${obj.icon} fa-2x icono"></i><br>
				<i>${obj.icon}</i>
			</td>
			`,
         column_module = `
			<b>${obj.menu}</b><br>
			<i>tag: ${obj.tag}</i>
			`,
         column_info = `
			<td class="text-center">
				<p class="">
					pertenece a: <b>${!obj.belongs_to ? "-" : obj.parent_menu}</b><br>
					<!-- Orden: <b>${obj.order}</b><br> -->
					archivo: <b>${!obj.file_path ? "-" : obj.file_path}</b>
				</p>
			</td>
			`,
         column_active = `
			<div class="text-center align-middle">
				<i class="${active_icon} fa-2x icono" style="color:${icon_color}"></i>
			</div>
			`;

      let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
      if (permission_update) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Módulo' ><i class='fa-regular fa-pen-to-square fa-lg i_edit'></i></button>`;
      }
      if (permission_delete) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-${switch_enabled.color} btn_delete' type='button' data-id='${obj.id}' title='${switch_enabled.title}' data-active='${obj.active}'><i class='${switch_enabled.icon} fa-2x i_delete'></i></button>`;
      }
      column_buttons += `</div>
         </td>`;

      list.push([column_icon, column_module, column_info, column_active, column_buttons]);
   });
   //Dibujar Tabla
   table.rows.add(list).draw();
   table.columns.adjust().draw();
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
   if ($(e.target).hasClass("btn_delete") || $(e.target).hasClass("i_delete")) {
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
   // modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR USUARIO");
   btn_submit.removeClass("btn-dark");
   btn_submit.addClass("btn-primary");
   btn_submit.text("GUARDAR");

   btn_cancel.removeClass("btn-danger");
   btn_cancel.addClass("btn-secondary");
   btn_cancel.text("NUEVO");

   btn_reset.click();

   let id_obj = btn_edit.attr("data-id");
   let data = { id: id_obj, op: "show" };
   const ajaxResponse = await ajaxRequestAsync(URL_MENU_APP, data);

   const obj = ajaxResponse.data;
   //form
   // console.log(obj);
   id_modal.val(Number(obj.id));
   input_menu.val(obj.menu);
   input_description.val(obj.description);
   input_tag.val(obj.tag);
   input_file_path.val(obj.file_path);
   input_icon.val(obj.icon);
   await fillSelect2(URL_MENU_APP, obj.belongs_to, input_belongs_to, true);
   switchEnabled(Boolean(Number(obj.active)), input_active);
   switchEnabled(Boolean(Number(obj.show_counter)), input_show_counter);
   label_module_enable.text(obj.active == 1 ? "Activo" : "No Activo");
   label_module_counter.text(obj.show_counter == 1 ? "Mostrar Contador" : "No Mostrar Contador");

   setTimeout(() => {
      input_menu.focus();
   }, 500);
}

//ELIMINAR OBJETO -- CAMBIAR STATUS CON EL SWITCH
async function deleteObj(btn_delete) {
   const status = btn_delete.attr("data-active") == "1" ? "0" : "1";
   const data = {
      op: "activeDesactive",
      id: Number(btn_delete.attr("data-id")),
      switch_active: status
   };
   await ajaxRequestAsync(URL_MENU_APP, data);
   fillSidebar(false);
   fillTable(false);
}
