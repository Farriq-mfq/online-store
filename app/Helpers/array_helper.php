<?php 
    function pick(array $data,array $pick):array{
        return array_intersect_key($data,array_flip($pick));
    }


    function batch_convert(array $data,array $merge = []):array{
        $batch = [];
        foreach ($data as $key => $value) {
            if(is_array($value)){
                for($i = 0; $i < count($value);$i++) {
                    $batch[$i][$key] = $value[$i];
                }
            }else{
                $batch[] = $value;
            }
        }
        if(count($merge)){
            foreach($batch as $merge_key => $merge_batch){
                $batch[$merge_key] = array_merge($merge_batch,$merge);
            }
        }
        return $batch;
    }

    function show_array_contains(array $array,$contains):array{
        $result = [];
        foreach (array_keys($array) as $val) {
            if(str_contains($val,$contains)){
                $result[] = $val;
            }
        }
        return $result;
    }