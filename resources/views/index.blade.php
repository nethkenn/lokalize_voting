@extends('layout')
@section('content')
<!--BUTTON-->
<ul class="nav nav-tabs col-lg-8" id="myTab" role="tablist">
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#global" role="tab" aria-controls="home" aria-selected="true">Global Board of Director</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#regional" role="tab" aria-controls="profile" aria-selected="false">Regional Board of Director</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ambassador" role="tab" aria-controls="contact" aria-selected="false">Ambassador</a>
  </li>
  <li class="nav-item col-md-4 col-lg-3 col-sm-4">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#advisor" role="tab" aria-controls="contact" aria-selected="false">Advisor</a>
  </li>
</ul>
<div class="tab-content col-lg-8" id="myTabContent">
  <div class="tab-pane fade show active" id="global" role="tabpanel" aria-labelledby="home-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Global Board of Directors    <span style="color:white;margin-left: 30px;font-size: 11px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img  src="https://pbs.twimg.com/profile_images/1344113391/228649_224879334193376_100000139341211_987369_696765_n.jpg">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/34368425_2047111755316755_3702243297842954240_n.jpg?_nc_cat=0&oh=35362410c30f9118a72d60780862373c&oe=5BC5D32B">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/17361643_1826639617353601_6928723209733742971_n.jpg?_nc_cat=0&oh=fce7b7d2a4408afda673d877c4f4b75f&oe=5BFE2387">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/31957653_1904301046255961_3496826363673837568_n.jpg?_nc_cat=0&oh=f942366e0dc05d42215ed79653248d5f&oe=5C058391" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/28277378_2058765337471924_7997795100558308734_n.jpg?_nc_cat=0&oh=e91855bf38b58f2900d92c187770f366&oe=5BC83616" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/36965795_10209088466807221_8140901486394605568_n.jpg?_nc_cat=0&oh=6c5f07a93d89916eddaeb9a96679a10d&oe=5C0FF740">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
    </div>
  </div>

  <!--regional-->
  <div class="tab-pane fade" id="regional" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Regional Board of Directors    <span style="color:white;margin-left: 30px;font-size: 11px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img  src="https://pbs.twimg.com/profile_images/1344113391/228649_224879334193376_100000139341211_987369_696765_n.jpg">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/34368425_2047111755316755_3702243297842954240_n.jpg?_nc_cat=0&oh=35362410c30f9118a72d60780862373c&oe=5BC5D32B">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/17361643_1826639617353601_6928723209733742971_n.jpg?_nc_cat=0&oh=fce7b7d2a4408afda673d877c4f4b75f&oe=5BFE2387">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/31957653_1904301046255961_3496826363673837568_n.jpg?_nc_cat=0&oh=f942366e0dc05d42215ed79653248d5f&oe=5C058391" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/28277378_2058765337471924_7997795100558308734_n.jpg?_nc_cat=0&oh=e91855bf38b58f2900d92c187770f366&oe=5BC83616" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/36965795_10209088466807221_8140901486394605568_n.jpg?_nc_cat=0&oh=6c5f07a93d89916eddaeb9a96679a10d&oe=5C0FF740">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
    </div>
  </div>

  <!--ambassador-->
  <div class="tab-pane fade" id="ambassador" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Ambassador    <span style="color:white;margin-left: 30px;font-size: 11px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img  src="https://pbs.twimg.com/profile_images/1344113391/228649_224879334193376_100000139341211_987369_696765_n.jpg">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/34368425_2047111755316755_3702243297842954240_n.jpg?_nc_cat=0&oh=35362410c30f9118a72d60780862373c&oe=5BC5D32B">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/17361643_1826639617353601_6928723209733742971_n.jpg?_nc_cat=0&oh=fce7b7d2a4408afda673d877c4f4b75f&oe=5BFE2387">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/31957653_1904301046255961_3496826363673837568_n.jpg?_nc_cat=0&oh=f942366e0dc05d42215ed79653248d5f&oe=5C058391" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/28277378_2058765337471924_7997795100558308734_n.jpg?_nc_cat=0&oh=e91855bf38b58f2900d92c187770f366&oe=5BC83616" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/36965795_10209088466807221_8140901486394605568_n.jpg?_nc_cat=0&oh=6c5f07a93d89916eddaeb9a96679a10d&oe=5C0FF740">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
    </div>
  </div>
  <!--advisor-->
  <div class="tab-pane fade" id="advisor" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12 globaltitle">
      <h5>
      Advisor    <span style="color:white;margin-left: 30px;font-size: 11px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
      </h5>
    </div>
    <div class="col-lg-12 globalcontent">
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img  src="https://pbs.twimg.com/profile_images/1344113391/228649_224879334193376_100000139341211_987369_696765_n.jpg">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/34368425_2047111755316755_3702243297842954240_n.jpg?_nc_cat=0&oh=35362410c30f9118a72d60780862373c&oe=5BC5D32B">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/17361643_1826639617353601_6928723209733742971_n.jpg?_nc_cat=0&oh=fce7b7d2a4408afda673d877c4f4b75f&oe=5BFE2387">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/31957653_1904301046255961_3496826363673837568_n.jpg?_nc_cat=0&oh=f942366e0dc05d42215ed79653248d5f&oe=5C058391" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/28277378_2058765337471924_7997795100558308734_n.jpg?_nc_cat=0&oh=e91855bf38b58f2900d92c187770f366&oe=5BC83616" >
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 globalpicture">
        <img src="https://scontent.fmnl9-1.fna.fbcdn.net/v/t1.0-9/36965795_10209088466807221_8140901486394605568_n.jpg?_nc_cat=0&oh=6c5f07a93d89916eddaeb9a96679a10d&oe=5C0FF740">
        <div class="textvote">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          <center><button type="button" class="btn btn-primary">VOTE NOW!</button></center>
        </div>
      </div>
    </div>
  </div>
</div>

<!--voted-->
<div class="col-lg-4 votedlist">
  <div class="votedtitle">
      Voted List
  </div>

  <div class="votedglobaltitle">
  </div>
</div>
@endsection