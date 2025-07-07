<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? APP_NAME ?></title>
    <!-- Correction des chemins des assets -->
    <link rel="stylesheet" href="<?= View::asset('vendor/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= View::asset('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <link rel="icon" href="<?= View::asset('images/favicon.ico') ?>"> -->
</head>
<body>
    <?php require_once VIEW_PATH . '/layouts/header.php'; ?>
    
    <main class="container my-4">
        <?php View::renderPartial($view, $data ?? []); ?>
    </main>
    
    <?php require_once VIEW_PATH . '/layouts/footer.php'; ?>
    
    <script src="<?= View::asset('vendor/bootstrap/bootstrap.min.js') ?>"></script>
    <script src="<?= View::asset('js/main.js') ?>"></script>
    <?php if (isset($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <script src="<?= View::asset('js/' . $script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>