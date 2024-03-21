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
 * Activity view page for the mod_hello plugin.
 *
 * @package   mod_hello
 * @copyright 2024 Chopa
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

global $USER;

$id = required_param('id', PARAM_INT);
[$course, $cm] = get_course_and_cm_from_cmid($id, 'hello');
$instance = $DB->get_record('hello', ['id'=> $cm->instance], '*', MUST_EXIST);

$context = context_module::instance($cm->id);
require_login($course, true, $cm); // Установка контекста и проверка авторизации

// Completion and trigger events.
page_view($instance, $course, $cm, $context);

$username = fullname($USER); // Получаем полное имя пользователя

// Собираем приветственное сообщение
$content = "Привет, $username!"; // Ваше приветственное сообщение

echo $OUTPUT->header();
echo $content;
echo $OUTPUT->footer();
 
 