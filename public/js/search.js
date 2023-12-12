const base_url =
  "http://localhost/candidatos/jvillon/inventario-codeigniter/public/";
function delay(callback, ms) {
  var timer = 0;
  return function () {
    var context = this,
      args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}

$("input#search").keyup(
  delay(function (e) {
    let search = document.getElementById("search").value;
    //var parent = document.getElementById("container");
    var div = document.getElementById("box");
    //const throwawayNode = parent.removeChild(child);

    $.ajax({
      url:
        "http://localhost/candidatos/jvillon/inventario-codeigniter/public/index.php/product/find/" +
        search,
      type: "GET",
      dataType: "json",
      success: function (data) {
        div.innerHTML = "";
        $.each(data, function (index, product) {
          div.innerHTML += `<div class="col-sm-4 pt-5">
          <div class="card col p-0 me-3">
              <img class="card-img-top img-fluid w-75 mx-auto" src="${base_url}uploads/img/${product["imagen"]}">
              <div class="card-body">
                  <p><strong>SKU:</strong>${product["sku"]}</p>
                  <h3 class="card-title"><${product["nombre"]}</h3>
                  <p class="card-text">
                      ${product["descripcion"]}
                  </p>
                  <a href="#" class="btn btn-info abrirmodal" id="${product["id"]}" onclick="modalEdit(this)" data-toggle="modal" data-target="#modal_producto">Editar</a>
              </div>
          </div>
      </div>`;
        });
      },
      error: function (error) {
        console.log("Error en la petición " + error);
      },
    });
  }, 500)
);
