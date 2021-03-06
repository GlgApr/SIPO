<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pengumuman_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["pengumuman"] = $this->pengumuman_model->getAll();
        $this->load->view("admin/pengumuman/list", $data);
    }

    public function add()
    {
        $pengumuman = $this->pengumuman_model;
        $validation = $this->form_validation;
        $validation->set_rules($pengumuman->rules());

        if ($validation->run()) {
            $pengumuman->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/pengumuman/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/pengumuman');

        $pengumuman = $this->pengumuman_model;
        $validation = $this->form_validation;
        $validation->set_rules($pengumuman->rules());

        if ($validation->run()) {
            $pengumuman->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["pengumuman"] = $pengumuman->getById($id);
        if (!$data["pengumuman"]) show_404();

        $this->load->view("admin/pengumuman/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->pengumuman_model->delete($id)) {
            redirect(site_url('admin/pengumuman'));
        }
    }
}
