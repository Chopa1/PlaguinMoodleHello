<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Page configuration form
 *
 * @package mod_hello
 * @copyright  2024 Chopa
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/course/moodleform_mod.php');
// Определение класса плагина
class mod_hello_mod_form extends moodleform_mod {

    // Определение формы для редактирования параметров модуля
    function definition() {
        global $CFG, $DB;

        // Получение формы
        $mform =& $this->_form;

        // Добавление элемента названия модуля
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('name'), array('size'=>'48'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        // Добавление кнопки сохранения
        $this->standard_coursemodule_elements();

        // Добавление элемента для отображения "привет" в модуле
        $mform->addElement('static', 'hellogreeting', get_string('hellogreeting', 'hello'), 'Привет!');

        // Добавление скрытых элементов
        $mform->addElement('hidden', 'intro', 0);
        $mform->setType('intro', PARAM_INT);

        // Добавление кнопки сохранения
        $this->add_action_buttons();
    }
}

