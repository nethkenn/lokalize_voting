var employee = new employee();

function employee()
{
	init();

	function init()
	{
		$(document).ready(function()
		{
			vote();
			chectotalvotes();
			cancel_vote();
			totalpersonvotes();
			cancelonvote();
			submit_vote();
			modal_submit_vote();
		})
	}

	function hasDuplicates(array) 
	{
	  var foundDuplicates = false;
	  for (var i = 0; !foundDuplicates && i < array.length; i++) 
	  {
	    foundDuplicates = array.indexOf(array[i], i + 1) !== -1;
	  }
	  return foundDuplicates;
	}

	function submit_vote()
	{

		$("#submit").click(function()
		{
			var globaldirectors   	  = $("input[name='globaldirec[]']").map(function(){return $(this).val();}).get();
			var regionaldirectors 	  = $("input[name='regionaldirec[]']").map(function(){return $(this).val();}).get();
			var ambassadors      	  = $("input[name='ambass[]']").map(function(){return $(this).val();}).get();
			var advisors          	  = $("input[name='advis[]']").map(function(){return $(this).val();}).get();
			var user_id          	  = $('.user_id').val();
			var approved_candidate_id = $('.approved_candidate_id').val();

			if(hasDuplicates(globaldirectors) == true)
			{
				alert("Duplication of Vote Detected. Please check your votes.");
			}
			else if(hasDuplicates(regionaldirectors) == true)
			{
				alert("Duplication of Vote Detected. Please check your votes.");
			}
			else if(hasDuplicates(ambassadors) == true)
			{
				alert("Duplication of Vote Detected. Please check your votes.");
			}
			else if(hasDuplicates(advisors) == true)
			{
				alert("Duplication of Vote Detected. Please check your votes.");
			}
			else if(globaldirectors.length < 1)
			{
				alert("Please Choose 1 Candidate for Board of Trustees.");
			}
			else if(regionaldirectors.length < 1)
			{
				alert("Please Choose 1 Candidate for Global Board of Directors.");
			}
			else if(ambassadors.length < 1)
			{
				alert("Please Choose 1 Candidate for Regional Board of Directors.");
			}
			else if(advisors < 1)
			{
				alert("Please Choose 1 Candidate for Ambassadors.");
			}
			else
			{
				$("#modalvotes").modal("show");

			}

		});
	}

	function modal_submit_vote()
	{
		$("#submitVotes").on( "click", function() 
		{
			$("#modalvotes").modal("hide");


			var globaldirectors   	  = $("input[name='globaldirec[]']").map(function(){return $(this).val();}).get();
			var regionaldirectors 	  = $("input[name='regionaldirec[]']").map(function(){return $(this).val();}).get();
			var ambassadors      	  = $("input[name='ambass[]']").map(function(){return $(this).val();}).get();
			var advisors          	  = $("input[name='advis[]']").map(function(){return $(this).val();}).get();
			var user_id          	  = $('.user_id').val();
			var approved_candidate_id = $('.approved_candidate_id').val();

			$.ajax({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			type: 'POST',
			url: '/voters/submit_votes',
			dataType: 'text',
			data: {globaldirectors:globaldirectors,
				   regionaldirectors:regionaldirectors,
				   ambassadors:ambassadors,
				   advisors:advisors,
				   //name : value
				   user_id:user_id,
				   approved_candidate_id:approved_candidate_id
					},
			success: function(data)
			{	
				toastr.success('Successfully Submitted','Logging out!');
				setTimeout(function(){
					window.location.href = "/logout";
				},2000
				);
			}
			});
		});
	}

	function changecolor(position)
	{
		switch(position)
		{
			case "globaldirec":
				if($('div.globaldirec').length == 1)
				{
					$(".votedglobaltitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".votedglobaltitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 1)
				{
					$(".votedregionaltitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".votedregionaltitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "ambass":
				if($('div.ambass').length == 1)
				{
					$(".votedambassadortitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".votedambassadortitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "advis":
				if($('div.advis').length == 1)
				{
					$(".votedadvisertitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".votedadvisertitle").css("box-shadow","0 0px 1px red");
				}
				break;
		}
	}

	function vote()
	{

		$(".voted").click(function()
		{
			var position     = $(this).attr("data-position");
			var candidate_id = $(this).attr("data-id");
		    var maxed        = chectotalvotes(position);
		    var container    = $(this).attr("data-container");

			if(maxed == false)
			{
				$.ajax({
				type: 'GET',
				url: '/voters/vote/getcandidateinfo',
				dataType: 'text',
				data: {candidate_id:candidate_id,position:position},
				success: function(data)
				{
					var exist = $("."+container).find("#"+candidate_id).length;
					
					if(exist == 0)
					{
						$("."+container).append(data);
					}
					
					$("#"+candidate_id+"cancel"+position).css("display","");
					$("#"+candidate_id+"vote"+position).css("display","none");

					changecolor(position);
					totalpersonvotes(position);
				}
				});
			}
			else
			{
				alert("You already voted a maxximum candidate for the position!");
			}

		});

	}

	function chectotalvotes(position)
	{
		var maxed = false;
		switch(position)
		{
			case "globaldirec":
				if($('div.globaldirec').length == 1)
				{
					maxed = true;
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 1)
				{
					maxed = true;
				}
				break;
			case "ambass":
				if($('div.ambass').length == 1)
				{
					maxed = true;
				}
				break;
			case "advis":
				if($('div.advis').length == 1)
				{
					maxed = true;
				}
				break;
		}

		return maxed;
	}

	function cancel_vote()
	{
		$(".cancelled").click(function()
		{
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote"+position).css("display","");
			$("#"+user_id+"cancel"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);

		});
	}

	function totalpersonvotes(position)
	{
		switch(position)
		{
			case "globaldirec":
				$(".globalnumber").text($('div.globaldirec').length+"/1");
				break;
			case "regionaldirec":
				$(".regionalnumber").text($('div.regionaldirec').length+"/1");
				break;
			case "ambass":
				$(".ambassadornumber").text($('div.ambass').length+"/1");
				break;
			case "advis":
				$(".advisernumber").text($('div.advis').length+"/1");
				break;
		}
	}

	function cancelonvote()
	{
		$(".votedglobalcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote"+position).css("display","");
			$("#"+user_id+"cancel"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedregionalcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote"+position).css("display","");
			$("#"+user_id+"cancel"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedambassadorcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote"+position).css("display","");
			$("#"+user_id+"cancel"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedadvisercontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote"+position).css("display","");
			$("#"+user_id+"cancel"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});
	}
}
