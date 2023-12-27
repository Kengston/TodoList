    async function saveTask() {
        console.log("savetask function called");
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
            console.log(`The task: ${taskName} has been created successfully`);
            window.location.reload();
        } else {
            console.error(`An error occurred: ${response.statusText}`);
            response.text().then(text => console.error('Response body:', text));
        }

        document.getElementById('taskName').value = '';
        document.getElementById('taskDescription').value = '';
        toggleAddTaskForm();
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

    async function saveEditedTask(taskId) {
        const taskElement = document.getElementById('task-' + taskId);
        const editedName = taskElement.querySelector('.edit-task-name').value;
        const editedDescription = taskElement.querySelector('.edit-description').value;

        const body = {
            task_name: editedName,
            description: editedDescription
        };

        const response = await fetch(`/tasks/${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(body)
        });

        if (response.ok) {
            // Update the task content with edited values
            const taskContent = taskElement.querySelector('.task-content');
            const descriptionElement = taskContent.querySelector('.description');

            // Update task name
            taskContent.textContent = editedName;

            // If description exists, update it; otherwise, create a new one
            if (descriptionElement) {
                descriptionElement.textContent = editedDescription;
            } else if (editedDescription !== '') {
                const newDescription = document.createElement('p');
                newDescription.classList.add('description');
                newDescription.textContent = editedDescription;
                taskContent.appendChild(newDescription);
            }

            // Show task buttons again
            const taskButtons = taskElement.querySelector('.task-buttons');
            taskButtons.style.display = 'flex';

            console.log(`Task id: ${taskId} has been edited successfully`);
            window.location.reload();
        } else {
            console.error(`Failed to edit task: ${response.statusText}`);
            // Handle error case if needed
        }
    }


    async function editTask(taskId) {
        const taskElement = document.getElementById('task-' + taskId);
        const taskContent = taskElement.querySelector('.task-content');
        const deleteButton = taskElement.querySelector('.delete-button');
        const editButton = taskElement.querySelector('.edit-button');
        const saveEditButton = taskElement.querySelector('.save-edit-button');
        const cancelEditButton = taskElement.querySelector('.cancel-edit-button');
        const editForm = taskElement.querySelector('.edit-form');
        const editButtons = taskElement.querySelector('.edit-buttons');

        // Toggle edit mode class for the task element
        taskElement.classList.toggle('edit-mode');

        // Determine if the task element is in edit mode after toggling the class
        const isInEditMode = taskElement.classList.contains('edit-mode');

        if (isInEditMode) {
            const descriptionElement = taskElement.querySelector('.description');
            const nameElement = taskElement.querySelector('.name');
            const name = nameElement ? nameElement.textContent.trim() : '';
            const description = descriptionElement ? descriptionElement.textContent.trim() : '';

            // Show edit mode
            editForm.style.display = 'block';
            editButtons.style.display = 'flex';
            taskContent.style.display = 'none';

            // Set input field values
            taskElement.querySelector('.edit-task-name').value = name;
            taskElement.querySelector('.edit-description').value = description;

            // Hide other buttons
            deleteButton.style.display = 'none';
            editButton.style.display = 'none';
        } else {
            // Hide edit mode
            editForm.style.display = 'none';
            editButtons.style.display = 'none';
            taskContent.style.display = 'flex';

            // Show other buttons
            deleteButton.style.display = 'inline-block';
            editButton.style.display = 'inline-block';
        }
    }