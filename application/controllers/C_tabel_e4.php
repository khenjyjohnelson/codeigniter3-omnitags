<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_e4 extends Omnitags
{
	// Pages
	// Public Pages
	public function index()
	{
		$this->declarew();
		$this->session_all();

		$data1 = array(
			'title' => lang('tabel_e4_alias_v1_title'),
			'konten' => $this->v1['tabel_e4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e4']),
			'tbl_e4' => $this->tl_e4->get_all_e4(),
			'tbl_e2' => $this->tl_e2->get_all_e2(),
		);

		$data = array_merge($data1, $this->package);

		set_userdata('previous_url', current_url());
		$this->track_page();
		load_view_data('_layouts/template', $data);
	}

	// Public Pages
	public function detail($param1 = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_e4->get_e4_by_field('tabel_e4_field1', $param1)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_e4_alias_v8_title'),
			'konten' => $this->v8['tabel_e4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b2']),
			'tbl_e4' => $this->tl_e4->get_e4_by_field('tabel_e4_field1', $param1),
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

		$data1 = array(
			'title' => lang('tabel_e4_alias_v3_title'),
			'konten' => $this->v3['tabel_e4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e4']),
			'tbl_e4' => $this->tl_e4->get_all_e4(),
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
			'title' => lang('tabel_e4_alias_v4_title'),
			'konten' => $this->v4['tabel_e4'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e4']),
			'tbl_e4' => $this->tl_e4->get_all_e4(),
		);

		$data = array_merge($data1, $this->package);

		set_userdata('previous_url', current_url());
		$this->track_page();
		load_view_data('_layouts/printpage', $data);
	}

	/**
	 * Handles the submission of the form for adding new data to the 'tabel_e4' table.
	 *
	 * This function validates the form input and if successful, inserts the data into the 'tabel_e4' table.
	 * It then redirects the user back to the previous page with a notification message.
	 *
	 * @return void
	 */
	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		validate_all(
			array(
				$this->v_post['tabel_e4_field1'],
				$this->v_post['tabel_e4_field3'],
				$this->v_post['tabel_e4_field4'],
				$this->v_post['tabel_e4_field5'],
				$this->v_post['tabel_e4_field6'],
				$this->v_post['tabel_e4_field7'],
				$this->v_post['tabel_e4_field8'],
				$this->v_post['tabel_e4_field9'],
				$this->v_post['tabel_e4_field10'],
				$this->v_post['tabel_e4_field11'],
				$this->v_post['tabel_e4_field12'],
				$this->v_post['tabel_e4_field13'],
			),
			$this->views['flash2'],
			'tambah'
		);

		// $id = get_next_code($this->aliases['tabel_e1'], $this->aliases['tabel_e1_field1'], 'FK');
		// $this->aliases['tabel_e1_field1'] => $id,

		$data = array(
			$this->aliases['tabel_e4_field1'] => $this->v_post['tabel_e4_field1'],
			$this->aliases['tabel_e4_field2'] => 1,
			$this->aliases['tabel_e4_field3'] => $this->v_post['tabel_e4_field3'],
			$this->aliases['tabel_e4_field4'] => $this->v_post['tabel_e4_field4'],
			$this->aliases['tabel_e4_field5'] => $this->v_post['tabel_e4_field5'],
			$this->aliases['tabel_e4_field6'] => $this->v_post['tabel_e4_field6'],
			$this->aliases['tabel_e4_field7'] => $this->v_post['tabel_e4_field7'],
			$this->aliases['tabel_e4_field8'] => $this->v_post['tabel_e4_field8'],
			$this->aliases['tabel_e4_field9'] => $this->v_post['tabel_e4_field9'],
			$this->aliases['tabel_e4_field10'] => $this->v_post['tabel_e4_field10'],
			$this->aliases['tabel_e4_field11'] => $this->v_post['tabel_e4_field11'],
			$this->aliases['tabel_e4_field12'] => $this->v_post['tabel_e4_field12'],
			$this->aliases['tabel_e4_field13'] => $this->v_post['tabel_e4_field13'],

			$this->aliases['created_at'] => date("Y-m-d\TH:i:s"),
			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_e4->insert_e4($data);

		$notif = $this->handle_4b($aksi, 'tabel_e4');

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Update data
	public function update()
	{
		// Di sini aku masih ada perdebatan apakah akan menggunakan gambar dengan nama file yang sama atau tidak
		// Atau menggunakan menggunakan data dari field lain sebagai nama gambar
		// Hal itu tentunya tergantung preferensi user
		// Fitur update gambar di bawah sudah selesai
		// Bisa mengupload gambar dengan tulisan yang dihapus, tentunya dengan minim data double

		$this->declarew();
		$this->session_3();

		$tabel_e4_field1 = $this->v_post['tabel_e4_field1'];

		$tabel = $this->tl_e4->get_e4_by_field('tabel_e4_field1', $tabel_e4_field1)->result();
		$this->check_data($tabel);
		$tabel_e4 = $this->tl_e4->get_e4_by_e4_field1($tabel_e4_field1)->result();
		$this->check_data($tabel_e4);

		validate_all(
			array(
				$this->v_post['tabel_e4_field1'],
				$this->v_post['tabel_e4_field2'],
				$this->v_post['tabel_e4_field3'],
				$this->v_post['tabel_e4_field4'],
				$this->v_post['tabel_e4_field4_old'],
				$this->v_post['tabel_e4_field5'],
			),
			$this->views['flash3'],
			'ubah' . $tabel_e4_field1
		);

		$data = array(
			$this->aliases['tabel_e4_field2'] => $this->v_post['tabel_e4_field2'],
			$this->aliases['tabel_e4_field3'] => $this->v_post['tabel_e4_field3'],
			$this->aliases['tabel_e4_field4'] => $this->v_post['tabel_e4_field4'],
			$this->aliases['tabel_e4_field5'] => $this->v_post['tabel_e4_field5'],
			$this->aliases['tabel_e4_field6'] => $this->v_post['tabel_e4_field6'],
			$this->aliases['tabel_e4_field7'] => $this->v_post['tabel_e4_field7'],
			$this->aliases['tabel_e4_field8'] => $this->v_post['tabel_e4_field8'],
			$this->aliases['tabel_e4_field9'] => $this->v_post['tabel_e4_field9'],
			$this->aliases['tabel_e4_field10'] => $this->v_post['tabel_e4_field10'],
			$this->aliases['tabel_e4_field11'] => $this->v_post['tabel_e4_field11'],
			$this->aliases['tabel_e4_field12'] => $this->v_post['tabel_e4_field12'],
			$this->aliases['tabel_e4_field13'] => $this->v_post['tabel_e4_field13'],

			$this->aliases['created_at'] => date("Y-m-d\TH:i:s"),
			$this->aliases['updated_at'] => date("Y-m-d\TH:i:s"),
		);

		$aksi = $this->tl_e4->update_e4($data, $tabel_e4_field1);

		$notif = $this->handle_4c($aksi, 'tabel_e4', $tabel_e4_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Delete data
	public function delete($tabel_e4_field1 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel_e4 = $this->tl_e4->get_e4_by_e4_field1($tabel_e4_field1)->result();
		$this->check_data($tabel_e4);

		$aksi = $this->tl_e4->delete_e4($tabel_e4_field1);

		$notif = $this->handle_4e($aksi, 'tabel_e4', $tabel_e4_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Print one data

	// Import excel
	public function importExcel()
	{
		$this->load->library('spreadsheet_lib');

		// Check if the form was submitted
		if (post('submit')) {
			// Handle file upload
			$file_path = $_FILES['filepegawai']['tmp_name'];

			// Read Excel file using the library
			$excel_data = $this->spreadsheet_lib->readExcel($file_path);

			// Process $excel_data as needed (e.g., insert into database)

			// Redirect or show success message
		} else {
			// Display form view
			$this->load->view('import_excel_form');
		}
	}


}
