<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class GeometryObjectFactory
{
    /**
     * @throws NotImplementedException
     * @throws InvalidPositionException
     */
    public static function createForGeoJsonFeatureGeometry(array $featureGeometry): ?GeometryObject
    {
        return match ($featureGeometry['type']) {
            'LineString' => self::createForLineStringCoordinates($featureGeometry['coordinates']),
            'MultiLineString' => self::createForMultiLineStringCoordinates($featureGeometry['coordinates']),
            'MultiPoint' => self::createForMultiPointCoordinates($featureGeometry['coordinates']),
            'MultiPolygon' => self::createForMultiPolygonCoordinates($featureGeometry['coordinates']),
            'Point' => self::createForPointCoordinates($featureGeometry['coordinates']),
            'Polygon' => self::createForPolygonCoordinates($featureGeometry['coordinates']),
            default => throw new NotImplementedException('Feature geometries of type "' . $featureGeometry['type'] . '" are currently not supported')
        };
    }

    /**
     * @throws InvalidPositionException
     */
    public static function createForLineStringCoordinates(array $coordinates): LineString
    {
        $lineString = new LineString();
        foreach ($coordinates as $coordinate) {
            $lineString->addPosition(new Position($coordinate[0], $coordinate[1], $coordinate[2] ?? null));
        }

        return $lineString;
    }

    /**
     * @throws InvalidPositionException
     */
    public static function createForMultiLineStringCoordinates(array $coordinates): MultiLineString
    {
        $multiLineString = new MultiLineString();
        foreach ($coordinates as $lineStringCoordinates) {
            $multiLineString->addLineString(self::createForLineStringCoordinates($lineStringCoordinates));
        }

        return $multiLineString;
    }

    public static function createForMultiPointCoordinates(array $coordinates): MultiPoint
    {
        throw new NotImplementedException('Creating multiPoints is not supported yet');
    }

    /**
     * @throws InvalidPositionException
     */
    public static function createForMultiPolygonCoordinates(array $coordinates): MultiPolygon
    {
        $multiPolygon = new MultiPolygon();
        foreach ($coordinates as $polygonCoordinates) {
            $polygon = self::createForPolygonCoordinates($polygonCoordinates);
            if (null === $polygon) {
                continue;
            }

            $multiPolygon->addPolygon($polygon);
        }

        return $multiPolygon;
    }

    /**
     * @throws InvalidPositionException
     */
    public static function createForPointCoordinates(array $coordinates): Point
    {
        return new Point(new Position($coordinates[0], $coordinates[1], $coordinates[2] ?? null));
    }

    /**
     * @throws InvalidPositionException
     */
    public static function createForPolygonCoordinates(array $coordinates): ?Polygon
    {
        $exteriorCoordinates = array_shift($coordinates);
        if (null === $exteriorCoordinates) {
            return null;
        }

        $polygon = new Polygon(self::createForLineStringCoordinates($exteriorCoordinates));
        foreach ($coordinates as $lineStringData) {
            $polygon->addInteriorRing(self::createForLineStringCoordinates($lineStringData));
        }

        return $polygon;
    }
}
