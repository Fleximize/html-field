<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license MIT
 */

namespace craft\htmlfield;

use Craft;
use Twig\Markup;

/**
 * Stores the HTML field data.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 1.0.0
 */
class HtmlFieldData extends Markup
{
    protected string $rawContent;
    protected ?int $siteId;

    /**
     * Constructor
     *
     * @param string $content
     * @param int|null $siteId
     */
    public function __construct(string $content, ?int $siteId = null)
    {
        // Save the raw content in case we need it later
        $this->rawContent = $content;
        $this->siteId = $siteId;

        // Parse the ref tags
        $content = Craft::$app->getElements()->parseRefs($content, $siteId);

        parent::__construct($content, Craft::$app->charset);
    }

    /**
     * Returns the raw content, with reference tags still in-tact.
     *
     * @return string
     */
    public function getRawContent(): string
    {
        return $this->rawContent;
    }

    /**
     * Returns the parsed content, with reference tags returned as HTML links.
     *
     * @return string
     */
    public function getParsedContent(): string
    {
        return (string)$this;
    }
}
