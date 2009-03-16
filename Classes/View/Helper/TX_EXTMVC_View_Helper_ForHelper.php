<?php

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

require_once(t3lib_extMgm::extPath('extmvc') . 'Classes/View/Helper/TX_EXTMVC_View_Helper_AbstractHelper.php');

/**
 * A For Helper
 *
 * @version $Id:$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class TX_EXTMVC_View_Helper_ForHelper extends TX_EXTMVC_View_Helper_AbstractHelper {

	public function render($view, $content, $arguments, $templateSource, $variables) {
		if (is_array($arguments['each'])) {
			foreach ($arguments['each'] as $singleElement) {
				$variables[TX_EXTMVC_Utility_Strings::underscoredToUpperCamelCase($arguments['as'])] = $singleElement; // FIXME strtolower
				$newContent .= $view->renderTemplate($templateSource, $variables);
			}
		}
		return $newContent;
	}

}

?>