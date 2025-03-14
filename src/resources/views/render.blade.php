@php

    use Steppoll\Library\PollBaseStructure;

        /** @var PollBaseStructure $poll */


@endphp

<script src="{{ asset('js/pollstep/pollstep.js') }}"></script>

<div class="poll__{{$stepClass}}">

    @include("steppoll::step-counter")

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


    <div class=" col-12   mt-2 mb-2  alertPoll  p-2" style="display: none; color: #ff2f00; font-size: 0.8em;"></div>


    <div class="row m-0" style="    gap: 0.5em;">
        @if($poll->btnCancelName)
            <div class="col p-0">
                <a class="btn btn-primary btn-gray   float-end btnNextStep stepPoll_btn col-12 mb-2"
                   href="{{$poll->btnCancelUrl}}">{{$poll->btnCancelName}}</a>
            </div>
        @endif
        <div class="col  p-0">
            <a class="btn btn-primary   float-end btnNextStep stepPoll_btn col-12 mb-2"
               onclick="StepPoll.NextStep()">{{$poll->btnNextName}}</a>
        </div>
    </div>


</div>
