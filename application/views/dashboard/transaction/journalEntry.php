<script>
    
   function changeFunc() {
    var selectBox = document.getElementById("programsList");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;   
    var dataString = 'pId=' + selectedValue;
   
    $.ajax({
      type: "POST",
      url: "<?php echo base_url().'transaction/get_subledgers' ;?>",
      data: dataString,
      success: function(msg) 
      {
          alert(msg);
       $('#subLedgerList').html(msg);                
     }   
   });
  }


</script>


<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1 text-center">Journal Entry form</h3>
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

            <style>

                .width100 {
                    width:120px;
                }

                .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    padding: 5px !important;
                }

                .table th {

                    width:150px;
                }
                #page-wrapper {
                    background-color: #fff;
                }
                table td {
                    text-align: center;
                }
                .lastButton {
                    text-align: center;
                    margin:0 auto;
                }
            </style>
            <div class="container-fluid " >
                <div class="row">
                    <div class="col-md-4 ">
                        <table class="table">
                            <tr>
                                <td  class="text-right width100">Journal no:</td>
                                <td><input class="form-control" type="text"></td>

                            </tr>
                            <tr>

                                <td class="text-right width100">Date:</td>
                                <td><input class="form-control" type="text"></td>


                            </tr>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <table class="table">
                            <tr>
                                <td class="text-right width100">Source :</td>
                                <td><input  class="form-control" type="text"></td>

                            </tr>

                        </table>
                    </div>

                    <div class="col-md-4 ">
                        <table class="table">
                            <tr>
                                <td class="text-right width100">Journal Type:</td>
                                <td><input  class="form-control" type="text"></td>

                            </tr>
                            <tr>

                                <td class="text-right width100">Bank Balance:</td>
                                <td><strong style="color:red;">Rs. 0,00,000/-</strong></td>


                            </tr>
                        </table>
                    </div>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Debit | Credit</th>
                                <th>Programm</th>
                                <th>Sub-Ledger</th>
                                <th>Account type</th>
                                <th>Descrption</th>
                                <th>Amount</th>
                                <th>Cheque number</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" id="sel1">
                                        <option value="dr.">Debit</option>
                                        <option value="cr">Credit</option>
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control" id="programsList" onchange="changeFunc();">
                                        <option value="0">Select Program</option>
                                        <?php if (!empty($program_list)) {
                                            foreach ($program_list as $plists) {
                                                ?>

                                                <option value="<?php echo $plists->id; ?>"><?php echo $plists->program_name; ?></option>
    <?php }
} ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="subLedgerList">
                                        
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="sel1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text">
                                </td>
                                <td>
                                    <input type="text">
                                </td>
                                <td>
                                    <input type="text">
                                    </td>
                               
                                <td><button type="text" class="btn btn-default">Add</button></td>

                            </tr>

                        </tbody>
                    </table>
                </div> 

            </div>
            <div class="container " style="max-width:1000px;">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>debit | credit</th>
                                <th>Account type</th>
                                <th>descrption</th>
                                <th>subLedger</th>
                                <th>helper Accout</th>

                                <th>programm</th>
                                <th>debit</th>
                                <th>credit</th>
                                <th>payee</th>
                                <th>amount</th>

                                <th>check number</th>
                                <th> </th>
                                <th> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Anna</td>
                                <td>Pitt</td>
                                <td>35</td>
                                <td>New York</td>
                                <td>USA</td>
                                <td>1</td>
                                <td>Anna</td>
                                <td>Pitt</td>
                                <td>35</td>
                                <td>35</td>

                                <td><button type="text" class="btn btn-default">Add</button></td>
                                <td><button type="text" class="btn btn-default">Edit</button></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Anna</td>
                                <td>Pitt</td>
                                <td>35</td>
                                <td>New York</td>
                                <td>USA</td>
                                <td>1</td>
                                <td>Anna</td>
                                <td>Pitt</td>
                                <td>35</td>
                                <td>35</td>

                                <td><button type="text" class="btn btn-default">Add</button></td>
                                <td><button type="text" class="btn btn-default">Edit</button></td>
                            </tr>

                            <tr>
                                <td colspan="7">total</td>
                                <td>35</td>
                                <td>New York</td>
                                <td colspan="2"></td>

                            </tr>

                            <tr>
                                <td colspan="7">debit and credit diffence</td>
                                <td>35</td>
                                <td>New York</td>
                                <td colspan="2"></td>

                            </tr>
                        </tbody>
                    </table>
                </div> 

                <div class="row">

                    <div class="col-md-4 col-md-offset-1" >
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-1" >
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="pwd">total check blance</label>
                            <div class="col-sm-7">
                                <input style="width:60%;" type="password" class="form-control" id="pwd">
                            </div>
                        </div>

                    </div>

                    <div class="clearfix">
                    </div>
                    <div class="lastButton">
                        <input type="button" class="btn btn-default" value="submit">
                        <input type="submit" class="btn btn-default" value="reset">

                    </div>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
        </div>
