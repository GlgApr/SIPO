<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model
{
    private $_table = "event";

    public $judul_event;
    public $isi_event;
    public $image_event = "default.jpg";
    public $id_event;

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
        return $this->db->get_where($this->_table, ["id_event" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_event = uniqid();
        $this->judul_event = $post["judul"];
        $this->isi_event = $post["isi"];
        $this->image_event = $this->_uploadimage_event();
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_event = $post["id"];
        $this->judul_event = $post["judul"];
        $this->isi_event = $post["isi"];
        if (!empty($_FILES["image_event"]["name"])) {
    $this->image_event = $this->_uploadimage_event();
    }
  else {

    $this->image_event = $post["old_image_event"];
}
        $this->db->update($this->_table, $this, array('id_event' => $post['id']));
    }

    public function delete($id)
    {
      $this->_deleteimage_event($id);
        return $this->db->delete($this->_table, array("id_event" => $id));
    }
    private function _uploadimage_event()
{
    $config['upload_path']          = './upload/product/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->id_event;
    $config['overwrite']			= true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image_event')) {
        return $this->upload->data("file_name");
    }

    return "default.jpg";
}
private function _deleteimage_event($id)
{
    $product = $this->getById($id);
    if ($product->image_event != "default.jpg") {
	    $filename = explode(".", $event->image_event)[0];
		return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
    }
}
}
