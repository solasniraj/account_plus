
  <style>


@media print {
    aside#sidebar,header[role="banner"],footer,#comments,#respond {
        display: none;
    }
    #container #content #main {
        width: 90%;
        margin: 0px;
        padding: 0px;
    }
    * {
        color: #000;    
        background-color: #fff;
        @include box-shadow(none);
        @include text-shadow(none);
    }
    a:after {
        content: "( "attr(href)" )";
    }

}


  </style>

    <div class="container">
        <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
           <img src="http://localhost/account_plus/image/watersplash.png" img-align="top" alt="images" style= "width:40px; height:40px;">
           <br>
           <h2 > GDB Nepal government Ltd </h2>
     </div>
    </div>
    <div id="page-wrapper">
        <div class="graphs">
            <div class="xs tabls">
                <div data-example-id="simple-responsive-table" class="bs-example4">

                   <!-- priview first table of singleJournla entry -->

                   <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <center>
                                    <th>General Ledger Transaction Details</th>
                                    <th>Reference</th>
                                    <th>Date </th>
                                    <th>Person/item </th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Journal Entry #14 </th>
                                <th>13</th>
                                <th><input id="datepicker" class="form-control" type="text" placeholder="Day/Month/Year" name="datepicker"></th>
                                <th>&nbsp</th>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- second table for singleJournalEntry  -->

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <center>
                                    <th>Account code</th>
                                    <th>Account name</th>
                                    <th>DEmension </th>
                                    <th>Debit </th>
                                    <th>Credit</th>
                                    <th>Memo</th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1200 </th>
                                <th>Account Receivables</th>                           
                                <th>&nbsp</th>
                                <th>500.oo</th>
                                <th>&nbsp</th>
                                <th>&nbsp</th>


                            </tr>
                            <tbody>
                                <tr>
                                    <th>1060 </th>
                                    <th>Checking Account</th>                           
                                    <th>&nbsp</th>
                                    <th>&nbsp</th>
                                    <th>500</th>
                                    <th>&nbsp</th>


                                </tr>
                                <tr>
                                    <th colspan="2">Total </th>

                                    <th>&nbsp</th>
                                    <th>500</th>
                                    <th>500</th>
                                    <th>&nbsp</th>


                                </tr>

                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
