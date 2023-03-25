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
                  <input list="materias" style="width: 100px" id="materialist" class="mate"></input>
                  <datalist id="materias">

                  </datalist>
                </td>
                <td>
                  <input type="text" list="profesores" style="width: 100px" id="profesorlist" class="pro"></input>
                  <datalist id="profesores">

                  </datalist></td>
                <td>
                  <button class="btn btn-primary mb-2 agregar" type="button"><i class="fas fa-plus"></i></button>
                </td>
              </tr>`;
              listarMateria(val);
              listarProfesor(val);
        }
        $(".agregar").click(function() {
          let grupo = $('#grupo').val();
          console.log(grupo);
          var valores = "";
          $(this).parents("tr").find(".numero").each(function () {
            valores += $(this).html() + "\n";
          });
          const array = valores.split("\n");
          let idalumno = array[0];
          console.log(idalumno);
          let idasignatura = $(this).parents('tr').find('.mate').val();
          console.log(idasignatura);
          let idprofesor = $(this).parents('tr').find('.pro').val();
          console.log(idprofesor);
          $.ajax({
            type: "POST",
            url: "ajaxalumno.php?idnum=" + idalumno + "&idmate=" + idasignatura + "&idprof=" + idprofesor + "&grup=" + grupo,
            data: "",
            dataType: "json",
            success: function (response) {
              for (const key in response) {
                  const element = response[key];
                  console.log(element);
                  if (element === true) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Registrado',
                      showConfirmButton: false,
                      timer: 2000
                  })
                  } else if (element === false) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: 'No Registrado',
                      showConfirmButton: false,
                      timer: 2000
                  })
                  } else if (element === "empty") {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Todo los campos son obligatorio',
                        showConfirmButton: false,
                        timer: 2000
                    })
                  } else if (element === "occupied") {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'info',
                      title: 'Ya Registrado!!',
                      showConfirmButton: false,
                      timer: 2000
                  })
                  }
              }
              
            }
          });
        });
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
        console.log(response[key])
        const profesor = response[key];
        fila.innerHTML += `<option value="${profesor.idprofesor}">Nombre: ${profesor.profesor}</option>`;
      }
    }
  })
}

