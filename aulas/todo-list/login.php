<?php include 'layouts/header.php'; ?>
    <form action="auth.php" method="POST" class="mx-auto max-w-xl border shadow-md p-2">
        <h2 class="text-bold text-lg mb-2">Login</h2>
        <?php if (isset($_GET['msg'])): ?>
            <div class="bg-green-200 p-2 mb-2"><?= $_GET['msg'] ?></div>
        <?php endif ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-200 p-2 mb-2"><?= $_GET['error'] ?></div>
        <?php endif ?>
        <input class="w-full p-2 border mb-2" type="text" name="username" placeholder="Username">
        <input class="w-full p-2 border mb-2" type="password" name="password" placeholder="Senha">
        <input class="w-full p-2 border mb-2 bg-yellow-200 hover:bg-yellow-400" type="submit" value="Login">
        <a class="text-center w-full block text-indigo-600" href="register.php">Cadastrar</a>
    </form>
<?php include 'layouts/footer.php'; ?>