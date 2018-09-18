<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
 if($this->session->userdata('login_cred')){
   $login_cred=$this->session->userdata('login_cred');
   $username=$login_cred['username'];
   $user_id=$login_cred['id'];
   $user_name_arr=getAdminUsername($user_id);
   $user_name=$user_name_arr[0]->first_name.'&nbsp;'.$user_name_arr[0]->last_name;
 }else{
   $username='Administrator';
   $user_id='';
   $user_name='';
 }
   ?>
<div class="right_administrator">
    <a href="javascript:void(0);" class="administrator"><span class="user"><i class="fa fa-user"></i></span> <?=$user_name?> <i class="fa fa-angle-down down"></i></a>
    <div class="administrator_box">
    <ul>
    <li><a href="<?=base_url()?>admin/account/my_account"><i class="fa fa-user"></i> My Account</a></li>
                        <li><a href="<?=base_url()?>admin/account/settings"><i class="fa fa-cog"></i> General Settings</a></li>
                        <li><a href="<?=base_url()?>admin/account/change_pw"><i class="fa fa-lock"></i> Change Password</a></li>
                        <li class="logout"><a href="<?=base_url()?>admin/dashboard/logout/"><i class="fa fa-power-off"></i> Logout</a></li>
       
    </ul>
                        </div>
                    </div>
    <div class="header_notification">
        <ul>
            <li class="<?=getPendingApproval()>0?'has_row':''?>"><a href="<?=base_url()?>admin/user/new_user"><i class="fa fa-user"></i> <span></span></a></li>
            <!-- <li><a href="#"><i class="fa fa-file"></i> <span></span></a></li> -->
        </ul>
    </div>