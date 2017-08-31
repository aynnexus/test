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
                <?php   $feedback = json_decode($temp->Field->feedback_fields);

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
                <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=450&layout=standard&action=like&size=small&show_faces=true" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
            </div>
    
        </div>
    <img src="{{url('/storage/'.$temp->Profile->footer_image)}}" height="250px" width="100%">
</body>
<script type="text/javascript">
    
</script>
@endsection
