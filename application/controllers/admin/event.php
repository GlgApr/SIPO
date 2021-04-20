<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("event_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["event"] = $this->event_model->getAll();
        $this->load->view("admin/event/list", $data);
    }

    public function add()
    {
        $event = $this->event_model;
        $validation = $this->form_validation;
        $validation->set_rules($event->rules());

        if ($validation->run()) {
            $event->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/event/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/event');

        $event = $this->event_model;
        $validation = $this->form_validation;
        $validation->set_rules($event->rules());

        if ($validation->run()) {
            $event->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["event"] = $event->getById($id);
        if (!$data["event"]) show_404();

        $this->load->view("admin/event/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->event_model->delete($id)) {
            redirect(site_url('admin/event'));
        }
    }
}
