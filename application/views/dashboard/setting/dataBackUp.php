<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Data Back Up</h3>
        
        <div class="tab-content">
            <div class="invalid">
							 <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {               
                 echo $flashMessage;
            }          
            if (isset($error)) {
                echo $error;
            }
            ?>
						</div>
            <div class="tab-pane active" id="horizontal-form">
                <?php echo form_open_multipart('setting/createBackup', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                
                <h2>Last date of data back up : </h2>
                    
                
                    <div class="col-sm-4 col-sm-offset-2">
                             <button class="btn btn-success btn-lg" style="width:119px;">Backup Now</button>
                           
                        </div>          
            </div>
        </div>   
       
    </div>
</div>

