$("button.delete-product").click(function () {
  let id = $(this).attr("data-id");

  $.ajax({
    url: "../api/product",
    data: JSON.stringify({ productId: id }),
    contentType: "application/json",
    cache: false,
    method: "DELETE",
    success: (response) => {
      if (response.status == "success") {
        $(`tr#${id}`).remove();
      }
      alert(JSON.stringify(response.message));
    },
  });
});
