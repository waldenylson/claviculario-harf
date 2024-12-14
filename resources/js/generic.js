import { TempusDominus } from "@eonasdan/tempus-dominus";

$(function () {
    // $(".datepicker").datetimepicker({ format: "L" });

    $(".masked-date-input").mask("00/00/0000", { placeholder: "__/__/____" });
    $(".masked-year-input").mask("0000", {
        placeholder: new Date().getFullYear(),
    });
    $(".masked-time-input").mask("00:00", { placeholder: "HH:MM" });
    $(".masked-cel-phone").mask("(00)00000-0000", {
        placeholder: "(99)99999-9999",
    });
    $(".masked-cpf").mask("000.000.000-00", { placeholder: "999.999.999-99" });
    $(".masked-saram").mask("000000-0", { placeholder: "999999-9" });

    // $("#dias").selectize({
    //     delimiter: ",",
    //     persist: false,
    //     create: function (input) {
    //         return {
    //             value: input,
    //             text: input,
    //         };
    //     },
    // });

    $("a.btn-remover").on("click", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        swal({
            title: "Deseja Mesmo Remover o Registro?",
            text: "Esta operação não poderá ser desfeita!",
            icon: "warning",
            buttons: ["Cancelar", "Sim, Remova-o!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = link;
            }
        });
    });
});

new TempusDominus(document.getElementById("datetimepicker1"), {
    //put your config here
});
