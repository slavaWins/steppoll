@php

    use App\Contracts\StepPoll\PollBaseStructure;

    /** @var PollBaseStructure $poll */

   $poll= new \App\Polls\ExamplePoll();

@endphp

<script src="{{ asset('js/pollstep/pollstep.js') }}"></script>

<small class="float-end">Шаг <b class="stepNumber">1</b> / <b class="stepCount">{{$poll->stepCount}}</b></small>
<span class="pollId" pollId="{{basename(get_class($poll))}}"></span>

<form method="POST" id="formFinal" action="{{ route('poll.complete', basename(get_class($poll))) }}">
    @csrf
</form>
<div class="stepPollContainer">
    @for($i=0; $i<$poll->stepCount;$i++)
        <form class=" stepPoll stepPoll_{{$i}}" style="@php if($i>0)echo 'display: none;'; @endphp">
            <h3> {{$poll->titles[$i]}}</h3>
            {{$poll->RenderStepInputs($i)}}
        </form>
    @endfor
</div>
<BR>
<a class="btn btn-outline-dark float-end btnNextStep col-12 mb-2" onclick="StepPoll.NextStep()">Далее</a>


<div class=" col-12   mt-2 mb-2  alertPoll  p-2" style="display: none; color: #ff2f00;"></div>

