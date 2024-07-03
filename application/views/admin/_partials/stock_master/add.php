<?php 
  if ($this->session->flashdata('success'))
  {
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>SUKSES!</strong> Data Barang telah ditambahkan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
  </div>
<?php
  }
?>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Data Barang</h4>
        <p class="text-muted mb-3">Mohon di isi dengan sebenar-benarnya</p>
        <form id="addForm" action="" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="kode_barang" class="form-label">Kode Barang</label>
              <input id="kode_barang" class="form-control" name="kode_barang" type="text">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="nama_barang" class="form-label">Nama Barang</label>
              <input id="nama_barang" class="form-control" name="nama_barang" type="text">
            </div>
          </div>
          <div class="col-md-12">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="kategori_barang" class="form-label">Kategori Barang</label>
              <input id="kategori_barang" class="form-control" name="kategori_barang" type="text">
            </div>
          </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="unit_barang" class="form-label">Unit Barang</label>
              <input id="unit_barang" class="form-control" name="unit_barang" type="text">
            </div>
          </div>
          <div class="col-md-12">
          <div class="col-md-12">
</div>
          <a href="<?= base_url("admin/stock_master") ?>">
            <input class="btn btn-warning" type="button" value="Kembali">
          </a>
          <input class="btn btn-primary" type="submit" value="Submit">
        </form>
      </div>
    </div>
	</div>
</div>