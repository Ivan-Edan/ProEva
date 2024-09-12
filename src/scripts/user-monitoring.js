$(document).ready(function() {
    $('.main-task, .subtask-name').click(function() {
        var content = $(this).text(); // Use this to display task/subtask details in the modal

        $('#taskModalLabel').text($(this).text());
        $('#modalContent').text(content);

        var modal = new bootstrap.Modal(document.getElementById('taskModal'));
        modal.show();
    });
});
document.querySelectorAll('.main-task').forEach(function(taskRow) {
    taskRow.addEventListener('click', function() {
        var subtaskId = this.getAttribute('data-target');
        var subtasksRow = document.querySelector(subtaskId);
        subtasksRow.style.display = (subtasksRow.style.display === 'table-row') ? 'none' : 'table-row';
    });
});