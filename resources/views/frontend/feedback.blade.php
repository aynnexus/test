@extends('layouts.app')

@section('content')
<body class="hold-transition register-page" style="background-repeat: no-repeat;background: {{$temp->Profile->background_color}};background-image: url(<?php echo ($temp->Profile!=null)?'/storage/'.$temp->Profile->background_image:''; ?>);">

    <img src="{{url('/storage/'.$temp->Profile->header_image)}}" height="200px" width="100%">
        <div class="register-box" style="margin:0% auto">
            <div class="register-logo">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 47%;">
            </div>

            <div class="register-box-body" style="border-radius:10px;">
                 <p class="login-box-msg">Thanks for your submition. Now you get internet accesss.</p>
                <?php $feedback = json_decode($temp->Field->feedback_fields); ?>
                @if(isset($feedback) && $feedback->comment==1 || $feedback->rate==1 || $feedback->survey==1)
                {!! Form::open(['url'=>'guest/feedback/'.$id,'id'=>'login']) !!}
                    @if(isset($feedback) && $feedback->comment==1)
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea name="comment" rows="4" cols="50" class="form-control" {{$feedback->cbb_require==1?'required':''}}>
                        </textarea>
                    </div>
                    @endif

                    @if(isset($feedback) && $feedback->rate==1)
                    @foreach($temp->Rating as $key=>$rating)
                        
                        <div class="form-group">  
                            <div class="">
                                <label>{{$rating->Rate->label}}</label>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="stars">
                                    <input class="star star-5" value="5" id="star-5{{$key}}" type="radio" name="{{$rating->Rate->label}}"/>
                                    <label class="star star-5" for="star-5{{$key}}"></label>
                                    <input class="star star-4" value="4" id="star-4{{$key}}" type="radio" name="{{$rating->Rate->label}}"/>
                                    <label class="star star-4" for="star-4{{$key}}"></label>
                                    <input class="star star-3" value="3" id="star-3{{$key}}" type="radio" name="{{$rating->Rate->label}}"/>
                                    <label class="star star-3" for="star-3{{$key}}"></label>
                                    <input class="star star-2" value="2" id="star-2{{$key}}" type="radio" name="{{$rating->Rate->label}}"/>
                                    <label class="star star-2" for="star-2{{$key}}"></label>
                                    <input class="star star-1" value="1" id="star-1{{$key}}" type="radio" name="{{$rating->Rate->label}}"/>
                                    <label class="star star-1" for="star-1{{$key}}"></label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                    <br>
                    @if(isset($feedback) && $feedback->survey==1)
                    @foreach($temp->Surveying as $key=>$surveying)
                        <div class="form-group has-feedback">
                            <label>{{$key+1}}. {{$surveying->Question->label}}</label>
                            @foreach($surveying->Question->Answers as $answer)
                                <p><input type="radio" required name="answer{{$key}}" value="{{$answer->answer_id}}"> {{$answer->label}}</p>
                            @endforeach
                        </div>
                    @endforeach
                    @endif

                    <div class="row">
                        <div class="col-xs-8">
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" id="login" class="btn btn-success btn-block">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {!! Form::close() !!}
                @endif
            </div>
            <!-- /.form-box --> 
            <div class="row">
                <div id="fb-root"></div>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true"></div>
                <button style="display: none;" id="loginBtn">Facebook Login</button>
                <div id="response"></div>
            </div>
            
        </div>
        <br>
        <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="250px" width="100%">
        
        @if($ads)  
        <div class="adspopUp">
            <!-- Modal -->
            <div class="modal fade" id="adspopUp" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <button type="button" onclick="closeVideo()" class="close status hide" data-dismiss="modal">&times;</button>
                            <h3 id="countdown" style="font-weight: bold"></h3>
                            <div class="row">
                              <div class="col-xs-12 col-md-12 col-lg-12" id="media">
                                    @if($ads->type==1)
                                        <img src="{{url('/storage/'.$ads->photo)}}" width="100%">
                                    @else
                                        <iframe src="{{$ads->video}}" width="100%" frameborder="0" allowfullscreen></iframe>
                                    @endif
                              </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                        <button type="button" onclick="closeVideo()" class="btn btn-default status hide" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
             </div>
            <!-- model end -->
        </div>
        @endif
</body>

<script type="text/javascript">
    $("#adspopUp").modal('show');
    var timer = '<?php echo $ads['timeout'] ?>',
    el = document.getElementById('countdown');
    (function t_minus() {
        'use strict';
        el.innerHTML = timer--;
        if (timer >= 0) {
            setTimeout(function () {
                t_minus();
            }, 1000);
        } else {
            //$("#adspopUp").modal('hide');
            $('button.status').removeClass('hide')
        }
    }());
    function closeVideo() {
        $('div#media').remove();
    }
    const ID = '<?php echo $temp->Field->iframe_link ?>';
    const guest_id = '<?php echo $id ?>'
    function getUserData() {    
        FB.api(
            "me?fields=age_range",
            function (response) {
              if (response && !response.error) {
                updateJsonAge(response.age_range.min,guest_id)
              }
            }
        );
    }
    function updateJsonAge(data,id)
    {
        $.get('./guest_age/field?age='+data+'&id='+id);
    }

    window.fbAsyncInit = function() {
        //SDK loaded, initialize it
        FB.init({
            appId      : ID,
            xfbml      : true,
            version    : 'v2.9'
        });

        //check user session and refresh it
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                //user is authorized
                document.getElementById('loginBtn').style.display = 'none';
                getUserData();
            } else {
                //user is not authorized
            }
        });
    };

    //load the JavaScript SDK
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.com/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    //add event listener to login button
    document.getElementById('loginBtn').addEventListener('click', function() {
        //do the login
        FB.login(function(response) {
            if (response.authResponse) {
                //user just authorized your app
                document.getElementById('loginBtn').style.display = 'none';
                getUserData();
            }
        }, {scope: 'email,public_profile', return_scopes: true});
    }, false);

</script>
@endsection
