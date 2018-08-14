@if(isset($candidate))
    <div class="approvedcontent {{$divname}}" id="{{$candidate->user_id}}">
       <img src="{{$candidate->user_picture}}">
       <p>{{$candidate->user_display_name}}</p>
       <input type="hidden" name="{{$divname}}[]" value="{{$candidate->user_id}}" name="">
       <button type="button" class="btn btn-primary btn-sm removedapprovedlist" data-id="{{$candidate->user_id}}" data-position="{{$divname}}"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
@endif