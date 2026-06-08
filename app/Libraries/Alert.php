<?php

namespace App\Libraries;

class Alert {

    private array $errorMessage = [
        'filtersuccess' => 'Access granted.',
        'filterdanger' => 'You must be logged in to access this page.',
    ];

    public function setMessages(array $messages): void
    {
        $this->errorMessage = array_merge($this->errorMessage, $messages);
    }

    public function makeMessage($status, $type) {
        $result = new \stdClass();
        if($status) {
            $result->class = "success";
            $shortType = $type."success";
        } else {
            $result->class = "danger";
            $shortType = $type."danger";
        }
        $result->message = $this->errorMessage[$shortType] ?? 'Unexpected alert message.';
        return $result;
    }
}

?>