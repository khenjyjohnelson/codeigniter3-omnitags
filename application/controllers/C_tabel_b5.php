<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_b5 extends Omnitags
{
	// Pages
	// Public Pages
	public function detail($param1 = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_b5->get_b5_by_field('tabel_b5_field1', $param1)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_b5_alias_v8_title'),
			'konten' => $this->v8['tabel_b5'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b5']),
			'tbl_b5' => $this->tl_b5->get_b5_by_field('tabel_b5_field1', $param1),
		);

		$data = array_merge($data1, $this->package);

		set_userdata('previous_url', current_url());
		$this->track_page();
		load_view_data('_layouts/template', $data);
	}

	// Account Only Pages


	// Admin Pages
	public function admin()
	{
		$this->declarew();
		$this->page_session_3();

		$param1 = $this->v_get['tabel_b5_field7'];

		$filter = $this->tl_b5->get_b5_by_field('tabel_b5_field7', $param1);

		if (empty($param1)) {
			$result = $this->tl_b5->get_all_b5();
		} else {
			$result = $filter;
		}

		$data1 = array(
			'title' => lang('tabel_b5_alias_v3_title'),
			'konten' => $this->v3['tabel_b5'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b5']),
			'tbl_b5' => $result,
			'tbl_b7' => $this->tl_b7->get_all_b7(),
			'tabel_b5_field7_value' => $param1,
		);

		$data = array_merge($data1, $this->package);

		set_userdata('previous_url', current_url());
		$this->track_page();
		load_view_data('_layouts/template', $data);
	}

	// Print all data
	public function laporan()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b5_alias_v4_title'),
			'konten' => $this->v4['tabel_b5'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b5']),
			'tbl_b5' => $this->tl_b5->get_all_b5(),
		);

		$data = array_merge($data1, $this->package);

		set_userdata('previous_url', current_url());
		$this->track_page();
		load_view_data('_layouts/printpage', $data);
	}

	// Print one data


	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		validate_all(
			array(
				$this->v_post['tabel_b5_field2'],
				$this->v_post['tabel_b5_field3'],
				$this->v_post['tabel_b5_field4'],
				$this->v_post['tabel_b5_field5'],
				$this->v_post['tabel_b5_field7'],
			),
			$this->views['flash2'],
			'tambah'
		);

		$tabel_b5_field2 = $this->v_post['tabel_b5_field2'];
		$method = $this->tl_c2->get_b5_by_field('tabel_b5_field2', $tabel_b5_field2);

		// mencari apakah jumlah data kurang dari 1
		if ($method->num_rows() < 1) {

			$gambar = $this->upload_new_image(
				$this->v_post['tabel_b5_field2'],
				$this->v_upload_path['tabel_b5'],
				'tabel_b5_field4',
				$this->file_type1,
				$method
			);

			// $id = get_next_code($this->aliases['tabel_e1'], $this->aliases['tabel_e1_field1'], 'FK');
			// $this->aliases['tabel_e1_field1'] => $id,

			$data = array(
				$this->aliases['tabel_b5_field1'] => '',
				$this->aliases['tabel_b5_field2'] => $this->v_post['tabel_b5_field2'],
				$this->aliases['tabel_b5_field3'] => htmlspecialchars($this->v_post['tabel_b5_field3']),
				$this->aliases['tabel_b5_field4'] => $gambar,
				$this->aliases['tabel_b5_field5'] => $this->v_post['tabel_b5_field5'],
				$this->aliases['tabel_b5_field6'] => $this->aliases['tabel_b5_field6_value2'],
				$this->aliases['tabel_b5_field7'] => $this->v_post['tabel_b5_field7'],

				$this->aliases['created_at'] => date("Y-m-d\TH:i:s"),
				$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
			);

			$aksi = $this->tl_b5->insert_b5($data);

			$notif = $this->handle_4b($aksi, 'tabel_b5');

			redirect($_SERVER['HTTP_REFERER']);
		} else {

			set_flashdata($this->views['flash1'], $this->aliases['tabel_b5_field2'] . ' telah digunakan!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// Update data
	public function update() //update tidak diperlukan di sini
	{
		$this->declarew();
		$this->session_3();

		$tabel_b5_field1 = $this->v_post['tabel_b5_field1'];

		$tabel = $this->tl_b5->get_b5_by_field('tabel_b5_field1', $tabel_b5_field1)->result();
		$this->check_data($tabel);

		validate_all(
			array(
				$this->v_post['tabel_b5_field1'],
				$this->v_post['tabel_b5_field2'],
				$this->v_post['tabel_b5_field3'],
				$this->v_post['tabel_b5_field4_old'],
				$this->v_post['tabel_b5_field5'],
				$this->v_post['tabel_b5_field7'],
			),
			$this->views['flash3'],
			'ubah' . $tabel_b5_field1
		);

		$gambar = $this->change_image_advanced(
			$this->v_post['tabel_b5_field2'],
			$tabel[0]->nama,
			$this->v_upload_path['tabel_b5'],
			'tabel_b5_field4',
			$this->file_type1,
			$tabel
		);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b5_field2'] => $this->v_post['tabel_b5_field2'],
			$this->aliases['tabel_b5_field3'] => htmlspecialchars($this->v_post['tabel_b5_field3']),
			$this->aliases['tabel_b5_field4'] => $gambar,
			$this->aliases['tabel_b5_field5'] => $this->v_post['tabel_b5_field5'],
			$this->aliases['tabel_b5_field7'] => $this->v_post['tabel_b5_field7'],

			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_b5->update_b5($data, $tabel_b5_field1);

		$notif = $this->handle_4c($aksi, 'tabel_b5', $tabel_b5_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sync_theme($tabel_b5_field7 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b7->get_b7_by_field('tabel_b7_field1', $tabel_b5_field7)->result();
		$this->check_data($tabel);

		$data = array(
			$this->aliases['tabel_b5_field7'] => $tabel_b5_field7,

			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_b5->update_all_b5($data);

		$notif = $this->handle_4c($aksi, 'tabel_b5', $tabel_b5_field7);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function aktifkan($tabel_b5_field1 = null) //update tidak diperlukan di sini
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b5->get_b5_by_field('tabel_b5_field1', $tabel_b5_field1)->result();
		$this->check_data($tabel);
		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b5_field6'] => $this->aliases['tabel_b5_field6_value1'],

			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_b5->update_b5($data, $tabel_b5_field1);

		$notif = $this->handle_4c($aksi, 'tabel_b5_field6', $tabel_b5_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function nonaktifkan($tabel_b5_field1 = null) //update tidak diperlukan di sini
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b5->get_b5_by_field('tabel_b5_field1', $tabel_b5_field1)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b5_field6'] => $this->aliases['tabel_b5_field6_value2'],

			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_b5->update_b5($data, $tabel_b5_field1);

		$notif = $this->handle_4c($aksi, 'tabel_b5_field6', $tabel_b5_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Delete data
	public function delete($tabel_b5_field1 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel_b5 = $this->tl_b5->get_b5_by_field('tabel_b5_field1', $tabel_b5_field1)->result();
		$this->check_data($tabel_b5);
		$img = $tabel_b5[0]->img;

		unlink($this->v_upload_path['tabel_b5'] . $img);

		$aksi = $this->tl_b5->delete_b5_by_field('tabel_b5_field1', $tabel_b5_field1);

		$notif = $this->handle_4e($aksi, 'tabel_b5', $tabel_b5_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

}
