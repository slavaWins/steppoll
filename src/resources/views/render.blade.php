@php

    use Steppoll\Library\PollBaseStructure;

        /** @var PollBaseStructure $poll */


@endphp

<script src="{{ asset('js/pollstep/pollstep.js') }}"></script>

<small class="float-end stepPoll_steps">
    ШАГ <span class="stepNumber">1</span> / <span class="stepCount">{{$poll->stepCount}}</span>
</small>

<span class="pollId" pollId="{{$stepClass}}"></span>

<form method="POST" id="formFinal" action="{{ route('poll.complete', $stepClass) }}">
    @csrf
</form>

<div class="stepPollContainer">
    @for($i=0; $i<$poll->stepCount;$i++)
        <form class=" stepPoll stepPoll_{{$i}}" style="@php if($i>0)echo 'display: none;'; @endphp"
              onsubmit="event.preventDefault(); StepPoll.NextStep(); return false;">
            <h3> {{$poll->titles[$i]}}</h3>
            {{$poll->RenderStepInputs($i)}}
        </form>
    @endfor
</div>
<BR>
<a class="btn btn-outline-dark float-end btnNextStep stepPoll_btn col-12 mb-2" onclick="StepPoll.NextStep()">Далее</a>


<div class=" col-12   mt-2 mb-2  alertPoll  p-2" style="display: none; color: #ff2f00;"></div>

