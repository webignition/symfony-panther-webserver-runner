<?php

declare(strict_types=1);

namespace webignition\SymfonyPantherWebServerRunner;

use Symfony\Component\Panther\ProcessManager\WebServerManager;

class WebServerRunner
{
    private $webServerDir;
    private $options = [];

    /**
     * @var WebServerManager|null
     */
    private $webServerManager;

    /**
     * @param string $webServerDir
     * @param array<string, int|string> $options
     */
    public function __construct(string $webServerDir, array $options = [])
    {
        $this->webServerDir = $webServerDir;
        $this->options = array_merge(Options::getDefault(), $options);
    }

    public function start(): void
    {
        if (null === $this->webServerManager) {
            $this->webServerManager = $this->createWebServerManager();
            $this->webServerManager->start();
        }
    }

    public function stop(): void
    {
        if ($this->webServerManager instanceof WebServerManager) {
            $this->webServerManager->quit();
            $this->webServerManager = null;
        }
    }

    private function createWebServerManager(): WebServerManager
    {
        return new WebServerManager(
            $this->webServerDir,
            (string) $this->options['hostname'],
            (int) $this->options['port']
        );
    }
}
