var data_array;

function product(id, link) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
			data_array = result;
            for (var i in result) {
                items.push(get_product_html(result[i],i > 7));
			}
            $("#" + id).html(items.join("\r\n"));
			$("#" + id + "_page").html(genere_page( Math.ceil(result.length / 8)).join("\r\n"));
        },
        error: function (request, textStatus, errorThrown) {
        },
        complete: function (request, textStatus) {
        }
    });
}

function genere_page(length){
	var page=[];
	page.push("<li><a href=\"#\">Previous</a></li>");
	for(var i = 0; i < length;i++)
		page.push("<li><a href=\"#\" type:\"button\" onclick=\"on_page(" + (i + 1) + ")\">" + (i + 1) +"</a></li>");
	page.push("<li><a href=\"#\">Next</a></li>");
	return 	page;
}


function on_page(page){
	console.log("PAGE " + page);
	
	var tmp = $("#general")[0].childNodes;
	var all = [];
	for(var i in tmp)
		if(!tmp[i].length)
			all.push(tmp[i]);
	
	for(var i = 0; i < all.length;i++){
		if(i >= ((page - 1) * 8) && (i < (page * 8))){
			all[i].id = "";
		}else{
			all[i].id = "hide";
		}
	}
}




function get_filter(id, link) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
			data_array = result;
            for (var i in result) {
                console.log(result[i]);
                items.push(get_product_html(result[i],i > 7));
            }
            $("#" + id).html(items.join("\r\n"));
			$("#" + id + "_page").html(genere_page( Math.ceil(result.length / 8)).join("\r\n"));

        },
        error: function (request, textStatus, errorThrown) {
        },
        complete: function (request, textStatus) {
        }
    });
}


function match(input, str){
    for(var i in str){
        if(input.toLowerCase().indexOf(str[i]) < 0)
            return false;
    }
    return true;
}


function prcess_string(str){
    str_ = [];
    str = str.toLowerCase();
    var str = str.split(" ").sort();
    for(var i in str){
        if(str[i] != "")
            str_.push(str[i]);
    }
    return str_;
}


function get_filter_search(id, link,search) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
			data_array = result;
			var idx = 0;
            for (var i in result) {
				if(match( JSON.stringify(result[i]),prcess_string(search))   ){
					items.push(get_product_html(result[i],idx++ > 7));
				}
            }
            $("#" + id).html(items.join("\r\n"));
			$("#" + id + "_page").html(genere_page( Math.ceil(items.length / 8)).join("\r\n"));
        },
        error: function (request, textStatus, errorThrown) {
        },
        complete: function (request, textStatus) {
        }
    });
}

function get_img_link(ob){
	return "upload/" + ob.manufactorID.trim() + "/" + ob.id.trim() + ".png"
}


function get_product_html(ob,hide) {
	var add = "";
	if(hide)
		add = " id=\"hide\"";
		
    return "<li class=\"panel panel-default box_product\" " + add +">"
        + "<div class=\"panel-body  text-center\">"
        + "<img class=\"product_image\"    src=\"" + get_img_link(ob) + "\"> " + "<br><br>"
        + "<div class=\"text-muted text-inbox\">"
        + "Giá bán : " + ob.price + "000&nbsp;vnđ"
        + "<br>" + ob.name + "<br>"
        + "</div>"
        + "<button type=\"button\" class=\"btn btn-primary \" onclick = \"on_view_product(\'"+ob.id +"\')\">Chi tiết</button>"
        + "</div>"
        + "</li>";
}


function manufacter(id, link) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
            for (var i in result) {
                items.push("<li onclick=\"on_nav('" + (id + "=" + result[i].id) + "')\"><a href=\"#\">" + result[i].name + "</a></li>");
            }
            $("#" + id).html(items.join("\r\n"));
        },
        error: function (request, textStatus, errorThrown) {
            console.log(errorThrown);
        },
        complete: function (request, textStatus) {
        }
    });
}

function cagetory(id, link) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
            for (var i in result) {
                items.push("<li onclick=\"on_nav('" + (id + "=" + result[i].id) + "')\"><a href=\"#\">" + result[i].name + "</a></li>");
            }
            $("#" + id).html(items.join("\r\n"));
        },
        error: function (request, textStatus, errorThrown) {
            console.log(errorThrown);
        },
        complete: function (request, textStatus) {
        }
    });
}


function get_select(id, link) {
    $.ajax({
        url: link,
        dataType: 'json',
        success: function (result) {
            var items = [];
            for (var i in result) {
                items.push("<option value=\"" + result[i].id + "\">" + result[i].name + "</option>");
            }
            $("#" + id).html(items.join("\r\n"));
        },
        error: function (request, textStatus, errorThrown) {
            console.log(errorThrown);
        },
        complete: function (request, textStatus) {
        }
    });
}