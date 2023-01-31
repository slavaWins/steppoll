<?php

namespace Steppoll\Library;

use App\Models\User;
use MrProperter\Library\PropertyBuilderStructure;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;

class PollBaseStructure
{
    public int $stepCount = 3;

    public array $titles = [
        0 => 'Укажите ваш контакт',
        1 => 'Как вы назовете ваш первый проект?',
        2 => 'Для чего вы используйте',
    ];



    public function IsCan(?User $user)
    {
        if(!$user)return "Доступно только для пользователей";
        return true;
    }

    public function Complited(?User $user, array $data)
    {

        return redirect()->route("home")->withErrors('Опрос пройден!');
    }


    /**
     * @return PropertyConfigStructure
     */
    public function RenderStepInputs(int $step)
    {
        foreach ($this->GetPropsByStep($step) as $K => $V) {
            \MrProperter\Models\MPModel::BuildInputByStruct($K, $V, null);
        }
    }

    /**
     * @return PropertyBuilderStructure[]
     */
    public function GetPropsByStep(int $step)
    {
        $list = [];
        /**
         * @var  $K
         * @var  PropertyBuilderStructure $V
         */
        foreach ($this->GetSteps()->list as $K => $V) {

            if (in_array($step, $V->tags)) {
                $list[$K] = $V;
            }
        }
        return $list;
    }

    public function GetSteps()
    {

        $config = new PropertyConfigStructure(new MPModel());

        $config->String("phone")->SetLabel("Телефон")->SetValidationRule("required|string|min:10|max:10|regex:/^\d+(\.\d{1,2})?$/")->SetPrefix("+7")
            ->SetMin(10)->SetMax(10)->AddTag(0);

        $config->String("name")->SetLabel("Название проекта")->SetMin(2)->SetMax(312)->AddTag(1);

        $config->Select("companyType")->SetLabel("Кто вы?")->SetDescr("Для чего будет использоваться проект.")->SetOptions([
            'not' => "Не указано",
            'personal' => "Для себя",
            'company' => "Бизнес компания",
            'companyBig' => "Организация",
        ])
            ->SetDefault("not")->AddTag(2);
        return $config;
    }

}
