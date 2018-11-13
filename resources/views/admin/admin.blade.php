@extends('layout')
@section('content')
<div class="container">

<div class="modal fade" id="modalvotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to submit your vote?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="submitVotes" class="btn btn-primary">Submit Vote</button>
      </div>
    </div>
  </div>
</div>

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
			<a class="nav-link" id="pills-Voters-tab" data-toggle="pill" href="#pills-voters" role="tab" aria-controls="pills-voters" aria-selected="false">Voted Voters</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="pills-VotersPending-tab" data-toggle="pill" href="#pills-voters-pending" role="tab" aria-controls="pills-voters-pending" aria-selected="false">Pending Voters</a>
		</li>
		{{-- <li class="nav-item">
			<a class="nav-link wa" id="pills-PollResult-tab" data-toggle="pill" href="#pills-result" role="tab" aria-controls="pills-result" aria-selected="false">Poll Result</a>
		</li> --}}
	</ul>
	<div class="row">
		<div class="col-lg-12">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active table-responsive" id="pills-boardtrustees" role="tabpanel" aria-labelledby="pills-home-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
								<th scope="col">Region</th>
								<th scope="col">LinkedIn Address</th>
							</tr>
						</thead>
						<tbody>
							@php
							$count = 1;
							@endphp
							@foreach($global_candidate as $key => $val)
							<tr>
								<th scope="row">{{$count++}}</th>
								<td>{{$val->user_first_name}} {{$val->user_last_name}}</td>
								<td>{{$val->user_region}}</td>
								<td><a target="_blank" href="https://{{$val->user_linked_in}}">{{$val->user_linked_in}}</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-globalboards" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
								<th scope="col">Region</th>
								<th scope="col">LinkedIn Address</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								@php
								$count = 1;
								@endphp
								@foreach($regional_candidate as $key => $val)
								<tr>
									<th scope="row">{{$count++}}</th>
									<td>{{$val->user_first_name}} {{$val->user_last_name}}</td>
									<td>{{$val->user_region}}</td>
									<td><a target="_blank" href="https://{{$val->user_linked_in}}">{{$val->user_linked_in}}</a></td>
								</tr>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-regionalboards" role="tabpanel" aria-labelledby="pills-contact-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
								<th scope="col">Region</th>
								<th scope="col">LinkedIn Address</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								@php
								$count = 1;
								@endphp
								@foreach($ambassador_candidate as $key => $val)
								<tr>
									<th scope="row">{{$count++}}</th>
									<td>{{$val->user_first_name}} {{$val->user_last_name}}</td>
									<td>{{$val->user_region}}</td>
									<td><a target="_blank" href="https://{{$val->user_linked_in}}">{{$val->user_linked_in}}</a></td>
								</tr>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-ambssador" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
								<th scope="col">Region</th>
								<th scope="col">LinkedIn Address</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								@php
								$count = 1;
								@endphp
								@foreach($advisor_candidate as $key => $val)
								<tr>
									<th scope="row">{{$count++}}</th>
									<td>{{$val->user_first_name}} {{$val->user_last_name}}</td>
									<td>{{$val->user_region}}</td>
									<td><a target="_blank" href="https://{{$val->user_linked_in}}">{{$val->user_linked_in}}</a></td>
								</tr>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="pills-voters" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								@php
								$count = 1;
								@endphp
								@foreach($voting_status_completed as $key => $completed)
								<tr>
									<th scope="row">{{$count++}}</th>
									<td>{{$completed->user_first_name}} {{$completed->user_last_name}}</td>
								</tr>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="pills-voters-pending" role="tabpanel" aria-labelledby="pills-profile-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								@php
								$count = 1;
								@endphp
								@foreach($voting_status_pending as $key => $pending)
								<tr>
									<th scope="row">{{$count++}}</th>
									<td>{{$pending->user_first_name}} {{$pending->user_last_name}}</td>
								</tr>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>
				{{-- <div class="tab-pane fade" id="pills-result" role="tabpanel" aria-labelledby="pills-contact-tab">
					
				</div> --}}
			</div>
		</div>
	</div>
</div>
@endsection
@section("script")
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="/assets/js/admin.js"></script>
@endsection

{{-- <script src="/assets/js/admin.js"></script> --}}

