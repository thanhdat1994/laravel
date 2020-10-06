var format = function (num) {
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if (str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
        if (str[j] != ",") {
            output.push(str[j]);
            if (i % 3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};
$(function () {
    $("#discount").keyup(function (e) {
        $(this).val(format($(this).val()));
    });
});
$('#datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
});
$('#dateOrder').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
});

$('#timeOrder').timepicker({
    minuteStep: 1,
    defaultTime: 'current',
    icons: {
        up: 'glyphicon glyphicon-chevron-up',
        down: 'glyphicon glyphicon-chevron-down'
    },
});

function number_format(number, decimals, dec_point, thousands_sep) {
    var n = number,
        prec = decimals;

    var toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return (Math.round(n * k) / k).toString();
    };

    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
    var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

    var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec);
    //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = toFixedFix(Math.abs(n), prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0, i + (n < 0)) +
            _[0].slice(i).replace(/(\d{3})/g, sep + '$1');
        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    var decPos = s.indexOf(dec);
    if (prec >= 1 && decPos !== -1 && (s.length - decPos - 1) < prec) {
        s += new Array(prec - (s.length - decPos - 1)).join(0) + '0';
    } else if (prec >= 1 && decPos === -1) {
        s += dec + new Array(prec).join(0) + '0';
    }
    return s;
}

function format_date(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('/');
}

function sumProduct() {
    productId = $("[name='product_id[]']");
    productPrice = $("[name='price[]']");
    productQuantity = $("[name='quantity[]']");
    var sum = 0;
    for (var i = 0; i < productId.length; i++) {
        var id = productId[i].value;
        var price = productPrice[i].value.replace(/[^0-9.-]+/g,"")
        var quantity = productQuantity[i].value;
        sum = price * quantity;
        $("label[id='amount_" + id + "']").text(number_format(sum));
    }
    subtotalProduct();
    totalProduct();
}

function subtotalProduct() {
    var total = 0;
    var subtotal = 0;
    $("label[name='amount[]']").each(function() {
        subtotal += parseInt($(this).text().replace(/[^0-9.-]+/g,""));
    })
    $("#subtotal").text(number_format(subtotal));
}

function totalProduct() {
    var total = 0;
    var subtotal = $("#subtotal").text();
    total = parseInt(subtotal.replace(/[^0-9.-]+/g, "")) - parseInt($("input[name='inputDiscount']").val().replace(/[^0-9.-]+/g, ""));
    $("input[name='inputTotal']").val(number_format(total));
}
