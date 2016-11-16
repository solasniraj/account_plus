            <div id="page-wrapper">
                <div class="graphs">
                    <h3 class="blank1">Year Configuration</h3>
                     
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
                         <?php if(!empty($fiscalYearInfo)){                foreach ($fiscalYearInfo as $comData){ ?>
            <div class="alert alert-info" style="margin-bottom: 0;">You are going to close fiscal year <?php echo $comData->fiscal_year; ?> . If you are sure to close current fiscal year and open new fiscal year, please proceed.</div>            
              <br/> 
            <div class="col-sm-4">
                                <button class="btn btn-success btn-lg" style="">Close current fiscal year</button>
                            </div>
                         <?php } ?>       
                     
     <?php  } ?>
                </div>
            
        </div>
    </div>
