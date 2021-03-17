<?php
namespace App\Http\Traits;

use App\Brand;

trait StatusTrait {

    # set success Status
    protected $successStatus = '200';

    # set failed Status
    protected $failedStatus = '401';
}