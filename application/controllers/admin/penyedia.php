<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class penyedia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("penyedia_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["penyedia"] = $this->penyedia_model->getAll();
        $this->load->view("admin/penyedia/list", $data);
    }

    public function add()
    {
        $penyedia = $this->penyedia_model;
        $validation = $this->form_validation;
        $validation->set_rules($penyedia->rules());

        if ($validation->run()) {
            $penyedia->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/penyedia/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/penyedia');

        $penyedia = $this->penyedia_model;
        $validation = $this->form_validation;
        $validation->set_rules($penyedia->rules());

        if ($validation->run()) {
            $penyedia->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["penyedia"] = $penyedia->getById($id);
        if (!$data["penyedia"]) show_404();

        $this->load->view("admin/penyedia/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->penyedia_model->delete($id)) {
            redirect(site_url('admin/penyedia'));
        }
    }
}
