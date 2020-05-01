var Message = {
  generateCsvData: function (elm) {
    var _key = $("#content_template").val();
    if (!empty(_key)) {
      $(elm).data("key", _key);
      App.redirectUrl(elm);
    } else {
      bootbox.alert("Template belum dipilih");
    }
  },
};
