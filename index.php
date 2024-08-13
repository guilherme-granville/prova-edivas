<?php
// Feito por:
// Guilherme Granville
// Wisley Henrique
// André Luiz Gimenez
// Murilo Lodi
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "EventosDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $local_evento = $_POST['local_evento'];
    $horario_evento = $_POST['horario_evento'];
    $responsavel_evento = $_POST['responsavel_evento'];
    $capacidade_maxima = $_POST['capacidade_maxima'];

    $sql = "INSERT INTO Eventos (nome_evento, data_evento, local_evento, horario_evento, responsavel_evento, capacidade_maxima)
            VALUES ('$nome_evento', '$data_evento', '$local_evento', '$horario_evento', '$responsavel_evento', $capacidade_maxima)";

    if ($conn->query($sql) === TRUE) {
        $message = "Evento cadastrado com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $conn->error;
    }
    header("Location: " . $_SERVER['REQUEST_URI'] . "?message=" . urlencode($message));
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cadastro de Eventos">
    <title>Cadastro de Eventos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="manifest" href="manifest.json">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Eventos</h1>
        <form method="POST" action="">
            <label for="nome_evento">Nome do Evento:</label>
            <input type="text" id="nome_evento" name="nome_evento" required>

            <label for="data_evento">Data:</label>
            <input type="date" id="data_evento" name="data_evento" required>

            <label for="local_evento">Local:</label>
            <input type="text" id="local_evento" name="local_evento" required>

            <label for="horario_evento">Horário:</label>
            <input type="time" id="horario_evento" name="horario_evento" required>

            <label for="responsavel_evento">Responsável:</label>
            <input type="text" id="responsavel_evento" name="responsavel_evento" required>

            <label for="capacidade_maxima">Capacidade Máxima:</label>
            <input type="number" id="capacidade_maxima" name="capacidade_maxima" required>

            <input type="submit" value="Cadastrar Evento">
        </form>
    </div>
    <?php if (isset($_GET['message'])) : ?>
        <script>
            alert("<?php echo htmlspecialchars($_GET['message']); ?>");
        </script>
    <?php endif; ?>
    <script>
	if('serviceWorker' in navigator){
		navigator.serviceWorker.register('/service-worker.js').then(registration => {console.log('Serviço Iniciado - Service Start', registration.scope);}).catch(error => {console.log('Falha na inicialização do serviço - Service Fail'),error});
		}
		
</body>
</html>
