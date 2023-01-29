<?php

namespace App\Polls;

use App\Contracts\StepPoll\PollBaseStructure;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;

class ExamplePoll extends PollBaseStructure
{
    public $name = "Сарт";
    public int $stepCount = 2;
    public array $titles = [
        0 => 'Укажите ваш контакт',
        1 => 'Как вы назовете ваш первый проект?',
        2 => 'Для чего вы используйте',
    ];

    public function Complited(?User $user)
    {
        log::info("Complited!");

        return redirect()->route("home")->withErrors($user->name .' OK!');
    }


    public function GetSteps()
    {

        $config = new PropertyConfigStructure(new MPModel());


        $config->String("name")->SetLabel("Название проекта")->SetMin(2)->SetMax(312)->AddTag(0);


        $config->Select("companyType")->SetLabel("Кто вы?")->SetDescr("Для чего будет использоваться проект.")->SetOptions([
            'not' => "Не указано",
            'personal' => "Для себя",
            'company' => "Бизнес компания",
            'companyBig' => "Организация",
        ])
            ->SetDefault("not")->AddTag(1);


        return $config;
    }

}
