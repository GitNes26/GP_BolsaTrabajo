'use strict'

const
form = $("#form"),
input_db = $("#input_db"),
btn_sync_info = $("#btn_sync_info"),
tbody = $("#table_nominas tbody"),
$tbody = document.querySelector("#table_nominas tbody"),
$row_template = document.querySelector("#row_template").content,
$row_fragment = document.createDocumentFragment()
;
let table = $("#table_nominas").DataTable();
let tableData;
// table.column(5).visible(0);

const FillTable1 = async(data=null) => {
	let dataResponse = data;
	/** Realizar Petición */
	if (data == null) {
		let datasend = { op:"Index" }
  	const ajaxResponse = await AjaxRequestAsync(URL_NOMINA_APP, datasend);
		dataResponse = ajaxResponse.data
	}
	/** Pasar los registros a una variable global para cuando se desee sincronizar */
	tableData = dataResponse;

	/** Limpiar table */
	tbody.slideUp();
	// table.clear().draw();
	table.destroy(); // Destruimos el DataTable para volver a construirlo
	await dataResponse.map(obj => {
		/** Armando campos con su contenido */
		let campo_codigo = `${obj.codigoempleado}`,
			campo_nombre = `${obj.nombre}`.toUpperCase(),
			campo_paterno = `${obj.apellidopaterno}`.toUpperCase(),
			campo_materno = `${obj.apellidomaterno}`.toUpperCase(),
			campo_rfc = `${obj.rfc}`.toUpperCase(),
			campo_curp = `${obj.curp}`.toUpperCase(),
			campo_fecha = FormatDatetime(obj.fechaalta, false)
		;


		let campo_botones = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
		// if (permiso_cambios) {
			campo_botones +=
				//html
				`<button class='btn btn-outline-primary btn_editar' type='button' data-id='${obj.id}' title='Edit User' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-user-pen fa-lg i_editar'></i></button>`;
		// }
		// if (permiso_bajas) {
			campo_botones +=
				//html
				`<button class='btn btn-outline-danger btn_eliminar' type='button' data-id='${obj.id}' title='Delete User' data-nombre='${obj.usuario}'><i class='fa-solid fa-trash-alt i_eliminar'></i></button>`;
		// }
		campo_botones += `</div>
         </td>`;

		/** Dibujar tabla
				INTENTAR LLENAR LA TABLA CON TEMPLATES, ES MÁS RAPIDA */
		$row_template.querySelector(".td_ce").innerHTML = campo_codigo;
		$row_template.querySelector(".td_n").innerHTML = campo_nombre;
		$row_template.querySelector(".td_ap").innerHTML = campo_paterno;
		$row_template.querySelector(".td_am").innerHTML = campo_materno;
		$row_template.querySelector(".td_rfc").innerHTML = campo_rfc;
		$row_template.querySelector(".td_curp").innerHTML = campo_curp;
		$row_template.querySelector(".td_fa").innerHTML = campo_fecha;
		// ya que termine de asignarle valores a mis elementos de la plantilla, creo un nodo llamado clone ya que duplicara el contenido de mi template

		let $clone = document.importNode($row_template, true); //el primer parametro es el elemento a cloonar y el segundo parametro es para indicar que si quiero que se duplique  su contenido
		$row_fragment.appendChild($clone); //lo agego al fragmento
	});
	$tbody.innerHTML = null; //si se va a sustituir, se recomienda vaciar el contenido de nuestra seccion antes de agregar nuestro fragment
	$tbody.appendChild($row_fragment); //ya que termino el recorrido y todo esta el fragment, agregamos todo a la seccion  seleccionada

	table = $('#table_nominas').DataTable(DT_CONFIG)
	table.draw();
	tbody.slideDown("slow");
}
const FillTable = async(data=null) => {
	let dataResponse = data;
	/** Realizar Petición */
	if (data == null) {
		let datasend = { op:"Index" }
  	const ajaxResponse = await AjaxRequestAsync(URL_NOMINA_APP, datasend);
		dataResponse = ajaxResponse.data
	}
	/** Pasar los registros a una variable global para cuando se desee sincronizar */
	tableData = dataResponse;
	let fieldsData = []
	/** Limpiar table */
	tbody.slideUp();
	// table.clear().draw();
	await dataResponse.map(obj => {
		/** Armando campos con su contenido */
		let campo_codigo = `<b>${obj.codigoempleado}</b>`,
			campo_nombre = `${obj.nombre}`.toUpperCase(),
			campo_paterno = `${obj.apellidopaterno}`.toUpperCase(),
			campo_materno = `${obj.apellidomaterno}`.toUpperCase(),
			campo_rfc = `${obj.rfc}`.toUpperCase(),
			campo_curp = `${obj.curp}`.toUpperCase(),
			campo_fecha = FormatDatetime(obj.fechaalta, false)
		;


		let campo_botones = `<td class='align-middle'>
            <div class='btn-group' role='group' aria-label='Basic example'>`;
		// if (permiso_cambios) {
			campo_botones +=
				//html
				`<button class='btn btn-outline-primary btn_editar' type='button' data-id='${obj.id}' title='Edit User' data-bs-toggle="modal" data-bs-target="#modal"><i class='fa-solid fa-user-pen fa-lg i_editar'></i></button>`;
		// }
		// if (permiso_bajas) {
			campo_botones +=
				//html
				`<button class='btn btn-outline-danger btn_eliminar' type='button' data-id='${obj.id}' title='Delete User' data-nombre='${obj.usuario}'><i class='fa-solid fa-trash-alt i_eliminar'></i></button>`;
		// }
		campo_botones += `</div>
         </td>`;
		const objRow = [
			campo_codigo,
			campo_nombre,
			campo_paterno,
			campo_materno,
			campo_rfc,
			campo_curp,
			campo_fecha
		]
		fieldsData.push(objRow)

	});
	/** Dibujar tabla */
	table.clear()
		.rows
		.add(fieldsData)
		.draw()
	table.columns.adjust().draw();
	tbody.slideDown("slow");
}
const FillTableWithData= async(data=null) => {
	let dataResponse = data;
	/** Realizar Petición */
	if (data == null) {
		let datasend = { op:"Index" }
  	const ajaxResponse = await AjaxRequestAsync(URL_NOMINA_APP, datasend);
		dataResponse = ajaxResponse.data
	}
	/** Pasar los registros a una variable global para cuando se desee sincronizar */
	tableData = dataResponse;

	/** Limpiar table */
	tbody.slideUp();
	table.clear().draw();
	$('#table_nominas').DataTable({
		destroy: true,
    data: dataResponse,
		columns: [
			{ data: `codigoempleado` },
			{ data: `nombre`},
			{ data: `apellidopaterno` },
			{ data: `apellidomaterno` },
			{ data: `rfc`},
			{ data: `curp` },
			{ data: "fechaalta" }
		]
	});
	// { data: FormatDatetime("fechaalta", false) }

	tbody.slideDown("slow");
}

