<?php include 'layouts/header.php'; ?>
    <form action="add-user.php" method="POST" class="mx-auto max-w-xl border shadow-md p-2">
        <h2 class="text-bold text-lg mb-2">Cadastro</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-200 p-2 mb-2"><?= $_GET['error'] ?></div>
        <?php endif ?>
        <input class="w-full p-2 border mb-2" type="text" name="username" placeholder="Username" value="<?= $_GET['username'] ?? '' ?>">
        <input class="w-full p-2 border mb-2" type="password" name="password" placeholder="Senha">
        <input class="w-full p-2 border mb-2" type="password" name="confirm-password" placeholder="Repita sua senha">
        <input class="w-full p-2 border mb-2 bg-yellow-200 hover:bg-yellow-400" type="submit" value="Cadastrar">
        <a class="text-center w-full block text-indigo-600" href="login.php">Login</a>
    </form>
<?php include 'layouts/footer.php'; ?>