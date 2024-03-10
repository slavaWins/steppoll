<?php

namespace Steppoll\Library;

use MrProperter\Models\MPModel;
use Nette\Schema\ValidationException;

class PollAutoBaseStructure extends PollBaseStructure
{


    /**
     * @return string
     */
    public function GetModelClass()
    {
        return MPModel::class;
    }

  private function GetPropertyByStep($config, $step)
    {

       return collect($config->list)->first(function ( $prop) use ($step) {

            return isset($prop->tags[$step]);
        });
    }

    final function GetSteps()
    {
        $this->titles=[];

        $cl =  $this->GetModelClass();

        $config = (new  $cl())->PropertiesSetting();

        for ($step = 0; $step <= 10; $step++) {


            $prop = $this->GetPropertyByStep($config, $step);

            if (!$prop) break;

            $this->titles[$step] = $prop->label ?? $prop->name;
        }
        $this->stepCount = count($this->titles);

        if(empty($this->titles)){
            throw new \Exception("Нет тегов у инпутов в " . $this->GetModelClass().' добавьте теги AddTag([0]) в поля по порядку');
        }

        return $config;
    }

}
