
	 	
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h2><?=$this->lang('edit_portfolio')?></h2>
        </section>

        <!-- Main content -->
        <section class="content">	 	

		 <div class="row">	
		 	
		 <div class="col-lg-12">
		 
	       <?=$this->message()?>
	       <?=$this->validation()?>
		  
          </div>	
           
          
		 <div class="col-lg-12">	
		  
		  
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                </div>
                <div class="box-body">
                 <form role="form" action="<?=$this->siteUrl()?>/admin/portfolios/edit/<?=e($data['portfolio']['id'])?>" method="post" enctype="multipart/form-data"> 
				 
                    <input type="hidden" name="id" class="form-control" value="<?=e($data['portfolio']['id'])?>" />
					<input type="hidden" name="image" id="image" class="form-control" value="<?=e($data['portfolio']['imagelocation'])?>">
                  
				  
                  <div class="form-group">
                    <label><?=$this->lang('description')?></label>	
                    <textarea type="text" name="description" class="form-control" rows="3"><?=e($data['portfolio']['description'])?></textarea>
                  </div>
				  
					<div class="form-group">
					<label><?=$this->lang('current_image')?></label>
					 <img src="<?=$this->siteUrl().'/'.PUBLIC_PATH.'/'.UPLOADS_PATH?>/admin/portfolio/<?=e($data['portfolio']['imagelocation'])?>" width="100" height="90"/>
					</div>	

					<div class="form-group">
					 <label><?=$this->lang('update_the_image')?></label>
						<input type="file" name="photoimg" id="photoimg" class="form-control">
					 <h6><?=$this->lang('leave_it_blank')?>.</h6>
					</div>			  
                                   
                  <div class="box-footer">
                    <?=$this->token()?>
                    <button type="submit" name="edit_portfolio" class="kafe-btn kafe-btn-mint-small full-width"><?=$this->lang('submit')?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              

		 
		</div><!-- /.col -->
		
        
			 
	    </div><!-- /.row -->		  		  
	   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
