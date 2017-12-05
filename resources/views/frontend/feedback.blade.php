@extends('layouts.app')

@section('content')
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '2067438900150555'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=2067438900150555&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<body class="hold-transition register-page container-fluid frontend-body" style="color:white;width:auto; background-position:top center;background-attachment: fixed;background: {{$temp->Profile->background_color}};background-image: url(<?php echo ($temp->Profile!=null)?'/storage/'.$temp->Profile->background_image:''; ?>);background-repeat:no-repeat;padding:0;">

	<header  style="text-align:center;"> <img src="{{url('/storage/'.$temp->Profile->header_image)}}" height="200px" width="100%" style="max-width:600px;"></header>
        <div class="loading-div" id="loading-start" >
  	  <div class="loading-text"><p><span style="padding-right:10px;"><img src="{{asset('img/loading.gif')}}"></span>Please Wait... Connecting...</p></div>
    	</div>
	<div class="register-box" style="margin:0% auto">
            <div class="register-logo">
                <img src="{{url('/storage/'.$temp->Profile->logo_image)}}" class="logo-template" width="100" height="100" style="left: 45%;margin-top:-45px;">
            </div>

            <div class="register-box-body custom-box" style="color:white">
                <p class="login-box-msg" style="color: #fffffe;font-size: 15px">Thank you for signing in. Please enjoy 100MB of free internet access.</p>
                <?php $feedback = json_decode($temp->Field->feedback_fields); ?>
                @if(isset($feedback) && $feedback->comment==1 || $feedback->rate==1 || $feedback->survey==1)
                {!! Form::open(['url'=>'guest/feedback/'.$id,'id'=>'login']) !!}
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

                    @if(isset($feedback) && $feedback->comment==1)
                    <div class="form-group">
                        <label>Feedback</label>
                        <textarea name="comment" rows="4" cols="50" class="form-control" placeholder="We welcome your feedback" {{$feedback->cbb_require==1?'required':''}}></textarea>
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
                @if(isset($feedback) && $feedback->like==1)
                    <?php $space= str_replace(' ', '', $feedback->like_page); ?>
                    <div class="fb-like" data-href="https://facebook.com/{{strtolower($space)}}" data-width="300" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                @endif
                <button style="display: none;" id="loginBtn">Facebook Login</button>
                <div id="response"></div>
            </div>            
        </div>
        <br>
        <p style="margin-botton:20px"> </p>
        @if($ads)  
            <!-- Modal -->
            <div class="modal fade" id="adspopUp" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="border-radius: 5px">
                        <div class="modal-header">    
                            <div>  
                                <button type="button" onclick="closeVideo()" class="close status hide" data-dismiss="modal">&times;</button>

                                <button id="countdown" type="button" class="close status"></button>
                               <!--  <h3 id="countdown" class="pull-right" style="font-weight: bold"></h3> -->
                            </div>    
                            <div class="row">
                              <div class="col-xs-12 col-md-12 col-lg-12" id="media">
                                    @if($ads->type==1)
                                        <img src="{{url('/storage/'.$ads->photo)}}" width="100%">
                                    @else
                                        <iframe src="{{$ads->video}}" width="100%" height="300" frameborder="0" allowfullscreen></iframe>
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
        @endif
	<!--<div class="ads-footer"><img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="200px" width="100%" aling="center" style="max-width:500px;margin-bottom:25px;"></div>-->
	<footer class="frontend-footer" style="text-align:center;">
	       <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="175px" width="100%" aling="center" style="max-width:600px;">
		<!--<div class="up-footer">
	        <p>Powered by <a href="http://nexus.com.mm">Nexus Solutions</a></p>
      	  </div>
     	  <div class="low-footer"></div>-->
	</footer>
</body>

<script type="text/javascript">
    $("#adspopUp").modal('show');
    var timer = '<?php echo $ads['timeout'] ?>',
    el = document.getElementById('countdown');
    (function t_minus() {
        'use strict';
        if (el!=null) {
            el.innerHTML = timer--;
        }
        if (timer >= 0) {
            setTimeout(function () {
                t_minus();
            }, 1000);
        } else {
            //$("#adspopUp").modal('hide');
            $('button.status').removeClass('hide')
            $('button#countdown').addClass('hide')
        }
    }());
    function closeVideo() {
        $('div#media').remove();
    }
    var ID = '<?php echo $temp->Field->iframe_link ?>';
    var guest_id = '<?php echo $id ?>';
    
    function getUserData() {    
        FB.api(
            "me?fields=birthday",
            function (response) {
              if (response && !response.error) {
                updateJsonAge(response.birthday,guest_id)
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
            version    : 'v2.11'
        });
            FB.login(function(response) {
                if (response.authResponse) {
                    //user just authorized your app
                    document.getElementById('loginBtn').style.display = 'none';
                    getUserData();
                }
            }, {scope: 'email,public_profile,user_birthday', return_scopes: true});
            //check user session and refresh it
            // FB.getLoginStatus(function(response) {
            //     if (response.status === 'connected') {
            //         //user is authorized
            //         document.getElementById('loginBtn').style.display = 'none';
            //         getUserData();
            //     } else {
            //         console.log('user is not authorized');
            //     }
            // });
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
    // window.onload =  function ()
    // {   
    //     document.addEventListener('click', function() { 
    //     //do the login
    //         FB.login(function(response) {
    //             if (response.authResponse) {
    //                 //user just authorized your app
    //                 document.getElementById('loginBtn').style.display = 'none';
    //                 getUserData();
    //             }
    //         }, {scope: 'email,public_profile,user_friends,user_birthday', return_scopes: true});
    //     }, false);  
    // }
    

    $(".loading").click(function() {
      $('#loading-start').show();
    });

</script>
@endsection
