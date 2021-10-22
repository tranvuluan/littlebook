
/**Sử lý danh mục sách, sử dụng Ajax lấy data book */
var id_categorychildpage = 0;

function requestAjaxToShowBookCategory(id_categorychild, id_filter) {
    id_categorychildpage = id_categorychild;
    $.ajax({
        method: "GET",
        dataType: "html",
        url: "./classes/getbookcategory.php",
        data: {
            'id_categorychild': String(id_categorychild),
            'id_filter': String(id_filter)
        },
        success: function (response) {
            $('#show_allbook').html(response);
        }
    });

}

// Click danh mục bên trái (li_sach)
function joincategorychild(element) {
    console.log(element);
    let li_categorychild = document.getElementsByClassName('li_sach');
    for (let i = 0; i < li_categorychild.length; i++) {
        li_categorychild[i].classList.remove('activeClick');
    }
    element.classList.add('activeClick');
}


/*Xử lý filter*/
function filter(id_filter, element) {
    let filterbtns = document.getElementsByClassName('filter');
    for (let i = 0; i < filterbtns.length; i++) {
        filterbtns[i].classList.remove('active');
    }
    element.classList.add('active');
    // element.classList.add('click');
    requestAjaxToShowBookCategory(id_categorychildpage, id_filter);
}

/**Khuyễn mãi */

// Quickview
function quickview(id_book) {
    $.ajax({
        method: "GET",
        dataType: "html",
        url: "classes/getquickview.php",
        data: {
            'id_book': id_book
        },
        success: function (response) {
            $('<div class="modal hide fade">' + response + '</div>').modal();
        }
    })
}

function changeValue(element, trId) {
    let value = element.value;
    if (value < 0) {
        alert("Số lượng không hợp lệ");
        element.value = 1;
        return;
    }
    let id_book = element.getAttribute('data-id_book')
    let trNode = document.getElementById('tr_' + trId);
    let childNode = trNode.children;
    console.log(childNode);
    let priceAll_book = childNode[2].innerText.split('\n');
    let price_book = priceAll_book[0];
    let original_price_book = null;
    if (priceAll_book[1]) original_price_book = priceAll_book[1];

    $(document).ready(
        $.ajax({
            method: 'GET',
            url: 'classes/getcart.php',
            data: {
                'quantity': value,
                'id_book': id_book
            },
            success: function (response) {
                console.log(response);
                changeTable();
                $('#total-price').html(response + 'đ');
            }
        })
    );
    function changeTable() {
        if (original_price_book == null) {
            childNode[4].innerHTML = price_book * value;
        }
        else {
            let html = price_book * value + '<br><span style="text-decoration: line-through; color:#41414141">' + original_price_book * value + '</span>'
            childNode[4].innerHTML = html
        }

    }
}

function removeItemFromCartSession(element) {
    let id_book = element.getAttribute('data-id_book');
    $(document).ready(
        $.ajax({
            method: 'GET',
            url: 'classes/getcart.php',
            data: {
                'id_book_remove': id_book
            },
            success: function (response) {
                console.log(response);
            }
        })
    );
    location.reload();
}



function requestAjaxToLogin() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    $(document).ready(
        $.ajax({
            method: 'POST',
            url: 'classes/getloginuser.php',
            data: {
                'username': username,
                'password': password
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                    $('#spanlogin').html('Đăng nhập thành công');
                }
                else {
                    $('#spanlogin').html('Sai tên đăng nhập hoặc mật khẩu')
                }
            }
        })
    );
}
function requestAjaxToRegister() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let repassword = document.getElementById('repassword').value;
    let fullname = document.getElementById('fullname').value;
    let phone = document.getElementById('phone').value;
    $(document).ready(
        $.ajax({
            method: 'POST',
            url: 'classes/getregister.php',
            data: {
                'username': username,
                'password': password,
                'repassword': repassword,
                'fullname': fullname,
                'phone': phone
            },
            success: function (response) {
                resRegister(response);
            }
        })
    );
    function resRegister(response) {
        if (response == -1) {
            $('#spanlogin').html("Tên đăng nhập đã tồn tại");
        }
        else if (response == 0) {
            $('#spanlogin').html("Mật khẩu không khớp");
        }
        else if (response == 1) {
            $('#spanlogin').html("Đã tạo tài khoản thành công");
        }
        else {
            window.open('404.php');
        }
    }
}

function toRegister() {
    document.querySelector('.form-title h4').innerText = 'Sign Up';
    document.getElementById('footer_signin').classList.toggle('d-none');
    document.querySelector('.signup-section').classList.toggle('d-none');
    document.getElementById('fg_repassword').classList.toggle('d-none');
    document.getElementById('btnregister').classList.toggle('d-none');
    document.getElementById('btnlogin').classList.toggle('d-none');
    document.getElementById('fg_fullname').classList.toggle('d-none');
    document.getElementById('fg_phone').classList.toggle('d-none');

}

function toSignIn() {
    document.querySelector('.form-title h4').innerText = 'Login';
    document.getElementById('footer_signin').classList.toggle('d-none');
    document.querySelector('.signup-section').classList.toggle('d-none');
    document.getElementById('fg_repassword').classList.toggle('d-none');
    document.getElementById('btnregister').classList.toggle('d-none');
    document.getElementById('btnlogin').classList.toggle('d-none');
    document.getElementById('fg_fullname').classList.toggle('d-none');
    document.getElementById('fg_phone').classList.toggle('d-none');
}

function toCheckcout(status, countItem) {
    if (status == '1') {
        if (countItem > 0)
            window.open('thanhtoan.php');
        else 
            alert('Giỏ hàng hiện rỗng');
    }
    else {
        document.getElementById('btnLogin').click();
    }
}

function requestAjaxToCompleteCheckout(jsonarr, id_user) {
    console.log(jsonarr);
    console.log(id_user);
}