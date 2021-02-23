<?php
declare(strict_types=1);

/**
 * This file is part of the PHP-VAST package.
 *
 * (c) Dmytro Sokil <dmytro.sokil@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sokil\Vast\Creative\InLine\CompanionAds;

use DomElement;

class Companion
{

    /**
     * @var DomElement
     */
    private $domElement;

    /**
     * @param DomElement $domElement
     */
    public function __construct(DomElement $domElement)
    {
        $this->domElement = $domElement;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setId(string $value): self
    {
        $this->domElement->setAttribute('id', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCreativeType(string $value): self
    {
        $this->domElement->setAttribute('creativeType', $value);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): self
    {
        $cdata = $this->domElement->ownerDocument->createCDATASection($value);
        if ($this->domElement->hasChildNodes()) {
            $this->domElement->replaceChild($cdata, $this->domElement->firstChild);
        } else {
            $this->domElement->appendChild($cdata);
        }
        return $this;
    }

}
