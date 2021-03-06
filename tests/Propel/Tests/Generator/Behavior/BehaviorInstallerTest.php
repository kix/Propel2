<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Propel\Tests\Generator\Behavior;

use Propel\Tests\TestCase;
use Propel\Generator\Util\BehaviorLocator;
use Propel\Generator\Config\QuickGeneratorConfig;

/**
 * Tests the table structure behavior hooks.
 *
 * @author Thomas Gossmann
 */
class BehaviorInstallerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        require_once(__DIR__ . '/../../../../Fixtures/behavior-installer/src/gossi/propel/behavior/l10n/L10nBehavior.php');
    }

    public function testBehaviorLocator()
    {
        $config = new QuickGeneratorConfig();
        $config->setBuildProperty('builderComposerDir', __DIR__ . '/../../../../Fixtures/behavior-installer');
        $locator = new BehaviorLocator($config);
        
        // test found behaviors
        $behaviors = $locator->getBehaviors();
        $this->assertSame(1, count($behaviors));
        
        $this->assertTrue(array_key_exists('l10n', $behaviors));
        $this->assertSame('gossi/propel-l10n-behavior', $behaviors['l10n']['package']);
        
        // test class name
        $this->assertSame('\\gossi\\propel\\behavior\\l10n\\L10nBehavior', $locator->getBehavior('l10n'));
    }
}
