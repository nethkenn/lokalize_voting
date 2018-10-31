@extends('layout')
@section('content')
<!--BUTTON-->
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
        Are you sure you want to submit your vote?<br>
        You will automatically logged out.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="submitVotes" class="btn btn-primary">Submit Vote</button>
      </div>
    </div>
  </div>
</div>
<!--view info-->
<div class="modal fade" id="modalViewInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<ul class="nav nav-tabs col-lg-8" id="myTab" role="tablist">
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#global" role="tab" aria-controls="home" aria-selected="true">Board of Trustees</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#regional" role="tab" aria-controls="profile" aria-selected="false">Global Board of Director</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ambassador" role="tab" aria-controls="contact" aria-selected="false">Regional Board of Director</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#advisor" role="tab" aria-controls="contact" aria-selected="false">Ambassador</a>
  </li>
</ul>
<div class="tab-content col-lg-8" id="myTabContent">
  <div class="tab-pane fade show active" id="global" role="tabpanel" aria-labelledby="home-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      <input type="hidden" value="{{$user_id}}" class="user_id" name="">
      Board of Trustees    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 1 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      @foreach($global_candidate as $key => $global)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$global->user_picture}}">
        <div class="textvote">
          <center><b></b>{{ucfirst($global->user_first_name)}} {{ucfirst($global->user_last_name)}}</center>
          <center><b></b>{{ucfirst($global->user_country)}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$global->user_id}}" data-position="globaldirec" data-container="votedglobalcontentcontainer" id="{{$global->user_id}}voteglobaldirec">VOTE NOW!</button></center>
          <center><button type="button" class="btn btn-primary cancelled {{$global->user_id}}cancelglobaldirec" data-id="{{$global->user_id}}" data-position="globaldirec" id="{{$global->user_id}}cancelglobaldirec" style="display:none">CANCEL VOTE</button></center>
        </div>
        <center><button type="button "   class="btn-sm btn-info " data-toggle="modal" data-target="#modal{{$global->approved_candidate_id}}">
        View info</button></center>
      </div>
      {{-- modal start view more info --}}
      <!-- Modal -->
      <div class="modal fade" id="modal{{$global->approved_candidate_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{$global->user_first_name}} {{$global->user_last_name}}</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>LinkedIn:</b> <a target="_blank" href="{{$global->user_linked_in}}">{{$global->user_linked_in}}</a><br>
              <b>Media Link:</b> <a target="_blank" href="{{$global->user_media_linked}}">{{$global->user_media_linked}}</a>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      {{-- modal end view more info --}}
      @endforeach
    </div>
  </div>
  <!--regional-->
  <div class="tab-pane fade" id="regional" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Global Board of Directors    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 1 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      @foreach($regional_candidate as $key => $regional)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$regional->user_picture}}">
        <div class="textvote">
          <center><b></b>{{ucfirst($regional->user_first_name)}} {{ucfirst($regional->user_last_name)}}</center>
          <center><b></b>{{ucfirst($regional->user_country)}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$regional->user_id}}" data-position="regionaldirec" data-container="votedregionalcontentcontainer" id="{{$regional->user_id}}voteregionaldirec">VOTE NOW!</button></center>
          <center><button type="button" class="btn btn-primary cancelled {{$regional->user_id}}cancelregionaldirec" data-id="{{$regional->user_id}}" data-position="regionaldirec" id="{{$regional->user_id}}cancelregionaldirec" style="display:none">CANCEL VOTE</button></center>
        </div>
        <center><button type="button "   class="btn-sm btn-info " data-toggle="modal" data-target="#modal{{$regional->approved_candidate_id}}">
        View info
        </button></center>
      </div>
      <div class="modal fade" id="modal{{$regional->approved_candidate_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{$regional->user_first_name}} {{$regional->user_last_name}}</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>LinkedIn:</b> <a target="_blank" href="{{$regional->user_linked_in}}">{{$regional->user_linked_in}}</a><br>
              <b>Media Link:</b> <a target="_blank" href="{{$regional->user_media_linked}}">{{$regional->user_media_linked}}</a>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!--ambassador-->
  <div class="tab-pane fade" id="ambassador" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Regional Board of Directors ({{$user_region}})    <span style="color:white;margin-left: 20px;font-size: 11px;">You can only choose 1 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      @foreach($ambassador_candidate as $key => $ambassador)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$ambassador->user_picture}}">
        <div class="textvote">
          <center><b></b> {{ucfirst($ambassador->user_first_name)}} {{ucfirst($ambassador->user_last_name)}}</center>
          <center><b></b> {{ucfirst($ambassador->user_country)}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$ambassador->user_id}}" data-position="ambass" data-container="votedambassadorcontentcontainer" id="{{$ambassador->user_id}}voteambass">VOTE NOW!</button></center>
          <center><button type="button" class="btn btn-primary cancelled {{$ambassador->user_id}}cancelambass" data-id="{{$ambassador->user_id}}" data-position="ambass" id="{{$ambassador->user_id}}cancelambass" style="display:none">CANCEL VOTE</button></center>
        </div>
        <center><button type="button "   class="btn-sm btn-info " data-toggle="modal" data-target="#modal{{$ambassador->approved_candidate_id}}">
        View info
        </button></center>
      </div>
      <div class="modal fade" id="modal{{$ambassador->approved_candidate_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{$ambassador->user_first_name}} {{$ambassador->user_last_name}}</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>LinkedIn:</b> <a target="_blank" href="{{$ambassador->user_linked_in}}">{{$ambassador->user_linked_in}}</a><br>
              <b>Media Link:</b> <a target="_blank" href="{{$ambassador->user_media_linked}}">{{$ambassador->user_media_linked}}</a>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!--advisor-->
  <div class="tab-pane fade" id="advisor" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Ambassador ({{$user_region}})   <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 1 candidate for this position. Vote Wisely! </span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      @foreach($advisor_candidate as $key => $advisor)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$advisor->user_picture}}">
        <div class="textvote">
          <center><b></b>{{ucfirst($advisor->user_first_name)}} {{ucfirst($advisor->user_last_name)}}</center>
          <center><b></b>{{ucfirst($advisor->user_country)}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$advisor->user_id}}" data-position="advis" data-container="votedadvisercontentcontainer" id="{{$advisor->user_id}}voteadvis">VOTE NOW!</button></center>
          <center><button type="button" class="btn btn-primary cancelled {{$advisor->user_id}}canceladvis" data-id="{{$advisor->user_id}}" data-position="advis" id="{{$advisor->user_id}}canceladvis" style="display:none">CANCEL VOTE</button></center>
        </div>
        <center><button type="button "   class="btn-sm btn-info " data-toggle="modal" data-target="#modal{{$advisor->approved_candidate_id}}">
        View info
        </button></center>
      </div>
      <div class="modal fade" id="modal{{$advisor->approved_candidate_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{$advisor->user_first_name}} {{$advisor->user_last_name}}</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>LinkedIn:</b> <a target="_blank" href="{{$advisor->user_linked_in}}">{{$regional->user_linked_in}}</a><br>
              <b>Media Link:</b> <a target="_blank" href="{{$advisor->user_media_linked}}">{{$regional->user_media_linked}}</a>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="col-lg-4">
  <!--voted-->
  <div class="col-lg-12 votedlist">
    <div class="votedtitle">
      Voted List
    </div>
    <!--GLOBAL VOTES-->
    <div class="votedglobaltitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;BOARD OF TRUSTEES<span class="pull-right globalnumber">0/1</span>
    </div>
    <!--GLOBAL CONTENTS-->
    <div class="votedglobalcontentcontainer">
    </div>
    <!--REGIONAL VOTES-->
    <div class="votedregionaltitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;GLOBAL BOARD OF DIRECTORS<span class="pull-right regionalnumber">0/1</span>
    </div>
    <!--REGIONAL CONTENTS-->
    <div class="votedregionalcontentcontainer">
    </div>
    <!--AMBASSADOR VOTES-->
    <div class="votedambassadortitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;REGIONAL BOARD OF DIRECTORS<span class="pull-right ambassadornumber">0/1</span>
    </div>
    <!--AMBASSADOR CONTENTS-->
    <div class="votedambassadorcontentcontainer">
    </div>
    <!--ADVISER VOTES-->
    <div class="votedadvisertitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;AMBASSADORS<span class="pull-right advisernumber">0/1</span>
    </div>
    <!--ADVISER CONTENTS-->
    <div class="votedadvisercontentcontainer">
    </div>
  </div>
  <div class="col-lg-12 submitdiv">
    <button type="button" id="submit"  class="btn btn-primary">SUBMIT</button>
  </div>
</div>
@endsection
@section("script")
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="/assets/js/employee.js"></script>
@endsection