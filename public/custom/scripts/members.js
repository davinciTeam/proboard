$(document).ready(function(){
	var page = 1;
	var searchParamaters = 
	{
		'name': 'ASC',
		'insertion': 'ASC',
		'lastname': 'ASC',
		'ovnumber': 'ASC',
	};

	function generateHtml(result) {
		var html = "";
	
		for (var i = 0; i < 10; i++) {
			if (!result[i]) break;
			html += "\
			<tr>\
				<td>"+result[i].ovnumber+"</td>\
				<td>"+result[i].name+"</td>\
				<td>"+result[i].insertion+"</td>\
				<td>"+result[i].lastname+"</td>\
				<td><a href=\"/members/editMember/" + result[i].slug +'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
			if (result[i].active == '1') {
				html += "<td><i class='fa fa-circle green-text' aria-hidden='true'></i></td>"
			} else {
				html += "<td><i class='fa fa-circle red-text' aria-hidden='true'></td>"
			}
			html += "</tr>";
		}
		$('#members').empty().append(html)
	}

    $(".sorting").click(function(){
        $(this).toggleClass("glyphicon-arrow-up").toggleClass("glyphicon-arrow-down");
    
    	if (searchParamaters[$(this).attr('id')] === 'ASC') {
    		searchParamaters[$(this).attr('id')] = 'DESC'
		} else {
			searchParamaters[$(this).attr('id')] = 'ASC'
		}
    	$.ajax({
			url: "/members/overview/0/true",
			data: {
				field: $(this).attr('id'),
				search: searchParamaters[$(this).attr('id')]
			},
			method: 'POST',
			success: function( result ) {
				generateHtml(result);
			},
			fail :function() {
				alert('Controlleer u internet verbiniding');
			}
		});
    });

    $(".navigation-js").click(function(e){

        e.preventDefault();

        var page = $(this).children();
        page = ($(page['0']).attr('data-ci-pagination-page')-1)*10;

        $('.active').removeClass('active');
        $(this).addClass('active');
        window.history.pushState({}, 'Project-beheer', 'http://project-beheer/members/overview/'+page)

        $.ajax({
			url: "/members/overview/"+page+"/true",
			method: 'POST',
			success: function( result ) {
				generateHtml(result);
			},
			fail :function() {
				alert('Controlleer u internet verbiniding');
			}
		});
    });
});