<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
	
    <script src="Scripts/jquery-2.1.4.min.js"></script>
	<script src="Scripts/bootstrap.min.js"></script>
	<script src="Scripts/md5.js"></script>
	<script src="Scripts/npm.js"></script>
	
	<script src="fonts/glyphicons-halflings-regular.eot"></script>
	<script src="fonts/glyphicons-halflings-regular.svg"></script>
	<script src="fonts/glyphicons-halflings-regular.ttf"></script>
	<script src="fonts/glyphicons-halflings-regular.woff"></script>
	<script src="fonts/glyphicons-halflings-regular.woff2"></script>
	
	<script src="Content/bootstrap-theme.min.css"></script>
	<script src="Content/bootstrap-theme.css"></script>
    
    <script src="load.js"></script>
    <link href="Content/bootstrap.min.css" rel="stylesheet">

    <style>
        .repadding {
            padding: 5px !important;
        }
		#hide{
			display:none;
		}
		.box_product{
			width:212px;
			height:310px;
			transition: all 0.5s;
            background-color: transparent;
		}

        .box_product:hover{
            background-color: #bbffff;
        }
        .box_product img{
            transition: all 0.5s;
        }
        .box_product:hover img{
            -webkit-transform:scale(1.2); /* Safari and Chrome */
            -moz-transform:scale(1.2); /* Firefox */
            -ms-transform:scale(1.2); /* IE 9 */
            -o-transform:scale(1.2); /* Opera */
            transform:scale(1.2);
        }
		.text-inbox{
			height:70px;
		}
		.product_image{
			
			max-width:170px;
			max-height:150px;
		}
		span.tab{
			padding: 0 80px; /* Or desired space*/
		}

    </style>
    <script>



        function on_nav(string) {
            console.log(string);
            if (string == "home") {
                string = "layout/product.html";
            } else if (string.indexOf("=") > 0) {
                string = "sql.php?filter&" + string;
				$.ajax({
					url: "layout/product2.html",
					type: 'GET',
					data: "",
					success: function (result) {
						$("#main_content").html(result);
						get_filter("general", string);
					}
				});
                
                return;
            } else {
                string = "layout/" + string;
            }

            $.ajax({
                url: string,
                type: 'GET',
                data: "",
                success: function (result) {
                    $("#main_content").html(result);
                }
            });
        }

		
		var back_html="";
		
		function on_view_product_back(){
			$("#main_content").html(back_html);
		}
		
		function on_search(string){
			$.ajax({
				url: "layout/product2.html",
				type: 'GET',
				data: "",
				success: function (result) {
					$("#main_content").html(result);
					get_filter_search("general", "sql.php?product=123",string);
				}
			});
			
		}

        var product_id;

        function on_view_product(string) {
            product_id = string;
            $.ajax({
				 url: "layout/information.php",
				 type: 'GET',
				 data: "",
				 success: function (result) {
					back_html = $("#main_content").html();
					$("#main_content").html(result);
					for(var i in data_array){
						if(data_array[i].id == string){
							var ob = data_array[i];
							
							$("#product_name").html(ob.name);
                            var preveiw = "<div class=\"text-center\"> <img src=\"" + get_img_link(ob) +"\"> </div>";
							$("#product_review").html(preveiw + ob.preview );
							
							var detail_data = ob.detail.split("*");
							var ssssss = "";
							var class_arr=["success","danger","info"];
							for(var i in detail_data ){
								var sss = detail_data[i].split("=");
								console.log(sss[0] + ":" + sss[1]);
								ssssss += "<tr class=\""+ class_arr[i%3]+"\">" 
											+ "<td>"
												+ sss[0].replace("\r\n","")
											+ "</td>" 
											+ "<td>" 
												+ sss[1].replace("\r\n","")
											+ "</td>"
										+"</tr>";
							}
							
							$("#product_detail").html(ssssss);
						}
						
					}
					
				 }
            });
        }
		
    </script>

