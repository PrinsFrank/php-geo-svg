<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Factory;

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
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObjectCallback;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Html\Elements\CircleElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\Element;
use PrinsFrank\PhpGeoSVG\Html\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\Html\Elements\TitleElement;
use PrinsFrank\PhpGeoSVG\Html\Rendering\PathShapeRenderer;

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
            $svgElement->addChildElement(self::buildForGeometryObject($geometryObject, $coordinator, $geometryCollection->getGeometryObjectCallback()));
        }

        return $svgElement;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForGeometryObject(GeometryObject $geometryObject, Coordinator $coordinator, GeometryObjectCallback $geometryObjectCallback = null): Element
    {
        $element = match (get_class($geometryObject)) {
            LineString::class => self::buildForLineString($geometryObject, $coordinator),
            MultiPoint::class => self::buildForMultiPoint($geometryObject, $coordinator),
            MultiPolygon::class => self::buildForMultiPolygon($geometryObject, $coordinator),
            MultiLineString::class => self::buildForMultiLineString($geometryObject, $coordinator),
            Polygon::class => self::buildForPolygon($geometryObject, $coordinator),
            Point::class => self::buildForPoint($geometryObject, $coordinator),
            default => throw new NotImplementedException('GeometryObject with class "' . get_class($geometryObject) . '" can\'t be built yet.')
        };

        if (null !== $geometryObject->getTitle()) {
            $element->addChildElement((new TitleElement())->setTextContent(new TextContent($geometryObject->getTitle())));
        }

        if (null !== $geometryObject->getFeatureClass()) {
            $element->setAttribute('data-feature-class', $geometryObject->getFeatureClass());
        }

        if(!is_null($geometryObjectCallback)) {
            $geometryObjectCallback->__invoke($geometryObject, $element);
        }

        return $element;
    }

    public static function buildForLineString(LineString $lineString, Coordinator $coordinator): PathElement
    {
        return (new PathElement())
            ->setAttribute('d', PathShapeRenderer::renderLineStringPath($lineString, $coordinator));
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForMultiPoint(MultiPoint $multiPoint, Coordinator $coordinator): GroupElement
    {
        $element = new GroupElement();
        foreach ($multiPoint->getPoints() as $point) {
            $element->addChildElement(self::buildForGeometryObject($point, $coordinator));
        }

        return $element;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForMultiPolygon(MultiPolygon $multiPolygon, Coordinator $coordinator): GroupElement
    {
        $element = new GroupElement();
        foreach ($multiPolygon->getPolygons() as $polygon) {
            $element->addChildElement(self::buildForGeometryObject($polygon, $coordinator));
        }

        return $element;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForMultiLineString(MultiLineString $multiLineString, Coordinator $coordinator): GroupElement
    {
        $element = new GroupElement();
        foreach ($multiLineString->getLineStrings() as $lineString) {
            $element->addChildElement(self::buildForGeometryObject($lineString, $coordinator));
        }

        return $element;
    }

    /**
     * @throws NotImplementedException
     */
    public static function buildForPolygon(Polygon $polygon, Coordinator $coordinator): Element
    {
        $element = new GroupElement();
        $element->addChildElement(self::buildForGeometryObject($polygon->getExteriorRing(), $coordinator));
        foreach ($polygon->getInteriorRings() as $interiorRing) {
            $element->addChildElement(self::buildForGeometryObject($interiorRing, $coordinator));
        }

        return $element;
    }

    public static function buildForPoint(Point $point, Coordinator $coordinator): CircleElement
    {
        return self::buildForPosition($point->getPosition(), $coordinator);
    }

    public static function buildForPosition(Position $position, Coordinator $coordinator): CircleElement
    {
        $element = new CircleElement();
        $element->setAttribute('cy', $coordinator->getY($position));
        $element->setAttribute('cx', $coordinator->getX($position));

        return $element;
    }
}
