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
		{{-- <li class="nav-item">
			<a class="nav-link wa" id="pills-PollResult-tab" data-toggle="pill" href="#pills-result" role="tab" aria-controls="pills-result" aria-selected="false">Poll Result</a>
		</li> --}}
	</ul>
	<div class="row">
		<div class="col-lg-8">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active table-responsive" id="pills-boardtrustees" role="tabpanel" aria-labelledby="pills-home-tab">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Full Name</th>
								<th scope="col">Region</th>
								<th scope="col">LinkedIn Address</th>
								<th scope="col">Action</th>
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
								<td><button type="button" class="btn btn-primary btn-sm approved" data-id="{{$val->user_id}}" data-position="globaldirec" data-container="approvedglobalcontentcontainer" id="{{$val->user_id}}approveglobaldirec">Approve</button>
									<button type="button" class="btn btn-primary btn-sm removed" data-id="{{$val->user_id}}" data-position="globaldirec" id="{{$val->user_id}}removeglobaldirec" style="display:none">Remove</button>
								</td>
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
								<th scope="col">Action</th>
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
									<td><button type="button" class="btn btn-primary btn-sm approved" data-id="{{$val->user_id}}" data-position="regionaldirec" data-container="approvedregionalcontentcontainer" id="{{$val->user_id}}approveregionaldirec">Approve</button>
									<button type="button" class="btn btn-primary btn-sm removed" data-id="{{$val->user_id}}" data-position="regionaldirec" id="{{$val->user_id}}removeregionaldirec" style="display:none">Remove</button></td>
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
								<th scope="col">Action</th>
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
									<td><button type="button" class="btn btn-primary btn-sm approved" data-id="{{$val->user_id}}" data-position="ambass" data-container="approvedambassadorcontentcontainer" id="{{$val->user_id}}approveambass">Approve</button>
										<button type="button" class="btn btn-primary btn-sm removed" data-id="{{$val->user_id}}" data-position="ambass" id="{{$val->user_id}}removeambass" style="display:none">Remove</button>
									</td>
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
								<th scope="col">Action</th>
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
									<td><button type="button" class="btn btn-primary btn-sm approved" data-id="{{$val->user_id}}" data-position="advis" data-container="approvedadvisercontentcontainer" id="{{$val->user_id}}approveadvis">Approve</button>
										<button type="button" class="btn btn-primary btn-sm removed" data-id="{{$val->user_id}}" data-position="advis" id="{{$val->user_id}}removeadvis" style="display:none ">Remove</button>
									</td>
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
		<div class="col-lg-4">
			<!--approved-->
			<div class="col-lg-12 approvedlist">
				<div class="approvedtitle">
					Approved List
				</div>
				<!--GLOBAL VOTES-->
				<div class="approvedglobaltitle">
					<i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;BOARD OF TRUSTEES<span class="pull-right globalnumber">0/15</span>
				</div>
				<!--GLOBAL CONTENTS-->
				<div class="approvedglobalcontentcontainer">
				</div>
				<!--REGIONAL VOTES-->
				<div class="approvedregionaltitle">
					<i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;GLOBAL BOARD OF DIRECTORS<span class="pull-right regionalnumber">0/30</span>
				</div>
				<!--REGIONAL CONTENTS-->
				<div class="approvedregionalcontentcontainer">
				</div>
				<!--AMBASSADOR VOTES-->
				<div class="approvedambassadortitle">
					<i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;REGIONAL BOARD OF DIRECTORS<span class="pull-right ambassadornumber">0/15</span>
				</div>
				<!--AMBASSADOR CONTENTS-->
				<div class="approvedambassadorcontentcontainer">
				</div>
				<!--ADVISER VOTES-->
				<div class="approvedadvisertitle">
					<i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;AMBASSADORS<span class="pull-right advisernumber">0/20</span>

				</div>
				<!--ADVISER CONTENTS-->
				<div class="approvedadvisercontentcontainer">
				</div>
			</div>
			<div class="col-lg-12 approvediv">
				<button type="button" id="submit" class="btn btn-primary approvedCandidates">SUBMIT</button>
				{{--  @if($errors->any())
                <div class="alert alert-danger" style="border-radius: 15px 50px 30px;height: 50px">
                  <center><h4>{{$errors->first()}}</h4></center>
                </div>
                @endif --}}
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