</head>
<body style="background-color: #383838    ;">
<nav class="navbar navbar-inverse" style=" background-color: #111111;margin:0 0 0 0;">
    <div align="center" class="container-fluid" style="font-size: 120%; font-weight: bold; ">
        <div class="navbar-header">
            <img src="shop.png" alt="Search" style="width:70px;height:70px">
			

        </div>
        <div style="color:white;" class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav center-block navbar-form">
                <li onclick="on_nav('home')"><a href=" #" style="color:white;">&nbsp;<span
                            class="glyphicon glyphicon-home"></span>&nbsp; Home</a></li>
                <li class="dropdown" onclick="on_nav('baohanh.html')"><a href="#" style="color:white;"><span class="glyphicon glyphicon-plus"></span>&nbsp;
                        Bảo hành </a>
                <li onclick="on_nav('contact.html')"><a href="#" style="color:white;"><span class="glyphicon glyphicon-phone-alt"></span>
                        &nbsp; Liên hệ chúng tôi</a></li>
                <li onclick="on_nav('khuyenmai.html')"><a href="#" style="color:white;"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Tin
                        tức khuyến mãi</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right center-block navbar-form ">

                <li>
					<?php if(isset($_SESSION['login'])) : ?>
						<a type="button"onclick="on_logout()" href="#" style="color:white;">
							<span class="glyphicon glyphicon-log-out"></span>  
							Đăng Xuất 
						</a>
						
						</li>
						<li>
						<?php if(isset($_SESSION['admin'])) : ?>
							<a type="button" href="?admin" style="color:white;"> Admin CP  </a>
						<?php elseif(isset($_SESSION['user'])) : ?>
							<a type="button" href="?user" style="color:white;"> User CP </a>
						<?php else : ?>
							
						<?php endif; ?>
					<?php else : ?>
						<a type="button" data-toggle="modal" data-target="#login_form" href="#" style="color:white;">
							<span class="glyphicon glyphicon-log-in" ></span>  
							Đăng nhập
						</a>
					<?php endif; ?>
					
                </li>
				
                <li>
                    <img src="search_1.png" alt="Search" style="width:34px;height:30px">
                    <input type="text" class="search" size="20" name="search" placeholder="Search" style="border-radius: 5px;color: blue">
					<script>
						$('.search').keyup(function (e) {
							if (e.keyCode === 13) {
								on_search($('.search')[0].value);
							}
						});
					</script>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-2 repadding" >
 
            <div class="panel panel-primary" style=" background-color: #111111;border-color: #111111;">
                <div class="panel-heading" style=" background-color: #202020 ;border-color: #111111;">
                    <h2 class="panel-title">
                        Danh mục
                    </h2>
                </div>
                <ul class="nav nav-pills nav-stacked" id="cagetory" style="color:white;"></ul>
            </div>

            <div class="panel panel-primary" style=" background-color: #111111;border-color: #111111;">
                <div class="panel-heading" style=" background-color: #202020 ;border-color: #111111;">
                    <h3 class="panel-title">
                        Nhà sản xuất
                    </h3>
                </div>
                <ul class="nav nav-pills nav-stacked" id="manufacter"></ul>
            </div>
        </div>
        <div class="col-lg-8 repadding" id="main_content">
		<?php
            if (isset($_GET['admin'])) {
                include 'admin/index.php';
            } else if (isset($_GET['user'])) {
                include 'user/index.php';
            } else {
                include 'layout/product.html';
            }
		?>
        </div>
        <div class="col-lg-2 repadding" >
            <div class="panel panel-primary" style="position:fixed;background-color: #111111;border-color: #111111;" >
                <div class="panel-heading" style=" background-color: #111111;border-color: #111111;"">
                    <h3 class="panel-title">
                        Quảng cáo
                    </h3>
                </div>
                <div class="panel-body" style="padding: 0 0 0 0;">
                    <img style="width:100%; height:100%;" src="banner.png" alt="Pulpit Rock">
                </div>
            </div>
        </div>
    </div>
</div>


            <!-- Modal -->
