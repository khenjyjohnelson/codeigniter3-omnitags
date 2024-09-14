<div class="row mb-2 align-items-center">
  <div class="col-md-9 d-flex align-items-center">
    <h1><?= $title ?> <?= count_data_fb($tbl_e4) ?><?= $phase ?></h1>

  </div>
  <div class="col-md-3 text-right">
    <?php foreach ($dekor->result() as $dk): ?>
      <img src="img/<?= $tabel_b1 ?>/<?= $dk->$tabel_b1_field4 ?>" width="200" alt="Image">
    <?php endforeach ?>
  </div>
</div>
<hr>


<div class="row">
  <div class="col-md-10">
    <?= btn_tambah() ?>
    <?= btn_laporan('tabel_e4') ?>
    <!-- <button class="btn btn-info   b-4" type="button" data-toggle="modal" data-target="#import">+ Import</button>
    <button type="button" class="btn btn-info mb-4" id="export-btn" target="_blank">
      <i class="fas fa-print"></i> Cetak Excel</button> -->

  </div>

  <div class="col-md-2 d-flex justify-content-end">
    <?= view_switcher() ?>
  </div>
</div>


<div id="card-view" class="row data-view active">
  <?php if (empty($tbl_e4)) {
    load_view('_partials/no_data');
  } else {
    foreach ($tbl_e4 as $id_e4 => $tl_e4):
      echo card_file(
        $id_e4,
        $tabel_e4_field1_alias . ": " . $id_e4,
        $tl_e4[$tabel_e4_field2],
        btn_lihat($id_e4) . ' ' .
        btn_edit($id_e4),
        'text-white bg-danger',
        'col-md-3',
        $tabel_e4,
        $tl_e4[$tabel_e4_field3]
      );
    endforeach;
  } ?>
</div>


<div id="table-view" class="table-responsive data-view" style="display: none;">
  <table class="table table-light" id="data">
    <thead class="thead-light">
      <tr>
        <th><?= lang('no') ?></th>
        <th><?= lang('tabel_e4_field1_alias') ?></th>
        <th><?= lang('tabel_e4_field2_alias') ?></th>
        <th><?= lang('tabel_e4_field3_alias') ?></th>
        <th><?= lang('action') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php if (!empty($tbl_e4)) {
        foreach ($tbl_e4 as $id_e4 => $tl_e4): ?>
          <tr>
            <td></td>
            <td><?= $id_e4; ?></td>
            <td><?= $tl_e4[$tabel_e4_field2] ?></td>
            <td><img src="img/<?= $tabel_e4 ?>/<?= $tl_e4[$tabel_e4_field3] ?>" width="100"></td>
            <td>
              <?= btn_lihat($id_e4) ?>
              <?= btn_edit($id_e4) ?>

              <!-- Sebelumnya saya sudah membahas ini di v_admin_spp
          Saya akan mempending fitur ini dengan alasan yang sama dalam waktu yang belum ditentukan -->
              <!-- <a class="btn btn-light text-danger" onclick="return confirm('Hapus user?')" href="< site_url($tabel_c2 . '/hapus/' . $tl_e4->$tabel_e4_field1) ?>">
            <i class="fas fa-trash"></i></a> -->

            </td>
          </tr>
        <?php endforeach;
      } ?>
    </tbody>

  </table>
</div>

<!-- modal tambah -->
<div id="tambah" class="modal fade tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <?= modal_header(lang('add') . ' ' . lang('tabel_e4_alias'), '') ?>
      <form action="<?= site_url($language . '/' . $tabel_e4 . '/tambah') ?>" method="post"
        enctype="multipart/form-data">
        <div class="modal-body">
          <?= input_add('text', 'tabel_e4_field2', 'required') ?>
          <?= add_file('tabel_e4_field3', 'required') ?>

        </div>
        <!-- memunculkan notifikasi modal -->
        <p class="small text-center text-danger"><?= get_flashdata('pesan_tambah') ?></p>
        <div class="modal-footer">
          <?= btn_simpan() ?>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal edit -->
<?php if (!empty($tbl_e4)) {
  foreach ($tbl_e4 as $id_e4 => $tl_e4): ?>
    <div id="ubah<?= $id_e4; ?>" class="modal fade ubah">
      <div class="modal-dialog">
        <div class="modal-content">
          <?= modal_header_id(lang('change_data') . ' ' . lang('tabel_e4_alias'), $id_e4) ?>

          <!-- administrator tidak dapat mengubah password akun lain -->
          <form action="<?= site_url($language . '/' . $tabel_e4 . '/update') ?>" method="post"
            enctype="multipart/form-data">
            <div class="modal-body">
              <?= input_hidden('tabel_e4_field1', $id_e4, 'required') ?>
              <?= input_edit('text', 'tabel_e4_field2', $tl_e4[$tabel_e4_field2], 'required') ?>
              <?= edit_file($tabel_e4, 'tabel_e4_field3', $tl_e4[$tabel_e4_field3], '') ?>

            </div>

            <!-- memunculkan notifikasi modal -->
            <p class="small text-center text-danger"><?= get_flashdata('pesan_ubah') ?></p>

            <div class="modal-footer">
              <?= btn_update() ?>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div id="lihat<?= $id_e4; ?>" class="modal fade lihat" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?= modal_header_id(lang('tabel_e4_alias'), $id_e4) ?>

          <!-- administrator tidak bisa melihat password user lain -->
          <form>
            <div class="modal-body">
              <?= table_data(
                row_data('tabel_e4_field2', $tl_e4[$tabel_e4_field2]) .
                row_file($tabel_e4, 'tabel_e4_field3', $tl_e4[$tabel_e4_field3]),
                'table-light'
              ) ?>

            </div>

            <!-- memunculkan notifikasi modal -->
            <p class="small text-center text-danger"><?= get_flashdata('pesan_lihat') ?></p>

            <div class="modal-footer">
              <?= btn_tutup() ?>
            </div>
          </form>

        </div>
      </div>
    </div>
  <?php endforeach;
} ?>

<?= adjust_col_js() ?>