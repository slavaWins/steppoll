<?php

namespace Steppoll\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResponseApi;
use App\Polls\ExamplePoll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MrProperter\Models\MPModel;
use Steppoll\Library\PollBaseStructure;
use Illuminate\Support\Facades\Log;

class StepPollController extends Controller
{

    /**
     * @param $name
     * @return PollBaseStructure|null
     */
    public static function GetPollByClass($stepClass)
    {
        $stepClass = '\App\Polls\\' . basename($stepClass);
        if (!class_exists($stepClass)) return null;


        /** @var PollBaseStructure $poll */
        $poll = new $stepClass();

        return $poll;
    }

    public static function ValidatePoll(PollBaseStructure $poll, $stepNumber, $data, $isComplite = false)
    {
        $stepNumber = intval($stepNumber);
        if ($stepNumber > $poll->stepCount) return "Ошибка шага";


        $validateRules = [];
        $validateLabels = [];

        $list = [];
        if (!$isComplite) {
            $list = $poll->GetPropsByStep($stepNumber);
        } else {
            $list = $poll->GetSteps()->list;
        }

        foreach ($list as $K => $prop) {
            $validateRules[$K] = MPModel::RenderValidateRuleByPropertyData($prop, true);
            $validateLabels[$K] = $prop->label ?? $K;
        }

        $validator = Validator::make($data, $validateRules, [], $validateLabels);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        return null;
    }

    public function Complete($stepClass, Request $request)
    {

        $poll = self::GetPollByClass($stepClass);
        if (!$poll) return ResponseApi::Error("Error poll id");


        $isError = self::ValidatePoll($poll, 0, $request->toArray(), true);

        if ($isError) return ResponseApi::Error($isError);

        $data = $request->toArray();
        unset($data['_token']);
        unset($data['myStepNumber']);

        return $poll->Complited(Auth::user() ?? null, $data);
    }


    public function validateStepData($stepClass, Request $request)
    {
        $poll = self::GetPollByClass($stepClass);
        if (!$poll) return ResponseApi::Error("Error poll id");


        $myStepNumber = max(0, intval($request->input('myStepNumber') ?? 0));


        $isError = self::ValidatePoll($poll, $myStepNumber, $request->toArray());

        if ($isError) return ResponseApi::Error($isError);


        return ResponseApi::Successful("ok");
    }

    public function index($stepClass)
    {
        $poll = self::GetPollByClass($stepClass);
        if (!$poll) return redirect()->back();

        return view('step-poll.page', compact(['poll']));
    }
}
