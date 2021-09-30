<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Factory;

use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\HTML\Elements\CircleElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Element;
use PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\HTML\Elements\TitleElement;

class ElementFactory
{
    /**
     * @throws NotImplementedException
     */
    public static function buildForGeometryCollection(GeometryCollection $geometryCollection): Element
    {
        $svgElement = (new SvgElement())
            ->setAttribute('width', 360)
            ->setAttribute('height', 180)
            ->setAttribute('viewbox', '0 0 360 180');

        foreach ($geometryCollection->getGeometryObjects() as $geometryObject) {
            $svgElement->addChildElement(self::buildForGeometryObject($geometryObject));
        }

        return $svgElement;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForGeometryObject(GeometryObject $geometryObject): Element
    {
        $element = match(get_class($geometryObject)) {
            LineString::class => new PathElement(),
            MultiPoint::class,
            MultiPolygon::class,
            MultiLineString::class,
            Polygon::class => new GroupElement(),
            Point::class => new CircleElement(),
            default => throw new NotImplementedException()
        };

        if ($geometryObject->getTitle() !== null) {
            $element->addChildElement((new TitleElement())->setTextContent(new TextContent($geometryObject->getTitle())));
        }

        return $element;
    }
}