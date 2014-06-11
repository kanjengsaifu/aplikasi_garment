<?php $pageTitle = 'View Sub Spesifikasi'; $pageActive = 'sub_spesifikasi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Sub Spesifikasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Sub Spesifikasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM sub_spesifikasi WHERE id_sub_spesifikasi=$id");
			$data = mysql_fetch_array($sql);
		?>

		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Sub Spesifikasi #<?php echo $data['id_sub_spesifikasi']; ?></h3>
					</div>
					<div class="box-body">

						<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
						<div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <b>Success!</b> Data updated.
                        </div>
	                    <?php endif; ?>

						<div class="form-group">
							<label>Spesifikasi</label>
							<p><?php echo getSpesifikasi($data['id_spesifikasi']); ?></p>
						</div>

						<div class="form-group">
							<label>Sub</label>
							<p><?php echo $data['nama']; ?></p>
						</div>

						<div class="form-group">
							<label>Harga</label>
							<p><?php echo $data['harga']; ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Action</h3>
					</div>
					<div class="box-body">
						<p>
							<a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
						</p>
						<p>
							<a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger">Hapus</a>
						</p>

					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>