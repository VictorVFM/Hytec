function ValorTotal(data) {
  let soma = 0;
  data.forEach((element) => {
    let valor = element.valor.replace(/[R$]/g, "").trim();
    valor = parseFloat(valor, 2);
    soma += valor;
  });

  return `R$ ${soma.toFixed(2)}`;
}

// Exportar arquivo
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
        field: "state",
        checkbox: true,
        visible: $(this).val() === "selected",
      },
      {
        field: "id",
        title: "Peça",
      },
      {
        field: "name",
        title: "Fornecedor",
      },
      {
        field: "price",
        title: "Quantidade",
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


