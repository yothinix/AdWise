<?php
class Get_password extends CI_Controller
{
    public function index($password=FALSE)
    {
        if ($this->form_validation->run() == FALSE)
        {
            //โหลดหน้า signup แล้วบอก error
        }
        else
        {
            //login ด้วย pass ใหม่ให้ auto แล้วพาไปหน้า change password
        }
    }
}
?>