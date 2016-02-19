<?php
namespace Swisscom\Neos\Base\TYPO3CR\Migration\Filters;

/*
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;

/**
 * Filter nodes by node name.
 */
class NodeParentPath implements \TYPO3\TYPO3CR\Migration\Filters\FilterInterface
{
    /**
     * The node name to match on.
     *
     * @var string
     */
    protected $nodeParentPath;

    /**
     * Sets the node parentpath to match on.
     *
     * @param string $nodeParentPath
     * @return void
     */
    public function setNodeParentPath($nodeParentPath)
    {
        $this->nodeParentPath = $nodeParentPath;
    }

    /**
     * Returns TRUE if the given node has the parentpath this filter expects.
     *
     * @param \TYPO3\TYPO3CR\Domain\Model\NodeData $node
     * @return boolean
     */
    public function matches(\TYPO3\TYPO3CR\Domain\Model\NodeData $node)
    {
        return $node->getParentPath() === $this->nodeParentPath;
    }
}
