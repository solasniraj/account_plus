  <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
                            <h1><a href="<?php echo base_url(); ?>">Account <span>Plus</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="<?php echo base_url().'dashboard'; ?>"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class="active"><a href="<?php echo base_url().'transaction'; ?>"><i class="lnr lnr-power-switch"></i><span>Daily Transaction</span></a></li>
						<li class="menu-list"><a href="#"><i class="lnr lnr-cog"></i><span>Ledger</span></a></li>
						<li><a href="#"><i class="lnr lnr-spell-check"></i> <span>Income</span></a></li>
						<li><a href="#"><i class="lnr lnr-menu"></i> <span>Expendiature</span></a></li>              
                                                <li><a href="#"><i class="lnr lnr-menu"></i> <span>Liabilities</span></a></li>   
                                                <li class="menu-list"><a href="#"><i class="lnr lnr-menu"></i> <span>Programs</span></a>
                                                <ul class="sub-menu-list">
								<li><a href="<?php echo base_url().'programs/addProgram' ?>">Add Programs</a> </li>
								<li><a href="<?php echo base_url().'programs/programListing' ?>">View Programs</a></li>
								
							</ul>
                                                </li>              
						<li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>Miscelleneous</span></a></li>      
						<li class="menu-list"><a href="#"><i class="lnr lnr-indent-increase"></i> <span>Users</span></a>  
							<ul class="sub-menu-list">
								<li><a href="<?php echo base_url().'user/addUser' ?>">Add Users</a> </li>
								<li><a href="<?php echo base_url().'user/userListing' ?>">View Users</a></li>
								
							</ul>
						</li>
						<li class="menu-list"><a href="#"><i class="lnr lnr-pencil"></i> <span>Reports</span></a>
                                                <ul class="sub-menu-list">
								<li><a href="<?php echo base_url().'reports/index' ?>">Summary</a> </li>
								<li><a href="<?php echo base_url().'reports/bankCashBook' ?>">Bank Cash Book</a></li>
                                                                <li><a href="<?php echo base_url().'reports/trialBalance' ?>">Trial Balance</a></li>
                                                                <li><a href="<?php echo base_url().'reports/pLAccount' ?>">PL Account</a></li>
                                                                <li><a href="<?php echo base_url().'reports/balanceSheet' ?>">Balance Sheet</a></li>
                                                                <li><a href="<?php echo base_url().'reports/monthlyStatement' ?>">Monthly Statement</a></li>
                                                                <li><a href="<?php echo base_url().'reports/dayBook' ?>">Day Book</a></li>
								
							</ul>
                                                    </li>
						<li><a href="<?php echo base_url().'documentation/index' ?>"><i class="lnr lnr-select"></i> <span>Help</span></a></li>
						
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->