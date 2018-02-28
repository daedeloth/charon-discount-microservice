<?php

namespace App\Http\Api;

use CatLab\Charon\Laravel\InputParsers\JsonBodyInputParser;
use \Request;

/*
 * Remember that middleware I was talking about earlier?
 * (You should really read these in order of commit)
 * Since I didn't manage to set the raw body in the middleware,
 * I set the raw json body in an attribute, which I'm reading here.
 */

/**
 * Class TeamleaderInputParser
 * @package App\Http\Api
 */
class TeamleaderInputParser extends JsonBodyInputParser
{
    /**
     * @return bool|string
     */
    protected function getRawContent()
    {
        $request = Request::instance();

        if ($request->attributes->get('teamleader-input-body')) {
            return $request->attributes->get('teamleader-input-body');
        };

        return parent::getRawContent();
    }
}