// form.on("submit", async(e) => {
input_db.on("change", async(e) => {
	e.preventDefault();
	const datasend = form.serializeArray();
	const ajaxResponse = await AjaxRequestAsync(URL_NOMINA_APP, datasend);
	FillTable(ajaxResponse.data)
});

btn_sync_info.click(async() => {
	let data = []
	// for (let tr = 0; tr < $("tbody tr").length; tr++) {
	// 	const element = $("tbody tr")[tr];
	// 	const obj = {
	// 		codigoEmpleado: null,
	// 		nombreE: null,
	// 		apellidoP: null,
	// 		apellidoM: null,
	// 		Rfc: null,
	// 		fechaAlta: null
	// 	}
	// 	obj.codigoEmpleado = element.children[0].innerText;
	// 	obj.nombreE = element.children[1].innerText;
	// 	obj.apellidoP = element.children[2].innerText;
	// 	obj.apellidoM = element.children[3].innerText;
	// 	obj.Rfc = element.children[4].innerText;
	// 	obj.fechaAlta = FormatDatetimeToSQL(element.children[5].innerText);
	// 	data.push(obj)
	// }
	tableData.forEach(reg => {
		const obj = {
			codigoEmpleado: null,
			nombreE: null,
			apellidoP: null,
			apellidoM: null,
			Rfc: null,
			fechaAlta: null
		}
		obj.codigoEmpleado = reg.codigoempleado;
		obj.nombreE = reg.nombre;
		obj.apellidoP = reg.apellidopaterno;
		obj.apellidoM = reg.apellidomaterno;
		obj.Rfc = reg.rfc;
		obj.Curp = reg.curp;
		obj.fechaAlta = FormatDatetimeToSQL(reg.fechaalta);
		data.push(obj)
	})
	data = JSON.stringify(data);
	const datasend = {
		op: "SyncInfo",
		data: data
	}
	const ajaxResponse = await AjaxRequestAsync(URL_NOMINA_APP, datasend);
})




const init = async () => {
	await FillTable();
}
init();

const back = (e) => {
	e.preventDefault();
	history.back();
}