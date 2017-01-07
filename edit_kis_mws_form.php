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
 * Defines the editing form for the kis_mws question type.
 *
 * @package    qtype
 * @subpackage kis_mws
 * @copyright  2017 Igor Karpukhin
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * kis_mws question type editing form.
 *
 * @copyright  2017 Igor Karpukhin
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_kis_mws_edit_form extends question_edit_form {

    protected function definition_inner($mform) {
    	global $PAGE;
    	$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery-1.8.3.min.js',true);
    	$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery-ui/ui/jquery-ui.min.js',true);
    	$PAGE->requires->js('/question/type/kis_mws/jquery.sheet/jquery.sheet.js',true);
    	//    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-ui/theme/jquery-ui.min.css\" />
    	$PAGE->requires->css('/question/type/kis_mws/jquery.sheet/jquery-ui/theme/jquery-ui.min.css',true);
    	 
        $qtype = question_bank::get_qtype('kis_mws');

        $mform->addElement('text', 'hint',
        		get_string('hint', 'qtype_kis_mws')); //TODO
        $mform->addElement('html',$this->insert_ss());
        
        $mform->addElement('header', 'responseoptions', get_string('responseoptions', 'qtype_kis_mws'));
        $mform->setExpanded('responseoptions');

        $mform->addElement('select', 'responseformat',
                get_string('responseformat', 'qtype_kis_mws'), $qtype->response_formats());
        $mform->setDefault('responseformat', 'editor');

        $mform->addElement('select', 'responserequired',
                get_string('responserequired', 'qtype_kis_mws'), $qtype->response_required_options());
        $mform->setDefault('responserequired', 1);
        $mform->disabledIf('responserequired', 'responseformat', 'eq', 'noinline');

        $mform->addElement('select', 'responsefieldlines',
                get_string('responsefieldlines', 'qtype_kis_mws'), $qtype->response_sizes());
        $mform->setDefault('responsefieldlines', 15);
        $mform->disabledIf('responsefieldlines', 'responseformat', 'eq', 'noinline');

        $mform->addElement('select', 'attachments',
                get_string('allowattachments', 'qtype_kis_mws'), $qtype->attachment_options());
        $mform->setDefault('attachments', 0);

        $mform->addElement('select', 'attachmentsrequired',
                get_string('attachmentsrequired', 'qtype_kis_mws'), $qtype->attachments_required_options());
        $mform->setDefault('attachmentsrequired', 0);
        $mform->addHelpButton('attachmentsrequired', 'attachmentsrequired', 'qtype_kis_mws');
        $mform->disabledIf('attachmentsrequired', 'attachments', 'eq', 0);

        $mform->addElement('header', 'responsetemplateheader', get_string('responsetemplateheader', 'qtype_kis_mws'));
        $mform->addElement('editor', 'responsetemplate', get_string('responsetemplate', 'qtype_kis_mws'),
                array('rows' => 10),  array_merge($this->editoroptions, array('maxfiles' => 0)));
        $mform->addHelpButton('responsetemplate', 'responsetemplate', 'qtype_kis_mws');

        $mform->addElement('header', 'graderinfoheader', get_string('graderinfoheader', 'qtype_kis_mws'));
        $mform->setExpanded('graderinfoheader');
        $mform->addElement('editor', 'graderinfo', get_string('graderinfo', 'qtype_kis_mws'),
                array('rows' => 10), $this->editoroptions);
    }

    function insert_ss() {
    	//$hint = $this->question->options->hint;
    	//if ( empty($hint) )
//    	<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-1.8.3.min.js\"></script>
//    	<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-ui/ui/jquery-ui.min.js\"></script>
//    	<script type=\"text/javascript\" src=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery.sheet.js\"></script>
//    	<link rel=\"stylesheet\" type=\"text/css\" href=\"".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/jquery-ui/theme/jquery-ui.min.css\" />
    	$hint='[{"title":"Sheet 1","rows":[{"height":"18px","columns":[{"value":"1"},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]},{"height":"18px","columns":[{},{},{},{},{}]}],"metadata":{"widths":["120px","120px","120px","120px","120px"],"frozenAt":{"row":0,"col":0}}}]';
    	global $CFG;
    	$hint_ss = "</br>
    	<script type=\"text/javascript\">
    	
			$.sheet.preLoad('".$CFG->wwwroot ."/question/type/kis_mws/jquery.sheet/');
		
            $(function() {
				var h;
				h = $('#id_hint').val();
				if (!h) {
					h='$hint';
					}
				if (h) {
				//alert(h);
				var json = jQuery.parseJSON(h);
                var tables = $.sheet.dts.toTables.json(json);

                $('#sheetParentPlantilla').html(tables).sheet();
						} else {
				alert(h+'!!!');
						$('#sheetParentPlantilla').sheet();
						}
                $(\"form\").submit(function(){
					var jS = $(\"#sheetParentPlantilla\").getSheet();
					var json;
                  json = $.sheet.dts.fromTables.json(jS);
                  $(\"#id_hint\").val(JSON.stringify(json));
                });
            });
        </script>
        <style>
            #id_hint{
                width:800px;
            }
		</style>
    	
        <div id='general' style='margin-top: -33px;'>
            <div id='sheetParentPlantilla' title='SpreadSheet' style='height: 315px; width: 666px; margin-left: 265px;'>
            </div>
		</div>
    	
";
    	return $hint_ss;
    }
    
    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);

        if (empty($question->options)) {
            return $question;
        }

        $question->responseformat = $question->options->responseformat;
        $question->responserequired = $question->options->responserequired;
        $question->responsefieldlines = $question->options->responsefieldlines;
        $question->attachments = $question->options->attachments;
        $question->attachmentsrequired = $question->options->attachmentsrequired;

        $draftid = file_get_submitted_draft_itemid('graderinfo');
        $question->graderinfo = array();
        $question->graderinfo['text'] = file_prepare_draft_area(
            $draftid,           // Draftid
            $this->context->id, // context
            'qtype_kis_mws',      // component
            'graderinfo',       // filarea
            !empty($question->id) ? (int) $question->id : null, // itemid
            $this->fileoptions, // options
            $question->options->graderinfo // text.
        );
        $question->graderinfo['format'] = $question->options->graderinfoformat;
        $question->graderinfo['itemid'] = $draftid;

        $question->responsetemplate = array(
            'text' => $question->options->responsetemplate,
            'format' => $question->options->responsetemplateformat,
        );

        return $question;
    }

    public function validation($fromform, $files) {
        $errors = parent::validation($fromform, $files);

        // Don't allow both 'no inline response' and 'no attachments' to be selected,
        // as these options would result in there being no input requested from the user.
        if ($fromform['responseformat'] == 'noinline' && !$fromform['attachments']) {
            $errors['attachments'] = get_string('mustattach', 'qtype_kis_mws');
        }

        // If 'no inline response' is set, force the teacher to require attachments;
        // otherwise there will be nothing to grade.
        if ($fromform['responseformat'] == 'noinline' && !$fromform['attachmentsrequired']) {
            $errors['attachmentsrequired'] = get_string('mustrequire', 'qtype_kis_mws');
        }

        // Don't allow the teacher to require more attachments than they allow; as this would
        // create a condition that it's impossible for the student to meet.
        if ($fromform['attachments'] != -1 && $fromform['attachments'] < $fromform['attachmentsrequired'] ) {
            $errors['attachmentsrequired']  = get_string('mustrequirefewer', 'qtype_kis_mws');
        }

        return $errors;
    }

    public function qtype() {
        return 'kis_mws';
    }
}
