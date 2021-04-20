<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{
    private $_table = "pengumuman";

    public $judul_pengumuman;
    public $isi_pengumuman;
    public $id_pengumuman;
    public $image_pengumuman = "default.jpg";

    public function rules()
    {
        return [
            ['field' => 'judul',
            'label' => 'Judul',
            'rules' => 'required'],

            ['field' => 'isi',
            'label' => 'Isi',
            'rules' => 'required'],

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_pengumuman" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_pengumuman = uniqid();
        $this->judul_pengumuman = $post["judul"];
        $this->isi_pengumuman = $post["isi"];
        $this->image_pengumuman = $this->_uploadimage_pengumuman();
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_pengumuman = $post["id"];
        $this->judul_pengumuman = $post["judul"];
        $this->isi_pengumuman = $post["isi"];
        if (!empty($_FILES["image_pengumuman"]["name"])) {
    $this->image_pengumuman = $this->_uploadimage_pengumuman();
    }
  else {

    $this->image_pengumuman = $post["old_image_pengumuman"];
}
        $this->db->update($this->_table, $this, array('id_pengumuman' => $post['id']));
    }

    public function delete($id)
    {
      $this->_deleteimage_pengumuman($id);
        return $this->db->delete($this->_table, array("id_pengumuman" => $id));
    }
    private function _uploadimage_pengumuman()
{
    $config['upload_path']          = './upload/product/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->id_pengumuman;
    $config['overwrite']			= true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image_pengumuman')) {
        return $this->upload->data("file_name");
    }

    return "default.jpg";
}
private function _deleteimage_pengumuman($id)
{
    $product = $this->getById($id);
    if ($product->image_pengumuman != "default.jpg") {
	    $filename = explode(".", $pengumuman->image_pengumuman)[0];
		return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
    }
}
}
