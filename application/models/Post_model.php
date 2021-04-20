<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{
    private $_table = "post";

    public $judul_post;
    public $isi_post;
    public $id_post;
    public $image_post = "default.jpg";

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
        return $this->db->get_where($this->_table, ["id_post" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_post = uniqid();
        $this->judul_post = $post["judul"];
        $this->isi_post = $post["isi"];
        $this->image_post = $this->_uploadimage_post();
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_post = $post["id"];
        $this->judul_post = $post["judul"];
        $this->isi_post = $post["isi"];
        if (!empty($_FILES["image_post"]["name"])) {
    $this->image_post = $this->_uploadimage_post();
    }
  else {

    $this->image_post = $post["old_image_post"];
}
        $this->db->update($this->_table, $this, array('id_post' => $post['id']));
    }

    public function delete($id)
    {
      $this->_deleteimage_post($id);
        return $this->db->delete($this->_table, array("id_post" => $id));
    }
    private function _uploadimage_post()
{
    $config['upload_path']          = './upload/product/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->id_post;
    $config['overwrite']			= true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image_post')) {
        return $this->upload->data("file_name");
    }

    return "default.jpg";
}
private function _deleteimage_post($id)
{
    $product = $this->getById($id);
    if ($product->image_post != "default.jpg") {
	    $filename = explode(".", $post->image_post)[0];
		return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
    }
}
}
