$(document).ready(function () {
  $('#idcar').click('input',function() {
    let val = $('#carrera').val();
    $.ajax({
      type: "POST",
      url: "ajaxalumno.php?id=" + val,
      data:"",
      dataType: "json",
      success: function (response) {
        const fila = document.querySelector(".datos");
        $('.datos').empty();
          for (const key in response) {
              const element = response[key];
              fila.innerHTML += `
              <tr id="fila1">
                <td class="numero">${element.idnumcon}</td>
                <td class="numero">${element.nombrea}</td>
                <td>
                  <input list="materias" style="width: 100px" id="materialist" class="numero"></input>
                  <datalist id="materias">

                  </datalist>
                </td>
                <td>
                  <input list="profesores" style="width: 100px" id="profesorlist" class="pro"></input>
                  <datalist id="profesores">

                  </datalist></td>
                <td>
                  <button class="btn btn-primary mb-2 agregar" type="button"><i class="fas fa-plus"></i></button>
                </td>
              </tr>`;
              listarMateria(val);
              listarProfesor(val);
        }
        buscar();
      }
    });
    
  })
});
function listarMateria(val) {
  const fila = document.querySelector("#materias");
  $.ajax({
    type: "POST",
    url: "ajaxalumno.php?idmat=" + val,
    data: "",
    dataType: "json",
    success: function (response) {
      for (const key in response) {
        const asignatura = response[key];
        console.log(response[key]);
        fila.innerHTML += `<option value="${asignatura.idasignatura}" id="mat">Materia: ${asignatura.asignatura}</option>`;
      }
    }
  })
}
function listarProfesor(val) {
  const fila = document.querySelector("#profesores");
  $.ajax({
    type: "POST",
    url: "ajaxalumno.php?idpro=" + val,
    data: "",
    dataType: "json",
    success: function (response) {
      for (const key in response) {
        const profesor = response[key];
        console.log(response[key]);
        fila.innerHTML += `<option value="${profesor.idprofesor}">Nombre: ${profesor.profesor}</option>`;
      }
    }
  })
}

function buscar(){
  $(".agregar").click(function() {
    var valores = "";
    let grupo = $('#grupo').val();
    console.log(grupo);
    

    // Obtenemos la fila 2
    let obtenerFila = document.getElementById("fila1");

    // Obtenemos todos los td de la fila
    let elementosFila = obtenerFila.getElementsByTagName("td");
    
    // Iteramos los elementos de la fila para mostrarlos uno por uno.
    for (let i=0; i<=4; i++) {
      console.log(elementosFila[i].innerText);
    }

    let profesora = $("#profesorlist").val();
    console.log(profesora);
    $(this).parents("tr").find(".numero").each(function() {
      valores += $(this).html() + "\n";
    });
    console.log(valores);
  });
}
