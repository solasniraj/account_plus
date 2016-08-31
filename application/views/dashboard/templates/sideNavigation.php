<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <h1><a href="<?php echo base_url(); ?>">Account <span>Plus</span></a></h1>
    </div>
    <div class=" active logo-icon text-center">
        <a href="<?php echo base_url() . 'dashboard'; ?>"><i class="lnr lnr-home"></i> </a>
    </div>

    <!--logo and iconic logo end-->
    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="menu-list"><a href="#"><i class="lnr lnr-pie-chart"></i><span>Daily Transaction</span></a>
                <ul class="sub-menu-list">
                    <li><a href="#">Cash Receipt</a> </li>
                    <li><a href="<?php echo base_url() . 'transaction/journalEntry'; ?>">Journal Entry</a></li>

                </ul>
            </li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-book"></i><span>Bank Account</span></a>
                <ul class="sub-menu-list">
                    <li><a href="<?php echo base_url() . 'bank/addAccount'; ?>">Add Account</a> </li>
                    <li><a href="<?php echo base_url() . 'bank/index'; ?>">View Accounts</a></li>
                </ul>
            </li>

            <li><a href="#"><i class="lnr lnr-menu"></i> <span>Expendiature</span></a></li>              
            <li><a href="#"><i class="lnr lnr-pushpin"></i> <span>Liabilities</span></a></li>   
            <li class="menu-list"><a href="#"><i class="lnr lnr-spell-check"></i> <span>Account Headings</span></a>
                <ul class="sub-menu-list">
                    <li><a href="<?php echo base_url() . 'programs/addProgram' ?>">Add Account Heading</a> </li>
                    <li><a href="<?php echo base_url() . 'programs/programListing' ?>">View Account Headings</a></li>

                </ul>
            </li>
            <li><a href="<?php echo base_url() . 'chartAccount/index'; ?>"><i class="lnr lnr-paperclip"></i> <span>Chart Of Accounts</span></a></li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-briefcase"></i> <span>Donors</span></a>
                <ul class="sub-menu-list">
                    <li><a href="<?php echo base_url() . 'donars/addDonar' ?>">Add Donor</a> </li>
                    <li><a href="<?php echo base_url() . 'donars/index' ?>">View Donors</a></li>

                </ul>
            </li> 
            <li class="menu-list"><a href="#"><i class="lnr lnr-cog"></i> <span>Miscellaneous</span></a>
                <ul class="sub-menu-list">
                    <li><a href="<?php echo base_url() . 'miscelleneous/bankReconcillation'; ?>">Bank Reconcillation</a> </li>
                    <li><a href="<?php echo base_url() . 'setting/index'; ?>">Data Backup</a></li>
                    <li><a href="<?php echo base_url() . 'setting/dataRestore' ?>">Data Restore</a></li>
                </ul>
            </li>      
<!--						<li class="menu-list"><a href="#"><i class="lnr lnr-users"></i> <span>Users</span></a>  
                    <ul class="sub-menu-list">
                            <li><a href="<?php //echo base_url().'user/addUser'  ?>">Add Users</a> </li>
                            <li><a href="<?php //echo base_url().'user/userListing'  ?>">View Users</a></li>
                            
                    </ul>
            </li>-->
            <li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i> <span>Reports</span></a>
                <ul class="sub-menu-list">
                    <li><a href="<?php echo base_url() . 'reports/index' ?>">Summary</a> </li>
                    <li><a href="<?php echo base_url() . 'reports/bankCashBook' ?>">Bank Cash Book</a></li>
                    <li><a href="<?php echo base_url() . 'reports/trialBalance' ?>">Trial Balance</a></li>
                    <li><a href="<?php echo base_url() . 'reports/trialBalance' ?>">Receipt and Payment Account</a></li>
                    <li><a href="<?php echo base_url() . 'reports/pLAccount' ?>">Income and Expenditure Account</a></li>
                    <li><a href="<?php echo base_url() . 'reports/balanceSheet' ?>">Balance Sheet</a></li>
                    <li><a href="<?php echo base_url() . 'reports/monthlyStatement' ?>">Monthly Statement</a></li>
                    <li><a href="<?php echo base_url() . 'reports/dayBook' ?>">Day Book</a></li>

                </ul>
            </li>
            <li><a href="<?php echo base_url() . 'documentation/index' ?>"><i class="lnr lnr-file-empty"></i> <span>Help</span></a></li>

        </ul>
        <!--sidebar nav end-->
    </div>
</div>
<!-- left side end-->