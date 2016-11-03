<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
var table; 
$(document).ready(function() { 
    //datatables
    table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order. 
        "iDisplayLength": 50,
        "aLengthMenu": [[10, 25, 50, 100], ["10", "25", "50", "100"]],
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

function showState(sel) {
    
	var select_id = sel.options[sel.selectedIndex].value;  
        var jlId = $(sel).closest('td').prev('td').prev().prev().prev().text();
       var select = $(sel).closest('td').html();
        
        if (select_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			 url: baseUrl + "transaction/changeGlStat",
			data: {select: select_id, jnNo: jlId},
			cache: false,
			success: function(msg) {  
                            if(msg==1){
                            $(sel).closest('td').replaceWith("<td><select><option value='1' selected>Publish</option></select><br/><strong>Status Updated</strong></td>");
			
}else if(msg==3){
                                    $(sel).closest('td').replaceWith("<td><select><option value='3' selected>Void</option></select><br/><strong>Status Updated</strong></td>");
                       
}else{
                                 
                                    }
			}
		});
	} 
}

$(document).ready(function ()
{
    
    $(document).on("change", '#department', function(e) {
            var department = $(this).val();
            

            $.ajax({
                type: "POST",
                data: {department: department},
                url: 'admin/users/get_name_list.php',
                dataType: 'json',
                success: function(json) {

                    var $el = $("#name");
                    $el.empty(); // remove old options
                    $el.append($("<option></option>")
                            .attr("value", '').text('Please Select'));
                    $.each(json, function(value, key) {
                        $el.append($("<option></option>")
                                .attr("value", value).text(key));
                    });														
	                

                    
                    
                }
            });

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
            <?php
            }
          
            if (isset($error)) {
                echo $error;
            }
            ?>
            <div data-example-id="simple-responsive-table" class="bs-example4">

                <div class="table-responsive">
                    
                    <table id="table" class="table table-striped table-bordered table-responsive table-condensed" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Bhoucher No</th>
                    <th>Description</th>
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
<link rel="stylesheet" href="<?php echo base_url().'contents/css/jquery-confirm.css'; ?>" >
<script src="<?php echo base_url().'contents/js/confirm.js'; ?>" ></script>       
<script>
  $(document).ready(function(){
   $(document).on("click", "#previewForm", function(e){
    e.preventDefault();
    var thiss = $(this); 

    $.confirm({
      title: 'A critical action',
      content: 'Do you really want to submit and publish this ?',
      confirmButton: 'Proceed',
      cancelButton: 'Cancel',
      animation: 'scale',
      animationSpeed: '400',
      animationBounce: '',
      confirm: function(){
       var hr = thiss.attr('href');
       window.location= hr;

     },
     cancel: function(){
       // do something when No is clicked.
     }
   });

  });
 }); 
</script>   