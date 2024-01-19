// =====================================
$(document).ready(function () {
  $('#table_id').DataTable({
    "order": [[ 0, "desc" ]]
  });
});

// datepicker

$(function () {
  $("#datepicker").datepicker();
});