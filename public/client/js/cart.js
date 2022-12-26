function addToCart(url, urlload, loadCount, loadTotalPrice) {
  $(document).on("click", "#__btn__add__to__cart", function (e) {
    e.preventDefault();
    const $id = $(this).data("id");
    const $qty = $(document).find("#__qty__to__add__cart");
    const $original = $(this).html();
    $.ajax({
      method: "POST",
      data: {
        id: $id,
        qty: $qty.val(),
      },
      beforeSend: () => {
        $(this).text("Waiting...");
        $(this).attr("disabled", true);
      },
      url,
      success: (data) => {
        $(this).html($original);
        $(this).attr("disabled", false);
        if (data.success) {
          loadCart(urlload, loadCount, loadTotalPrice);
          $.toast({
            heading: "Information",
            text: "Add cart success",
            bgColor: "#62AB00",
            textColor: "white",
            icon: "info",
            showHideTransition: "slide",
            position: "bottom-left",
          });
        }
      },
    });
  });
}
function removeCart(url, urlload, loadCount, loadTotalPrice) {
  $(document).on("click", "#__remove__cart__action", function (e) {
    e.preventDefault();
    const $id = $(this).data("id");
    const $original = $(this).parent().html();
    $.ajax({
      method: "POST",
      data: {
        id: $id,
      },
      beforeSend: () => {
        const $div = $("<div>");
        $div.css({
          position: "absolute",
          top: "0",
          right: "0",
          left: "0",
          bottom: "0",
          "background-color": "#000",
          opacity: "0.2",
          "z-index": "999",
        });
        $(this).parent().css("position", "relative");
        $(this).parent().append($div);
      },
      url,
      success: (data) => {
        if (data.success) {
          loadCart(urlload, loadCount, loadTotalPrice);
          $.toast({
            heading: "Information",
            text: "Remove cart success",
            bgColor: "#62AB00",
            textColor: "white",
            icon: "info",
            showHideTransition: "slide",
            position: "bottom-left",
          });
        }
      },
      error: () => {
        $(this).parent().append($original);
      },
    });
  });
}
function loadCart(loadUrl, loadCount, loadTotalPrice) {
  const $wrapper__ = $(document).find("#load__cart____");
  const $wrapper__cart__count__ = $(document).find("#load__cart__count");
  const $wrapper__cart__count__mobile = $(document).find(
    "#load__cart__count__mobile"
  );
  const $wrapper__total__price__ = $(document).find("#load__total__price");
  $wrapper__.load(loadUrl);
  $wrapper__cart__count__.load(loadCount);
  $wrapper__cart__count__mobile.load(loadCount);
  $wrapper__total__price__.load(loadTotalPrice);
}
