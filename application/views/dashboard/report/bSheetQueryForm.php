<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        <br>
        <h3 class="blank1">Balance Shet Report Query</h3>
        <div class="xs tabls">
            <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php }
            ?>

            <div data-example-id="simple-responsive-table" class="bs-example4">
                <div class="container">

                    <style>

                        .lastButton {
                            text-align: center;
                            margin:0 auto;
                        }
                        .form-control{
                            width:73%;
                        }

                    </style>


                    </head>
                    <body>
                        <h3 class="text-center"><span class="label label-default"></span></h3>

                        <br>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <?php echo form_open_multipart('reports/balanceSheet', array('id' => '','class'=>'form-horizontal', 'novalidate'=>'novalidate'));?>
                                   <?php if(!empty($fiscalYear)){ ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="fiscalYear"><b>Fiscal Year</b></label>
                                        <div class="col-sm-9">
                                            <select class="form-control1" id="sel1" name="fiscalYear">
                                                <?php foreach($fiscalYear as $fYear){ ?>
                                               <option value="<?php echo $fYear->fiscal_year; ?>"><?php echo $fYear->fiscal_year; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <?php } ?> 

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="pwd"><b>From Date </b> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="nepaliDateF" class="form-control1 nepali-calendar" name="nepaliDateF" value="" placeholder="YYYY-MM-DD"/>
        <input type="hidden" id="englishDateF" name="englishDateF"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="pwd"><b>To Date </b></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="nepaliDateT" class="form-control1 nepali-calendar" name="nepaliDateT" value="" placeholder="YYYY-MM-DD"/>
        <input type="hidden" id="englishDateT" name="englishDateT"/>

                                        </div>
                                    </div>
                                    <div class="lastButton">
                                        <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px;">Show Balance Sheet</button>
                                    </div>
<?php echo form_close(); ?>
                            </div>

                            
                        </div>
                </div>




            </div>
        </div>
    </div>
</div>
</div>
