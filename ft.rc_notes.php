<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rc_notes_ft extends EE_Fieldtype {

    var $info = array(
        'name'      => 'Red Carrot Notes',
        'version'   => '1.1'
    );

    // --------------------------------------------------------------------
	
	var $has_array_data = TRUE;
	
	

	function install()
	{
		return array(
			'title'  => '',
			'description' => '',
			'colour'      => '#E11842',
			'padding'      => '25px'
		);
	}
	
	function display_global_settings()
	{
	    $val = array_merge($this->settings, $_POST);
	
	    $form = form_label('Box Padding', 'padding').NBS.form_input('padding', $val['padding']).NBS.NBS.NBS.' ';
	
	    return $form;
	}
	
	function save_global_settings()
	{
	    return array_merge($this->settings, $_POST);
	}
	

	function save_settings($data)
	{
 		return array(
			'title'          => $this->EE->input->post('title'),
			'description'    => $this->EE->input->post('description'),
			'colour'         => $this->EE->input->post('colour')
		);
	}
	
	
	
	
	function display_settings($data)
	{
		$title	= isset($data['title']) ? $data['title'] : $this->settings['title'];
		$description	= isset($data['description']) ? $data['description'] : $this->settings['description'];
		$colour		= isset($data['colour']) ? $data['colour'] : $this->settings['colour'];

		$this->EE->table->add_row(
			lang('Title', 'title'),
			form_input('title', $title)
		);
		
		$this->EE->table->add_row(
			lang('Description', 'description'),
			form_input('description', $description)
		);
		
		$this->EE->table->add_row(
			lang('Colour', 'colour'),
			form_input('colour', $colour)
		);

	}
	
		
	function display_field($data)
	{
		$data_points = array('title', 'description', 'colour', 'padding');
		
		if ($data)
		{
			list($title, $description, $colour, $padding) = explode('|', $data);
		}
		else
		{
			foreach($data_points as $key)
			{
				$$key = $this->settings[$key];
			}
		}
		
		$prototype = '<div class="rc-note" style="background: '.$colour.'; color: #fff; padding: '. $padding .'; margin-top: 50px; border-bottom: #2d4a5d 2px solid;">';
		$prototype .= '<h3 style="color: #fff; margin: 0;">'. $title .'</h3>';
		$prototype .= '<p style="color: #fff;">'.$description.'</p>';
		$prototype .= '</div>';
		$prototype .= '<style type="text/css">.publish_rc_notes .hide_field, .publish_rc_notes .instruction_text { display: none; } .publish_rc_notes fieldset.holder { margin: 0 !important; padding: 0; } .publish_rc_notes p { line-height: 20px; font-size: 13px; } .publish_rc_notes h3 { font-size: 22px !important; } .publish_rc_notes { border: none; } .publish_rc_notes:first-of-type .rc-note, #hold_field_120 .rc-note { margin-top: 0px !important; }</style>';
		return $prototype;
	}

}