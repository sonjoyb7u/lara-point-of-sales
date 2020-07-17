<?php

function getMessage($type, $message) {
    session()->flash('type', $type);
    session()->flash('message', $message);

}


