<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Engagements extends ITF_Model {

    private $name="feedback_url";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */
    

    public function saveEngagement($data = array(), $where = array()) {
        return $this->db->save($this->name, $data, $where);
    }

    public function getEngagementByAssignId($aid = "0") {



        $this->db->from($this->name);

        $this->db->where("assign_time_id", $aid);

        $query = $this->db->get()->result();

        return $query;
    }
   

    public function up_data($id='')

    {
    $this->db->select('*');
    $this->db->where('id',$id);
    $this->db->from($this->name);
    return $this->db->get()->row();
    }

   
}
