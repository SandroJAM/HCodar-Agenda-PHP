<?php
include_once("templates/header.php");
?>

<!-- Aqui era inicialmente o miolo da página, apenas o conteúdo -->
<!--<h1>Minha Agenda</h1>
<i class="fas fa-eye"></i> -->

<div class="container">
    <!-- <p id="msg">Testando Mensagem</p> -->
    <?php if (isset($printMsg) && $printMsg != '') : ?>
        <p id="msg"><?= $printMsg ?></p>
    <?php endif; ?>
    <h1 id="main-title">Minha Agenda</h1>
    <?php if (count($contacts) > 0) : ?>
        <!-- <p>TEM CONTATOS!</p> -->
        <table class="table" id="contacts-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $contact["id"] ?></td>
                        <td scope="row"><?= $contact["name"] ?></td>
                        <td scope="row"><?= $contact["phone"] ?></td>
                        <td scope="row"><?= $contact["email"] ?></td>
                        <td class="actions">
                            <a href="<?= $BASE_URL ?>show.php?id=<?= $contact["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>edit.php?id=<?= $contact["id"] ?>"><i class="fas fa-edit edit-icon"></i></a>
                            <form class="delete-form" action="<?= $BASE_URL ?>/config/process.php" method="POST">
                                <input type="hidden" name="type" value="delete"> <!-- Não precisa de um página para deletar -->
                                <input type="hidden" name="id" value="<?= $contact["id"] ?>"> <!-- Parâmetros para deletar registro -->
                                <button type="submit" class="delete-btn"><i class="fas fa-times delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p id="empty-list-text">Não há contatos na sua agenda, <a href="<?= $BASE_URL ?>create.php">clique aqui para adicionar</a>.</p>
    <?php endif; ?>
</div>

<?php
include_once("templates/footer.php");
?>