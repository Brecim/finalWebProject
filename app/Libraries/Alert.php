<?php

namespace App\Libraries;

class Alert {

    public function makeMessage($status, $type) {
        $result = new \stdClass();
        if($status) {
            $result->class = "success";
            $shortType = $type."success";
        } else {
            $result->class = "danger";
            $shortType = $type."danger";
        }
        $result->message = $this->config->errorMessage[$shortType];
        return $result;
    }
}

?>