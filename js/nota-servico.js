let inputCnpj = document.getElementById("inputCnpj");
let inputCelular = document.getElementById("inputCelular");
let inputCep = document.getElementById("inputCep");
let inputLogradouro = document.getElementById("inputLogradouro");
let inputCidade = document.getElementById("inputCidade");
let inputBairro = document.getElementById("inputBairro");
let selectEstado = document.getElementById("selectEstado");
let inputNumero = document.getElementById("inputNumero");
let inputnPecas = document.getElementById('id_nPecas')
let indexPeca = 0;

let icons = Array.from(document.getElementsByClassName("icon"));

function habilitarAnimacao() {
  icons.forEach((element) => {
    element.addEventListener("mouseover", () => {
      element.classList.add("fa-bounce");
    });
  });

  icons.forEach((element) => {
    element.addEventListener("mouseout", () => {
      element.classList.remove("fa-bounce");
    });
  });
}

selectCliente.addEventListener("change", async function () {
  let id = selectCliente.value;
  const apiUrl = "http://localhost:5001/backend/cliente.php?id=" + id;
  await fetch(apiUrl)
    .then((response) => {
      return response.json();
      if (!response.ok) {
        throw new Error(`Erro na requisição: ${response.message}`);
      }
    })
    .then((data) => {
      console.log(data)
      inputCnpj.value = data.cnpj;
      inputCelular.value = data.telefone;
      inputCep.value = data.cep;
      inputLogradouro.value = data.logradouro;
      inputCidade.value = data.localidade;
      inputBairro.value = data.bairro;
      selectEstado.value = data.estado;
      inputNumero.value = data.numero;
    })
    .catch((error) => {
      console.error(`Erro: ${error}`);
    });
});

async function fetchData() {
  // URL do endpoint
  // URL do endpoint
  const url = "http://localhost:5001/backend/peca.php";

  // Realiza uma requisição GET
  let result = fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na requisição: " + response.status);
      }
      return response.json(); // Converta a resposta em JSON e retorne-a
    })
    .then((data) => {
      return data;
    })
    .catch((error) => {
      console.error("Erro na requisição: " + error);
    });
  return result;
}

let pecasList = document.addEventListener("DOMContentLoaded", function () {
  const pecasList = document.getElementById("pecas-list");
  const adicionarPecaButton = document.getElementById("adicionar-peca");

  adicionarPecaButton.addEventListener("click", async function () {
    const novaPeca = document.createElement("div");
    
    let pecas = [];
    novaPeca.innerHTML =
      `<div class="row g-3 needs-validation d-flex align-items-end mt-1" id="formulario">
        <div class="col-md-3">
        <label for="validationCustom05" class="form-label text-dark">Peça Utilizada</label>
            <div class="input-group">
                <select class="form-select border border-1 border-black peca-select" name="id_Peca[${
                  indexPeca + 1
                }]" required>
                    <option selected disabled></option>` +
      (await fetchData("/backend/peca.php").then((data) => {
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
            <input type="number" class="form-control border border-1 border-black" name="quantidade[${
              indexPeca + 1
            }]" required>
        </div>

        <div class="col-md-1" style="cursor: pointer;">
            <i class="icon fa-solid fa-trash-can fa-xl p-1 " onclick="excluirPeca(this)"></i>
        </div>
        
    </div>`;
    indexPeca++;
    inputnPecas.value = indexPeca + 1
    pecasList.appendChild(novaPeca);
    icons = Array.from(document.getElementsByClassName("icon"));
    habilitarAnimacao();
  });
});

function excluirPeca(element) {
  let linha = element.parentNode.parentNode;
  linha.parentNode.removeChild(linha);
  let pecas = document.querySelectorAll(".peca-select");
  let qtdPecas = document.querySelectorAll(".peca-quantidade");
  console.log(pecas)
  let i = 0;
  for (let i; i < pecas.length; i++) {
    pecas[i].name = `id_Peca[${i}]`;
    qtdPecas[i].name = `PecaQtd[${i}]`;
  
  }
  inputnPecas.value = indexPeca;
  indexPeca = i;
}

$(document).ready(function () {
  $(inputCnpj).inputmask("99.999.999/0001-99");
});

$(document).ready(function () {
  $(inputCelular).inputmask("(99)99999-9999");
});

$(document).ready(function () {
  $("#datepicker").flatpickr({
    dateFormat: "Y-m-d",
    maxDate: "today",
    theme: "light",
    allowInput: true,
  });
});

$(document).ready(function () {
  $("#datepickerHour").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    minTime: "16:00",
    maxTime: "22:30",
    defaultDate: "13:00",
  });
});

function formatarNumero(numero) {
  // Removemos os zeros à esquerda
  numero = numero.replace(/^0+/, "");

  // Adicionamos o prefixo #
  numero = "#";

  // Adicionamos os zeros à esquerda
  while (numero.length < 8) {
    numero = "0" + numero;
  }

  // Retornamos o número formatado
  return numero;
}



async function teste(){
  await fetchData("../backend/peca.php").then((data) => {
     data.forEach((element) => {
       console.log(element)
     });
   })
 }