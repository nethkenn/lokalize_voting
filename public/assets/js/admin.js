var admin = new admin();

function admin()
{
	init();

	function init()
	{
		$(document).ready(function()
		{
			approve();
			checktotalapprove();
			cancel_approve();
			totalpersonvotes();
			removeonapprove();
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
				alert("Duplication of Approved Candidate Detected. Please the approved Candidates.");
			}
			else if(hasDuplicates(regionaldirectors) == true)
			{
				alert("Duplication of Approved Candidate Detected. Please the approved Candidates.");
			}
			else if(hasDuplicates(ambassadors) == true)
			{
				alert("Duplication of Approved Candidate Detected. Please the approved Candidates.");
			}
			else if(hasDuplicates(advisors) == true)
			{
				alert("Duplication of Approved Candidate Detected. Please the approved Candidates.");
			}
			else if(globaldirectors.length < 10)
			{
				alert("Please Approve 15 Candidate for Board of Trustees.");
			}
			else if(regionaldirectors.length < 15)
			{
				alert("Please Approve 30 Candidate for Global Board of Directors.");
			}
			else if(ambassadors.length < 15)
			{
				alert("Please Choose 150 Candidate and 5 per Region for Regional Board of Directors.");
			}
			else if(advisors < 10)
			{
				alert("Please Choose 195 Candidate for Ambassadors.");
			}
			else
			{	

				$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'POST',
				url: '/admin/submit_votes',	
				dataType: 'text',
				data: {globaldirectors:globaldirectors,
					   regionaldirectors:regionaldirectors,
					   ambassadors:ambassadors,
					   advisors:advisors	
						},
				success: function(data)
				{
					toastr.success('All Candidates are ready for election!','Approved!');	
					location.reload('admin');		
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
				if($('div.globaldirec').length == 10)
				{
					$(".approvedglobaltitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".approvedglobaltitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 15)
				{
					$(".approvedregionaltitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".approveedregionaltitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "ambass":
				if($('div.ambass').length == 15)
				{
					$(".approvedambassadortitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".approvedambassadortitle").css("box-shadow","0 0px 1px red");
				}
				break;
			case "advis":
				if($('div.advis').length == 10)
				{
					$(".approvedadvisertitle").css("box-shadow","0 0px 1px green");
				}
				else
				{
					$(".approvedadvisertitle").css("box-shadow","0 0px 1px red");
				}
				break;
		}
	}

	function approve()
	{

		$(".approved").click(function()
		{
			var position     = $(this).attr("data-position");
			var candidate_id = $(this).attr("data-id");
		    var maxed        = checktotalapprove(position);
		    var container    = $(this).attr("data-container");

			if(maxed == false)
			{
				$.ajax({
				type: 'GET',
				url: '/admin/approve/getcandidateinfo',
				dataType: 'text',
				data: {candidate_id:candidate_id,position:position},
				success: function(data)
				{
					var exist = $("."+container).find("#"+candidate_id).length;
					
					if(exist == 0)
					{
						$("."+container).append(data);
					}

					$("#"+candidate_id+"remove"+position).css("display","");
					$("#"+candidate_id+"approve"+position).css("display","none");

					changecolor(position);
					totalpersonvotes(position);
				}
				});
			}
			else
			{	
		
				alert("You already approved a maxximum candidates for the position!");
			}

		});

	}

	function checktotalapprove(position)
	{
		var maxed = false;
		switch(position)
		{
			case "globaldirec":
				if($('div.globaldirec').length == 10)
				{
					maxed = true;
				}
				break;
			case "regionaldirec":
				if($('div.regionaldirec').length == 15)
				{
					maxed = true;
				}
				break;
			case "ambass":
				if($('div.ambass').length == 15)
				{
					maxed = true;
				}
				break;
			case "advis":
				if($('div.advis').length == 10)
				{
					maxed = true;
				}
				break;
		}

		return maxed;
	}

	function cancel_approve()
	{
		$(".removed").click(function()
		{
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"approve"+position).css("display","");
			$("#"+user_id+"remove"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});
	}

	function totalpersonvotes(position)
	{
		switch(position)
		{
			case "globaldirec":
				$(".globalnumber").text($('div.globaldirec').length+"/10");
				break;
			case "regionaldirec":
				$(".regionalnumber").text($('div.regionaldirec').length+"/15");
				break;
			case "ambass":
				$(".ambassadornumber").text($('div.ambass').length+"/15");
				break;
			case "advis":
				$(".advisernumber").text($('div.advis').length+"/10");
				break;
		}
	}

	function removeonapprove()
	{
		$(".approvedglobalcontentcontainer").on("click", "button.removedapprovedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"approve"+position).css("display","");
			$("#"+user_id+"remove"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".approvedregionalcontentcontainer").on("click", "button.removedapprovedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"approve"+position).css("display","");
			$("#"+user_id+"remove"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".approvedambassadorcontentcontainer").on("click", "button.removedapprovedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"approve"+position).css("display","");
			$("#"+user_id+"remove"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});

		$(".approvedadvisercontentcontainer").on("click", "button.removedapprovedlist", function(){
			var position     = $(this).attr("data-position");
			var user_id      = $(this).attr("data-id");

			$("#"+user_id).remove();
			$("#"+user_id+"approve"+position).css("display","");
			$("#"+user_id+"remove"+position).css("display","none");
			totalpersonvotes(position);
			changecolor(position);
		});
	}



}
