<?php include 'layouts/header.php'; ?>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="max-w-xl mx-auto">
            <h2 class="text-xl">Tarefas</h2>
            <?php
                // READ
                $tasks = file(TASKS_FILE);
            ?>
            <?php foreach ($tasks as $i => $raw_task): ?>
                <?php list($username, $task) = explode(',', $raw_task) ?>
                <?php if ($username == $_SESSION['user']): ?>
                    <div class="w-full border my-2 p-2 hover:bg-gray-100">
                        <?= $task ?>
                        <a class="float-right text-red-400 hover:text-red-600" href="rm-tarefa.php?id=<?= $i ?>">
                            Remover
                        </a>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <form action="add-tarefa.php" method="POST" class="mx-auto max-w-xl border shadow-md p-2">
            <h2 class="text-bold text-lg mb-2">Adicionar tarefa</h2>
            <input class="w-full p-2 border mb-2" type="text" name="task" placeholder="Tarefa">
            <input class="w-full p-2 border mb-2 bg-yellow-200 hover:bg-yellow-400" type="submit" value="Adicionar">
        </form>
    <?php endif ?>
<?php include 'layouts/footer.php'; ?>