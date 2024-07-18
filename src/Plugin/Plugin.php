<?php

/**
 * PHP CS Fixer
 *
 * (c) onceyoungs <onceyoungs@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Onceyoungs\PhpCsFixer\Plugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Script\Event;
use Composer\Util\Filesystem;
use Composer\Plugin\PluginInterface;
use Composer\EventDispatcher\EventSubscriberInterface;

class Plugin implements PluginInterface, EventSubscriberInterface 
{
	/**
	 * @var \Composer\Composer
	 */
	protected $composer;

	/**
	 * @var \Composer\IO\IOInterface
	 */
	protected $io;

	/**
	 * Apply plugin modifications to Composer
	 *
	 * @param Composer    $composer
	 * @param IOInterface $io
	 */
	public function activate(Composer $composer, IOInterface $io) {
		$this->composer = $composer;
		$this->io = $io;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents() {
		return ['post-autoload-dump' => 'install'];
	}

	public static function install(Event $event) {
		$plugin = new static();
		$plugin->activate($event->getComposer(), $event->getIO());
		$plugin->setGitPreCommitHook();
	}

	public function uninstall(Composer $composer, IOInterface $io) {
	}

	public function deactivate(Composer $composer, IOInterface $io) {
	}

	public function setGitPreCommitHook() {
		$config = $this->composer->getConfig();
		$fileSystem = new Filesystem();

		$projectDir = dirname($fileSystem->normalizePath(realpath(realpath($config->get('vendor-dir')))));
		if (!file_exists($projectDir . '/.php-cs-fixer.php')) {
			$fileSystem->copy(dirname(__DIR__) . '/Helper/.php-cs-fixer.php', $projectDir . '/.php-cs-fixer.php');
		}

		$hookDir = $projectDir . '/.git/hooks/';
		if (!file_exists($hookDir)) {
			return true;
		}

		$fixFileName = 'pre-commit-phpcsfixer-30';
		if (file_exists($hookDir . $fixFileName)) {
			return true;
		}

		$fileSystem->copy(dirname(__DIR__) . '/Helper/pre-commit-phpcsfixer', $hookDir . $fixFileName);
		$fileList[] = $hookDir . $fixFileName;

		if (file_exists($hookDir . 'pre-commit')) {
			file_put_contents($hookDir . 'pre-commit', "\n exec " . $hookDir . $fixFileName, FILE_APPEND);
		} else {
			file_put_contents($hookDir . 'pre-commit', "#!/bin/bash \n exec " . $hookDir . $fixFileName);
			$fileList[] = $hookDir . 'pre-commit';
		}
		$this->changeFilePermission($fileList);
	}

	private function changeFilePermission($fileList) {
		foreach ($fileList as $file) {
			try {
				chmod($file, 0777);
			} catch (\Throwable $e) {
				$this->io->writeError('php-cs-fixer: chmod 777 ' . $file . ' fail, Please do it manually');
			}
		}
	}
}
