$(document).ready(function(){
	var getUnreadNotifAmount = function() {
		var url = baseUrl + '/controller/user/notification/unread'
		var method = 'get'
		$.ajax({
            'url':url,
            'type' : method,
            success:function(data) {
              $('#unread-notif-qty').text(data)
              getUnreadNotif()
            },
            error : function(xhr) {
             	 var resp = JSON.parse(xhr.responseText);
                if (xhr.status==422) {
                  var det="";
                  angular.forEach(resp.errors,function(val,i) {
                    det+="- "+val+"<br>";
                  });
                  toastr.warning(det,resp.message);
                } else {

                   toastr.error(resp.message,"Error Has Found !");
                }
            }
          });
	}

	var getUnreadNotif = function() {
		var url = baseUrl + '/controller/user/notification'
		var method = 'get'
		$.ajax({
            'url':url,
            'type' : method,
            'data' : {
            	limit : 5
            },
            success:function(data) {
              renderUnreadNotif(data)
            },
            error : function(xhr) {
             	 var resp = JSON.parse(xhr.responseText);
                if (xhr.status==422) {
                  var det="";
                  angular.forEach(resp.errors,function(val,i) {
                    det+="- "+val+"<br>";
                  });
                  toastr.warning(det,resp.message);
                } else {

                   toastr.error(resp.message,"Error Has Found !");
                }
            }
          });
	}

	var renderUnreadNotif = function(details) {
		var detail, li, title, description
		var notif_container = $('#notif-container')
		$('.notif-item').remove()
		for(x in details) {
			detail = details[x]
			li = $('<li class="notif-item"><a href="{{ ' + detail.route + ' }}"></a></li>')
			title = $('<span><b>' + detail.title + '</b></span>')
			description = $('<span class="message">' + detail.description + '</span>')
			li.find('a').append(title)
			li.find('a').append(description)
			notif_container.prepend(li)
		}
	}

	getUnreadNotifAmount()
	setInterval(function(){
		getUnreadNotifAmount()
	}, 30000)
})