let inputHoraList = Array.from(document.getElementsByClassName("input-hora"));
let checkDiaInteiro = document.getElementById("check-dia-inteiro");

checkDiaInteiro.addEventListener("change", () => {
  inputHoraList.forEach((element) => {
    if (checkDiaInteiro.checked) {
      element.disabled = true;
      element.value = null;
    } else {
      element.disabled = false;
      element.value = null;
    }
  });
});

function ativarModal() {
  $("#modal-add-event").modal("show");
}

async function consultarEventos() {
  let url = "http://localhost:8000/backend/consultar-agendamentos.php";
  let eventos = [];

  const response = await fetch(url).then((r) => r.json());
  const data = await response;

  data.forEach((item) => {
    let evento = {
      groupId: item.id,
      title: item.nome,
      start: item.dataInicial.split(" ").join("T"),
      end: item.dataFinal.split(" ").join("T"),
    };
    eventos.push(evento);
  });

  return eventos;
}

document.addEventListener("DOMContentLoaded", async function () {
  let initialLocaleCode = "pt-br";
  let calendarEl = document.getElementById("calendar");

  let calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: "prev,next today custom1",
      center: "title",
      right: "dayGridYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth",
    },
    customButtons: {
      custom1: {
        text: "Adicionar Evento",
        click: function () {
          ativarModal();
        },
      },
    },

    locale: initialLocaleCode,
    buttonIcons: false, // show the prev/next text
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    eventClick: (info) => {
      console.log(info.event)
      Swal.fire({
        title: 'Tem certeza?',
        text: 'Deseja apagar o evento "' + info.event.title + '"?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar evento',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        customClass: {
          confirmButton: 'bg-success fw-bold'
        }
      }).then(async (result) => {

        // Obtém o ID do evento a ser excluído
        const id = info.event.groupId

        // Cria uma URL para a rota de exclusão
        const url = `http://localhost:8000/backend/consultar-agendamentos.php`;

        // Envia uma requisição DELETE para a API
        
        if (result.isConfirmed) {
          await fetch(url+'?id='+info.event.groupId, {
            method:"DELETE"
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          document.location.reload();
        }
      })
    },

    events: await consultarEventos(),
  });

  calendar.render();
});
