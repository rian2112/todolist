// Menampilkan daftar tugas
function getTasks() {
  fetch("api.php", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const taskList = document.getElementById("task-list");
      taskList.innerHTML = ""; // Clear task list sebelum menambah
      data.forEach((task) => {
        const taskItem = document.createElement("div");
        taskItem.classList.add("task-item");
        taskItem.innerHTML = `
                <h3>${task.task_name}</h3>
                <p>${task.task_description}</p>
                <button onclick="deleteTask(${task.id})">Hapus</button>
                <button class="edit-task" onclick="editTask(${task.id}, '${task.task_name}', '${task.task_description}')">Edit</button>
            `;
        taskList.appendChild(taskItem);
      });
    });
}

// Menambahkan tugas baru
function addTask() {
  const taskName = document.getElementById("task-name").value;
  const taskDescription = document.getElementById("task-description").value;

  if (!taskName || !taskDescription) {
    alert("Nama dan deskripsi tugas wajib diisi!");
    return;
  }

  const taskData = {
    task_name: taskName,
    task_description: taskDescription,
  };

  fetch("api.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(taskData),
  })
    .then((response) => response.json())
    .then(() => {
      getTasks(); // Refresh daftar tugas setelah menambah
    });

  // Clear input fields
  document.getElementById("task-name").value = "";
  document.getElementById("task-description").value = "";
}

// Mengedit tugas
function editTask(id, taskName, taskDescription) {
  const newTaskName = prompt("Edit Nama Tugas", taskName);
  const newTaskDescription = prompt("Edit Deskripsi Tugas", taskDescription);

  if (newTaskName && newTaskDescription) {
    const updatedTask = {
      id: id,
      task_name: newTaskName,
      task_description: newTaskDescription,
    };

    fetch("api.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(updatedTask),
    })
      .then((response) => response.json())
      .then(() => {
        getTasks(); // Refresh daftar tugas setelah edit
      });
  }
}

// Menghapus tugas
function deleteTask(id) {
  const confirmDelete = confirm("Apakah Anda yakin ingin menghapus tugas ini?");

  if (confirmDelete) {
    const taskData = { id };

    fetch("api.php", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(taskData),
    })
      .then((response) => response.json())
      .then(() => {
        getTasks(); // Refresh daftar tugas setelah menghapus
      });
  }
}

// Menampilkan tugas saat halaman dimuat
window.onload = getTasks;
