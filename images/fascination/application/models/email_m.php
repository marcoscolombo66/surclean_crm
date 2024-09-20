<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_m extends CI_Model {
  public function __construct(){parent::__construct();}
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
   function insert_viaje($data) {
        $this->db->insert('viajes_sugeridos', $data);
		return $this->db->insert_id();
    }
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function enviaNotificacionEmail($desde, $para, $asunto, $mensaje, $adjuntos = array()) {
    $nombre = 'Quebracho, siempre con vos!';

    $this->load->library('email');
    $mail_config['smtp_host'] = 'mail.libreviaje.com';
    $mail_config['smtp_port'] = '587';
    $mail_config['smtp_user'] = 'admin@libreviaje.com';
    $mail_config['smtp_pass'] = '@Jero2022';
    $mail_config['protocol'] = 'smtp';
    $mail_config['mailtype'] = 'html';
    $mail_config['charset'] = 'utf-8';
    $mail_config['newline'] = "\r\n";  // Corregido: utiliza comillas dobles para interpretar correctamente los saltos de línea.

    $this->email->initialize($mail_config);	   
    $this->email->from($desde, $nombre);
    $this->email->to($para);
    $this->email->subject($asunto);
    $this->email->message($mensaje);	

    // Adjuntar archivos si hay alguno
    if (!empty($adjuntos)) {
        foreach ($adjuntos as $adjunto) {
            $this->email->attach($adjunto);
        }
    }

    $this->email->send();	
}	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
	
}
?>