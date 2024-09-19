<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tabel_f5 extends CI_Model
{
	public function get_all_f5()
	{
		$this->db->order_by($this->aliases['tabel_f5_field1'], 'DESC');
		return $this->db->get($this->aliases['tabel_f5']);
	}
	
	public function get_f5_by_field($fields, $params)
	{
		if (is_array($fields) && is_array($params)) {
			foreach ($fields as $key => $field) {
				$param = $params[$key]; // Get the corresponding param value
				$this->db->where($this->aliases[$field], $param);
			}
		} else {
			$this->db->where($this->aliases[$fields], $params);
		}

		$this->db->order_by($this->aliases['tabel_f5_field1'], 'DESC');
		return $this->db->get($this->aliases['tabel_f5']);
	}
	
	public function insert_f5($data)
	{
		return $this->db->insert($this->aliases['tabel_f5'], $data);
	}

	public function update_f5($data, $param1)
	{
		$this->db->where($this->aliases['tabel_f5_field1'], $param1);
		return $this->db->update($this->aliases['tabel_f5'], $data);
	}

	public function delete_f5_by_field($fields, $params)
	{
		if (is_array($fields) && is_array($params)) {
			foreach ($fields as $key => $field) {
				$param = $params[$key]; // Get the corresponding param value
				$this->db->where($this->aliases[$field], $param);
			}
		} else {
			$this->db->where($this->aliases[$fields], $params);
		}

		return $this->db->delete($this->aliases['tabel_f5']);
	}
}
