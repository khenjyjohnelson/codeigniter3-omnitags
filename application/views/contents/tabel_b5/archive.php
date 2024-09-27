<div class="row mb-2 align-items-center">
  <div class="col-md-9 d-flex align-items-center">
    <h1><?= $title ?><?= count_data($tbl_b5) ?><?= $phase ?></h1>
  </div>
  <div class="col-md-3 text-right">
    <?php foreach ($dekor->result() as $dk):
      echo tampil_dekor_archive('175px', $tabel_b1, $dk->$tabel_b1_field4);
    endforeach ?>
  </div>
</div>
<hr>





<div class="row">
  <div class="col-md-10">
  </div>

  <div class="col-md-2 d-flex justify-content-end">
    <?= view_switcher() ?>
  </div>
</div>



<div id="card-view" class="data-view active">
  <div class="row">
    <?php if (empty($tbl_b5->result())) {
      load_view('partials/no_data');
    } else {
      $counter = 1;
      foreach ($tbl_b5->result() as $tl_b5):
        echo card_regular(
          $counter,
          $tl_b5->$tabel_b5_field1,
          $tl_b5->$tabel_b5_field1,
          $tl_b5->$tabel_b5_field2,
          btn_lihat($tl_b5->$tabel_b5_field1) . ' ' .
          btn_restore('tabel_b5', $tl_b5->$tabel_b5_field1) . ' ' .
          btn_hapus_full('tabel_b5', $tl_b5->$tabel_b5_field1),
          'text-white bg-secondary',
          'col-md-3',
          $tabel_b5,
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
        <th>No</th>
        <th><?= $tabel_b5_field1_alias ?></th>
        <th><?= $tabel_b5_field2_alias ?></th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($tbl_b5->result() as $tl_b5): ?>
        <tr>
          <td></td>
          <td><?= $tl_b5->$tabel_b5_field1; ?></td>
          <td><?= $tl_b5->$tabel_b5_field2 ?></td>
          <td>
            <?= btn_lihat($tl_b5->$tabel_b5_field1) ?>
            <?= btn_restore('tabel_b5', $tl_b5->$tabel_b5_field1) ?>
            <?= btn_hapus_full('tabel_b5', $tl_b5->$tabel_b5_field1) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>


  </table>
</div>

<!-- modal edit-->
<?php foreach ($tbl_b5->result() as $tl_b5): ?>
  <div id="lihat<?= $tl_b5->$tabel_b5_field1; ?>" class="modal fade lihat" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?= modal_header_id($tabel_b5_alias, $tl_b5->$tabel_b5_field1) ?>

        <!-- administrator tidak bisa melihat password user lain -->
        <form>
          <div class="modal-body">
            <?= table_data(
              row_data('tabel_b5_field1', $tl_b5->$tabel_b5_field1) .
              row_data('tabel_b5_field2', $tl_b5->$tabel_b5_field2),
              'table-light'
            ) ?>
          </div>

          <!-- memunculkan notifikasi modal -->
          <p class="small text-center text-danger"><?= get_flashdata('pesan_lihat') ?></p>

          <div class="modal-footer">
            <?= btn_history('tabel_b5', $tl_b5->$tabel_b5_field1) ?>
            <?= btn_tutup() ?>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php endforeach; ?>

<?= adjust_col_js('col-md-3', 'col-md-4') ?>
<?= load_card_pagination_js($tbl_b5->num_rows(), 28) ?>