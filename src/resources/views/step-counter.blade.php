 <small class="float-end stepPoll_steps">
    ШАГ <span class="stepNumber">1</span> / <span class="stepCount">{{$poll->stepCount}}</span>
</small>
 @if($poll->stepCount==1)
     <style>.stepPoll_steps{
             display:none !important;
         }
     </style>
 @endif
