<?php
namespace PunktDe\PtExtbase\Utility\Git;

/***************************************************************
 *  Copyright (C) 2015 punkt.de GmbH
 *  Authors: el_equipo <opiuqe_le@punkt.de>
 *
 *  This script is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser General Public License as published
 *  by the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use PunktDe\PtExtbase\Utility\ShellCommandService;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Git Client
 *
 * @package PunktDe\PtExtbase\Utility\Git
 */
class GitClient implements SingletonInterface {

	/**
	 * @inject
	 * @var ObjectManager
	 */
	protected $objectManager;


	/**
	 * @inject
	 * @var ShellCommandService
	 */
	protected $shellCommandService;


	/**
	 * @inject
	 * @var \Tx_PtExtbase_Logger_Logger
	 */
	protected $logger;


	/**
	 * @var string
	 */
	protected $commandPath = '/usr/bin/git';


	/**
	 * @var string
	 */
	protected $repositoryRootPath = '~';



	/**
	 * @return void
	 */
	public function initializeObject() {
		$this->checkIfValidGitCommandIsAvailable();
	}



	/**
	 * @return void
	 * @throws \Exception
	 */
	protected function checkIfValidGitCommandIsAvailable() {
		$command = $this->objectManager->get('PunktDe\PtExtbase\Utility\Git\VoidCommand'); /** @var \PunktDe\PtExtbase\Utility\Git\VoidCommand $command */
		$command->setVersion(TRUE);
		if (!file_exists($this->commandPath) || strpos($this->execute($command), 'git') !== 0) {
			throw new \Exception("No valid git command found on system", 1422469432);
		}
	}



	/**
	 * @param StatusCommand $gitCommand
	 * @return string
	 */
	public function status(StatusCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param LogCommand $gitCommand
	 * @return string
	 */
	public function log(LogCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param AddCommand $gitCommand
	 * @return string
	 */
	public function add(AddCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param CommitCommand $gitCommand
	 * @return string
	 */
	public function commit(CommitCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param TagCommand $gitCommand
	 * @return string
	 */
	public function tag(TagCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param PushCommand $gitCommand
	 * @return string
	 */
	public function push(PushCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param InitCommand $gitCommand
	 * @return string
	 */
	public function init(InitCommand $gitCommand) {
		return $this->execute($gitCommand);
	}



	/**
	 * @param GitCommand $gitCommand
	 * @return string
	 */
	protected function execute($gitCommand) {
		return $this->shellCommandService->execute($this->renderCommand($gitCommand));
	}



	/**
	 * @param GitCommand $gitCommand
	 * @return string
	 */
	protected function renderCommand($gitCommand) {
		return sprintf('cd %s; %s %s', $this->repositoryRootPath, $this->commandPath, $gitCommand->render());
    }



	/**
	 * @param string $commandPath
	 */
	public function setCommandPath($commandPath) {
		$this->commandPath = $commandPath;
	}



	/**
	 * @param string $repositoryRootPath
	 */
	public function setRepositoryRootPath($repositoryRootPath) {
		$this->repositoryRootPath = $repositoryRootPath;
	}

}