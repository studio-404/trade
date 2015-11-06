<header>
	<div class="center">
		<div class="navigation">
			<div class="logo">
				<a href="javascript:;">
					CMS 1.0.1
				</a>
			</div>

			<nav>
				<ul>
					<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=welcome" : "javascript:;"?>"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
					<li><a href="javascript:;"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Pages</a>
						<ul>
							<?php
							if(isset($_SESSION["user404"]) && !empty($_SESSION["user404"])){
								echo $data["managed_pages"];
							}
							?>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=menuManagment" : "javascript:;"?>">Page managment</a></li>
						</ul>
					</li>
					<li><a href="javascript:;"><i class="fa fa-cube"></i>&nbsp;&nbsp;&nbsp;Modules</a>
						<ul>
							<li><a href="?action=vectormap">Trade map</a></li>
							<li><a href="?action=fusersstat">Front users & statements</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=charts" : "javascript:;"?>">Google charts</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=emailnewsletter" : "javascript:;"?>">Email newsletter</a></li>
							
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=managedemails&token=".$_SESSION["token"] : "javascript:;"?>"><i class="fa fa-minus"></i> Manage email groups</a></li>
							<!-- <li><a href="?action=invoices">Invoices</a></li> -->
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=catalogMoreInfo" : "javascript:;"?>">Catalog more info</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=components" : "javascript:;"?>">Components</a></li>
							<?php
							foreach ($data["components"] as $v) {
							?>	
							 <li><a href="<?=(isset($_SESSION["user404"])) ? "?action=componentModule&id=".$v["id"]."&token=".$_SESSION["token"] : "javascript:;"?>"><i class="fa fa-minus"></i> <?=$v["name"]?></a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<li><a href="javascript:;"><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;Users</a>
						<ul>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=wuserList" : "javascript:;"?>">Website users</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=userList" : "javascript:;"?>">Admin users</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=userRights" : "javascript:;"?>">User right groups .??</a></li>
						</ul>
					</li>
					<li><a href="javascript:;"><i class="fa fa-cogs"></i>&nbsp;&nbsp;&nbsp;Settings</a>
						<ul>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=filemanager" : "javascript:;"?>">File manager</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=languages" : "javascript:;"?>">Languages</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=languageData" : "javascript:;"?>"><i class="fa fa-minus"></i> Languages data</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=websiteSettings" : "javascript:;"?>">Website settings</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=exelator" : "javascript:;"?>">Exelator</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=textConverter" : "javascript:;"?>">Text converter</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=log" : "javascript:;"?>">Log</a></li>
							<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=backup" : "javascript:;"?>">Backup</a></li>							
						</ul>
					</li>
					<?php 
					if(isset($_SESSION["user404"]) && !empty($_SESSION["user404"])){
					?>
					<li><a href="javascript:;"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;&nbsp;Profile</a>
						<ul>							
							<li><a href="<?=(isset($_SESSION["user404"]) && !empty($_SESSION["user404"])) ? "?action=profileSettings" : "javascript:;"?>">Profile settings</a></li>
							<li><a href="<?=(isset($_SESSION["user404"]) && !empty($_SESSION["user404"])) ? "?action=changePassword" : "javascript:;"?>">Change password</a></li>				
						</ul>
					</li>
					<li><a href="<?=(isset($_SESSION["user404"])) ? "?action=signout" : "javascript:;"?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Sign out</a></li>	
					<?php
					}
					?>
				</ul>
			</nav>
		</div>
	</div>
</header>