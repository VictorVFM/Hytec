let selectCliente = document.getElementById('selectCliente')
let inputCnpj = document.getElementById('inputCnpj')
let inputCelular = document.getElementById('inputCelular')
let inputCep = document.getElementById('inputCep')
let inputLogradouro = document.getElementById('inputLogradouro')
let inputCidade  = document.getElementById('inputCidade')
let inputBairro = document.getElementById('inputBairro')
let selectEstado = document.getElementById('selectEstado')
let inputNumero = document.getElementById('inputNumero') 


let inputDataNota = document.getElementById('inputDataNota')
let inputHorario = document.getElementById('inputHorario')
let inputTecnico = document.getElementById('inputTecnico')
let inputValorTotal = document.getElementById('inputValorTotal')
let inputObservacoes = document.getElementById('inputObservacoes')

const modal_edit = document.getElementById('modal-edit')

function ativarModal(){

const pecas_list = document.getElementById("pecas-list");

pecas_list.innerHTML = '';

$('#modal-edit').modal('show');
}
let $table = $("#table");

$(function () {
  $table.bootstrapTable("destroy").bootstrapTable({
    exportDataType: $(this).val(),
    exportTypes: ["json", "xml", "csv", "txt", "sql", "excel", "pdf"],
    exportOptions: {
      fileName: "Tabela do Estoque",      
    },
    columns: [
      
      {
        field: "id",
        title: "Nº Serviço",
      },
      {
        field: "name",
        title: "Cliente",
      },
     
      {
        field: "date",
        title: "Data Serviço",
      },
      {
        field: "action",
        title: "Ações",
      },
    ],
  });
});


function adicionarEventosSelect() {
  let selects = document.querySelectorAll('select');
  console.log(selects)
  setTimeout(selects.forEach(function (select) {
    select.setAttribute('onfocus', 'this.size=3;');
    select.setAttribute('onblur', 'this.size=1;');
    select.setAttribute('onchange', 'this.size=1; this.blur();');
}),3000)
}
async function clicarNota(element){
let id = element.dataset.id
console.log(id)
buscarDados(id).then(data =>{
selectCliente.value = data.clienteID
inputCnpj.value = data.cnpj
inputCelular.value = data.telefone
inputCep.value = data.cep
inputLogradouro.value = data.logradouro
inputBairro.value = data.bairro
inputCidade.value = data.localidade
selectEstado.value = data.estado
inputNumero.value = data.numero
inputDataNota.value = data.dataNota
inputHorario.value = data.horario
inputTecnico.value = data.tecnicoID
inputValorTotal.value = data.valorTotal
inputObservacoes.value = data.observacoes
data.Pecas.forEach(element => {
  adicionarPecas(element.id,element.qtd)
});

})
ativarModal()
}



async function fetchData() {
  const url = "http://localhost:50001/backend/peca.php";
  let result = fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na requisição: " + response.status);
      }
      return response.json(); 
    })
    .then((data) => {
      return data;
    })
    .catch((error) => {
      console.error("Erro na requisição: " + error);
    });
  return result;
}

//Adiciona as vinculadas a nota de serviço antes de abrir o Modal
async function adicionarPecas(valuePeca,valueQuantPeca){
  const pecasList = document.getElementById("pecas-list");
  const novaPeca = document.createElement("div");
  
  let pecas = [];
    novaPeca.innerHTML =
      `<div class="row g-3 needs-validation d-flex align-items-end mt-1" id="formulario">
        <div class="col-md-3">
        <label for="validationCustom05" class="form-label text-dark">Peça Utilizada</label>
            <div class="input-group">
                <select class="form-select border border-1 border-black peca-select" id="${valuePeca}"  required disabled>
                    <option selected disabled></option>` +
      (await fetchData("../backend/peca.php").then((data) => {
        data.forEach((element) => {
          
          let peca = `<option value="${element["id"]}">${element["nome"]}</option>`;
          pecas = pecas + peca;
        });
      })) +
      pecas +
      `</select>
            </div>
        </div>
        <div class="col-md-1">   
        <label for="validationCustom05" class="form-label text-dark">Quantidade</label>      
            <input type="number" class="form-control border border-1 border-black" value="${valueQuantPeca}"  required disabled>
        </div>


    </div>`;

    

    pecasList.appendChild(novaPeca);
    document.getElementById(valuePeca).value = valuePeca
}

document.getElementById('btn-imprimir').addEventListener('click', function() {
  var conteudoModal = modal_edit.innerHTML;
  var janelaImprimir = window.open('', 'Imprimir', 'height=400,width=600');

  janelaImprimir.document.write('<html><head><title>Imprimir Modal</title></head><body>');
  janelaImprimir.document.write(conteudoModal);
  janelaImprimir.document.write('</body></html>');

  janelaImprimir.document.close();
  janelaImprimir.print();
});

async function buscarDados(id){
const url = 'http://localhost:5001/backend/nota-servico.php?id='+id
let response = await fetch(url)
.then(r => r.json())
let data = await response
return data
}

