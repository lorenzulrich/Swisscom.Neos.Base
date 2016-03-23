<?php
namespace Swisscom\Neos\Base\TYPO3CR\Migration\Transformations;

/*
 * This file is part of the TYPO3.TYPO3CR package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\TYPO3CR\Domain\Model\NodeData;
use TYPO3\TYPO3CR\Domain\Model\NodeDimension;
use TYPO3\TYPO3CR\Domain\Repository\ContentDimensionRepository;

/**
 * Rename a dimensionValue.
 */
class RenameDimensionValue extends \TYPO3\TYPO3CR\Migration\Transformations\AbstractTransformation
{

    /**
     * The  name for the dimension.
     *
     * @var string
     */
    protected $dimensionName;

    /**
     * The old name for the dimension.
     *
     * @var string
     */
    protected $oldDimensionValue;

    /**
     * The new name for the dimension.
     *
     * @var string
     */
    protected $newDimensionValue;

    /**
     * @return string
     */
    public function getOldDimensionValue()
    {
        return $this->oldDimensionValue;
    }

    /**
     * @param string $oldDimensionValue
     */
    public function setOldDimensionValue($oldDimensionValue)
    {
        $this->oldDimensionValue = $oldDimensionValue;
    }

    /**
     * @return string
     */
    public function getNewDimensionValue()
    {
        return $this->newDimensionValue;
    }

    /**
     * @param string $newDimensionValue
     */
    public function setNewDimensionValue($newDimensionValue)
    {
        $this->newDimensionValue = $newDimensionValue;
    }

    /**
     * @return string
     */
    public function getDimensionName()
    {
        return $this->dimensionName;
    }

    /**
     * @param string $dimensionName
     */
    public function setDimensionName($dimensionName)
    {
        $this->dimensionName = $dimensionName;
    }

    /**
     * Change the property on the given node.
     *
     * @param \TYPO3\TYPO3CR\Domain\Model\NodeData $nodeData
     * @return void
     */

    public function execute(NodeData $nodeData)
    {
        $dimensions = $nodeData->getDimensions();
        if ($dimensions !== array()) {
            $hasChanges = false;
            $newDimensions  = array();
            foreach ($dimensions as $dimension) {
                /** @var NodeDimension $dimension */
                if ($dimension->getName() === $this->dimensionName && $dimension->getValue() === $this->oldDimensionValue) {
                    $dimension->setValue($this->newDimensionValue);
                    $dimension = new NodeDimension($dimension->getNodeData(), $this->dimensionName, $this->newDimensionValue);
                    $hasChanges = true;
                }
                $newDimensions[] = $dimension;
            }
            if ($hasChanges) {
                $nodeData->setDimensions($newDimensions);
            }
        }
    }
}
