<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$stmt = $pdo->prepare('SELECT * FROM instansi ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$instansi = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_instansi = $pdo->query('SELECT COUNT(*) FROM instansi')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Data instansi</h2>
	<a href="create.php" class="create-karyawan">Create instansi</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>Aksi</td>
                <td>Instansi</td>
                <td>Deskripsi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instansi as $instansi): ?>
            <tr>
                <td><?=$instansi['id']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$instansi['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$instansi['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
                <td><?=$instansi['nama_instansi']?></td>
                <td><?=$instansi['deskripsi']?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="instansi.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_instansi): ?>
		<a href="instansi.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>