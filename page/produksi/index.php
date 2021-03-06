<?php $pageTitle = 'Manage Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Produksi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	 <div class="row">
		<div class="col-xs-12">
			<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data terhapus.
	            </div>
            <?php endif; ?>
            <?php if(isset($_GET['r']) && $_GET['r'] == 2): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data berhasil ditambahkan.
	            </div>
            <?php endif; ?>

		    <div class="box">
		        <div class="box-header">
		            <h3 class="box-title">Data Produksi<b>
		            	<?php if(isset($_GET['status'])){
		            		$status = getStatusProduksi($_GET['status']);
		            		echo $status['text'];
		            	} ?></b>
		            </h3>
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsiv">
		        	<div class="form-group input-group">
			            <div class="input-group-btn">
			                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Filter Status <span class="fa fa-caret-down"></span></button>
			                <ul class="dropdown-menu">
			                    <li><a href="?status=0">Pending</a></li>
			                    <li><a href="?status=2">Ready</a></li>
			                    <li><a href="?status=3">Uang Muka</a></li>
			                    <li><a href="?status=4">Produksi</a></li>
			                    <li><a href="?status=5">Pelunasan</a></li>
			                    <li><a href="?status=6">Selesai</a></li>
			                    <li><a href="?status=1">Cancel</a></li>
			                    <li class="divider"></li>
			                    <li><a href="?show=all">Semua</a></li>
			                </ul>
			            </div><!-- /btn-group -->
			        </div><!-- /input-group -->
			    	<div class="clearfix"></div>
		            <table class="table table-hover" id="table_data">
		            	<thead>
			            	<tr>
								<th>ID</th>
								<th>Kode</th>
								<th>Nama Pemesan</th>
								<th>Tanggal Pemesanan</th>
								<th>Status</th>
								<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
									<th>Spesifikasi</th>
								<?php endif; ?>
								<th>Jumlah</th>
								<th>Action</th>
							</tr>
		            	</thead>
						<tbody>
							<?php 
								$filter = ""; 
								if(isset($_GET['status'])){
									$filter = "WHERE status=".$_GET['status'];
								} else if($_SESSION['level'] == 2) {
									$filter = "WHERE status != 3 && status != 5 && status != 6 && status != 1";
								} else if($_SESSION['level'] == 4) {
									$filter = "WHERE status=3 || status=5";
								}
							?>
							<?php $sql = mysql_query("SELECT * FROM produksi ".$filter." ORDER BY id_produksi DESC"); ?>
							<?php while($row = mysql_fetch_array($sql)): ?>
								<tr>
									<td><?php echo $row['id_produksi']; ?></td>
									<td><?php echo $row['kode_produksi']; ?></td>
									<td><?php echo $row['nama']; ?></td>
									<td>
										<?php echo dateFormat($row['tanggal_pemesanan']); ?> s/d <?php echo dateFormat($row['tanggal_selesai']); ?>
									</td>
									<td>
										<?php $status = getStatusProduksi($row['status']); ?>
										<span class="<?php echo $status['class'] ; ?>"><?php echo $status['text']; ?></span>
									</td>
									<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
										<td><?php echo getCountSpesifikasi($row['id_produksi']); ?></td>
									<?php endif; ?>
									<td><?php echo getJumlahProduksi($row['id_produksi']); ?></td>
									<td>
										<a class="btn btn-primary btn-xs" title="Lihat" href="view.php?id=<?php echo $row['id_produksi']; ?>">
											<i class="glyphicon glyphicon-search"></i>
										</a>

										<?php if($_SESSION['level'] != 4): ?>
											<a class="btn btn-warning btn-xs" title="Edit" href="edit.php?id=<?php echo $row['id_produksi']; ?>">
												<i class="glyphicon glyphicon-edit"></i>
											</a>
										<?php endif; ?>

										<?php if($_SESSION['level'] == 1): ?>
											<a class="btn btn-danger btn-xs" title="Hapus" href="delete.php?id=<?php echo $row['id_produksi']; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')">
												<i class='glyphicon glyphicon-remove'></i>
											</a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
						
					</table>
		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<script type="text/javascript">
    $(function() {
        $("#table_data").dataTable();
    });
</script>

<?php include '../footer.php'; ?>
