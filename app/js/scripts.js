

function procuraVendas() {
  const id = $('#idVenda').val();
  $.ajax({
    type: 'POST',
    url: 'pesquisarVenda.php',
    data: {'id': id}
    dataType: 'json'
  }).done(function() {
    alert('deu certo');
  });

}

function troca(id) {
  if (id === "idProd") {
    $('#idVenda').attr('disabled', 'true');
  }
  else {
    $('#idProd').attr('disabled', 'true');
  }
}

function habilita() {
  $('#idVenda').removeAttr('disabled');
  $('#idProd').removeAttr('disabled');
}

const ProdutoComponent = Vue.extend({
  template: `<div id="info-produtos" class="row produto">
    <div class="row center-block">
      <div class="col-md-8">
        <label for="idProduto">Nome do Produto:</label>
        <input type="text" id="nomeProduto" value="" size="30" disabled />
      </div>
      <div class="col-md-4">
        <label for="nomeProduto">Quantidade:</label>
        <input type="text" id="qtde" value="" size="4" disabled />
      </div>
    </div>
  </div>`
});

const VendasCompoment = Vue.extend({
  template: `<div id="venda" class="container center-form col-md-6">
      <div id="info-venda" class="row center-block vendas">
          <div class="col-md-6">
              <label for="dataVenda">Data da Venda:</label>
              <input type="date" id="dataVenda" disabled/>

          </div>
          <div class="col-md-6">
              <label for="precoTotal">Preço Total:</label>
              <input type="text" id="precoTotal" disabled/>
          </div>
      </div>
      <produto-component></produto-component>
  </div>`,
  components: {ProdutoComponent},
});


const MenuComponent = Vue.extend({
  template: `<nav class="navbar navbar-dark bg-inverse" role="navigation">
      <ul class="nav navbar-nav">
          <li class="nav-item"><a href="index.html" class="nav-link">Início</a></li>
          <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Produtos</a>
              <div class="dropdown-menu">
                  <a href="cadastrarProduto.html" class="dropdown-item">Cadastrar Produto</a>
                  <a href="procurarProduto.html" class="dropdown-item">Procurar Produto</a>
              </div>
          </li>
          <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Vendas</a>
              <div class="dropdown-menu">
                  <a href="realizarVenda.html" class="dropdown-item">Realizar Venda</a>
                  <a href="procurarVenda.html" class="dropdown-item">Consultar Vendas</a>
              </div>
          </li>
      </ul>
  </nav>`
});

new Vue({
  el: '#app',
  components: { MenuComponent, VendasCompoment, ProdutoComponent },
});





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
  $('#formulario').submit( (evt) => {
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

  $('#inserir').click(function () {
    var id = $('#idProd').val();
    var qtde = $('#qtdeProd').val();
    var anterior = $('#produtosSalvos').val();
    $('#produtosSalvos').val('Produto: ' + id + ' Qtde: ' + qtde);
    var novo = $('#produtosSalvos').val();
    if (anterior.length !== 0)
      $('#produtosSalvos').val(novo + '\n' + anterior);
  });

  $('#enviar').click(function() {
    var textarea = $('#produtosSalvos').val();
    var texto = textarea.replace(/Produto: /g, '');
    texto = texto.replace(/Qtde: /g, '');
    var linhas = texto.split('\n');
    var dados = {};
    for (let i = 0; i < linhas.length; i++) {
      let linha = linhas[i];
      let pos = linha.indexOf(' ');
      let key = linha.substring(0, pos);
      let value = linha.substring(pos);
      dados[i] = {};
      dados[i][key] = parseInt(value);
    }
    console.log(dados);
    $('#hid').val(JSON.stringify(dados));
    $('#form2').submit();
  });
});
