    function saveTask() {
        const taskName = document.getElementById('taskName').value;
        const taskDescription = document.getElementById('taskDescription').value;

        // Здесь можно отправить данные на сервер или выполнить другую логику сохранения задачи
        console.log('Название задачи:', taskName);
        console.log('Описание задачи:', taskDescription);

        // Очищаем форму после сохранения задачи
        document.getElementById('taskName').value = '';
        document.getElementById('taskDescription').value = '';

        // Скрыть форму после сохранения задачи
        toggleAddTaskForm();
    }

    function addTask() {
        // Здесь можно добавить логику добавления новой задачи
        console.log('Добавить новую задачу');
    }

    function deleteTask(taskId) {
        const taskElement = document.getElementById('task-' + taskId);
        taskElement.style.transform = 'translateX(-200%)'; // Анимация удаления
        setTimeout(() => {
            taskElement.remove(); // Удаление элемента после анимации
            // Здесь можно добавить логику удаления задачи с taskId из базы данных
        }, 300); // Время анимации в миллисекундах
    }

    function editTask(taskId) {
        // Здесь можно добавить логику для редактирования задачи с taskId
        console.log('Редактировать задачу с ID:', taskId);
    }