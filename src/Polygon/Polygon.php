<?php

namespace PrinsFrank\PhpGeoSVG\Polygon;

use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class Polygon
{
    /** @var array<Vertex> */
    public array $vertices;

    public function addVertex(Vertex $vertex): self
    {
        $this->vertices[] = $vertex;

        return $this;
    }
}
