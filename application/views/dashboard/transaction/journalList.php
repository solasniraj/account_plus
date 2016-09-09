<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Journal Entries</h3>
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                         <thead>
                            <tr>
                            <center>
                            <th colspan="6">new bhaouchar </th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Bhoucher No </th>
                            <th>Discription</th>
                            <th>source</th>
                            <th>date</th>
                            <th>Amount(Rs)</th>
                            <th>&nbsp</th>
                            
                        </tr>
                        <tr>
                            <th>1 </th>
                            <th>GBS tranfered money</th>
                            <th>Nepal Government</th>
                            <th><input id="datepicker" class="form-control" type="text" placeholder="Day/Month/Year" name="datepicker"></th>
                            <th>123457</th>
                           
                            <td><a href="<?php echo base_url() . 'transaction/preview/' . $tGLList->gl_no; ?>">Preview</a></td>
                        </tr>
                         

                            
                        </tbody>
                        </table>

                </div>
            </div>
        </div>
   </div>
</div>
