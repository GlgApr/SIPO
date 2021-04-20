<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("post_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["post"] = $this->post_model->getAll();
        $this->load->view("admin/post/list", $data);
    }

    public function add()
    {
        $post = $this->post_model;
        $validation = $this->form_validation;
        $validation->set_rules($post->rules());

        if ($validation->run()) {
            $post->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/post/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/post');

        $post = $this->post_model;
        $validation = $this->form_validation;
        $validation->set_rules($post->rules());

        if ($validation->run()) {
            $post->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["post"] = $post->getById($id);
        if (!$data["post"]) show_404();

        $this->load->view("admin/post/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->post_model->delete($id)) {
            redirect(site_url('admin/post'));
        }
    }
}
