<?php include 'layouts/header.php'; ?>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="max-w-xl mx-auto">
            <h2 class="text-xl">Tarefas</h2>
            <?php
                // READ
                // $tasks = file(TASKS_FILE);
                require 'bd.php';
                $stmt = $pdo->prepare("
                    SELECT * FROM tasks WHERE user_id = ?
                ");
                $stmt->execute([$_SESSION['user_id']]);
                $tasks = $stmt->fetchAll();

            ?>
            <?php foreach ($tasks as $task): ?>
                <div class="w-full border my-2 p-2 hover:bg-gray-100">
                    <span
                        <?php if ($task['finished'] == '1'): ?>
                            class="line-through"
                        <?php endif ?>
                    ><?= $task['task'] ?></span>
                    <div class="float-right">
                        <?php if ($task['finished'] == '0'): ?>
                            <a class="text-indigo-400 hover:text-indigo-600" href="update-tarefa.php?id=<?= $task['id'] ?>">
                                Finalizar
                            </a>
                        <?php endif ?>
                        <a class="text-red-400 hover:text-red-600" href="rm-tarefa.php?id=<?= $task['id'] ?>">
                            Remover
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <form action="add-tarefa.php" method="POST" class="mx-auto max-w-xl border shadow-md p-2">
            <h2 class="text-bold text-lg mb-2">Adicionar tarefa</h2>
            <input class="w-full p-2 border mb-2" type="text" name="task" placeholder="Tarefa">
            <input class="w-full p-2 border mb-2 bg-yellow-200 hover:bg-yellow-400" type="submit" value="Adicionar">
        </form>
    <?php endif ?>
<?php include 'layouts/footer.php'; ?>