				
<style>
    .tbhead{
        background-color:#466d6d;
        border-style: solid;
    }

</style>

<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Ledger Details</h3>
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
            <div data-example-id="simple-responsive-table" class="bs-example5">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" border="1px solid">



                        <thead class="tbhead">
                            <tr>

                                <th>S.N.</th>
                                <th >Name</th>
                                <th>Code</th>

                                <th>Action</th>
                            </tr>

                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($accountCharts as $aclist) {
                                ?>
                                </thead>		
                                <tr>

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $aclist->chart_class_name; ?></td>
                                    <td><?php echo $aclist->chart_code; ?></td>
                                    <td><a href="<?php echo base_url() . 'chartAccount/addSubClass/' . $aclist->id; ?>">Add Item</a></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
