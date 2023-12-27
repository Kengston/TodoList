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
        taskElement.innerHTML = `
            <div class="task-content">
                ${editedName}
                <p class="description">${editedDescription}</p>
            </div>
            <div class="task-buttons">
                <button class="delete-button" onclick="deleteTask(${taskId})">&#10060;</button>
                <button class="edit-button" onclick="editTask(${taskId})">&#9998;</button>
            </div>
        `;
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

    // Toggle edit mode class for the task element
    taskElement.classList.toggle('edit-mode');

    if (taskElement.classList.contains('edit-mode')) {
        const descriptionElement = taskElement.querySelector('.description');
        const taskName = taskContent.textContent.trim();
        const description = descriptionElement ? descriptionElement.textContent.trim() : '';

        // Replace task content with input fields for editing and buttons
        const editForm = document.createElement('div');
        editForm.className = 'edit-form';

        const taskButtons = document.createElement('div');
        taskButtons.className = 'task-buttons';

        const editTaskName = document.createElement('input');
        editTaskName.className = 'edit-task-name';
        editTaskName.type = 'text';
        editTaskName.value = taskName;

        const editDescription = document.createElement('textarea');
        editDescription.className = 'edit-description';
        editDescription.value = description;

        const saveButton = document.createElement('button');
        saveButton.className = 'save-edit-button';
        saveButton.innerHTML = '&#10004;';
        saveButton.onclick = function () {
            saveEditedTask(taskId);
        };

        const cancelButton = document.createElement('button');
        cancelButton.className = 'cancel-edit-button';
        cancelButton.innerHTML = '&#10060;';
        cancelButton.onclick = function () {
            cancelEditedTask(taskId);
        };

        taskButtons.appendChild(cancelButton); // Change order here
        taskButtons.appendChild(saveButton); // Change order here

        editForm.appendChild(taskButtons);
        editForm.appendChild(editTaskName);
        editForm.appendChild(editDescription);

        taskContent.innerHTML = '';
        taskContent.appendChild(editForm);

        // Hide the delete and edit buttons in edit mode
        deleteButton.style.display = 'none';
        editButton.style.display = 'none';

        // Show save and cancel buttons
        saveEditButton.style.display = 'inline-block';
        cancelEditButton.style.display = 'inline-block';
    } else {
        // Handle toggling back to non-edit mode here if needed
        deleteButton.style.display = 'inline-block';
        editButton.style.display = 'inline-block';

        // Hide save and cancel buttons
        saveEditButton.style.display = 'none';
        cancelEditButton.style.display = 'none';
    }
}





