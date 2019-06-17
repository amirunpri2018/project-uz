$(document).ready(function () {

    $(".dropdown-toggle").click(function () {
        $("#logininput").toggle("fast");
    });

    $(".openbasketmenu").click(function () {
        $("#kontener_koszyka").toggle("fast");
    });

    $("#itembasket").click(function () {
        $("#kontener_koszyka").toggle("fast");
    });

    $(".produkt").hover(function (evt) {
            $(".addtobasket", this).fadeIn();
            $(".movetobasket", this).fadeIn();
        },
        function () {
            $(".addtobasket", this).fadeOut();
            $(".movetobasket", this).fadeOut();
        })
        .dragstart(function (evt) {
            evt.dataTransfer.setData("text", $(this).attr("id"));
            $("#kontener_koszyka").fadeIn();
            $("#info_przeniesienie").fadeIn();
        }).dragend(function (evt) {
        $("#info_przeniesienie").fadeOut();
    });

    var default_color = $("#kontener_koszyka").css("background-color");
    var default_border = $("#kontener_koszyka").css("border-color");
    var default_basket = $("#itembasket").css("background-color");

    $("#kontener_koszyka").dragover(function (evt) {
        evt.preventDefault();
        $(this).css("background-color", "green").css("border-color", "green");
        $("#itembasket").css("background-color", "green");

    }).dragleave(function (evt) {
        $(this).css("background-color", default_color);
        $(this).css("border-color", default_border);
        $("#itembasket").css("background-color", default_basket);


    }).drop(function (evt) {
        evt.preventDefault();
        $(this).css("background-color", default_color);
        $(this).css("border-color", default_border);
        $("#itembasket").css("background-color", default_basket);
        var suma = 0;
        var przedmiot = evt.dataTransfer.getData("text");

        var nazwa = $("#" + przedmiot + " .nazwa").text();
        var cena = $("#" + przedmiot + " .cenaprzedmiotu").text();
        var id = $("#" + przedmiot + ".produkt").attr("id");

        var li = "<li class='produkt_w_koszyku'><b>" + nazwa + "</b> <span class='cena_w_koszyku'>" + cena + " zł</span> <span style='float: right; margin-right: 30px;' class='deleteitembasket'><i class=\"fas fa-times\"></i></span></li>";

        $("#koszyk").append(li);

        localStorage.setItem('item_id', (localStorage.getItem('item_id') || '') + id + ", ");
        localStorage.setItem('itemlist', (localStorage.getItem('itemlist') || '') + li);

        $("#koszyk .cena_w_koszyku").each(function () {
            suma += parseFloat($(this).text());
        });

        $("#cena span").text(suma.toFixed(2));
        localStorage.setItem('sumalist', suma.toFixed(2));
    });

    $(document).on("click", ".addtobasket", function () {

        $("#kontener_koszyka").fadeIn();

        var nazwa = $(this).closest('.produkt').find('.nazwa').text();
        var cena = $(this).closest('.produkt').find('.cenaprzedmiotu').text();
        var id = $(this).closest('.produkt').attr("id");

        var suma = 0;

        var li = "<li data="+id+" class='produkt_w_koszyku'><b>" + nazwa + "</b> <span class='cena_w_koszyku'>" + cena + " zł</span><span style='float: right; margin-right: 30px;' class='deleteitembasket'><i class=\"fas fa-times\"></i></span></li>";

        $("#koszyk").append(li);

        localStorage.setItem('item_id', (localStorage.getItem('item_id') || '') + id + ",");
        localStorage.setItem('itemlist', (localStorage.getItem('itemlist') || '') + li);

        $("#koszyk .cena_w_koszyku").each(function () {
            suma += parseFloat($(this).text());
        });

        $("#cena span").text(suma.toFixed(2));
        localStorage.setItem('sumalist', suma.toFixed(2));
    });

    $(document).on('click', '.deleteitembasket', function () {
        var nazwa = $(this).closest('.produkt').find('.nazwa').text();
        var cena = $(this).closest('.produkt').find('.cenaprzedmiotu').text();
        var id = $(this).closest('.produkt').attr("id");

        var suma = 0;

        var li = "<li data="+id+" class='produkt_w_koszyku'><b>" + nazwa + "</b> <span class='cena_w_koszyku'>" + cena + " zł</span><span style='float: right; margin-right: 30px;' class='deleteitembasket'><i class=\"fas fa-times\"></i></span></li>";

        var $ul = $(this).parents('ul');
        $(this).closest("li").remove();
        localStorage.setItem('itemlist', $ul.html());
        localStorage.setItem('item_id', $("li.produkt_w_koszyku").map(function(){ return $(this).attr('data'); }).get().join(','));
        $("#zamowienie2").val(localStorage.getItem('item_id'));

        $("#koszyk .cena_w_koszyku").each(function () {
            suma += parseFloat($(this).text());
        });

        $("#cena span").text(suma.toFixed(2));
        localStorage.setItem('sumalist', suma.toFixed(2));
        $("#kwota2").val(localStorage.getItem('sumalist'));
    });

    if (localStorage.getItem('sumalist') != null) {

        $("#koszyk").append(localStorage.getItem('itemlist'));
        $("#cena span").text(localStorage.getItem('sumalist'));
    }

    // wyszukiwarka itemow

    var $rows = $('.col-md-3'); //pobranie wierszy z tabeli

    $('.form-control').keyup(function () { //funkcja keyup jest wywolywana kiedy uzytkownik nacisnie klawisz
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text; // uzycie wyrazenia regularnego do sprawdzenia elementu

        $rows.show().filter(function () { // najpierw pokazujemy wszystkie wiersze, a potem stosujemy funkcje filter()
            text = $(this).text().replace(/\s+/g, ' ');
            $("#footer").css("position", "fixed").css("bottom", "0");

            return !reg.test(text); //sprawdzamy czy wiersz pasuje doelementu szukanego, jeśli nie to chowamy ten wiersz
        }).hide();

        if (document.getElementById("input").value.length == 0) {
            $("#footer").css("position", "");
        }
    });
    //wyszukiwarka itemow end

    $(".container0").removeClass("container");

});