<?php

class Manage_assessment_type extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_assessment_type()
    {
        $query = $this->db->get('assessment_type');
        return $query->result();
    }

    function delete($AsmTypeID)
    {
        $this->db->delete('assessment_type', array('AssessmentTypeID' => $AsmTypeID));
    }

}
?>

