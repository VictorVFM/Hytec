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
          field: "razaosocial",
          title: "Razão Social",
        },
        {
          field: "cnpj",
          title: "CNPJ",
        },
        {
          field: "telefone",
          title: "Telefone",
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
  
  
  