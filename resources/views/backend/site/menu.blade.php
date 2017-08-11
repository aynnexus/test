<?php
$one_done = $step > 0 ? 'done' : '';
$two_done = $step > 1 ? 'done' : '';
$three_done = $step > 2 ? 'done' : '';
$four_done = $step > 3 ? 'done' : ''; 
?>

<ul class="app-menu">
    <?php $id = isset($id) ? $id : '';?>
    <li>
        <a href="{!! url('dashboard/sites/step_one/'.$id) !!}"
           class="{!! Request::is('factory/application/step_one/'.$id) ? 'active' : '' !!} {!!$one_done!!}">
            <div class="menu-tab">I</div>
            <span>Site Information</span>
        </a>
    </li>
    <li class="{!!$step > 0 ?"":"pn"!!}">
        <a href="{!!url('dashboard/sites/step_two/'.$id)!!}"
           class="{!! Request::is('factory/application/step_two/'.$id) ? 'active' : '' !!} {!!$two_done!!}">
            <div class="menu-tab">F</div>
            <span>Validation Fields</span>
        </a>
    </li>
    <li class="{!!$step > 1 ?"":"pn"!!}">
        <a href="{!!url('dashboard/sites/step_three/'.$id)!!}"
           class="{!! Request::is('factory/application/step_three/'.$id) ? 'active' : '' !!} {!!$three_done!!}">
            <div class="menu-tab">I</div>
            <span>Site Image</span>
        </a>
    </li>
    <li class="{!!$step > 2 ?"":"pn"!!}">
        <a href="{!!url('dashboard/sites/step_four/'.$id)!!}"
           class="{!! Request::is('factory/application/step_four/'.$id) ? 'active' : '' !!} {!!$four_done!!}">
            <div class="menu-tab">P</div>
            <span>Preview</span>
        </a>
    </li>
</ul>
