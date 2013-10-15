<?php

class Data_model extends CI_Model {
    /* USE QUERY METHOD
    function getAll(){
        $q = $this->db->query("SELECT * FROM data");
        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }
    */
    /* USE ACTIVE RECORD
    function getAll(){
        $q = $this->db->get('data');

        if($q->num_rows() > 0){
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    */
    /*SPECIFIC
    function getAll(){
        $q = $this->db->select('title, contents');
        $q = $this->db->get('data');
        if($q->num_rows() > 0){
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    */
    /*SPECIFIC QUERY
    function getAll(){
        $sql = "SELECT title, author, contents FROM data WHERE id = ? AND author = ?";
        $q = $this->db->query($sql, array(2, 'Jeffrey Way'));
        if($q->num_rows() > 0){
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    */

    function getAll(){
        $this->db->select('title, contents');
        $this->db->from('data');
        $this->db->where('id', 1);

        $q = $this->db->get();
        if($q->num_rows() > 0){
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
}