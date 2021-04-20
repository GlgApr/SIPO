<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>
<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/penyedia/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Password</th>
										<th>Email</th>
										<th>Photo</th>
										<th>Alamat</th>
										<th>Jam Buka</th>
										<th>Jam Tutup</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($penyedia as $penyedia): ?>
									<tr>
										<td width="150">
											<?php echo $penyedia->name ?>
										</td>
										<td>
											<?php echo $penyedia->password ?>
										</td>
										<td>
											<?php echo $penyedia->email ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/product/'.$penyedia->image) ?>" width="64" />
										</td>
										<td>
											<?php echo $penyedia->alamat ?>
										</td>
										<td>
											<?php echo $penyedia->jam_buka ?>
										</td>
										<td>
											<?php echo $penyedia->jam_tutup ?>
										</td>
										<td>
											<a href="<?php echo site_url('admin/penyedia/edit/'.$penyedia->penyedia_id) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/penyedia/delete/'.$penyedia->penyedia_id) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>

	<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
