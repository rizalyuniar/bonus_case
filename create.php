<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';



if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nama_instansi = isset($_POST['nama_instansi']) ? $_POST['nama_instansi'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    

    $stmt = $pdo->prepare('INSERT INTO instansi VALUES (?, ?, ?)');
    $stmt->execute([$id, $nama_instansi, $deskripsi]);
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create instansi</h2>
    <form action="create.php" method="post">
        <label for="nama">id</label>
        <input type="text" name="id" id="id">
        <label for="nama">Nama instansi</label>
        <label for="deskripsi">Deskripsi</label>
        <input type="text" name="nama_instansi" id="nama_instansi">
        <input type="text" name="deskripsi" id="deskripsi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>