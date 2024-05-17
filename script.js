$(document).ready(function(){
  $("#orderForm").hide();
  function loadData() {
    $.ajax({
      url: "LoadHealthyData.php",
      type: "POST",
      success: function (data) {
        $("#table-data").html(data);
        attachCheckboxHandlers();
      }
    });
  }
  loadData();
  $("#healthy-btn").on("click", function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    $.ajax({
      url: "LoadHealthyData.php",
      type: "POST",
      success: function (data) {
        $("#table-data").html(data);
        attachCheckboxHandlers();
      }
    });
  });
  $("#unhealthy-btn").on("click", function (e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    $.ajax({
      url: "LoadUnhealthyData.php",
      type: "POST",
      success: function (data) {
        $("#table-data").html(data);
        attachCheckboxHandlers();
      }
    });
  });
  function attachCheckboxHandlers() {
    $(".check-btn").change(function () {
      var productId = $(this).data("product-id");
      if ($(this).is(":checked")) {
        $("input.quantity[data-product-id='" + productId + "']").prop("disabled", false);
      } else {
        $("input.quantity[data-product-id='" + productId + "']").prop("disabled", true).val('');
      }
    });
  }

  $("#submitBtn").on("click", function (e) {
    e.preventDefault();
    var totalAmount = 0;
    var orderDetails = [];

    $(".check-btn:checked").each(function () {
      var productId = $(this).data("product-id");
      var quantity = $("input.quantity[data-product-id='" + productId + "']").val();
      var price = parseFloat($(this).closest("tr").find("td:nth-child(2)").text());

      orderDetails.push({ id: productId, quantity: quantity });
      totalAmount += price * quantity;
    });

    if (orderDetails.length === 0) {
      alert("Please select at least one item.");
      return;
    }
    else {
      $("#orderForm").show();
    }

    $("#totalAmount").val(totalAmount.toFixed(2));
    $("#orderForm").removeClass("hidden");
  });

  $("#orderDetailsForm").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serializeArray();
    var orderDetails = [];

    $(".check-btn:checked").each(function () {
      var productId = $(this).data("product-id");
      var quantity = $("input.quantity[data-product-id='" + productId + "']").val();
      orderDetails.push({ id: productId, quantity: quantity });
    });

    formData.push({ name: "orderDetails", value: JSON.stringify(orderDetails) });
    $.post("submit_order.php", formData, function (response) {
      alert(response);
      console.log(response);
      location.reload();
    });
  });
});
