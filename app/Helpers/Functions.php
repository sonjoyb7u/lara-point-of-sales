<?php

function getMessage($type, $message) {
    session()->flash('type', $type);
    session()->flash('message', $message);
}

// PURCHASE STATUS function...
function orderStatus() {
    $o_status = [
        'pending',
        'approved',
        'return',
    ];
    return $o_status;
}

// PURCHASE STATUS COLOR css...
function randomStatusColor($status) {
    $color = [
        'pending' => 'badge-warning',
        'approved' => 'badge-success',
        'return' => 'badge-danger',

    ];
    return $color[$status];
}


