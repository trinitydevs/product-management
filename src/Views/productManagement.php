-
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <title>Enterprise System</title>
</head>

<body>
    <header>
    </header>
    <main class="d-flex justify-content-center align-items-center flex-column">
        <div id="options">
            <h2>Gerenciamento de produtos</h2>
            <p>Insira um novo produto, busque, atualize ou exclua.</p>

            <div id="change-options" class="d-flex flex-row justify-content-between gap-3">
                <button class="options">Criar produto</button>
                <button class="options">Buscar produto</button>
                <button class="options">Atualizar produto</button>
                <button class="options">Excluir produto</button>
            </div>
        </div>

        <div id="post">
            <form id="productForm" method="POST" class="d-flex flex-column">
                <label for="">Nome do produto:</label>
                <input type="text" name="name" required>

                <label for="">Descrição:</label>
                <input type="text" name="description" required>

                <label for="">Preço:</label>
                <input type="text" name="price" required>

                <label for="">Estoque:</label>
                <input type="number" name="stock" required>

                <input type="submit" value="Criar">
            </form>
        </div>



        <div id="get">
            <form action="" method="GET" class="d-flex flex-column gap-2">
                <label for="">Produto:</label>
                <select name="product">
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= isset($_GET['product']) && $_GET['product'] == $product['id'] ? 'selected' : '' ?>>
                            <?= $product['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Buscar">
            </form>

            <?php if ($productDetails): ?>
                <div class="product-data">
                    <h6>Nome do produto:</h6>
                    <p class="product-name"><?= $productDetails['name'] ?></p>

                    <h6>Descrição:</h6>
                    <p class="product-description"><?= $productDetails['description'] ?></p>

                    <h6>Preço:</h6>
                    <p class="product-price">R$<?= $productDetails['price'] ?></p>

                    <h6>Data de criação:</h6>
                    <p class="product-date_hour"><?= $productDetails['date_hour'] ?></p>

                    <h6>Estoque:</h6>
                    <p class="product-date_hour"><?= $productDetails['stock'] ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div id="put">
            <form action="" method="POST" class="d-flex flex-column">
                <input type="hidden" name="_method" value="PUT">
                <table>
                    <caption>Produtos em estoque</caption>
                    <thead>
                        <th>ID</th>
                        <th>PRODUTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>PREÇO</th>
                        <th>DATA</th>
                        <th>QUANTIDADE</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><input type="number" name="id" value="<?= $product['id'] ?>" readonly></td>
                                <td><input type="text" name="name" value="<?= $product['name'] ?>"></td>
                                <td><input type="text" name="description" value="<?= $product['description'] ?>"></td>
                                <td><input type="number" name="price" value="<?= $product['price'] ?>"></td>
                                <td><input type="text" name="date_hour" value="<?= $product['date_hour'] ?>" readonly></td>
                                <td><input type="number" name="stock" value="<?= $product['stock'] ?>"></td>
                                <td><input type="submit" value="Atualizar"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div id="delete">
            <form action="" method="POST" class="d-flex flex-column">
                <input type="hidden" name="_method" value="DELETE">
                <label for="">Produto</label>
                <select name="id">
                    <option value="">Selecione um produto</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Excluir produto">
            </form>
        </div>

    </main>
    <footer>
    </footer>

</body>

</html>