<?php

session_start();

include_once("connection.php");
include_once("url.php");

// Inclusão para create

$data = $_POST;

// Modificação no Banco
if (!empty($data)) {

    // print_r($data); exit;

    // Inserir dados novos

    if ($data["type"] === "create") {

        // echo "INSERIR DADO NOVO";

        $name = $data["name"];
        $phone = $data["phone"]; // ctrl C + ctrl V / Selecionei dois clicks / Alterar com produtividade
        $email = $data["email"];
        $observations = $data["observations"];

        $query = "INSERT INTO contacts (name, phone, email, observations) VALUES (:name, :phone, :email, :observations)";

        // Agora tem que substituir cada um dos valores do prepare

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $observations);

        try {

            $stmt->execute();
            $_SESSION['msg'] = "Contato criado com sucesso!";
        } catch (PDOException $e) {
            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    } else if ($data["type"] === "edit") { // Atualizar (Editar) registro em query de update

        $name = $data["name"];
        $phone = $data["phone"];
        $email = $data["email"];
        $observations = $data["observations"];
        $id = $data["id"];

        $query = "UPDATE contacts SET name = :name, phone = :phone, email = :email, observations = :observations WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":observations", $observations);
        $stmt->bindParam(":id", $id);

        try {

            $stmt->execute();
            $_SESSION['msg'] = "Contato atualizado com sucesso!";
        } catch (PDOException $e) {
            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    } else if ($data["type"] === "delete") { // Fluxo de delete no sistema

        $id = $data["id"];

        $query = "DELETE FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        try {

            $stmt->execute();
            $_SESSION['msg'] = "Contato removido com sucesso!";
        } catch (PDOException $e) {
            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }

    // Redirect HOME

    header("location:" . $BASE_URL . "../index.php"); // Fim de ciclo - Não cair no arquivo registro em branco e mostra para o usuário

    // Seleção de Dados  
} else {

    $id;

    if (!empty($_GET)) {
        $id = $_GET["id"];
    }

    // retorna apenas o contato acionado
    if (!empty($id)) {

        $query = "SELECT * FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $contact = $stmt->fetch();
    } else {

        // Retorna todos os contatos

        $contacts = [];

        $query = "SELECT * FROM contacts";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $contacts = $stmt->fetchAll();
    }
}

// FECHAR CONEXÃO DO PDO - Tipo metodo CLOSE

$conn = null;
