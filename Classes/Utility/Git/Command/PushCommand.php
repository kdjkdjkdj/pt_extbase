<?php
namespace PunktDe\PtExtbase\Utility\Git\Command;

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

use PunktDe\PtExtbase\Utility\GenericShellCommandWrapper\GenericShellCommand;

/**
 * Push Command
 *
 * @package PunktDe\PtExtbase\Utility\Git\Command
 */
class PushCommand extends GenericShellCommand
{
    /**
     * A list of allowed git command options
     *
     * @var array
     */
    protected $argumentMap = [
        'tags' => '--tags',
        'remote' => '%s',
        'refspec' => '%s'
    ];


    /**
     * @var array
     */
    protected $arguments = [
        'tags' => false,
        'remote' => '',
        'refspec' => ''
    ];



    /**
     * @return $this
     */
    public function setTags()
    {
        $this->arguments['tags'] = true;
        return $this;
    }



    /**
     * @param string $remote
     * @return $this
     */
    public function setRemote($remote)
    {
        $this->arguments['remote'] = $remote;
        return $this;
    }



    /**
     * @param string $refspec
     * @return $this
     */
    public function setRefspec($refspec)
    {
        $this->arguments['refspec'] = $refspec;
        return $this;
    }
}
