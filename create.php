<?php
include_once("templates/header.php");
?>
<!-- <h1>Inserir Contato</h1>
<i class="fas fa-eye"></i> -->

<div class="container">
    <?php include_once("templates/backbtn.html"); ?> <!-- Botão de Voltar -->
    <h1 id="main-title">Cadastrar Contato</h1>
    <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST"> <!-- Envio de dados -->
        <input type="hidden" name="type" value="create">
        <div class="form-grup">
            <label for="name">Nome do Contato:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required>
        </div>
        <div class="form-grup">
            <label for="phone">Telefone do Contato:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o Telefone" required>
        </div>
        <div class="form-grup">
            <label for="email">Email do Contato:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Digite o E-Mail" required>
        </div>
        <div class="form-grup">
            <label for="observations">Observações do Contato:</label>
            <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Insira as Observações" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<?php
include_once("templates/footer.php");
?>