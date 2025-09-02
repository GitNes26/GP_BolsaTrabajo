//#region VARIABLES
var table;
table = $("#table").DataTable(DT_CONFIG);

$(document).ready(() => {
   $("#div_new_password").hide();
   $("#input_new_password").prop("readonly", true);
});

const btn_modal_form = $("#btn_modal_form"),
   tbody = $("#table tbody"),
   modal_body = $("#modal-body"),
   form = $("#form"),
   modal_title = $(".modal-title"),
   id_modal = $("#id"),
   op_modal = $("#op"),
   input_email = $("#input_email"),
   div_password = $("#div_password"),
   input_password = $("#input_password"),
   input_confirm_password = $("#input_confirm_password"),
   feedback_password = $("#feedback_password"),
   div_new_password = $("#div_new_password"),
   input_new_password = $("#input_new_password"),
   switch_new_password = $("#switch_new_password"),
   input_role_id = $("#input_role_id"),
   btn_submit = $("#btn_submit"),
   btn_reset = $("#btn_reset");

//#endregion VARIABLES
$(".select2").select2({ dropdownParent: $("#modal") });
focusSelect2($(".select2"));

/* --- FUNCIONES DE CAJON--- */
// estas funciones se encuentran en index.js para no repetir código
/* --- FUNCIONES DE CAJON--- */

init();
async function init() {
   fillTable();
   fillSelect2(URL_ROLE_APP, -1, input_role_id);
}

// CONFIRMAR CONTRASEÑA
input_confirm_password.on("input", function () {
   var pwd1 = input_password.val();
   var pwd2 = input_confirm_password.val();

   if (pwd1 === pwd2) {
      feedback_password.addClass("text-dark").text("Las contraseñas coinciden").removeClass("text-danger");
      input_password.addClass("is-valid").removeClass("is-invalid");
      input_confirm_password.addClass("is-valid").removeClass("is-invalid");
      btn_submit.prop("disabled", false);
   } else {
      feedback_password.addClass("text-danger").text("Las contraseñas no coinciden").removeClass("text-dark");
      input_password.addClass("is-invalid").removeClass("is-valid");
      input_confirm_password.addClass("is-invalid").removeClass("is-valid");
      btn_submit.prop("disabled", true);
   }
});

//CAMBIAR CONTRASEÑA - SWITCH
switch_new_password.click(() => {
   if (switch_new_password.is(":checked")) {
      input_new_password.prop("readonly", false);
   } else {
      input_new_password.val("");
      input_new_password.prop("readonly", true);
   }
});

//CLICK EN BTN ABRIR MODAL
btn_modal_form.click((e) => {
   e.preventDefault();
   $("#div_new_password").hide();
   $("#input_new_password").prop("readonly", true);

   modal_title.html("<i class='fa-solid fa-user-plus'></i></i>&nbsp; REGISTRAR USUARIO");
   btn_submit.removeClass("btn-primary");
   btn_submit.addClass("btn-dark");
   btn_submit.text("AGREGAR");
   div_new_password.hide();
   div_password.show();

   //Resetear form
   btn_reset.click();

   //EXCLUIR INPUTS PARA VALIDAR
   input_new_password.addClass("not_validate");
   input_password.removeClass("not_validate");
   input_confirm_password.removeClass("not_validate");

   // input_email.val("nuevo@gmial.com");
   // input_password.val("1");
});

//RESETEAR FORMULARIOS
btn_reset.click(async (e) => {
   input_password.removeClass("is-invalid is-valid");
   input_confirm_password.removeClass("is-invalid is-valid");
   feedback_password.text("").removeClass("text-danger text-success");
   btn_submit.prop("disabled", false);

   //EXCLUIR INPUTS PARA VALIDAR
   input_new_password.addClass("not_validate");
   input_password.removeClass("not_validate");
   input_confirm_password.removeClass("not_validate");

   await resetSelect2(input_role_id);

   id_modal.val("");
   setTimeout(() => {
      input_email.focus();
   }, 500);
});

