<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use CatLab\Charon\Collections\RouteCollection;
use CatLab\Charon\Laravel\InputParsers\JsonBodyInputParser;
use CatLab\Charon\Swagger\SwaggerBuilder;

/**
 * Class DescriptionController
 * @package App\Http\Api\V1\Controllers
 */
class DescriptionController extends Controller
{
    use \CatLab\Charon\Laravel\Controllers\ResourceController;

    /**
     * @return RouteCollection
     */
    public function getRouteCollection() : RouteCollection
    {
        return include __DIR__ . '/../routes.php';
    }

    /**
     * @param $format
     * @return \Illuminate\Http\Response
     * @throws \CatLab\Charon\Exceptions\RouteAlreadyDefined
     */
    public function description($format)
    {
        switch ($format) {
            case 'txt':
            case 'text':
                return $this->textResponse();
                break;

            case 'json':
                return $this->swaggerResponse();
                break;
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function textResponse()
    {
        $routes = $this->getRouteCollection();
        return \Response::make($routes->__toString(), 200, [ 'Content-type' => 'text/text' ]);
    }

    /**
     * @return mixed
     * @throws \CatLab\Charon\Exceptions\RouteAlreadyDefined
     */
    protected function swaggerResponse()
    {
        $builder = new SwaggerBuilder(Request::getHttpHost(), '/');

        $builder
            ->setTitle('Charon Amazing Discount Calculator API')
            ->setDescription('Calculates discount')
            ->setContact('CatLab Interactive', 'http://www.catlab.eu/', 'thijs@catlab.be')
            ->setVersion('1.0');

        /*
        $oauth2 = new OAuth2Authentication('oauth2');
        $oauth2
            ->setAuthorizationUrl(url('oauth/authorize'))
            ->setFlow('implicit')
            ->addScope('full', 'Full access')
        ;

        $builder->addAuthentication($oauth2);
        */

        foreach ($this->getRouteCollection()->getRoutes() as $route) {
            $builder->addRoute($route);
        }

        return $builder->build($this->getContext());
    }

    /**
     * Set the input parsers that will be used to turn requests into resources.
     * @param \CatLab\Charon\Models\Context $context
     */
    protected function setInputParsers(\CatLab\Charon\Models\Context $context)
    {
        $context->addInputParser(JsonBodyInputParser::class);

        // Don't include PostInputParser.
        // $context->addInputParser(PostInputParser::class);
    }
}