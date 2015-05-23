<?php session_start();?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title" style="color: blue;">
            <strong>
                Thông số kỹ thuật sản phẩm
            </strong>
        </h3>
    </div>
	
    <div class="panel-body">
        <button type="button" class="btn btn-info" onclick="on_view_product_back()">__ Trở lại __</button>
        <h2 id="product_name"></h2>

        <p id="product_review"></p>
		<div class="container">
            <h4>Đặt hàng</h4>
            <!-- Trigger the modal with a button -->
            <?php if(isset($_SESSION['login'])) : ?>

                <button style="border-top-left-radius: 26px; border-bottom-left-radius: 26px;border-bottom-right-radius: 26px; border-top-right-radius: 26px;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">+</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Đặt hàng</h4>
                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal" name='registration' onsubmit=" return formValidation(); ">



                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-4">
                                            <h2> Đặt hàng </h2>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-4 control-label">Địa chỉ</label>
                                        <div class="col-sm-4">
                                            <textarea rows="4" cols="50" name="addr" type="text" class="form-control" id="addr">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-4 control-label">Thời gian</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control" name="date" id="inputPassword4" placeholder="Thời gian" value="2015-04-09">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-4 control-label">Số lượng</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Số lượng">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Chọn đặt hàng</label>
                                        <div class="col-sm-2">
                                            <input type="button" class="btn btn-primary" value="Đặt hàng" onclick=" on_oder(); "/>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="reset" class="btn btn-danger" data-dismiss="modal" value="Hủy">
                                        </div>
                                        <script>
                                            function on_oder(){
                                                $.ajax({
                                                    url: "oder/oder.php",
                                                    type: 'GET',
                                                    data: $(".form-horizontal").serialize() + "&proid=" + product_id + "&oder",
                                                    success: function (result) {
                                                        if(result[0] == "DONE"){
                                                            $("#oder_messege").html("Đặt hàng thành công");
                                                            window.setTimeout(function(){
                                                                $('#myModal').modal('hide');
                                                            },1000);
                                                        }else{
                                                            $("#oder_messege").html("Có lỗi xãy ra, vui lòng thử lại sau");
                                                        }
                                                    }
                                                });
                                            }
                                        </script>

                                    </div>

                                    <div class="form-group" id="oder_messege">

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>



            <?php endif; ?>


        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Mô tả</th>
                <th>Chi tiết</th>
            </tr>
            </thead>
            <tbody id="product_detail">

            </tbody>
        </table>


       

    </div>
</div>


<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:blue;"></h3>

        <h2>Bình luận về sản phẩm</h2>
		
		<p><img src="user.png" style="width:30px; height:30px;"> <Strong> Phuong - hoangphuongkg93@gmail.com: </Strong><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Sản phẩm của shop tuyệt vời ông mặt trời - <font size="1" color="#909090">10:00 pm - 22/05/2015</font></p>
		
		<p><img src="user.png" style="width:30px; height:30px;"> <Strong> Thuc - thucbede@bedechua.com: </Strong><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Mình thích sản phẩm của shop lắm.hí.hí  đồ quỷ xứ à <font size="1" color="#909090">- 10:00 pm - 22/05/2015</font></p>

        <p>Hãy nhập họ tên và email để gửi bình luận</p>

        <form role="form">
            <div class="form-group">
                <label for="name" id="name">Họ tên</label>
                <input type="text" class="form-control" id="name" placeholder="Họ và tên" required="">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Điền email" required="">
                <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" id="comment" placeholder="Hãy viết gì đó..." required=""></textarea>
                <button type="submit" class="btn btn-default" onClick="alert('Bình luận bạn đã được gửi và đang chờ duyệt')">Gửi bình luận</button>
            </div>
        </form>

          
    </div>
</div>

