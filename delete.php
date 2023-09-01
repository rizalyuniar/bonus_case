<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM instansi WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $instansi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$instansi) {
        exit('instansi tidak\'tidak ada id yang sesuai');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            
            $stmt = $pdo->prepare('DELETE FROM instansi WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Berhasil Menghapus instansi!';
        } else {  
            header('Location: instansi.php');
            exit;
        }
    }
} else {
    exit('Tidak ada id yang sesuai!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus instansi #<?=$instansi['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Yakin Ingin Menghapus instansi #<?=$instansi['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$instansi['id']?>&confirm=yes">Iya</a>
        <a href="delete.php?id=<?=$instansi['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>