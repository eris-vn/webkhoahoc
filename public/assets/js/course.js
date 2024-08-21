cart = [];

function add_cart(id, redirect_payment = 0) {
  $.ajax({
    method: "POST",
    url: "/api/cart/add",
    data: {
      id,
    },
  }).done(function (data) {
    if (data.status == 200) {
      cart = data.data;
      render_cart();
      Toastify({
        text: data.msg,
        duration: 3000,
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
      }).showToast();
      if (redirect_payment == 1) {
        window.location.href = "/checkout";
      }
    } else {
      Toastify({
        text: data.msg,
        duration: 3000,
        style: {
          background: "linear-gradient(to right, #F64C18, #EE9539)",
        },
      }).showToast();
    }
  });
}

function delete_cart(id) {
  $.ajax({
    method: "POST",
    url: "/api/cart/delete",
    data: {
      id,
    },
  }).done(function (data) {
    if (data.status == 200) {
      cart = data.data;
      render_cart();

      if (window.location.pathname == "/cart") {
        window.location.reload();
      }
      Toastify({
        text: data.msg,
        duration: 3000,
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
      }).showToast();
    } else {
      Toastify({
        text: data.msg,
        duration: 3000,
        style: {
          background: "linear-gradient(to right, #F64C18, #EE9539)",
        },
      }).showToast();
    }
  });
}

function render_cart() {
  subtotal = 0;
  cart_html = "";
  count_cart = cart.length;

  if (count_cart) {
    cart.forEach((e) => {
      cart_html += `<li class="minicart-item">
            <div class="thumbnail">
                <a href="#">
                    <img src="${e.thumbnails}" alt="Product Images">
                </a>
            </div>
            <div class="product-content">
                <h6 class="title"><a href="single-product.html">${
                  e.name
                }</a></h6>
    
                <span class="price">${parseInt(
                  e.price
                ).toLocaleString()} vnđ</span>
            </div>
            <div class="close-btn" onclick="delete_cart(${e.id})">
                <button class="rbt-round-btn"><i class="feather-x"></i></button>
            </div>
        </li>`;
      subtotal += parseInt(e.price);
    });

    $("#cart-content").html(cart_html);
    $("#cart-count").removeClass("d-none");
    $("#cart-count").text(count_cart);
  } else {
    $("#cart-content").html("<div>Chưa có sản phẩm nào.</div>");
    $("#cart-count").addClass("d-none");
  }
  $("#cart-subtotal").text(`${subtotal.toLocaleString()} vnđ`);
}

function load_cart_from_php() {
  let cart_cookie = getCookie("cart");

  if (cart_cookie) {
    cart = JSON.parse(cart_cookie);
  }
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