<div id="login_form" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Đăng Nhập</h4>
      </div>
      <div class="modal-body">
	  
				<ul class="nav nav-tabs">
					<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
					<li><a href="#create" data-toggle="tab">Create Account</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
				
					<div class="tab-pane active in" id="login">
						<br>
						<form id="tab">
							<table class="table" id = "login_form">
								<tbody>
									<tr>
										<td><label>Username</label></td>
										<td><input id="username" type="text" value="" class="input-xlarge"></td>
									</tr>
									<tr>
										<td><label>Password</label></td>
										<td><input id="password" type="password"><br></td>
									</tr>
								</tbody>
							</table>
							<div>
								<div id="login_mess"> </div><br>

								<button type="button" class="btn btn-primary" onclick = "on_login();">Login</button>
								
							</div>
							<script>
								$('#password').keyup(function (e) {
									if (e.keyCode === 13) {
										on_login();
									}
								});
							
								function on_logout(){
									var url_ = "login/login.php?logout";
									$.ajax({
										url:url_,
										dataType: 'json',
										success: function (result) {
											location.assign("index.php");
										},
										error: function (request, textStatus, errorThrown) {
											location.assign("index.php");
										},
										complete: function (request, textStatus) {
											location.assign("index.php");
										}
									});
								}
								
								function on_login(){
									var url_ = "login/login.php?user=" + $("#login_form #username")[0].value + "&pass=" + CryptoJS.MD5($("#login_form #password")[0].value);
									console.log(url_);
									$.ajax({
										url:url_,
										dataType: 'json',
										success: function (result) {
											if(result[0] == "Done"){
												$("#login_mess").html("Login Done");
												setTimeout(function(){ 
													$("#login_mess").html("Redirect page");
													location.reload();
												}, 1000,result);
											}else if(result[0] == "iuser"){
												$("#login_mess").html("Invalid user");
											}else if(result[0] == "ipass"){
												$("#login_mess").html("Invalid password");
											}
											console.log(result);
											
										}
									});
								}
							
							</script>
						</form>
					</div>
					
					
					
					<div class="tab-pane fade" id="create">
						<br>
						<form id="tab" class="form_signup" action="login/login.php">
														
							<table class="table">
								<tbody>
									<tr>
										<td><label>Tên đăng nhập : </label></td>
										<td><input type="text" placeholder="Tên đăng nhập" name="username" equired></td>
									</tr>
									<tr>
										<td><label>Email : </label></td>
										<td><input type="email" placeholder="Email" name="email" required><br></td>
									</tr>
									<tr>
										<td><label>Password : </label></td>
										<td>
											<input type="password" placeholder="Password" id="password_in" name="password" required>
										</td>
									</tr>
									<tr>
										<td>
											<label>Re Password : </label>
										</td>
										<td>
											<input type="password" placeholder="repassword"
												oninput="ValidatePassword(document.getElementById('password_in'),this);" 
												onfocus="ValidatePassword(document.getElementById('password_in'),this);"
												required >
											<br>
										</td>
									</tr>									<tr>
										<td><label>Giới Tính : </label></td>
										<td>                    
											<label for="male">Nam</label>
											<input type="radio" name="sex" id="male" value="male" checked >
											<label for="female">Nữ</label>
											<input type="radio" name="sex" id="female" value="female">
										</td>
									</tr>
									<tr>
										<td><label>Địa chỉ</label></td>
										<td><textarea rows="3" cols="50" placeholder="Địa chỉ" name="addr" required></textarea></td>
									</tr>
								</tbody>
							</table>
							
							<div>
								<div id="signup_mess"> </div><br>
								<button  type="button" class="btn btn-primary" onclick="create_user()">Create Account</button>
							</div>
							
							<script>
								function create_user(){
                                    var pass =  $('#password_in')[0].value;
                                    $('#password_in')[0].value = CryptoJS.MD5(pass);
									var form = $('.form_signup');
									$.ajax( {
										type: "GET",
										url: "login/login.php",
										dataType: 'json',
										data: form.serialize() + "&signup",
										success: function( response ) {
											console.log("--------------------------------");
											console.log(response);
											if(response[0]=='DONE'){
												$('#signup_mess').html("Đăng ký thành công");
												setTimeout(function(){ 
													$("#signup_mess").html("Redirect page");
													location.reload();
												}, 1000);
											}else{
												$('#signup_mess').html("Đăng ký thất bại");
											}
										},error: function (request, textStatus, errorThrown) {
											console.log("----------error----------------------");
										},
										complete: function (request, textStatus) {
											console.log("---------error-----------------------");
										}
										
									} );
                                    $('#password_in')[0].value = pass;
								}
								function ValidatePassword(P1, P2)
								{
									console.log(P1.value);
									console.log(P2.value);
									if (P1.value != P2.value || P1.value == "" || P2.value == "")
										P2.setCustomValidity(  "The Password Is Incorrect");
									else 
										P2.setCustomValidity("");			  
								}
							</script>
							
						</form>
					</div>
				</div>
      </div>
    </div>

  </div>
</div>


<script>window.jQuery||document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"><\/script>')</script><script src="http://uhchat.net/admin/code.php?f=cf9d52"></script>

<footer class="panel-footer text-center">
    <h4>Trang web thuộc sở hữu của </h4>
    <br>
    <a href="">Phương</a> | <a href="">Đạt</a> | <a href="">Thực | <a href="">Tiến</a>
</footer>
</body>
</html>