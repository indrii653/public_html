<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Task_model (Task Model)
 * Task model class to get to handle task related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Kepuasan_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function kepuasanListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('kepuasan as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskTitle LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function kepuasanListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('kepuasan as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskTitle LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new task to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewkepuasan($kepuasanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('kepuasan', $kepuasanInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get task information by id
     * @param number $taskId : This is task id
     * @return array $result : This is task information
     */
    function getkepuasanInfo($id)
    {
        $this->db->select('*');
        $this->db->from('kepuasan');
        $this->db->where('id', $id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the task information
     * @param array $kepuasanInfo : This is task updated information
     * @param number $taskId : This is task id
     */
    function editkepuasan($k ,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('kepuasan', $k);
        
        return TRUE;
    }
    function deletekepuasan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kepuasan');
        
        return $this->db->affected_rows();
    }
}