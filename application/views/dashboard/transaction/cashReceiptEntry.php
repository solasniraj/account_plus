<div id="page-wrapper">

    <div class="graphs">
        <h3 class="blank1">Cash Receipt Entry</h3>
        <div class="xs tabls">
            <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php
            }
          
            if (isset($error)) {
                echo $error;
            }
            ?>
                <div class="form-group" >
                    <div class="row">
                        <div class="col-md-4 ">
                            <table class="table">

                                <tr><td for="focusedInput"><b>Gouswara bhourchar no </b></td>
                                    <td><input class="form-control" type="text"></td>
                                    


                                </tr>


                                <tr>
                                    <td class="width100"><b>Nyareson </b></td>
                                    <td><input  class="form-control" type="text"></td>

                                </tr>
                            </table>
                        </div>


                        
                        <div class="col-md-4">
                            <table class="table">
                               <tr>

                                <td class="text-right width100"><b>Date</b></td>
                                <td><input class="form-control" id="datepicker" type="text" placeholder="Day/Month/Year"></td>


                            </tr>


                            <tr>
                                <td class="text-right width100"><b>Source </b></td>
                                <td><input  class="form-control" type="text"></td>
                            </tr>

                        </tr>
                    </table>
                </div>
            </div>
        </div>







        <!--*************** Second table************* -->

        <div class="table-responsive">
            <table class="tablee">
                <tbody>

                    <tr>

                        <td><b>Types</b></td>
                        <td class="col-md-1"><b>Income R no.</b></td>
                        <td class="col-md-1.3"><b>Bank Bhouchar no.</b></td>
                        <td class="col-md-1.3"><b>Receipent name</b></td>
                        <td class="col-md-1.3"><b>Income title</b></td>

                        <td class="col-md-1"><b>Income(rs)</b></td>
                        <td><b>Remark</b></td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>


                    </tr>

                    <tr>
                        <td><select class="form-control" id="programsList" onchange="whenProgramIsSelected(this)">
                            <option value="">Rupees</option>
                        </select></td>             
                        <td> <input  class="form-control " type="text" name="income" id="income"></td>
                        <td><input  class="form-control " type="text" name="description" id="description"></td>
                        <td>  <input  class="form-control " type="text" name="description" id="description"></td>
                        <td><select class="form-control" id="programsList" onchange="whenProgramIsSelected(this)">
                            <option value="">Household tax</option>
                        </select></td>  
                        <td>  <input  class="form-control " type="text" name="description" id="description"></td>
                        <td>  <input  class="form-control " type="text" name="description" id="description"></td>
                        <td colspan="3"  class="b"><div class="lastButton">
                            <button class="btn btn-success " id="submitCurrentData" style=" padding:5px;margin:5px;width:70px;font-size:18px;">Save</button></td>

                        </tr>
                    </tbody>
                </table>
            </div>


<br>

        </div>
    </div>
</div>
</div>









