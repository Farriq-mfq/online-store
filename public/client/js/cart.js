function addToCart(url, urlload, loadCount, loadTotalPrice) {
  $(document).on("click", "#__btn__add__to__cart", function (e) {
    e.preventDefault();
    const $id = $(this).data("id");
    const $qty = $(document).find("#__qty__to__add__cart");
    $.ajax({
      method: "POST",
      data: {
        id: $id,
        qty: $qty.val(),
      },
      url,
      success: (data) => {
        console.log(data);
        loadCart(urlload, loadCount, loadTotalPrice);
      },
    });
  });
}
function removeCart(url, urlload, loadCount,loadTotalPrice) {
  $(document).on("click", "#__remove__cart__action", function (e) {
    e.preventDefault();
    const $id = $(this).data("id");
    $.ajax({
      method: "POST",
      data: {
        id: $id,
      },
      url,
      success: (data) => {
        console.log(data);
        loadCart(urlload, loadCount, loadTotalPrice);
      },
    });
  });
}
function loadCart(loadUrl, loadCount, loadTotalPrice) {
  const $wrapper__ = $(document).find("#load__cart____");
  const $wrapper__cart__count__ = $(document).find("#load__cart__count");
  const $wrapper__total__price__ = $(document).find("#load__total__price");
  $wrapper__.load(loadUrl);
  $wrapper__cart__count__.load(loadCount);
  $wrapper__total__price__.load(loadTotalPrice);
}
