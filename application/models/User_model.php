<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public $user_id;
    public $name;
    public $password;
    public $email;
    public $image = "default.jpg";
    public $alamat;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],

            ['field' => 'alamat',
            'label' => 'alamat',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->user_id = uniqid();
        $this->name = $post["name"];
        $this->password = $post["password"];
        $this->email = $post["email"];
        $this->image = $this->_uploadImage();
        $this->alamat = $post["alamat"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->user_id = $post["id"];
        $this->name = $post["name"];
        $this->password = $post["password"];
        $this->email = $post["email"];
        $this->alamat = $post["alamat"];
        if (!empty($_FILES["image"]["name"])) {
    $this->image = $this->_uploadImage();
    }
  else {

    $this->image = $post["old_image"];
}
        $this->alamat = $post["alamat"];
        $this->db->update($this->_table, $this, array('user_id' => $post['id']));
    }

    public function delete($id)
    {
      $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("user_id" => $id));
    }
    private function _uploadImage()
{
    $config['upload_path']          = './upload/product/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->user_id;
    $config['overwrite']			= true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image')) {
        return $this->upload->data("file_name");
    }

    return "default.jpg";
}
private function _deleteImage($id)
{
    $product = $this->getById($id);
    if ($product->image != "default.jpg") {
	    $filename = explode(".", $user->image)[0];
		return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
    }
}
}
