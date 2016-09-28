<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
var table; 
$(document).ready(function() { 
    //datatables
    table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order. 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseUrl + "transaction/getJournalPagination",
            "type": "POST"
        }, 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ], 
    }); 
});
</script>

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
                    
                    <table id="table" class="table table-bordered" cellspacing="0" width="99%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Bhoucher No</th>
                            <th>Discription</th>
                            <th>Date</th>
                            <th>Amount(Rs)</th>
                            <th>Status</th>
                            <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
