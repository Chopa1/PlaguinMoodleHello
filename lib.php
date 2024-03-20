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
 * @package mod_page
 * @copyright  2009 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Определение списка функций, доступных из вне
function hello_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO: return true;
        default: return null;
    }
}

// Определение формы для добавления и редактирования экземпляров модуля
function hello_add_instance($hello) {
    global $DB;

    // Приведение данных формы к объекту stdClass
    $hello->timemodified = time();
    $hello->id = $DB->insert_record('hello', $hello);

    return $hello->id;
}

// Определение функции для обновления экземпляра модуля
function hello_update_instance($hello) {
    global $DB;

    // Приведение данных формы к объекту stdClass
    $hello->timemodified = time();
    $hello->id = $hello->instance;

    // Обновление данных экземпляра в базе данных
    $DB->update_record('hello', $hello);

    return true;
}

// Определение функции для удаления экземпляра модуля
function hello_delete_instance($id) {
    global $DB;

    if (!$hello = $DB->get_record('hello', array('id' => $id))) {
        return false;
    }

    $result = true;

    if (!$DB->delete_records('hello', array('id' => $hello->id))) {
        $result = false;
    }

    return $result;
}

// Определение списка возможных событий для плагина
function hello_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    return false;
}

// Определение списка доступных к редактированию полей модуля
function hello_get_coursemodule_info($coursemodule) {
    return null;
}

// Определение списка функций обратного вызова
function hello_extend_navigation_course($navigation, $course, $context) {
    return null;
}