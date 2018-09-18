<div class="listing_category_bottom">
<div class="listings_pagination">
		    	<ul>
		    		 <?php if($page!=1){?>
		    		<li><a href="<?=base_url()?>admin/<?=$this->router->fetch_class()?>/<?=$this->router->fetch_method()?>/<?=$page-1?><?= ($this->uri->segment(5)!=NULL)?'/'.$this->uri->segment(5):'' ?><?= ($this->uri->segment(6)!=NULL)?'/'.$this->uri->segment(6):'' ?>"><i class="fa fa-angle-double-left"></i> Prev</a></li>
		    		<?php } for($i=1;$i<=$no_of_page;$i++){ 
		    			
		    			if($i<=4){
		    				echo'<li '. (($page == $i)?'class="active"':'').'><a href="'.base_url().'admin/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$i.(($this->uri->segment(5)!=NULL)?'/'.$this->uri->segment(5):'').(($this->uri->segment(6)!=NULL)?'/'.$this->uri->segment(6):'').'"'.'>'.prefix_number($i).'</a></li>';	
		    			}else if($i>4 && $i<=($tot_rows-4)){
		    				echo '<li><a>...</a></li>';
		    			}else{
		    				echo'<li><a href="'.base_url().'admin/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$i.(($this->uri->segment(5)!=NULL)?'/'.$this->uri->segment(5):'').(($this->uri->segment(6)!=NULL)?'/'.$this->uri->segment(6):'').'"'.(($page == $i)?'class="current-page"':'').'>'.prefix_number($i).'</a></li>';	
		    			}
		    			?>
		    		<?php } if($page<$no_of_page){?>
		    	       <li><a href="<?=base_url()?>admin/<?=$this->router->fetch_class()?>/<?=$this->router->fetch_method()?>/<?=$page+1?><?= ($this->uri->segment(5)!=NULL)?'/'.$this->uri->segment(5):'' ?><?= ($this->uri->segment(6)!=NULL)?'/'.$this->uri->segment(6):'' ?>">Next <i class="fa fa-angle-double-right"></i></a></li>
		            <?php } ?>
		        	</ul>
    			</div>
    			</div>