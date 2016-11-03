<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">

        <?php
        $fiscal_year = $this->session->userdata('fiscal_year');
        $value = str_replace('/', '&#47;', $fiscal_year);
        $fy = urlencode($value);
        if (!empty($committeeInfo)) {
            foreach ($committeeInfo as $cLists) {
                ?>

                <main class="flex-center">
        <?php if (!empty($cLists->logo)) { ?>
                        <div>
                            <img src="<?php echo base_url() . 'contents/uploads/images/' . $cLists->logo; ?>" height="60"/>
                        </div>
        <?php } ?>
                    <div>
                        <h4><?php echo $cLists->committee_name; ?></h4>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>

                    </div>
                </main>    
    <?php }
} ?>



        <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

            <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                <tr>
                    <td colspan="2"><h3>Bank reconciliation</h3> 
                        <h4><?php echo $bank ?></h4>

                    </td>
                </tr>


            </table>
        </div>


        <div class="clearfix"></div>
        <div class="xs tabls">
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
            <div data-example-id="simple-responsive-table" class="bs-example4">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>


                                <th class="text-left" colspan="5">Balance as per bank statement (end of period)</th>
                                <th><?php echo $amount; ?></th>
                                <th>&nbsp;</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>bibaran</td>	
                                <td>vouchure number</td>
                                <td>check number</td>
                                <td>date</td>
                                <td>bausa no</td>
                                <td>rakam </td>
                                <td> &nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" id="sel1">
                                        <option>baink ma jamm huna napayeko rakam</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </td>	
                                <td><input class="form-control"  type="text"></td>
                                <td><input class="form-control"  type="text"></td>
                                <td><input class="form-control"  type="text"></td>
                                <td>
                                    <select class="form-control" id="sel1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </td>	
                                <td><input class="form-control"  type="text"></td>
                                <td rowspan="3"><button class="btn btn-default"  type="text">save</button></td>
                            </tr>

                            <tr>


                                <td class="text-left" colspan="6">(+) baink man jamm  huna napayeko num (ka)</td>




                            </tr>
                            <tr>


                                <td style="text-right">jamm (ka)</td>	
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>1000</td>
                                <td>&nbsp;</td>


                            </tr>


                            <tr>


                                <td class="text-left" colspan="6">(-)bank bata bhuktani huna baki check (ka)</td>




                            </tr>

                            <tr>


                                <td style="text-right"></td>	
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td rowspan="3"><button class="btn btn-default">delete</button></td>


                            </tr>

                            <tr>


                                <td style="text-right">jamm (ka)</td>	
                                <td>&nbspn;</td>
                                <td>&nbspn;</td>
                                <td>&nbspn;</td>
                                <td>1000</td>
                                <td>&nbsp;</td>


                            </tr>

                            <tr>


                                <td style="text-right">yetata bank moujdad</td>	
                                <td>&nbspn;</td>
                                <td>&nbspn;</td>
                                <td>&nbspn;</td>
                                <td>1000</td>
                                <td>&nbsp;</td>


                            </tr>


                            <tr>


                                <td class="text-left" colspan="5">sesta anusar bank moojdad</td>
                                <td>10000</td>
                                <td>&nbsp;</td>


                            </tr>

                            <tr>


                                <td class="text-left" colspan="5">farak rakam</td>
                                <td>10000</td>
                                <td>&nbsp;</td>


                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

