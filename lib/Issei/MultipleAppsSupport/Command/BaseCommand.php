<?php

namespace Issei\MultipleAppsSupport\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Base Command.
 *
 * @author Issei.M <issei.m7@gmail.com>
 */
abstract class BaseCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appsDir = __DIR__ . '/../../../../../../../' . $input->getOption('apps-dir');
        if (!is_dir($appsDir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.'));
        }

        $env = $input->getParameterOption(array('--env', '-e'), getenv('SYMFONY_ENV') ?: 'dev');
        $debug = getenv('SYMFONY_DEBUG') !== '0' && !$input->hasParameterOption(array('--no-debug', '')) && $env !== 'prod';

        $finder = new Finder();
        $finder->in($appsDir)
               ->exclude('config')
               ->depth('== 1');

        foreach ($finder->name('*Kernel.php') as $file) {
            include_once $file->getRealpath();
            $kernelClass = substr(basename($file->getRealpath()), 0, -4); // trim the .php extension

            $kernel = new $kernelClass($env, $debug);
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $output->writeln(sprintf('Excuting command on <comment>%s</comment>...', $kernel->getName()));
            $application->run($this->createInputForKernel($input, $kernel));

            $kernel->shutdown();
        }
    }

    /**
     * Returns the new created input for kernel to be executed.
     *
     * @param  InputInterface  $input  The base input.
     * @param  KernelInterface $kernel The kernel that will be executed.
     * @return ArrayInput              The new input.
     */
    protected function createInputForKernel(InputInterface $input, KernelInterface $kernel)
    {
        return new ArrayInput($this->buildInputParameters($input->getArguments(), $input->getOptions(), $kernel));
    }

    /**
     * Processes the parameters which be used to create the new ArrayInput.
     *
     * @param  array           $arguments
     * @param  array           $options
     * @param  KernelInterface $kernel
     * @return array
     */
    protected function buildInputParameters(array $arguments, array $options, KernelInterface $kernel)
    {
        $parameters = $arguments;

        unset($options['apps-dir']);

        foreach ($options as $name => $option) {
            if (false !== $option) {
                $parameters['--' . $name] = $option;
            }
        }

        return $parameters;
    }
}
