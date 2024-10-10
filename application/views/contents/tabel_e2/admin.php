<div class="row mb-2 align-items-center">
  <div class="col-md-9 d-flex align-items-center">
    <h1><?= $title ?><?= count_data($tbl_e2) ?><?= $phase ?></h1>
  </div>
  <div class="col-md-3 text-right">
    <?php foreach ($dekor->result() as $dk):
      echo tampil_dekor('175px', $tabel_b1, $dk->$tabel_b1_field4);
    endforeach ?>
  </div>
</div>
<hr>


<div class="row">
  <div class="col-md-10">
    <?= btn_tambah() ?>
    <?= btn_laporan('tabel_e2') ?>
    <?= btn_archive('tabel_e2') ?>
  </div>

  <div class="col-md-2 d-flex justify-content-end">
    <?= view_switcher() ?>
  </div>
</div>




<div id="card-view" class="data-view active">
  <div class="row">
    <?php if (empty($tbl_e2->result())) {
    load_view('_partials/no_data');
  } else {
    $counter = 1;
    foreach ($tbl_e2->result() as $tl_e2):
      echo card_regular(
        $counter,
        $tl_e2->$tabel_e2_field1,
        "ID: " . $tl_e2->$tabel_e2_field1,
        $tl_e2->$tabel_e2_field2,
        btn_lihat($tl_e2->$tabel_e2_field1) . ' ' .
        btn_edit($tl_e2->$tabel_e2_field1),
        'text-light bg-dark',
        'col-md-3',
        $tabel_e2,
      );
    $counter++;
    endforeach;
  } ?>

</div>
  <div class="row">
    <?= card_pagination() ?>
  </div>
</div>


<div id="table-view" class="table-responsive data-view" style="display: none;">
  <table class="table table-light" id="data">
    <thead class="thead-light">
      <tr>
        <th><?= lang('no') ?></th>
        <th><?= lang('tabel_e2_field1_alias') ?></th>
        <th><?= lang('tabel_e2_field2_alias') ?></th>
        <th><?= lang('tabel_e2_field3_alias') ?></th>
        <th><?= lang('action') ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($tbl_e2->result() as $tl_e2): ?>
        <tr>
          <td></td>
          <td><?= $tl_e2->$tabel_e2_field1; ?></td>
          <td><?= $tl_e2->$tabel_e2_field2 ?></td>
          <td><?= $tl_e2->$tabel_e2_field3 ?></td>
          <td>
            <?= btn_lihat($tl_e2->$tabel_e2_field1) ?>
            <?= btn_edit($tl_e2->$tabel_e2_field1) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>


  </table>
</div>


<!-- modal tambah -->
<div id="tambah" class="modal fade tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <?= modal_header(lang('add') . ' ' . lang('tabel_e2_alias'), '') ?>

      <form action="<?= site_url($language . '/' . $tabel_e2 . '/tambah') ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <?= input_add('text', 'tabel_e2_field2', 'required') ?>


              <?= input_ckeditor('tabel_e2_field4', '', 'required') ?>

            </div>
            <div class="col-md-6">
              <?= input_textarea('tabel_e2_field5', '', 'required') ?>
              <?= input_textarea('tabel_e2_field6', '', 'required') ?>

            </div>
          </div>

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
<?php foreach ($tbl_e2->result() as $tl_e2): ?>
  <div id="ubah<?= $tl_e2->$tabel_e2_field1; ?>" class="modal fade ubah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <?= modal_header_id(lang('change_data') . ' ' . lang('tabel_e2_alias'), $tl_e2->$tabel_e2_field1) ?>

        <!-- administrator tidak dapat mengubah password akun lain -->
        <form action="<?= site_url($language . '/' . $tabel_e2 . '/update') ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <?= input_hidden('tabel_e2_field1', $tl_e2->$tabel_e2_field1, 'required') ?>
                <?= input_edit($tl_e2->$tabel_e2_field1, 'text', 'tabel_e2_field2', $tl_e2->$tabel_e2_field2, 'required') ?>
                
                <?= input_ckeditor('tabel_e2_field4', $tl_e2->$tabel_e2_field4, 'required') ?>
              </div>
              <div class="col-md-6">
                <?= input_textarea('tabel_e2_field5', $tl_e2->$tabel_e2_field5, 'required') ?>
                <?= input_textarea('tabel_e2_field6', $tl_e2->$tabel_e2_field6, 'required') ?>

              </div>
            </div>

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


  <div id="lihat<?= $tl_e2->$tabel_e2_field1; ?>" class="modal fade lihat" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <?= modal_header_id(lang('tabel_e2_alias'), $tl_e2->$tabel_e2_field1) ?>

        <!-- administrator tidak bisa melihat password user lain -->
        <form>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <?= table_data(
                  row_data('tabel_e2_field1', $tl_e2->$tabel_e2_field1) .
                  row_data('tabel_e2_field2', $tl_e2->$tabel_e2_field2) .
                  row_data('tabel_e2_field3', $tl_e2->$tabel_e2_field3),
                  'table-light'
                ) ?>
              </div>
              <div class="col-md-8">
                <?= table_data(
                  row_data('tabel_e2_field4', $tl_e2->$tabel_e2_field4) .
                  row_data('tabel_e2_field5', $tl_e2->$tabel_e2_field5) .
                  row_data('tabel_e2_field6', $tl_e2->$tabel_e2_field6),
                  'table-light'
                ) ?>
              </div>
            </div>

          </div>

          <!-- memunculkan notifikasi modal -->
          <p class="small text-center text-danger"><?= get_flashdata('pesan_lihat') ?></p>

          <div class="modal-footer">
            <?= btn_history('tabel_e2', $tl_e2->$tabel_e2_field1) ?>
            <?= btn_tutup() ?>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php endforeach; ?>

<?= adjust_col_js('col-md-3', 'col-md-4') ?>
<?= load_card_pagination_js($tbl_e2->num_rows(), 28) ?>