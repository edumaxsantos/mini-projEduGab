var LISTA = [];

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

Vue.component('produto-component', {
  template: `<div id="info-produtos" class="row produto">
    <div class="row center-block">
      <div class="col-md-3">
        <label for="codProd">Código:</label>
        <input type="text" id="codProd" :value="produto[0]" size= "12" disabled />
      </div>
      <div class="col-md-6">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" id="nomeProduto" :value="produto[1]" size="30" disabled />
      </div>
      <div class="col-md-3">
        <label for="qtde">Quantidade:</label>
        <input type="text" id="qtde" :value="produto[2]" size="10" disabled />
      </div>
    </div>
  </div>`,
  props: ['produto']
});

Vue.component('vendas-component', {
  template: `<div id="venda" class="container center-form col-md-6">
      <div id="info-venda" class="row center-block vendas">
          <div class="col-md-4">
              <label for="dataVenda">Data da Venda:</label>
              <input type="date" id="dataVenda" disabled/>

          </div>
          <div class="col-md-4">
              <label for="precoTotal">Preço Total:</label>
              <input type="text" id="precoTotal" disabled/>
          </div>
      </div>
      <produto-component v-for="prod in produtos" :produto="prod"></produto-component>
  </div>`,
  props: ['produtos']
});


Vue.component('menu-component', {
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
  data: {
    lista: []
  },
  methods: {
    procurar() {
      procuraVendas();
      console.log(LISTA);
      this.lista = LISTA;
      /*const dados = procuraVendas();
      console.log("DADOS = ", dados);
      console.log("tamanho = ", dados.length);
      for (let i = 0; i < 2; i++) {
        console.log(dados[i]);
      }*/
    }
  }
});


function procuraVendas() {
  const idV = $('#idVenda').val();

  var request = $.ajax({
    type: 'POST',
    url: 'pesquisarVenda.php',
    data: {id: idV},
    dataType: 'json'
  });
  request.done(function(dados) {
    //console.log("dados puros: ", dados);
    $('#dataVenda').val(dados["Vendasdata_venda"]);
    $('#precoTotal').val(dados["Vendaspreco_total"]);
    const nomesProd = dados.nome;
    const produtos = dados["Vendaslista"];
    let codProd = [];
    //console.log("produtos = ", produtos);

    //console.log(produtos);
    let count = 0, lista = [];
    for (let prod in produtos) {
      const key = Object.keys(produtos[prod]);
      const obj = produtos[prod];
      codProd[count] = key[0];
      //console.log(obj[key]);
      lista[count] = [];
      lista[count][0] = key[0];
      lista[count][1] = nomesProd[count];
      lista[count][2] = obj[key];
      count++;
    }
    //console.log("LISTA F = ", lista);
    LISTA = lista;
    console.log("LISTA =", LISTA);

  });
  request.fail(function(jqXHR,textStatus,errorThrown) {
    alert('deu errado lul ' + textStatus + ' ' + errorThrown);
  });
}



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
