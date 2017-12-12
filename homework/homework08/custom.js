$(document).ready(function () {
    $('.adding').css("display", "none");
    
    $("#all").click(function () {
    $('.adding').css("display", "none");
        $.get("api.php", "goods", function(data) {
        var res = $.parseJSON(data);
                $('.content').css("display", "block");
                $('.content').html(makeTable(res));
        });
});

        $("#new").click(function () {
        $('.content').css("display", "none");
        $('.adding').css("display", "block");
});
        $('#add').click(function () {
form = $('#newgood')[0];
                  info = {
                name: jQuery("[name=name]").val(),
                description: jQuery("[name=description]").val(),
                cat_id: jQuery("[name=cat_id]").val(),
};
            
            $.ajax({
        type: 'POST',
                url: 'api.php',
                data: info,
                success: function (data) {
                res = "<h2>Товар был успешно добавлен с id = " + data + "</h2>"
                        $('.adding').css("display", "none");
                        $('.content').html(res);
                        $('.content').css("display", "block");
                }


        });
        });
});
        
        
        function makeTable(manyOfThem) {
        var len = manyOfThem.length;
                var res;
                res = "<table><thead><tr><th>ID</th><th>Название товара</th><th>Описание</th><th>Операции</th></tr></thead><tbody>";
                for (var i = 0; i < len; i++) {
        res += "<tr><td>" + manyOfThem[i]['id'] + "</td>";
                res += "<td>" + manyOfThem[i]['name'] + "</td>";
                res += "<td>" + manyOfThem[i]['description'] + "</td>";
                res += "<td>  TODO  </td></tr>";
        }
        res += "</tbody></table>";
                return res;
                };
                