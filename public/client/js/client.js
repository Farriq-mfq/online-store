function clickModal(urlcall, urlload) {
  $(document).on("click", "#show_detail_product", function (e) {
    e.preventDefault();
    const $modal = $(document).find("#quickModal");
    const $id = $(this).data("id");
    const $image = $(document).find("#product_image_modal");
    const $slider_image = $(document).find("#slider_image_modal");
    $.get({
      url: urlcall,
      data: {
        id: $id,
      },
      beforeSend: () => {
        $image.slick("destroy");
        $slider_image.slick("destroy");
        $slider_image.children().remove();
        $image.children().remove();
        $(this).css("pointer-events", "none");
      },
      success: (data) => {
        $(this).css("pointer-events", "auto");
        if (data != null) {
          for (let i = 0; i < data.product_images.length; i++) {
            const images = data.product_images[i];
            $image.append(`<div class="single-slide">
                        <img src="${images.image}" alt="Product image">
                        </div>`);
          }

          for (let i = 0; i < data.product_images.length; i++) {
            const images = data.product_images[i];
            $slider_image
              .append(
                `<div class="single-slide">
                                <img src="${images.image}" alt="Product image">
                            </div>`
              )
              .fadeIn(400);
          }

          $("#load_product").load(urlload, `id=${$id}`, function () {
            setTimeout(() => {
              $image.slick({
                slidesToShow: 1,
                arrows: false,
                fade: true,
                draggable: false,
                swipe: false,
                asNavFor: ".product-slider-nav",
              });
              $slider_image.slick({
                infinite: true,
                autoplay: true,
                autoplaySpeed: 8000,
                slidesToShow: 4,
                arrows: true,
                prevArrow: {
                  buttonClass: "slick-prev",
                  iconClass: "fa fa-chevron-left",
                },
                nextArrow: {
                  buttonClass: "slick-next",
                  iconClass: "fa fa-chevron-right",
                },
                asNavFor: ".product-details-slider",
                focusOnSelect: true,
              });
            }, 200);
            $modal.modal("show");
          });
        }
      },
    });
  });
}
