<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        /* TOP BAR */
        .topbar {
            background: #1e293b;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
        }

        /* LAYOUT */
        .container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: #0f172a;
            min-height: 100vh;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #1e293b;
        }

        /* CONTENT */
        .content {
            padding: 25px;
            width: 100%;
        }

        /* CARDS */
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 180px;
            text-align: center;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        /* FORM */
        .form-box {
            background: white;
            padding: 20px;
            width: 400px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        input, select, button {
            padding: 8px;
            width: 100%;
            margin: 6px 0;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        /* TABLE */
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }
    </style>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
    DHH Training System
</div>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a>Dashboard</a>
        <a>My Courses</a>
        <a>Students</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <h2>Teacher Dashboard</h2>

        <!-- SUMMARY CARDS -->
        <div class="cards">
            <div class="card">Students<br><b id="studentCount">0</b></div>
            <div class="card">Tools Assigned<br><b id="toolCount">0</b></div>
            <div class="card">Active Course<br><b>Yes</b></div>
        </div>

        <!-- ADD STUDENT -->
        <div class="form-box">
            <h3>Add Student</h3>

            <label>Student ID</label>
            <input type="text" id="studentId" placeholder="S101">

            <label>Student Name</label>
            <input type="text" id="studentName" placeholder="Rahul">

            <label>Assign Tool</label>
            <select id="studentTool">
                <option value="">Select Tool</option>
                <option>GitHub</option>
                <option>VS Code</option>
                <option>Design Graph Paper</option>
            </select>

            <button onclick="addStudent()">Add Student</button>
        </div>

        <!-- STUDENTS TABLE -->
        <h3>Students</h3>

        <table id="studentTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Tool</th>
                <th>Action</th>
            </tr>
        </table>

    </div>
</div>

<!-- JAVASCRIPT -->
<script>
let students = [];

function addStudent() {
    const id = document.getElementById("studentId").value.trim();
    const name = document.getElementById("studentName").value.trim();
    const tool = document.getElementById("studentTool").value;

    if (!id || !name || !tool) {
        alert("Please fill all fields");
        return;
    }

    // Store student
    students.push({ id, name, tool });

    renderTable();
    updateCounts();

    // Clear form
    document.getElementById("studentId").value = "";
    document.getElementById("studentName").value = "";
    document.getElementById("studentTool").value = "";
}

function renderTable() {
    const table = document.getElementById("studentTable");
    table.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Tool</th>
            <th>Action</th>
        </tr>
    `;

    students.forEach((s, index) => {
        const row = table.insertRow();
        row.insertCell(0).innerText = s.id;
        row.insertCell(1).innerText = s.name;
        row.insertCell(2).innerText = s.tool;
        row.insertCell(3).innerHTML = `<button onclick="removeStudent(${index})">Remove</button>`;
    });
}

function removeStudent(index) {
    students.splice(index, 1);
    renderTable();
    updateCounts();
}

function updateCounts() {
    document.getElementById("studentCount").innerText = students.length;
    document.getElementById("toolCount").innerText = students.filter(s => s.tool).length;
}
</script>

</body>
</html>
