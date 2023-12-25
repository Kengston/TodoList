async function saveTask() {
    const taskName = document.getElementById('taskName').value;
    const taskDescription = document.getElementById('taskDescription').value;

    const body = {
        task_name: taskName,
        description: taskDescription
    };

    const response = await fetch('/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    });

    if (response.ok) {
        window.location.reload(); // This will reload the page
    } else {
        console.error(`HTTP error: ${response.status} ${response.statusText}`);
        response.text().then(text => console.error('Response body:', text));
    }

    document.getElementById('taskName').value = '';
    document.getElementById('taskDescription').value = '';
    toggleAddTaskForm();
}

function addTask() {
    // Call saveTask to add new task
    saveTask();
}

async function deleteTask(taskId) {
    const taskElement = document.getElementById('task-' + taskId);

    const response = await fetch(`/tasks/${taskId}`, {
        method: 'DELETE',
    });

    if (response.ok) {
        taskElement.style.transform = 'translateX(-200%)'; // Animation deletion
        setTimeout(() => {
            taskElement.remove(); // Remove element after animation
        }, 300);
        console.log(`Task id: ${taskId} has been deleted successfully`);
    } else {
        console.error(`Failed to delete task: ${response.statusText}`);
    }
}

function editTask(taskId) {
    // Existing implementation for editing a task
    console.log('Редактировать задачу с ID:', taskId);
}