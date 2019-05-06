<template>
    <div id="middle-header">
        <div class="header-middle"><!--header-middle-->
			<div class="container" style="width: 100%;">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="themes/eshopper/images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                 <li class="dropdown">
                                        <a href="#" class="dropbtn">
                                            <i class="fa fa-shopping-cart"></i> Cart <span>(2)</span>
                                        </a>
                                        <div class="dropdown-content" style="width: 294px;left: -26px;">
                                            <div class="row" style="margin-right: 0px;margin-left: 0px;margin-top: 4px; padding-bottom: 0px; padding-top: 0px;">
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 7px;padding-right: 0px;">
                                                    <img src="themes/eshopper/images/home/product1.jpg" alt="" style="width:100%" />
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 20px;padding-right: 0px;">
                                                   <p>id</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 0px;">
                                                    <div style="color: #fff; margin-top: 7px;">
                                                        search fee: Kshs.1234
                                                    </div>
                                                </div>
                                            </div>
                                         </a>
                                         <hr style="margin-top: 3px;margin-bottom: 3px;">
                                         <div class="row" style="margin-right: 0px;margin-left: 0px;margin-bottom:5px; padding-bottom: 0px;padding-top: 0px;">
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 7px;padding-right: 0px;">
                                                    <el-button type="success" plain size="small"
                                                     class="col" title="Apply now" >Checkout</el-button>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 20px;padding-right: 0px;">
                                                    <el-button type="danger" plain size="small"
                                                      title="Apply now" >Clear</el-button>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 0px;">
                                                     <hr style="margin-top: 3px;margin-bottom: 3px;">
                                                    <div style="color: #fff; margin-top: 7px;">
                                                        Total: Kshs. 12345
                                                    </div>
                                                </div>
                                        </div>
                                        <hr style="margin-top: 3px;margin-bottom: 3px;">
                                        </div>
                                </li>
								<li><a href="#"><i class="fa fa-user"></i> Account</a></li>

								<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
    </div>
</template>

<script>
export default {
    name:"Middle-Header"
}
</script>

<style>
    .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    }

    .dropdown {
    position: relative;
    display: inline-block;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* .dropdown-content a:hover {background-color: #ddd;} */

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: #3e8e4100}
</style>
