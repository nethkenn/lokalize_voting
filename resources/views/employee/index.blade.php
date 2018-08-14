@extends('layout')
@section('content')
<!--BUTTON-->

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
      Board of Trustees    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 1 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">

    @foreach($global_candidate as $key => $global)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$global->user_picture}}">
        <div class="textvote">
          <center>{{$global->user_first_name}} {{$global->user_last_name}}</center>
          <center>{{$global->user_country}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$global->user_id}}" data-position="globaldirec" data-container="votedglobalcontentcontainer" id="{{$global->user_id}}vote">VOTE NOW!</button></center>
           <center><button type="button" class="btn btn-primary cancelled" data-id="{{$global->user_id}}" data-position="globaldirec" id="{{$global->user_id}}cancel" style="display:none">CANCEL VOTE</button></center>           
        </div>
        <center><button type="button" class="btn btn-outline-info btn-sm">View more Info</button></center>
      </div>
    @endforeach

    </div>
  </div>

  <!--regional-->
  <div class="tab-pane fade" id="regional" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Global Board of Directors    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 10 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
    @foreach($regional_candidate as $key => $regional)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$regional->user_picture}}">
        <div class="textvote">
          <center>{{$regional->user_first_name}} {{$regional->user_last_name}}</center>
          <center>{{$regional->user_country}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$regional->user_id}}" data-position="regionaldirec" data-container="votedregionalcontentcontainer" id="{{$regional->user_id}}vote">VOTE NOW!</button></center>
           <center><button type="button" class="btn btn-primary cancelled" data-id="{{$regional->user_id}}" data-position="regionaldirec" id="{{$regional->user_id}}cancel" style="display:none">CANCEL VOTE</button></center>
        </div>
      </div>
    @endforeach
    </div>
  </div>

  <!--ambassador-->
  <div class="tab-pane fade" id="ambassador" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Regional Board of Directors    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 5 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>

    <div class="col-lg-12 globalcontent">
    @foreach($ambassador_candidate as $key => $ambassador)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$ambassador->user_picture}}">
        <div class="textvote">
          <center>{{$ambassador->user_first_name}} {{$ambassador->user_last_name}}</center>
          <center>{{$ambassador->user_country}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$ambassador->user_id}}" data-position="ambass" data-container="votedambassadorcontentcontainer" id="{{$ambassador->user_id}}vote">VOTE NOW!</button></center>
           <center><button type="button" class="btn btn-primary cancelled" data-id="{{$ambassador->user_id}}" data-position="ambass" id="{{$ambassador->user_id}}cancel" style="display:none">CANCEL VOTE</button></center>
        </div>
      </div>
    @endforeach
    </div>
  </div>
  <!--advisor-->
  <div class="tab-pane fade" id="advisor" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Ambassador    <span style="color:white;margin-left: 30px;font-size: 11px;">You can only choose 195 candidate for this position. Vote Wisely!</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
    @foreach($advisor_candidate as $key => $advisor)
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img class="img-responsive" src="{{$advisor->user_picture}}">
        <div class="textvote">
          <center>{{$advisor->user_first_name}} {{$advisor->user_last_name}}</center>
          <center>{{$advisor->user_country}}</center>
          <center><button type="button" class="btn btn-primary voted" data-id="{{$advisor->user_id}}" data-position="advis" data-container="votedadvisercontentcontainer" id="{{$advisor->user_id}}vote">VOTE NOW!</button></center>
           <center><button type="button" class="btn btn-primary cancelled" data-id="{{$advisor->user_id}}" data-position="advis" id="{{$advisor->user_id}}cancel" style="display:none">CANCEL VOTE</button></center>
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
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;GLOBAL BOARD OF DIRECTORS<span class="pull-right regionalnumber">0/10</span>
    </div>
    <!--REGIONAL CONTENTS-->
    <div class="votedregionalcontentcontainer">
    </div>

      <!--AMBASSADOR VOTES-->
    <div class="votedambassadortitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;REGIONAL BOARD OF DIRECTORS<span class="pull-right ambassadornumber">0/5</span>
    </div>
    <!--AMBASSADOR CONTENTS-->
    <div class="votedambassadorcontentcontainer">
    </div>

    <!--ADVISER VOTES-->
    <div class="votedadvisertitle">
      <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;AMBASSADORS<span class="pull-right advisernumber">0/20</span>
    </div>
    <!--ADVISER CONTENTS-->
    <div class="votedadvisercontentcontainer">
    </div>
  </div>

  <div class="col-lg-12 submitdiv">
  <button type="button" id="submit" class="btn btn-primary">SUBMIT</button>
  </div>

</div>

@endsection
<script src="/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/employee.js"></script>
