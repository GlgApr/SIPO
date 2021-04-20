<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/penyedia/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/penyedia/edit') ?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="id" value="<?php echo $penyedia->penyedia_id?>" />

							<div class="form-group">
								<label for="name">Name*</label>
								<input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
								 type="text" name="name" placeholder="Nama Pengguna" value="<?php echo $penyedia->name ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('name') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="price">Password</label>
								<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
								 type="text" name="password" placeholder="Password" value="<?php echo $penyedia->password ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Email</label>
								<input class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
								 type="text" name="email" placeholder="Email Pengguna" value="<?php echo $penyedia->email ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('email') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Photo</label>
								<input class="form-control-file <?php echo form_error('image') ? 'is-invalid':'' ?>"
								 type="file" name="image" />
								<input type="hidden" name="old_image" value="<?php echo $penyedia->image ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('image') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Alamat*</label>
								<textarea class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
								 name="alamat" placeholder="Masukkan alamat lengkap"> <?php echo $penyedia->alamat ?> </textarea>
								<div class="invalid-feedback">
									<?php echo form_error('alamat') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="name">Jam Operasional*</label>
								<input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
								 type="text" name="jam_buka" placeholder="Jam Buka" value="<?php echo $penyedia->jam_buka ?>"/>
								 <input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
 								 type="text" name="jam_tutup" placeholder="Jam Tutup" value="<?php echo $penyedia->jam_tutup ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('name') ?>
								</div>
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
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

		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
