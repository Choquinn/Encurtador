<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
      <?php include 'style.css';?>
    </style>
</head>
<body>
    <form method="POST">
        <h1>Registrar</h1>
        <input type="text" name="username" placeholder="Usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <input type="password" name="vpassword" placeholder="Repita sua senha" required>
        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta?<a href="/login"> Conecte-se</a></p>
</body>
</html>