<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function currentUserId()
{
    return auth()->user()->uuid;
}