
	 	
	 	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
 
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h2><?=$this->lang('portfolios')?></h2>
        </section>

        <!-- Main content -->
        <section class="content">	 	
		 <div class="row">	
          
		 <div class="col-lg-12">	 		


		 		<div class="box box-info">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					   <th><?=$this->lang('user')?></th>
					   <th><?=$this->lang('image')?></th>
					   <th><?=$this->lang('description')?></th>
					   <th><?=$this->lang('featured')?></th>
					   <th><?=$this->lang('action')?></th>
                      </tr>
                    </thead>
                    <tbody>
				    <?php
						foreach($data['portfolios'] as $row) {
	
					    echo '<tr id="tr'.e($row["id"]).'">';
						
					foreach($data["users"] as $r1){	
					  if($row["userid"] == $r1["userid"]):	
					    echo '<td><img src="'. $this->siteUrl().'/'.PUBLIC_PATH.'/'.UPLOADS_PATH .'/admin/users/'. e($r1["imagelocation"]) .'" width="50" height="30" />'. e($r1["name"]) .'</td>';
					  endif;	
					}
					
					    echo '<td><img src="'. $this->siteUrl().'/'.PUBLIC_PATH.'/'.UPLOADS_PATH .'/admin/portfolio/'. e($row["imagelocation"]) .'" width="70" height="60" /></td>';
					    echo '<td>'. e($row["description"]) .'</td>';
						

						
					    if (e($row["featured"]) == 1) :
					    echo '<td>
						  <span class="label label-success">'. $this->lang('featured') .'</span>
					      <a id="un_feature_portfolio" data-id="' . e($row["id"]) . '" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'. $this->lang('un_feature') .'">
						   <span class="fa fa-times"></span></a>
					      </td>';
						elseif(e($row["featured"]) == 0):
					    echo '<td>
						  <span class="label label-success">'. $this->lang('not_featured') .'</span>
					      <a id="feature_portfolio" data-id="' . e($row["id"]) . '" class="btn btn-success btn-xs" data-toggle="tooltip" title="'. $this->lang('feature') .'">
						   <span class="fa fa-check"></span></a>
						   
					      </td>';
						endif;						
						
					    echo '<td>
					      <a href="'. $this->siteUrl() .'/admin/portfolios/edit/' . e($row["id"]) . '" class="btn btn-success btn-xs" data-toggle="tooltip" title="'. $this->lang('edit') .'"><span class="fa fa-edit"></span></a>
					      <a id="delete_portfolio" data-id="' . e($row["id"]) . '" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'. $this->lang('delete') .'"><span class="fa fa-trash"></span></a>
						  
                          </td>';
					    echo '</tr>';
					   }
			        ?>
                    </tbody>
                    <tfoot>
                      <tr>
					   <th><?=$this->lang('user')?></th>
					   <th><?=$this->lang('image')?></th>
					   <th><?=$this->lang('description')?></th>
					   <th><?=$this->lang('featured')?></th>
					   <th><?=$this->lang('action')?></th>
                      </tr>
                    </tfoot>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
          </div>
        
			 
	    </div><!-- /.row -->		  		  
	   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


 	 
	  <script>
	  $(document).on('click', '#delete_portfolio', function (e) {
        e.preventDefault();
				  var id = $(this).data('id');
				  
		swal({
		  title: "<?=$this->lang('delete_this_record')?>?",
		  text: "<?=$this->lang('click_yes_delete')?>.",
		  icon: "warning",
		  buttons: ["Cancel!", "Yes!"],
		  dangerMode: true,
		}).then((willDelete) => {
			  if (willDelete) {    
				  
			     $.ajax({
			   		url: '<?=$this->siteUrl()?>/requests/delete_portfolio',
			    	type: 'GET',
			       	data: 'id='+$(this).data('id'),
			       	dataType: 'json'
			     })
			     .done(function(response){
				console.log(response);
			     	swal('<?=$this->lang('deleted')?>!', response.message, response.status);
				    $('#tr'+id).fadeOut(500, function() { $('#comment'+id).remove(); });
			     })
			     .fail(function(){
					 console.log(response);
			     	swal('<?=$this->lang('oops')?>...', '<?=$this->lang('something_went_wrong')?>!', 'error');
			     });				  
				 
			  } else {
				swal("<?=$this->lang('cancelled')?>!");
			  }
       });
	  });
	  </script>	

	  
       <!-- Feature User -->

	  <script>
	  $(document).on('click', '#feature_portfolio', function (e) {
        e.preventDefault();
				  var id = $(this).data('id');
				  
		swal({
		  title: "<?=$this->lang('feature_this_portfolio_on_frontend')?>?",
		  text: "<?=$this->lang('click_yes_feature')?>.",
		  icon: "warning",
		  buttons: ["Cancel!", "Yes!"],
		  dangerMode: true,
		}).then((willDelete) => {
			  if (willDelete) {    
				  
			     $.ajax({
			   		url: '<?=$this->siteUrl()?>/requests/feature_portfolio',
			    	type: 'GET',
			       	data: 'id='+$(this).data('id'),
			       	dataType: 'json'
			     })
			     .done(function(response){
				console.log(response);
			     	swal('<?=$this->lang('featured')?>!', response.message, response.status);
				        setTimeout(function(){
							location.reload();
						}, 500)
			     })
			     .fail(function(){
					 console.log(response);
			     	swal('<?=$this->lang('oops')?>...', '<?=$this->lang('something_went_wrong')?>!', 'error');
			     });				  
				 
			  } else {
				swal("<?=$this->lang('cancelled')?>!");
			  }
       });
	  });
	  </script>

	  <script>
	  $(document).on('click', '#un_feature_portfolio', function (e) {
        e.preventDefault();
				  var id = $(this).data('id');
				  
		swal({
		  title: "<?=$this->lang('remove_this_portfolio_on_frontend')?>?",
		  text: "<?=$this->lang('click_yes_remove')?>.",
		  icon: "warning",
		  buttons: ["Cancel!", "Yes!"],
		  dangerMode: true,
		}).then((willDelete) => {
			  if (willDelete) {    
				  
			     $.ajax({
			   		url: '<?=$this->siteUrl()?>/requests/un_feature_portfolio',
			    	type: 'GET',
			       	data: 'id='+$(this).data('id'),
			       	dataType: 'json'
			     })
			     .done(function(response){
				console.log(response);
			     	swal('<?=$this->lang('featured')?>!', response.message, response.status);
				        setTimeout(function(){
							location.reload();
						}, 500)
			     })
			     .fail(function(){
					 console.log(response);
			     	swal('<?=$this->lang('oops')?>...', '<?=$this->lang('something_went_wrong')?>!', 'error');
			     });				  
				 
			  } else {
				swal("<?=$this->lang('cancelled')?>!");
			  }
       });
	  });
	  </script>		  
	  

