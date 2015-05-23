<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title" style="color: blue;">
            <strong>
                Administrator Panel
            </strong>
        </h3>
    </div>
    <div class="panel-body">

        <script>
            var IDX = 0;
            $(document).ready(function () {
                manufacter("manufacter", "sql.php?manufacture=123");
                cagetory("cagetory", "sql.php?cagetory=123");
                get_select("catalog_select", "sql.php?cagetory=123");
                get_select("manufacter_select", "sql.php?manufacture=123");
                active(0);
            });

            function on_submit() {
                var aaa = [["cagetory_form", "catalog"], ["manufactor_form", "manufactor"], ["product_form", "product"], ["aaaa_form", ""]];

                $.ajax({
                    url: "database.php",
                    type: 'GET',
                    data: $("#" + aaa[IDX][0]).serialize() + "&admin&" + aaa[IDX][1],
                    success: function (result) {
                        $("#content")[0].innerHTML = result;
                    }
                });
            }

            function active(idx) {
                IDX = idx;
                var list_tab = $("#tabs li");
                for (var i in list_tab)
                    list_tab[i].className = ((i == idx) ? "active" : "");

                var list_tab_mgr = $("#tab_mgr form");
                for (var i in list_tab_mgr)
                    list_tab_mgr[i]
                    && list_tab_mgr[i].style
                    && (list_tab_mgr[i].style.display = ((i == idx) ? "" : "none"));

                $("#content")[0].innerHTML = "";
            }

            $.ajax({
                type: "GET",
                url: "oder/oder.php?get_oder",
                dataType: "json",
                success: function (msg) {
                    function ob_to_row(ob){
                        var re = "";
                        for(var i in ob)
                            re += "<td>" + i + "</td><td>" + ob[i] + "</td>";
                        return re;
                    }

                    var html = msg.map(function(ob){ return "<tr>"  +ob_to_row(ob) +  "</tr>"}).join("");
                    $("#oder_form").html("<table class='table'>" + html + "</table>");

                }
            });



        </script>

        <div class="bs-example">
            <ul class="nav nav-tabs" id="tabs">
                <li class="active"><a href="#" onclick="active(0)">CAGETORY</a></li>
                <li><a href="#" onclick="active(1)">MANUFACTOR</a></li>
                <li><a href="#" onclick="active(2)">PRODUCT</a></li>
                <li><a href="#" onclick="active(3)">ORDER LIST</a></li>
            </ul>
        </div>
        <br>

        <div id="tab_mgr">


            <form action="database.php" id="cagetory_form">
                <table class="table">
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="id" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>Catalog Name:</td>
                        <td><input type="text" name="name" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>Image link:</td>
                        <td><input type="text" name="img" width="100%"/></td>
                    </tr>
                </table>
                <br>
                <br>
                Choose to do action: <br>
                Press 1: Show <br>
                Press 2: Insert new record (not insert same data with each times, especially is not same ID) <br>
                Press 3: Update selected record <br>
                Press 4: Delete selected record, notice: delete respectively with ID (and NOTICE: not delete after <br>

                deleted) <br> <br>
                Press: <input type="text" name="Choose"/>
                <button type="button" name="submit" onclick="on_submit()"> Submit</button>
            </form>


            <form action="database.php" id="manufactor_form" display="none">
                <table class="table">
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="id" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>Manufactor Name:</td>
                        <td><input type="text" name="name" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>Image link:</td>
                        <td><input type="text" name="img" width="100%"/></td>
                    </tr>
                </table>
                <br>
                <br>
                Choose to do action: <br>
                Press 1: Show <br>
                Press 2: Insert new record (not insert same data with each times, especially is not same ID) <br>
                Press 3: Update selected record <br>
                Press 4: Delete selected record, notice: delete respectively with ID (and NOTICE: not delete after
                deleted) <br> <br>
                Press: <input type="text" name="Choose"/>
                <button type="button" name="submit" onclick="on_submit()"> Submit</button>
            </form>


            <form action="database.php" id="product_form" display="none">
                <table class="table">
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="Id" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>CatalogID:</td>
                        <td>
                            <select id="catalog_select" name="CatalogID" width="100%"> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>ManufactureID:</td>
                        <td>
                            <select id="manufacter_select" name="manufactorID"> </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="Name"/></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" name="Price"/></td>
                    </tr>
                    <tr>
                        <td>Quatity:</td>
                        <td><input type="text" name="quatity"/></td>
                    </tr>
                    <tr>
                        <td>Preview:</td>
						<td><textarea rows="10" cols="50" name="preview"> </textarea></td>
                    </tr>
                    <tr>
                        <td>Detail:</td>
                        <td><textarea rows="10" cols="50" name="detail"> </textarea></td>
                    </tr>
                </table>
                <br>
                <br>
                Choose to do action: <br>
                Press 1: Show <br>
                Press 2: Insert new record (not insert same data with each times, especially is not same ID) <br>
                Press 3: Update selected record <br>
                Press 4: Delete selected record, notice: delete respectively with ID (and NOTICE: not delete after <br>
				Press 5: Update datailed of product <br>
                deleted) <br> <br>
                Press: <input type="text" name="Choose"/>
                <button type="button" name="submit" onclick="on_submit()"> Submit</button>
            </form>


            <form action="database.php" id="oder_form" display="none">
                <table class="table">
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="id" width="100%"/></td>
                    </tr>
                    <tr>
                        <td>Catalog Name:</td>
                        <td><input type="text" name="name" width="100%"/></td>
                    </tr>
                </table>
                <br>
                <br>
                Choose to do action: <br>
                Press 1: Show <br>
                Press 2: Insert new record (not insert same data with each times, especially is not same ID) <br>
                Press 3: Update selected record <br>
                Press 4: Delete selected record, notice: delete respectively with ID (and NOTICE: not delete after
                deleted) <br> <br>
                Press: <input type="text" name="Choose"/>
                <button type="button" name="submit" onclick="on_submit()"> Submit</button>
            </form>


        </div>

        <div id="content">

        </div>


    </div>


</div>