<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Christopher Hlubek <hlubek@networkteam.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class Tx_ExtBase_Persistence_Repository_testcase extends Tx_ExtBase_Base_testcase {
	public function __construct() {
		require_once(t3lib_extMgm::extPath('blogexample', 'Classes/Domain/Model/BlogRepository.php'));
	}

	public function test_FindDelegatesToObjectRelationalMapperBuildQueryAndFetch() {
		$repository = new Tx_BlogExample_Domain_Model_BlogRepository();
		$repository->dataMapper = $this->getMock('Tx_ExtBase_Persistence_Mapper_ObjectRelationalMapper', array('buildQuery', 'fetch'), array(), '', FALSE);
		$repository->dataMapper->expects($this->once())
			->method('buildQuery')
			->with($this->equalTo('Tx_BlogExample_Domain_Model_Blog'), $this->equalTo('foo'))
			->will($this->returnValue('query'));
		$repository->dataMapper->expects($this->once())
			->method('fetch')
			->with($this->equalTo('Tx_BlogExample_Domain_Model_Blog'), $this->equalTo('query'))
			->will($this->returnValue(array()));
		
		$result = $repository->findByConditions('foo');
		$this->assertEquals(array(), $result);
	}

	public function test_MagicFindByPropertyUsesGenericFind() {
		$repository = $this->getMock('Tx_BlogExample_Domain_Model_BlogRepository', array('findByConditions'), array('Tx_BlogExample_Domain_Model_Blog'));
		$repository->expects($this->once())
			->method('findByConditions')
			->with($this->equalTo(array('name' => 'foo')))
			->will($this->returnValue(array()));
		
		$repository->findByName('foo');
	}

	public function test_MagicFindOneByPropertyUsesGenericFind() {
		$repository = $this->getMock('TX_Blogexample_Domain_Model_BlogRepository', array('findByConditions'), array('Tx_BlogExample_Domain_Model_Blog'));
		$repository->expects($this->once())
			->method('findByConditions')
			->with($this->equalTo(array('name' => 'foo')), $this->equalTo(''), $this->equalTo(''), $this->equalTo(1))
			->will($this->returnValue(array()));
		
		$repository->findOneByName('foo');
	}
}
?>