// REGISTRAR O EDITAR OBJETO
form.on("submit", async (e) => {
   e.preventDefault();
   id_modal.addClass("not_validate");
   op_modal.addClass("not_validate");
   input_new_password.addClass("not_validate");

   if (switch_new_password.is(":checked")) input_new_password.removeClass("not_validate");
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
   // return console.log(data);
   let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
   if (id_modal.val() <= 0) {
      //NUEVO
      addToArray("created_at", current_date, data);
   } else {
      //EDICION
      addToArray("updated_at", current_date, data);
   }

   // addToArray("consultor_paquete_id", 2, data);
   // addToArray("consultor_fecha_pago", current_date, data);
   // addToArray("consultor_pagado", true, data);
   // addToArray("tipo_objeto","consultor",data);

   // addToArray("suscriptor_name_negocio",vacasCrew,data);
   // addToArray("suscriptor_consultor_id",2,data);
   // addToArray("suscriptor_paquete_id",2,data);
   // addToArray("suscriptor_consultor_viewer",true,data);
   // addToArray("suscriptor_fecha_pago",current_date,data);
   // addToArray("suscriptor_pagado",true,data);
   // addToArray("tipo_objeto", "suscriptor", data);

   // return console.log(data);
   const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);
   if (ajaxResponse.message == "duplicado") return;
   if (id_modal.val() == id_cookie) fillSidebar();
   fillTable();
});

async function fillTable() {
   let data = { op: "index" };
   const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);

   //Limpiar table
   tbody.slideUp();
   table.clear().draw();

   const list = [];
   let objResponse = ajaxResponse.data;
   // return console.log(objResponse);

   objResponse.map((obj) => {
      //Campos
      let column_email = `${obj.email}`,
         column_role = `${obj.role}`,
         column_created_at = formatDatetime(obj.created_at, true);

      let column_buttons = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
      if (permission_update) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-primary btn_edit' type='button' data-id='${obj.id}' title='Editar Usuario' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-user-pen fa-lg i_edit'></i></button>`;
      }
      if (permission_delete) {
         column_buttons +=
            //html
            `<button class='btn btn-outline-danger btn_delete' type='button' data-id='${obj.id}' title='Eliminar Usuario' data-name='${obj.email}'><i class='fa-solid fa-trash-alt i_delete'></i></button>`;
      }
      column_buttons += `</div>
         </td>`;

      list.push([column_email, column_role, column_created_at, column_buttons]);
   });
   //Dibujar Tabla
   table.rows.add(list).draw();
   table.columns.adjust().draw();
   tbody.slideDown("slow");
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

      $("#div_new_password").show();
      $("#input_new_password").prop("readonly", true);
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
   modal_title.html("<i class='fa-solid fa-user-pen'></i></i>&nbsp; EDITAR USUARIO");
   btn_submit.removeClass("btn-dark");
   btn_submit.addClass("btn-primary");
   btn_submit.text("GUARDAR");
   div_password.hide();
   div_new_password.show();

   //EXCLUIR INPUTS PARA VALIDAR
   input_password.addClass("not_validate");
   input_confirm_password.addClass("not_validate");

   let id_obj = btn_edit.attr("data-id");
   let data = { id: id_obj, op: "show" };
   const ajaxResponse = await ajaxRequestAsync(URL_USER_APP, data);

   const obj = ajaxResponse.data;
   //form
   id_modal.val(Number(obj.id));
   input_email.val(obj.email);
   input_new_password.val("");

   await fillSelect2(URL_ROLE_APP, obj.role_id, input_role_id);
   setTimeout(() => {
      input_email.focus();
   }, 850);
}

//ELIMINAR OBJETO
async function deleteObj(btn_delete) {
   let title = `¿Estas seguro de eliminar a <br> ${btn_delete.attr("data-name")}?`;
   let text = ``;

   let current_date = moment().format("YYYY-MM-DD hh:mm:ss");
   let data = {
      op: "delete",
      id: Number(btn_delete.attr("data-id")),
      deleted_at: current_date
   };

   ajaxRequestQuestionAsync(title, text, URL_USER_APP, data, "fillTable()");
}
