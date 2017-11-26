function test(id, obj) {
    var td = $(obj).parent();
    var tr = td.parent();
    var cells = tr.children();
    var count_el = $(td).children('span')[0];
    var count = $(count_el).text();
    $(count_el).hide();
    $(obj).hide();
    $(td).append('<input  data-id = "'+ id +'" type="number" value="' + count + '">');
    $(td).children('input').defaultValue = count;
    $(td).children('input').on('change', function(e){
        var sign = e.target.value-$('input[type=number]')[0].defaultValue;
        $('input[type=number]')[0].defaultValue = e.target.value;
        $.ajax({
            url: "/userorders/getcount",
            type: 'GET',
            data: {
                id:id,
                sign:sign
            },
            success: function (data) {
                var newData = JSON.parse(data);
                //console.log(newData[0]['sum']);
                $(cells[7]).text(newData[0]['rez']);
                $(cells[8]).text(number_format(newData[0]['sum'] ,2, '.', '') + " руб.");
                $(count_el).text(newData[0]['count']);
            },
            error: function () {
                console.log('Внутренняя ошибка сервера');
            }
        });
    });
}

function number_format(number, decimals, dec_point, thousands_sep) {

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

document.onclick = function(e) {
    /*к сожалению, не успеваю отладить*/
    var els = $('input[type=number]');
    if($(e.target).data('id') === undefined){
        els.hide();
        $('button').show();
        $('[data-ref=true]').show();
    }else{
        for(var i = 0; i < els.length; i++){
            if($(els[i]).data('id') != $(e.target).data('id')){
                $(els[i]).hide();
                $('button').show();
                $('[data-ref]').show();
            }else{
                $('button[data-id='+ $(e.target).data('id') +']').hide();
                $('[data-ref='+ $(e.target).data('id') +']').hide();
            }
        }
    }
}

function confirmation() {
    $.ajax({
        url: "/userorders/confirmation",
        type: 'GET',
        data: {},
        success: function () {
        },
        error: function () {
            console.log('Внутренняя ошибка сервера');
        }
    });
}