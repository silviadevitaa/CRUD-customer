<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("supplier_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["supplier"] = $this->supplier_model->getAll();
        $this->load->view("admin/supplier/list", $data);
    }

    public function add()
    {
        $supplier = $this->supplier_model;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run()) {
            $supplier->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/supplier/new_form");
    }

    public function edit($id_supplier = null)
    {
        if (!isset($id_supplier)) redirect('admin/supplier');

        $supplier = $this->supplier_model;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run()) {
            $supplier->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["supplier"] = $supplier->getById($id_supplier);
        if (!$data["supplier"]) show_404();

        $this->load->view("admin/supplier/edit_form", $data);
    }

    public function delete($id_supplier=null)
    {
        if (!isset($id_supplier)) show_404();

        if ($this->supplier_model->delete($id_supplier)) {
            redirect(site_url('admin/supplier'));
        }
    }
}
