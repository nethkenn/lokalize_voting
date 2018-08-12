
function vote(candidate_id,container,position)
{
	var maxed = chectotalvotes(position);

	if(maxed == false)
	{
		$.ajax({
		type: 'GET',
		url: '/employeee/vote/getcandidateinfo',
		dataType: 'text',
		data: {candidate_id:candidate_id,position:position},
		success: function(data)
		{
			$("."+container).append(data);
			$("#"+candidate_id+"cancel").css("display","");
			$("#"+candidate_id+"vote").css("display","none");
			totalpersonvotes(position);
		}
		});
	}
	else
	{
		alert("puno na tukmol mag tanggal ka ng isa!");
	}

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

function cancel_vote(user_id,position)
{
	$("#"+user_id).remove();
	$("#"+user_id+"vote").css("display","");
	$("#"+user_id+"cancel").css("display","none");
	totalpersonvotes(position);

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