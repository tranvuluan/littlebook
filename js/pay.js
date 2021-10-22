function listToHTML(dsPay) {
    var HTML = '';
    for (var i = 0; i < dsPay.length; i++) {
        var html = objectToHTML(dsPay[i]);
        HTML += html;
    }
    return HTML;
}

function objectToHTML(object) {
    var html = '';
    html += '<li class="info list">'
    html += '<div class="col1">' + object.title + '</div>'
    html += '<div class="col2">' + object.quantity + '</div>'
    html += '<div class="col3">' + object.totalPrice + ' đ' + '</div>'
    html += '</li>'
    return html
}

function totalPrice(dsPay) {
    var totalPrice = 0;
    for (var i = 0; i < dsPay.length; i++) {
        totalPrice += dsPay[i].totalPrice;
    }
    return totalPrice;
}