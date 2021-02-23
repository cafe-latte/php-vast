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

namespace Sokil\Vast\Ad;

use Sokil\Vast\Creative\AbstractCreative;
use Sokil\Vast\Creative\InLine\CompanionAds as CompanionAdsCreative;
use Sokil\Vast\Creative\InLine\Linear as InLineAdLinearCreative;
use Sokil\Vast\Creative\Wrapper\Linear as WrapperAdLinearCreative;

class CompanionAds extends AbstractAdNode
{
    /**
     * @public
     */
    const TAG_NAME = 'Wrapper';

    /**
     * @private
     */
    const CREATIVE_TYPE_COMPANION_ADS = 'CompanionAds';

    /**
     * @return string
     */
    public function getAdSubElementTagName(): string
    {
        return self::TAG_NAME;
    }

    /**
     * URI of ad tag of downstream Secondary Ad Server
     *
     * @param string $uri
     *
     * @return Wrapper
     */
    public function setVASTAdTagURI(string $uri): self
    {
        $this->setScalarNodeCdata('VASTAdTagURI', $uri);

        return $this;
    }

    /**
     * @return string[]
     */
    protected function getAvailableCreativeTypes(): array
    {
        return [
            self::CREATIVE_TYPE_COMPANION_ADS,
        ];
    }

    /**
     * @param string $type
     * @param \DOMElement $creativeDomElement
     *
     * @return AbstractCreative|WrapperAdLinearCreative
     */
    protected function buildCreativeElement(string $type, \DOMElement $creativeDomElement): AbstractCreative
    {
        switch ($type) {
            case self::CREATIVE_TYPE_COMPANION_ADS:
              $creative = $this->vastElementBuilder->createInLineCompanionAdsAdLinearCreative($creativeDomElement);
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown Wrapper creative type %s', $type));
        }

        return $creative;
    }

    public function createCompanionAdsCreative(): CompanionAdsCreative
    {
      /** @var InLineAdLinearCreative $creative */
      $creative = $this->buildCreative(self::CREATIVE_TYPE_COMPANION_ADS);

      return $creative;
    }
}
