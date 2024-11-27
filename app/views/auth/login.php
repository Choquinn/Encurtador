<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
      <?php include 'style.css';?>
    </style>
</head>
<body>
    <form method="POST">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    </form>
    <p>Ainda não tem uma conta?<a href="/index"> Registre-se agora</a></p>
</body>
</html>