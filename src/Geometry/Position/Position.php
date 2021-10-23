<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\Position;

use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;

class Position
{
    public const MIN_LONGITUDE   = -180;
    public const MAX_LONGITUDE   = 180;
    public const TOTAL_LONGITUDE = self::MAX_LONGITUDE - self::MIN_LONGITUDE;

    public const MIN_LATITUDE   = -90;
    public const MAX_LATITUDE   = 90;
    public const TOTAL_LATITUDE = self::MAX_LATITUDE - self::MIN_LATITUDE;

    /**
     * The coordinate reference system for all GeoJSON coordinates is a
     * geographic coordinate reference system, using the World Geodetic
     * System 1984 (WGS 84) [WGS84] datum, with longitude and latitude units
     * of decimal degrees.  This is equivalent to the coordinate reference
     * system identified by the Open Geospatial Consortium (OGC) URN
     * urn:ogc:def:crs:OGC::CRS84.  An OPTIONAL third-position element SHALL
     * be the height in meters above or below the WGS 84 reference
     * ellipsoid.  In the absence of elevation values, applications
     * sensitive to height or depth SHOULD interpret positions as being at
     * local ground or sea level
     *
     * @throws InvalidPositionException
     */
    public function __construct(public float $longitude, public float $latitude, public ?float $elevation = null)
    {
        if ($this->longitude > self::MAX_LONGITUDE || $this->longitude < self::MIN_LONGITUDE) {
            throw new InvalidPositionException('The longitude should be between ' . self::MIN_LONGITUDE . ' and ' . self::MAX_LONGITUDE . ', "' . $this->longitude . '" provided.');
        }

        if ($this->latitude > self::MAX_LATITUDE || $this->latitude < self::MIN_LATITUDE) {
            throw new InvalidPositionException('The latitude should be between ' . self::MIN_LATITUDE . ' and ' . self::MAX_LATITUDE . ', "' . $this->latitude . '" provided.');
        }
    }

    public function hasElevation(): bool
    {
        return $this->elevation !== null;
    }
}