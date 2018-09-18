<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
   $login_cred=$this->session->userdata('login_cred');
   $username=$login_cred['username'];
   $user_id=$login_cred['id'];
   $user_name_arr=getAdminUsername($user_id);
  $module_slug=$this->uri->segment(2);
  $method_slug=$this->uri->segment(3);
  $document_module=array('tag_category','author','audience','language');
  $user_module=array('user_group','user_category','user');
  $help_module=array('help_category','help_document');
   ?>
 <div class="left_sidebar">
        <div class="left_toggle"><i class="fa fa-bars"></i></div>
        <div class="left_navblock">
            <div class="menu_space">
                <div class="content">
                    <div class="sidebar_logo">
                        <div class="collapse_button">        
                            <button id="sidebar_collapse" class="btn btn-default"><i style="color:#fff;" class="fa fa-bars"></i></button>
                        </div>
                        <div class="logo none_title">
                            <a href="<?=base_url()?>" target="_blank">Apostolic <span>Toolbox</span></a>
                        </div>  
                        <div class="logo collapse_title">
                            <a href="<?=base_url()?>" target="_blank">Apostolic <br>Toolbox</a>
                        </div>          
                    </div>                    
                    <ul class="left_vnavigation">
                        <li class="<?=$module_slug=='dashboard'?'active':''?>"><a href="<?=base_url()?>admin/dashboard"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                     
                      <li class="<?=in_array($module_slug,$document_module)?'active parent open':''?>"> <a href="#"><i class="fa fa-file"></i><span>Documents</span></a>
                            <ul class="sub_menu" <?=in_array($module_slug,$document_module)?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='tag_category'?'active':''?>"><a href="<?=base_url()?>admin/tag_category">Tag Categories</a></li>
                                <li class="<?=$module_slug=='author'?'active':''?>"><a href="<?=base_url()?>admin/author">Authors</a></li>
                                 <li class="<?=$module_slug=='audience'?'active':''?>"><a href="<?=base_url()?>admin/audience">Target audience</a></li> 
                                 <li class="<?=$module_slug=='language'?'active':''?>"><a href="<?=base_url()?>admin/language">Languages</a></li>
                                <!--  <li><a href="#">Approved file(s)</a></li>
                                <li><a href="#">Approving segment</a></li> -->
                            </ul>
                        </li> 
                        <li class="<?=in_array($module_slug,$user_module)?'active parent open':''?>"><a href="#"><i class="fa fa-user"></i><span>Users</span></a>
                            <ul class="sub_menu" <?=in_array($module_slug,$user_module)?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='user_group'?'active':''?>"><a href="<?=base_url()?>admin/user_group">User Groups</a></li>
                                <li class="<?=$module_slug=='user_category'?'active':''?>"><a href="<?=base_url()?>admin/user_category">User Categories</a></li>
                                <li class="<?=$module_slug=='user'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/user/add">Add User </a></li>
                                <li class="<?=$module_slug=='user'&&$method_slug==''?'active':''?><?=$module_slug=='user'&&$method_slug=='search'?'active':''?>"><a href="<?=base_url()?>admin/user">Manage Users </a></li>
                                <li class="<?=$module_slug=='user'&&$method_slug=='new_user'?'active':''?><?=$module_slug=='user'&&$method_slug=='new_user_search'?'active':''?>"><a href="<?=base_url()?>admin/user/new_user">Waiting For Approval (<?=getPendingApproval()?>) </a></li>
                            </ul>
                        </li>
                        <li class="<?=$module_slug=='banner'?'active':''?>"><a href="#"><i class="fa fa-picture-o"></i><span>Banner Ads</span></a>
                            <ul class="sub_menu" <?=$module_slug=='banner'?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='banner'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/banner/add">Add Banner Ad</a></li>
                                <li class="<?=$module_slug=='banner'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/banner"> Manage Banner Ads</a></li>
                            </ul>
                        </li>
                         <li class="<?=$module_slug=='prayer_request'?'active':''?>"> <a href="#"><i class="fa fa-bell"></i><span>Prayer Requests</span></a>
                            <ul class="sub_menu" <?=$module_slug=='prayer_request'?'style="display: block;"':''?>>
                                <li  class="<?=$module_slug=='prayer_request'&&$method_slug=='access_rights'?'active':''?>"><a href="<?=base_url()?>admin/prayer_request/access_rights">Access Rights</a></li>
                                  <li  class="<?=$module_slug=='prayer_request'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/prayer_request/add">Add Prayer Request</a></li>
                                <li  class="<?=$module_slug=='prayer_request'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/prayer_request"> Manage Prayer Requests </a></li>
                            </ul>
                        </li>
                           
                           <li class="<?=$module_slug=='static_page'?'active':''?>"><a href="#"><i class="fa  fa-pagelines"></i><span>Static Pages</span></a>
                            <ul class="sub_menu" <?=$module_slug=='static_page'?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='static_page'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/static_page/add">Add Page</a></li>
                                <li class="<?=$module_slug=='static_page'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/static_page">Manage Pages</a></li>
                            </ul>
                        </li>
                           <li class="<?=$module_slug=='static_widget'?'active':''?>"><a href="#"><i class="fa  fa-cubes"></i><span>Static Widgets</span></a>
                            <ul class="sub_menu" <?=$module_slug=='static_widget'?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='static_widget'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/static_widget/add">Add Widget</a></li>
                                <li class="<?=$module_slug=='static_widget'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/static_widget">Manage Widgets</a></li>
                            </ul>
                        </li>
                        <li class="<?=$module_slug=='email_template'?'active':''?>"><a href="#"><i class="fa fa-envelope"></i><span>Email templates</span></a>
                            <ul class="sub_menu <?=$module_slug=='email_template'?'active':''?>">
                                <li class="<?=$module_slug=='email_template'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/email_template/add">Add Template</a></li>
                                <li class="<?=$module_slug=='email_template'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/email_template">Manage Templates</a></li>
                            </ul>
                        </li>
                        <li class="<?=in_array($module_slug,$help_module)?'active':''?>"><a href="#"><i class="fa fa-info"></i><span>Help Resource</span></a>
                            <ul class="sub_menu" <?=in_array($module_slug,$help_module)?'style="display: block;"':''?>>
                                <li class="<?=$module_slug=='Help_category_main'&&$method_slug=='addmain'?'active':''?>"><a href="<?=base_url()?>admin/Help_category_main/addmain">Add Help Main Category</a></li>
                                <li class="<?=$module_slug=='help_category_main'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/help_category_main">Manage Help Main Categories</a></li>
                                <li class="<?=$module_slug=='help_category'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/help_category/add">Add Help Sub Category</a></li>
                                <li class="<?=$module_slug=='help_category'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/help_category">Manage Help Categories</a></li>
                                <li class="<?=$module_slug=='help_document'&&$method_slug=='add'?'active':''?>"><a href="<?=base_url()?>admin/help_document/add">Add Help Resource</a></li>
                                <li class="<?=$module_slug=='help_document'&&$method_slug==''?'active':''?>"><a href="<?=base_url()?>admin/help_document">Manage Help Resources</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
      
    <div class="container_fluid inner" id="pcont">

   