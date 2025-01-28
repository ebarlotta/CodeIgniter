<!-- index.php -->

<?php
$drivers = [];

// Función para obtener la lista de conductores
function getDrivers() {
    global $drivers;
    return json_encode($drivers);
}

// Función para agregar un conductor
function addDriver($name) {
    global $drivers;
    $drivers[] = array('name' => $name);
    return json_encode(array('message' => 'Driver added successfully'));
}

// Manejo de las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getDrivers') {
    header('Content-Type: application/json');
    echo getDrivers();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'addDriver') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data && isset($data['name'])) {
        echo addDriver($data['name']);
        exit;
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid data'));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uber-like App</title>
</head>
<body>
    <h1>Driver List</h1>
    <ul id="driver-list"></ul>

    <h2>Add Driver</h2>
    <form id="add-driver-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <button type="submit">Add Driver</button>
    </form>

    <script>
        // Función para obtener la lista de conductores
        async function fetchDrivers() {
            const response = await fetch('?action=getDrivers');
            const data = await response.json();
            const driverList = document.getElementById('driver-list');
            driverList.innerHTML = '';
            data.forEach(driver => {
                const listItem = document.createElement('li');
                listItem.textContent = driver.name;
                driverList.appendChild(listItem);
            });
        }

        // Función para agregar un conductor
        async function addDriver(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const response = await fetch('?action=addDriver', {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const result = await response.json();
            console.log(result);
            fetchDrivers();
            form.reset();
        }

        document.getElementById('add-driver-form').addEventListener('submit', addDriver);
        fetchDrivers();
    </script>
</body>
</html>

