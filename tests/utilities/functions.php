<?php

function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}

function raw($class, $attributes = [])
{
    return factory($class)->raw($attributes);
}
