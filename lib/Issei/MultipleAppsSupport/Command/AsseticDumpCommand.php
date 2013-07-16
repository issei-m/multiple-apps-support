<?php

namespace Issei\MultipleAppsSupport\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Dumps assets to the filesystem.
 *
 * @author Issei Murasawa <issei.m7@gmail.com>
 */
class AsseticDumpCommand extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('assetic:dump')
            ->setDescription('Dumps all assets to the filesystem')
            ->addArgument('write_to', InputArgument::OPTIONAL, 'Override the configured asset root')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function buildInputParameters(array $arguments, array $options, KernelInterface $kernel)
    {
        if (isset($arguments['write_to'])) {
            $arguments['write_to'] .= '/' . $kernel->getName();
        }

        return parent::buildInputParameters($arguments, $options, $kernel);
    }
}
