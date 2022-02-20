<div class="row">
				<div class="col-md-12">
					<!-- <div class="row clearfix"> -->
	                    <div class="body">
	                    	<div class="wrapper">
								<div class="header bg-blue-grey">
		                            <h2>
		                                Blue Grey - Title <small>Description text here...</small>
		                            </h2>
		                        </div>
								<?php  
								// debug($prov_approved);
								$no = 1; 
								foreach($list_course as $result) {
									$cover = "";
								?>
	                    			<div class="wrapper-item bg-blue-grey">
	                    				<?php echo $result["nm_learning"]; ?>
	                    					
	                    			</div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
	                    			<div class="wrapper-item bg-blue-grey"><?php echo $result["nm_learning"]; ?></div>
								<?php
									}
								?>
	                    	</div>
	                    	<!-- <td><a class='btn btn-xs btn-success waves-effect'>DAFTAR</a></td> -->

	                    </div>
					<!-- </div> -->
	
				</div>
			</div>