function modalEdit(elem) {
  let id = $(elem).attr("id");
  $("input#id").val(id);
  $.ajax({
    url: "http://localhost:8080/product/edit/" + id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, product) {
        $("input#sku").val(product.sku);
        $("input#nombre").val(product.nombre);
        $("textarea#descripcion").val(product.descripcion);
        $("input#color").val(product.color);
      });
    },
    error: function (error) {
      console.log("Error en la petición " + error);
    },
  });
}

function EnviarFormulario() {
  document.getElementById("formEdit").submit();
}
