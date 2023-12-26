function toggleAddTaskForm() {
    const addTaskForm = document.getElementById('addTaskForm');
    addTaskForm.style.display = addTaskForm.style.display === 'none' ? 'block' : 'none';
}

function cancelEditedTask(taskId) {
    const taskElement = document.getElementById('task-' + taskId);
    const deleteButton = taskElement.querySelector('.delete-button');
    const editButton = taskElement.querySelector('.edit-button');

    // Toggle edit mode class for the task element
    taskElement.classList.toggle('edit-mode');

    // Show the delete and edit buttons when canceling edit mode
    deleteButton.style.display = 'inline-block';
    editButton.style.display = 'inline-block';
    window.location.reload();
}
