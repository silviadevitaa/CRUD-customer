<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    private $_table = "supplier";

    public $id_supplier;
    public $name;
    public $address;

    public function rules()
    {
        return [
            ['field' => 'id_supplier',
            'label' => 'id_supplier',
            'rules' => 'required'],

            ['field' => 'name',
            'label' => 'name',
            'rules' => 'required'],

            ['field' => 'address',
            'label' => 'address',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_supplier" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_supplier = uniqid();
        $this->id_supplier = $post["id_supplier"];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_supplier = $post["id_supplier"];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->update($this->_table, $this, array('id_supplier' => $post['id_supplier']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_supplier" => $id));
    }
}
