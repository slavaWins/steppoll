<?php

namespace Steppoll\Library;

use MrProperter\Library\PropertyBuilderStructure;
use MrProperter\Models\MPModel;

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

        return collect($config->list)->first(function ($prop) use ($step) {

            return isset($prop->tags[$step]);
        });
    }

    final function GetSteps()
    {
        $this->titles = [];

        $cl = $this->GetModelClass();

        $config = (new  $cl())->PropertiesSetting();

        $step = 0;

        $keys=  [];
        $stopAdding = false;
        for ($step = 0; $step < count($config->list); $step++) {

            /** @var  PropertyBuilderStructure $prop */
            $prop = $this->GetPropertyByStep($config, $step);

            if (!$prop) break;

            $keys[]= $prop->name;
            $prop->tags = [];
            $prop->tags[$step] = $step;

            $this->titles[$step] = $prop->label ?? $prop->name;
        }
        $this->stepCount = count($this->titles);

        foreach ($config->list as $K=>$V){
            if(!in_array($K, $keys)){
                unset($config->list[$K]);
            }
        }
        if (empty($this->titles)) {
            throw new \Exception("Нет тегов у инпутов в " . $this->GetModelClass() . ' добавьте теги AddTag([0]) в поля по порядку');
        }

        return $config;
    }

}
