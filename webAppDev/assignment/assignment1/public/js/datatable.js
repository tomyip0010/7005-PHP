// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();

  $(".project-clickable").click(function() {
    const projectId = $(this).data("id");
    const projectLink = `project/${projectId}`;
    window.document.location = projectLink
  });
});
