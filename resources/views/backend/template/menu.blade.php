<?php
$one_done = $step > 0 ? 'done' : '';
$two_done = $step > 1 ? 'done' : '';
$three_done = $step > 2 ? 'done' : '';
$four_done = $step > 3 ? 'done' : ''; 
$five_done = $step > 4 ? 'done' : ''; 

?>

<ul class="app-menu">
    <?php $id = isset($id) ? $id : '';?>
    <li>
        <a href="{!! url('dashboard/template/step_one/'.$id) !!}"
           class="{!! Request::is('dashboard/template/step_one/'.$id) ? 'active' : '' !!} {!!$one_done!!}">
            <div class="menu-tab">S</div>
            <span>Tag Sites</span>
        </a>
    </li>
    <li class="{!!$step > 0 ?"":"pn"!!}">
    <a href="{!!url('dashboard/template/step_two/'.$id)!!}"
           class="{!! Request::is('dashboard/template/step_two/'.$id) ? 'active' : '' !!} {!!$two_done!!}">
            <div class="menu-tab">F</div>
            <span>Template Fields</span>
        </a>
    </li>
    <li class="{!!$step > 1 ?"":"pn"!!}">
        <a href="{!!url('dashboard/template/step_three/'.$id)!!}"
           class="{!! Request::is('dashboard/template/step_three/'.$id) ? 'active' : '' !!} {!!$three_done!!}">
            <div class="menu-tab">I</div>
            <span>Template Image</span>
        </a>
    </li>
    <li class="{!!$step > 2 ?"":"pn"!!}">
        <a href="{!!url('dashboard/template/step_four/'.$id)!!}"
           class="{!! Request::is('dashboard/template/step_four/'.$id) ? 'active' : '' !!} {!!$four_done!!}">
            <div class="menu-tab">F</div>
            <span>Feedback</span>
        </a>
    </li>
    <li class="{!!$step > 2 ?"":"pn"!!}">
        <a href="{!!url('dashboard/template/step_five/'.$id)!!}"
           class="{!! Request::is('dashboard/template/step_five/'.$id) ? 'active' : '' !!} {!!$five_done!!}">
            <div class="menu-tab">A</div>
            <span>Ads</span>
        </a>
    </li>
    <li class="{!!$step > 2 ?"":"pn"!!}">
        <a href="{!!url('dashboard/template/preview/'.$id)!!}"
           class="{!! Request::is('dashboard/template/preview/'.$id) ? 'active' : '' !!} {!!$five_done!!}">
            <div class="menu-tab">P</div>
            <span>Preview</span>
        </a>
    </li>
    
</ul>
