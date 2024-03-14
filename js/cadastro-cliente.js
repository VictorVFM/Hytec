const url = 'https://viacep.com.br/ws/'
const btnBuscar = document.getElementById("btnBuscar")
const containerResultado = document.getElementById("containerResultado")


let inputCnpj = document.getElementById("inputCnpj")
let inputCelular = document.getElementById("inputCelular")
let inputCep = document.getElementById("inputCep")
let inputLogradouro = document.getElementById("inputLogradouro")
let inputCidade = document.getElementById("inputCidade")
let inputBairro = document.getElementById("inputBairro")
let selectEstado = document.getElementById("selectEstado")
let inputNumero = document.getElementById("inputNumero")


function clickEnter(event) {
  if (event.key === "Enter") {
    carregarEndereço()
  }
}

inputCep.addEventListener("keydown", clickEnter);

async function buscar() {
  let cep = document.getElementById("inputCep").value
  const response = await fetch(url+cep+'/json',  
  ).then(r => r.json())
  const data = await response
  return data
}


async function carregarEndereço() {
  buscar()
  .then(data => {
    if(!data.erro){
      inputLogradouro.value = data.logradouro;
      inputBairro.value = data.bairro;
      inputCidade.value = data.localidade;
      selectEstado.value = data.uf;
    }
    
  })
  .catch(error => {
    console.error(`Erro ao buscar endereço: ${error}`);
    // Não faça nada em caso de erro
  });
}


// JQUERY

$(document).ready(function () {
  $(inputCep).inputmask('99999-999');
});

$(document).ready(function () {
    $(inputCnpj).inputmask('99.999.999/0001-99');
});

$(document).ready(function () {
    $(inputCelular).inputmask('(99)99999-9999');
});


$("#datepicker").flatpickr({
  dateFormat: "d/m/Y",  
  maxDate: "today",
  theme:"dark",
  allowInput: true
});

  