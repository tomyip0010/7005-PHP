// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "ordering": false
  });

  $(".row-clickable").click(function() {
    const pathUrl = $(this).data("path");
    window.document.location = pathUrl
  });
});
