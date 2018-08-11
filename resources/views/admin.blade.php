@extends('layout')
@section('content')
<div class="container">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="pills-BoardTrutees-tab" data-toggle="pill" href="#pills-boardtrustees" role="tab" aria-controls="pills-boardtrustees" aria-selected="true">Manage Board of Trustees</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="pills-GlobalBoardDirector-tab" data-toggle="pill" href="#pills-globalboards" role="tab" aria-controls="pills-globalboards" aria-selected="false">Manage Global Board of Directors</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="pills-RegionalBoardDirector-tab" data-toggle="pill" href="#pills-regionalboards" role="tab" aria-controls="pills-regionalboards" aria-selected="false">Manage Regional Board of Directors</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="pills-Ambassador-tab" data-toggle="pill" href="#pills-ambssador" role="tab" aria-controls="pills-ambssador" aria-selected="false">Manage Ambassador</a>
		</li>
		<li class="nav-item">
			<a class="nav-link wa" id="pills-PollResult-tab" data-toggle="pill" href="#pills-result" role="tab" aria-controls="pills-result" aria-selected="false">Poll Result</a>
		</li>
	</ul>
	<div class="row">
		<div class="col-lg-9">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active table-responsive" id="pills-boardtrustees" role="tabpanel" aria-labelledby="pills-home-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First Name</th>
								<th scope="col">Surname</th>
								<th scope="col">Country</th>
								<th scope="col">Email</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-globalboards" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First Name</th>
								<th scope="col">Surname</th>
								<th scope="col">Country</th>
								<th scope="col">Email</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-regionalboards" role="tabpanel" aria-labelledby="pills-contact-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First Name</th>
								<th scope="col">Surname</th>
								<th scope="col">Country</th>
								<th scope="col">Email</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-ambssador" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First Name</th>
								<th scope="col">Surname</th>
								<th scope="col">Country</th>
								<th scope="col">Email</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm">Approve</button></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Paul Errol</td>
								<td>Añago</td>
								<td>Philippines</td>
								<td>paulerrol.anago@digmaweb.solutions</td>
								<td><button type="button" class="btn btn-primary btn-sm" id="asd">Approve</button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-result" role="tabpanel" aria-labelledby="pills-contact-tab">
					
				</div>
			</div>
		</div>
		<div class="col-lg-3 mawawala">
			<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Country</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Paul Errol Añago</td>
								<td>Philippines</td>
							</tr>
						</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $( document ).ready(function() {
       $( "#wa" ).click(function() {
		  $(".mawawala").hide();
		});
    });
 
</script>
@endsection