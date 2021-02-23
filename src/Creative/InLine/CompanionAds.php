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

namespace Sokil\Vast\Creative\InLine;


use DOMElement;
use Sokil\Vast\Creative\AbstractCompanionAdsCreative;
use Sokil\Vast\Creative\InLine\CompanionAds\Companion;

class CompanionAds extends AbstractCompanionAdsCreative
{
    /**
     * @var DOMElement
     */
    private $companionAdsDomElement;

    /**
     * @var DOMElement
     */
    private $companionsTrackingEvents;


    /**
     * @return DOMElement
     */
    private function getCompanionElement(): DOMElement
    {
        if (empty($this->companionAdsDomElement)) {
            $this->companionAdsDomElement = $this->getDomElement()->getElementsByTagName('Companion')->item(0);
            if (!$this->companionAdsDomElement) {
                $this->companionAdsDomElement = $this->getDomElement()->ownerDocument->createElement('Companion');
                $this->getDomElement()->getElementsByTagName('CompanionAds')->item(0)->appendChild($this->companionAdsDomElement);
            }
        }

        return $this->companionAdsDomElement;
    }

    /**
     * @return DOMElement
     */
    private function getCompanionsTrackingEventsElement(): DOMElement
    {
      if (empty($this->companionsTrackingEvents)) {
        $this->companionsTrackingEvents = $this->getDomElement()->getElementsByTagName('TrackingEvents')->item(0);
        if (!$this->companionsTrackingEvents) {
          $this->companionsTrackingEvents = $this->getDomElement()->ownerDocument->createElement('TrackingEvents');
          $this->getDomElement()->getElementsByTagName('Companion')->item(0)->appendChild($this->companionsTrackingEvents);
        }
      }

      return $this->companionsTrackingEvents;
    }


    /**
     * @return Companion
     */
    public function createCompanion(): Companion
    {
        $companionsDomElement = $this->getCompanionElement();

        $companionDomElement = $companionsDomElement->ownerDocument->createElement('StaticResource');
        $companionsDomElement->appendChild($companionDomElement);

        return $this->vastElementBuilder->createInLineAdCompanionAdsCreativeCompanion($companionDomElement);
    }

    /**
     * @return Companion
     */
    public function createTrackingEvents(): Companion
    {
      $companionsDomElement = $this->getCompanionElement();

      $companionDomElement = $companionsDomElement->ownerDocument->createElement('TrackingEvents');
      $companionsDomElement->appendChild($companionDomElement);

      return $this->vastElementBuilder->createInLineAdCompanionAdsCreativeCompanion($companionDomElement);
    }

    /**
     * @param $event
     * @return Companion
     */
    public function createTrackingEventsaa($event): Companion
    {
      $companionsDomElement = $this->getCompanionsTrackingEventsElement();

      $companionDomElement = $companionsDomElement->ownerDocument->createElement('Tracking');
      $companionsDomElement->appendChild($companionDomElement);
      $companionDomElement->setAttribute('event', $event);

      return $this->vastElementBuilder->createInLineAdCompanionAdsCreativeCompanion($companionDomElement);
    }

    /**
     * @return Companion
     */
    public function createCompanionClickThrough(): Companion
    {
      $companionsDomElement = $this->getCompanionElement();

      $companionDomElement = $companionsDomElement->ownerDocument->createElement('CompanionClickThrough');
      $companionsDomElement->appendChild($companionDomElement);

      return $this->vastElementBuilder->createInLineAdCompanionAdsCreativeCompanion($companionDomElement);
    }

    /**
     * Set 'id' attribute of 'creative' element
     *
     * @param string $id
     *
     * @return Linear
     */
    public function setId(string $id): self
    {
      $this->getDomElement()->setAttribute('id', $id);

      return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setWidth(string $value): self
    {
      $this->getCompanionElement()->setAttribute('width', $value);

      return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setHeight(string $value): self
    {
      $this->getCompanionElement()->setAttribute('height', $value);

      return $this;
    }


}
