@extends('layouts.app')

@section('content')

<body class="hold-transition register-page" style="background: {{$temp->Profile->background_color}}">
    <img src="{{url('/storage/'.$temp->Profile->header_image)}}" height="200px" width="100%">
        <div class="register-box" style="margin:0% auto">
            <div class="register-logo">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 46%;">
            </div>

            <div class="register-box-body" style="border-radius:10px;background: transparent;">
                <p class="login-box-msg"></p>
                <?php $feedback = json_decode($temp->Field->feedback_fields);

                   // dd($feedback);
                         ?>
                {!! Form::open(['url'=>'guest/feedback/'.$id,'id'=>'login']) !!}
                    @if(isset($feedback) && $feedback->comment==1)
                    <div class="form-group has-feedback">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" {{$feedback->cbb_require==1?'required':''}}>
                        </textarea>
                    </div>
                    @endif

                    @if(isset($feedback) && $feedback->rate==1)
                    @foreach($temp->Rating as $key=>$rating)
                        <div class="form-group has-feedback">    
                            {{$rating->Rate->label}}         
                              <div class="stars">
                                <input class="star star-5" value="5" id="star-5{{$key}}" type="radio" name="{{$rating->Rate->label}} "/>
                                <label class="star star-5" for="star-5{{$key}}"></label>
                                <input class="star star-4" value="4" id="star-4{{$key}}" type="radio" name="{{$rating->Rate->label}} "/>
                                <label class="star star-4" for="star-4{{$key}}"></label>
                                <input class="star star-3" value="3" id="star-3{{$key}}" type="radio" name="{{$rating->Rate->label}} "/>
                                <label class="star star-3" for="star-3{{$key}}"></label>
                                <input class="star star-2" value="2" id="star-2{{$key}}" type="radio" name="{{$rating->Rate->label}} "/>
                                <label class="star star-2" for="star-2{{$key}}"></label>
                                <input class="star star-1" value="1" id="star-1{{$key}}" type="radio" name="{{$rating->Rate->label}} "/>
                                <label class="star star-1" for="star-{{$key}}"></label>
                              </div>
                        </div>
                    @endforeach
                    @endif

                    @if(isset($feedback) && $feedback->survey==1)
                    @foreach($temp->Surveying as $key=>$surveying)
                        <div class="form-group has-feedback">
                            <label>{{$key+1}}. {{$surveying->Question->label}}</label>
                            @foreach($surveying->Question->Answers as $answer)
                                <p><input type="radio" name="answer{{$key}}" value="{{$answer->answer_id}}"> {{$answer->label}}</p>
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
                </form>
            </div>
            <!-- /.form-box --> 
            <div class="row">
                <div id="fb-root"></div>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true"></div>
                <button style="display: none;" id="loginBtn">Facebook Login</button>
                <div id="response"></div>
            </div>
            
        </div>
        <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="250px" width="100%">
</body>
<script type="text/javascript">
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
