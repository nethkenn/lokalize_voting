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
			var globaldirectors   = $("input[name='globaldirec[]']").map(function(){return $(this).val();}).get();
			var regionaldirectors = $("input[name='regionaldirec[]']").map(function(){return $(this).val();}).get();
			var ambassadors       = $("input[name='ambass[]']").map(function(){return $(this).val();}).get();
			var advisors          = $("input[name='advis[]']").map(function(){return $(this).val();}).get();

			if(hasDuplicates(globaldirectors) == true)
			{
				alert("may kaparehas sa global directors wag kang madaya");
			}
			else if(hasDuplicates(regionaldirectors) == true)
			{
				alert("may kaparehas sa global directors wag kang madaya");
			}
			else if(hasDuplicates(ambassadors) == true)
			{
				alert("may kaparehas sa ambassadors wag kang madaya");
			}
			else if(hasDuplicates(advisors) == true)
			{
				alert("may kaparehas sa advisor wag kang madaya");
			}
			else if(globaldirectors.length < 3)
			{
				alert("3 iboboto mo sa global directors tulok");
			}
			else if(regionaldirectors.length < 10)
			{
				alert("10 iboboto mo sa regional directors tulok");
			}
			else if(ambassadors.length < 5)
			{
				alert("5 iboboto mo sa ambassadors tulok");
			}
			else if(advisors < 20)
			{
				alert("20 iboboto mo sa advisor tulok");
			}
			else
			{


				$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'POST',
				url: '/employee/submit_votes',
				dataType: 'text',
				data: {globaldirectors:globaldirectors,
					   regionaldirectors:regionaldirectors,
					   ambassadors:ambassadors,
					   advisors:advisors
						},
				success: function(data)
				{
			
				}
				});
			}

		});
	}

	function changecolor(position)
	{
		switch(position)
		{
			case "globaldirec":
				if($('div.globaldirec').length == 3)
				{
					$(".votedglobaltitle").css("box-shadow","0 0px 20px green");
				}
				else
				{
					$(".votedglobaltitle").css("box-shadow","0 0px 20px red");
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 10)
				{
					$(".votedregionaltitle").css("box-shadow","0 0px 20px green");
				}
				else
				{
					$(".votedregionaltitle").css("box-shadow","0 0px 20px red");
				}
				break;
			case "ambass":
				if($('div.ambass').length == 5)
				{
					$(".votedambassadortitle").css("box-shadow","0 0px 20px green");
				}
				else
				{
					$(".votedambassadortitle").css("box-shadow","0 0px 20px red");
				}
				break;
			case "advis":
				if($('div.advis').length == 20)
				{
					$(".votedadvisertitle").css("box-shadow","0 0px 20px green");
				}
				else
				{
					$(".votedadvisertitle").css("box-shadow","0 0px 20px red");
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
				url: '/employee/vote/getcandidateinfo',
				dataType: 'text',
				data: {candidate_id:candidate_id,position:position},
				success: function(data)
				{
					$("."+container).append(data);
					$("#"+candidate_id+"cancel").css("display","");
					$("#"+candidate_id+"vote").css("display","none");

					changecolor(position);
					totalpersonvotes(position);
				}
				});
			}
			else
			{
				alert("puno na tukmol mag tanggal ka ng isa!");
			}

		});

	}

	function chectotalvotes(position)
	{
		var maxed = false;
		switch(position)
		{
			case "globaldirec":
				if($('div.globaldirec').length == 3)
				{
					maxed = true;
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 10)
				{
					maxed = true;
				}
				break;
			case "ambass":
				if($('div.ambass').length == 5)
				{
					maxed = true;
				}
				break;
			case "advis":
				if($('div.advis').length == 20)
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
			$("#"+user_id+"vote").css("display","");
			$("#"+user_id+"cancel").css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});
	}

	function totalpersonvotes(position)
	{
		switch(position)
		{
			case "globaldirec":
				$(".globalnumber").text($('div.globaldirec').length+"/3");
				break;
			case "regionaldirec":
				$(".regionalnumber").text($('div.regionaldirec').length+"/10");
				break;
			case "ambass":
				$(".ambassadornumber").text($('div.ambass').length+"/5");
				break;
			case "advis":
				$(".advisernumber").text($('div.advis').length+"/20");
				break;
		}
	}

	function cancelonvote()
	{
		$(".votedglobalcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote").css("display","");
			$("#"+user_id+"cancel").css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedregionalcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote").css("display","");
			$("#"+user_id+"cancel").css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedambassadorcontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote").css("display","");
			$("#"+user_id+"cancel").css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".votedadvisercontentcontainer").on("click", "button.cancelledvotedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"vote").css("display","");
			$("#"+user_id+"cancel").css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});
	}



}
