<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $instagram = htmlspecialchars($_POST['instagram']);
    $sugestoes = isset($_POST['sugestoes']) ? htmlspecialchars($_POST['sugestoes']) : '';

    // Pegando a imagem, se enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTemp = $_FILES['imagem']['tmp_name'];
        $imagemDestino = "uploads/" . basename($imagemNome);
        move_uploaded_file($imagemTemp, $imagemDestino);
    } else {
        $imagemDestino = "Nenhuma imagem enviada.";
    }

    // Configurações do e-mail
    $to = "guilhermeyo@gmail.com"; // Substitua pelo seu e-mail
    $subject = "Nova colaboração no Surf Braza";
    $body = "Nome: $nome\nEmail: $email\nInstagram: $instagram\n\nSugestões:\n$sugestoes\n\nImagem enviada: $imagemDestino";
    $headers = "From: $email";

    // Enviar o e-mail
    if (mail($to, $subject, $body, $headers)) {
        echo "Obrigado pela sua colaboração!";
    } else {
        echo "Falha no envio da mensagem. Tente novamente.";
    }
}
?>