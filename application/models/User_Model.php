<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function getHistory()
    {
        $query = "SELECT `user_role`.*, `user`.`role`
                    FROM `user_role` JOIN `user`
                      ON `user_role`.`id` = `user`.`id`
                     ";

        return $this->db->query($query)->result_array();
    }
}
