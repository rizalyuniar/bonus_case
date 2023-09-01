<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama_instansi = isset($_POST['nama_instansi']) ? $_POST['nama_instansi'] : '';
        $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
        
        $stmt = $pdo->prepare('UPDATE instansi SET id = ?, nama_instansi = ?, deskripsi = ? WHERE id = ?');
        $stmt->execute([$id, $nama_instansi, $deskripsi, $_GET['id']]);
        $msg = 'Data instansi Berhasil Di Update!';
    }
    
    $stmt = $pdo->prepare('SELECT * FROM instansi WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $instansi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$instansi) {
        exit('instansi tidak ada\'tidak ada id yang sesuai!');
    }
} else {
    exit('tidak ada id yang sesuai!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Data instansi #<?=$instansi['id']?></h2>
    <form action="update.php?id=<?=$instansi['id']?>" method="post">
    <label for="id">id</label>
        <input type="text" name="id" value="<?=$instansi['id']?>" id="id">
        <label for="nama_instansi">Nama instansi</label>
        <label for="deskripsi">deskripsi</label>
        <input type="text" name="nama_instansi" value="<?=$instansi['nama_instansi']?>" id="nama_instansi">
        <input type="text" name="deskripsi" value="<?=$instansi['deskripsi']?>" id="deskripsi">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>