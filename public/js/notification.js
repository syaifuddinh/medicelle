$(document).ready(function(){
	var getUnreadNotifAmount = function() {
		var url = baseUrl + '/controller/user/notification/unread'
		var method = 'get'
		$.ajax({
            'url':url,
            'type' : method,
            success:function(data) {
              var unread_notif_amount = parseInt(data)
              var prev_unread_notif_amount = parseInt(localStorage.getItem('unread_notif_amount'))
              if(unread_notif_amount != prev_unread_notif_amount) {
                  localStorage.setItem('unread_notif_amount', unread_notif_amount)
                  toastr.info('Anda memiliki ' + unread_notif_amount + ' pemberitahuan yang belum dibaca', 'Pemberitahuan', {
                      onclick : function() {
                          window.location = baseUrl + '/notification'
                      }
                  })
              }
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
			li = $('<li class="notif-item"><a href="#" onclick="readNotif(' + detail.id + ')"></a></li>')
			title = $('<span><b>' + detail.title + '</b></span>')
			description = $('<span class="message">' + detail.description + '</span>')
			li.find('a').append(title)
			li.find('a').append(description)
			notif_container.prepend(li)
		}
	}

  readNotif = function(notif_id) {
        $.ajax({
            'url':baseUrl + '/controller/user/notification/' + notif_id,
            'type' : 'get',
            success:function(data) {
              var resp =  data
              location.href = resp.route_link
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

	getUnreadNotifAmount()
	setInterval(function(){
		getUnreadNotifAmount()
	}, 30000)
})