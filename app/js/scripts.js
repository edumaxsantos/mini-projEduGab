
function gerarID() {
  let codigo = 'COD0';
  let texto = '1234567890';
  for (let a = 0; a < 7; a++) {
    let b = Math.floor(Math.random() * (texto.length - 0)) + 0;
    codigo += b;
  }
  $('#idProd').val(codigo);
}

function carregaProdutos(obj) {
  console.log(obj);
  for (let a in obj) {
    if (!(obj[a] === null)) {
      $('input[name='+a+']').val(obj[a]);
    }
  }
  $('option[value='+obj['categoria']+']').attr('selected','true');
}

function pegarProduto() {
  console.log("CHEGUEI");
  let id = $('#idProd').val();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     let obj = jQuery.parseJSON(this.response);
     carregaProdutos(obj);
    }
  };
  xhttp.open("GET", "pesquisar.php?id="+id, true);
  xhttp.send();
}

$( () => {
  $('[data-toggle="tooltip"]').tooltip();
  $('form').submit( (evt) => {
    if ($.trim($('#nomeProd').val()) == '') {
      evt.preventDefault();
      window.history.back();
      $('#nomeProd').addClass('form-control-danger');
      $('#div-nomeProd').addClass('has-danger');

    }
    if ($.trim($('#fornecedor').val()) == '') {
      evt.preventDefault();
      window.history.back();
      $('#fornecedor').addClass('form-control-danger');
      $('#div-fornecedor').addClass('has-danger');

    }
  });
});
