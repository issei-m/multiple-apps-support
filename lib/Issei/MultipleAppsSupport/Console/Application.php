<?php

namespace Issei\MultipleAppsSupport\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputOption;

use Issei\MultipleAppsSupport\Command\CacheClearCommand;
use Issei\MultipleAppsSupport\Command\AssetsInstallCommand;
use Issei\MultipleAppsSupport\Command\AsseticDumpCommand;

/**
 * Application.
 *
 * @author Issei Murasawa <issei.m7@gmail.com>
 */
class Application extends BaseApplication
{
    const VERSION = '1.0';

    /**
     * Constructor.
     *
     * @param KernelInterface $kernel A KernelInterface instance
     */
    public function __construct()
    {
        parent::__construct('Symfony - Multiple apps console', self::VERSION);

        $this->getDefinition()->addOption(new InputOption('--apps-dir', null, InputOption::VALUE_REQUIRED, 'The Environment name.', 'apps'));
        $this->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
        $this->getDefinition()->addOption(new InputOption('--no-debug', null, InputOption::VALUE_NONE, 'Switches off debug mode.'));

        $this->add(new CacheClearCommand);
        $this->add(new AssetsInstallCommand);
        $this->add(new AsseticDumpCommand);
    }
}
