<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Factory;

use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\HTML\Elements\CircleElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Element;
use PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\HTML\Elements\TitleElement;
use PrinsFrank\PhpGeoSVG\HTML\Rendering\PathShapeRenderer;

class ElementFactory
{
    /**
     * @throws NotImplementedException
     */
    public static function buildForGeometryCollection(GeometryCollection $geometryCollection, Coordinator $coordinator): Element
    {
        $svgElement = (new SvgElement())
            ->setAttribute('width', $coordinator->getWidth())
            ->setAttribute('height', $coordinator->getHeight())
            ->setAttribute('viewbox', '0 0 ' . $coordinator->getWidth() . ' ' . $coordinator->getHeight());

        foreach ($geometryCollection->getGeometryObjects() as $geometryObject) {
            $svgElement->addChildElement(self::buildForGeometryObject($geometryObject, $coordinator));
        }

        return $svgElement;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForGeometryObject(GeometryObject $geometryObject, Coordinator $coordinator): Element
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

        if ($geometryObject instanceof LineString) {
            $element->setAttribute('d', PathShapeRenderer::renderLineStringPath($geometryObject, $coordinator));
        } else {
            throw new NotImplementedException();
        }

        if ($geometryObject->getTitle() !== null) {
            $element->addChildElement((new TitleElement())->setTextContent(new TextContent($geometryObject->getTitle())));
        }

        return $element;
    }
}